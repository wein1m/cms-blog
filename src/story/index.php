<?php

require_once "../head.php";
require_once "../helpers/db.php";
include_once "../helpers/date.php";

$slug = $_GET["slug"];

if ($slug == '') {
    http_response_code(404);
    echo("Story not found.");
}

$article = db_fetch_row("
    SELECT * FROM artikel WHERE slug = ?
", [$slug]);

if (!$article) {
    http_response_code(404);
    echo("Story not found.");
}

$tags = db_fetch_col_arr("
    SELECT tag.name
    FROM artikel_tag
    JOIN tag
        ON artikel_tag.tag_id = tag.id
    WHERE artikel_tag.artikel_id = ?
", [$article["id"]]);
?>

<section id="story">
    <div id="confirmation-modal" class="hidden fixed inset-0 bg-black/50 z-999 items-center justify-center">
        <div id="confirmation-box" class="bg-white rounded-lg p-8 m-8">
            <h1 id="modal-title" class="text-3xl font-semibold">
                Confirmation
            </h1>

            <div class="pr-10 max-w-[24rem] my-4">
                <p id="modal-text-1" class="text-gray-800/80 text-xs md:text-sm leading-snug mb-2"></p>
                <p id="modal-text-2" class="text-gray-800/80 text-xs md:text-sm leading-snug"></p>
            </div>

            <div class="flex flex-wrap md:flex-nowrap flex-row gap-2 mt-4 w-full">
                <button type="button" id="modal-cancel"
                    class="rounded-sm w-full md:w-1/2 flex justify-center bg-[#e6e6f4] text-text-primary font-semibold px-4 py-2 hover:bg-[#cfcfd7] transition-colors duration-200 cursor-pointer">
                    Cancel
                </button>

                <a id="modal-confirm"
                    class="rounded-sm w-full md:w-1/2 flex justify-center bg-primary text-white font-semibold px-4 py-2 hover:bg-primary/90 transition-colors duration-200 cursor-pointer">
                    Confirm
                </a>
            </div>
        </div>
    </div>

    <div class="flex flex-col justify-center lg:items-center lg:text-center">
        <h1 class="title leading-snug"><?= $article["title"] ?></h1>
        <span class="lg:mt-4 text-left opacity-80 font-semibold tracking-wider">
            <?= FormatDate($article["created_at"]) ?> | Wein Salema Arbalest
        </span>

        <?php if ($isAdmin): ?>
        <div class="flex gap-4 mt-6">
            <!-- <a href="/cms-blog/src/story/edit/<?= $slug ?>" -->
            <button type="button" id="edit-story"
                class="flex items-center gap-2 border border-text-primary text-text-primary font-semibold px-4 py-2 hover:bg-text-primary hover:text-bg hover:cursor-pointer transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 20h9" />
                    <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z" />
                </svg>
                Edit Story
                </a>
                <button type="button" id="delete-story"
                    class="flex items-center gap-2 border border-primary text-primary font-semibold px-4 py-2 hover:bg-primary hover:text-white hover:cursor-pointer transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 6h18" />
                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                    </svg>
                    Delete Story
                </button>
        </div>
        <?php endif; ?>
    </div>

    <div class="flex flex-col justify-center mt-16">
        <img src="<?= $article['img_cover'] ?>" class="mb-4 rounded-lg lg:rounded-3xl" />
        <div class="font-gsans tracking-wider lg:mx-16 my-4 lg:text-lg">
            <?= $article["content"] ?>
        </div>

        <div class="lg:mx-16 my-2 flex gap-2 flex-wrap">
            <?php foreach($tags as $tag): ?>
            <a href="#" class="text-primary font-semibold px-3 py-1 border border-primary">
                # <?= $tag ?>
            </a>
            <?php endforeach; ?>
        </div>

        <div class="mt-32">
            <h5 class="text-5xl font-semibold mb-6">Related</h5>
            <div class="cards-grid">
                <?php
                $rows = db_fetch_all("
                    SELECT * FROM artikel
                    WHERE slug != ?
                    ORDER BY created_at DESC
                    LIMIT 3
                ", [$slug]);
                foreach ($rows as $row):
                ?>
                <a href="/cms-blog/src/story/<?= $row['slug'] ?>">
                    <div class="img-container">
                        <img src="<?= $row['img_cover'] ?>" />
                    </div>
                    <h5 class="text-2xl font-semibold leading-tight mb-2 line-clamp-2"><?= $row['title'] ?></h5>
                    <p class="line-clamp-2"><?= strip_tags($row['content']); ?></p>
                    <p class="mt-4 text-gray-800 font-semibold">
                        <?php GetDateCategory($row['created_at'], $row['id'], $conn); ?>
                    </p>
                </a>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</section>

<script>
const editURL = "/cms-blog/src/story/edit/<?= $slug ?>";
const deleteURL = "/cms-blog/src/story/delete.php?id=<?= $article['id'] ?>";
</script>
<script src="/cms-blog/assets/js/modal.js"></script>

<?php
include_once "../foot.php";
?>
