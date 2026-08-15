<?php
require_once "head.php";
require_once "helpers/date.php";
require_once "helpers/db.php";

?>

<section class="w-full">
    <div class="py-24 text-center font-gsans px-16">
        <h1 class="title text-4xl! font-bold">From the pages of Shiori.</h1>
        <h3 class="text-xl lg:text-2xl font-semibold">Stories, thoughts & discoveries.</h3>
    </div>

    <div class="px-6 lg:px-32 cards-grid">
        <?php
        $rows = db_fetch_all("SELECT * FROM artikel ORDER BY created_at DESC");
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
</section>

<?php
include_once "foot.php";
?>
