<?php

include_once "../head.php";

$slug = $_GET["slug"];

if ($slug == '') {
    http_response_code(404);
    echo("Story not found.");
}

$query = "SELECT * FROM artikel WHERE slug = ?";

$stmt = $conn->prepare($query);
$stmt->execute([$slug]);

$article = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$article) {
    http_response_code(404);
    echo("Story not found.");
}

$tags_query = "
    SELECT tag.name
    FROM artikel_tag
    JOIN tag
        ON artikel_tag.tag_id = tag.id
    WHERE artikel_tag.artikel_id = ?
";

$stmt = $conn->prepare($tags_query);
$stmt->execute([$article["id"]]);

$tags = $stmt->fetchAll(PDO::FETCH_COLUMN);

function FormatDate($raw_date) {
    $date = date('M d, Y', strtotime($raw_date));
    return $date;
}
function GetDateCategory($raw_date, $article_id) {
    global $conn;

    $date = date('M d, Y', strtotime($raw_date));

    $category_query = "
        SELECT kategori.name
        FROM artikel
        JOIN kategori
            ON artikel.id_kategori = kategori.id
        WHERE artikel.id = ?;
    ";

    $stmt = $conn->prepare($category_query);
    $stmt->execute([$article_id]);

    $category = $stmt->fetch(PDO::FETCH_COLUMN);

    echo $date . ' | ' . $category;
}
?>

<section>
    <div class="flex flex-col justify-center items-center px-86 mt-24 text-center ">
        <h1 class="text-6xl mb-4 font-semibold"><?= $article["title"] ?></h1>
        <span class="mt-4 opacity-80 font-semibold tracking-wider">
            <?= FormatDate($article["created_at"]) ?> | Wein Salema Arbalest</span>

        <?php if ($isAdmin): ?>
        <div class="flex gap-4 mt-6">
            <a href="/cms-blog/src/story/edit/<?= $slug ?>" class="flex items-center gap-2 border border-text-primary text-text-primary font-semibold px-4 py-2 hover:bg-text-primary hover:text-bg transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 20h9"/>
                    <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"/>
                </svg>
                Edit Story
            </a>
            <button type="button" class="flex items-center gap-2 border border-primary text-primary font-semibold px-4 py-2 hover:bg-primary hover:text-white transition-colors duration-200 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 6h18"/>
                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                </svg>
                Delete Story
            </button>
        </div>
        <?php endif; ?>
    </div>

    <div class="flex flex-col justify-center mt-16 mx-86">
        <img src="<?= $article['img_cover'] ?>" class="mb-4 rounded-3xl" />
        <div class="font-gsans text-lg tracking-wider mx-16 my-4">
            <?= $article["content"] ?>
        </div>

        <div class="mx-16 my-2 flex gap-2">
            <?php foreach($tags as $tag): ?>
            <a href="#" class="text-primary font-semibold px-3 py-1 border border-primary">
                # <?= $tag ?>
            </a>
            <?php endforeach; ?>
        </div>

        <div>
            <a href="/cms-blog/src/index.php"
                class="mx-16 my-4 flex items-center gap-2 text-text-primary hover:text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 72 72">
                    <path fill="currentColor"
                        d="M22.788 51.534L5 35.036l17.788-16.498l3.789 4.076l-10.396 9.641H67v5.562H16.181l10.396 9.642z" />
                    <path fill="none" stroke="#000000" stroke-linecap="round" stroke-linejoin="round"
                        stroke-miterlimit="10" stroke-width="2"
                        d="M22.788 51.534L5 35.036l17.788-16.498l3.789 4.076l-10.396 9.641H67v5.562H16.181l10.396 9.642z" />
                </svg>
                Back to Home</a>
        </div>

        <div class="mt-32">
            <h5 class="text-5xl font-semibold mb-6">Related</h5>
            <div class="grid grid-cols-3 gap-14">
                <?php
                $query = "SELECT * FROM artikel
                          WHERE slug != ?
                          ORDER BY created_at DESC
                          LIMIT 3 ";
                $stmt = $conn->prepare($query);
                $stmt->execute([$slug]);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($rows as $row):
                ?>
                <a href="/cms-blog/src/story/<?= $row['slug'] ?>" class="flex flex-col tracking-wide">
                    <img src="<?= $row['img_cover'] ?>" class="shadow-lg mb-4" />
                    <h5 class="text-2xl font-semibold leading-tight mb-2 line-clamp-2"><?= $row['title'] ?></h5>
                    <p class="line-clamp-2"><?= strip_tags($row['content']); ?></p>
                    <p class="mt-4 text-gray-800 font-semibold">
                        <?php GetDateCategory($row['created_at'], $row['id']); ?>
                    </p>
                </a>
                <?php endforeach; ?>

            </div>

        </div>
    </div>
</section>

<?php
include_once "../foot.php";
?>
