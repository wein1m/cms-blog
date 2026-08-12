<?php
require_once "head.php";


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

<section class="w-full">
    <div class="title">
        <h1> From the pages of Shiori.</h1>
        <h3>Stories, thoughts & discoveries.</h3>
    </div>

    <div class="px-32 grid grid-cols-3 gap-14">
        <?php
        $query = "SELECT * FROM artikel ORDER BY created_at DESC";
        $result = $conn->query($query);
        $rows = $result->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $row):
        ?>
        <a href="./story/<?= $row['slug'] ?>" class="flex flex-col tracking-wide">
            <img src="<?= $row['img_cover'] ?>"
                class="shadow-lg mb-4" />
            <h5 class="text-2xl font-semibold leading-tight mb-2 line-clamp-2"><?= $row['title'] ?></h5>
            <p class="line-clamp-2"><?= strip_tags($row['content']); ?></p>
            <p class="mt-4 text-gray-800 font-semibold">
                <?php GetDateCategory($row['created_at'], $row['id']); ?>
            </p>
        </a>
        <?php endforeach; ?>
    </div>

    <div class="relative flex flex-row w-full justify-center mt-32 page-number pb-32">
        <a class="scale-x-[-1] flex items-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
        <a>1</a>
        <a>2</a>
        <a>3</a>
        <div class="flex flex-row gap-1 items-center p-4">
            <div class="h-1 w-1 bg-text-primary rounded-full"></div>
            <div class="h-1 w-1 bg-text-primary rounded-full"></div>
            <div class="h-1 w-1 bg-text-primary rounded-full"></div>
        </div>
        <a>11</a>
        <a class="flex items-center">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>
</section>

<?php
include_once "foot.php";
?>
