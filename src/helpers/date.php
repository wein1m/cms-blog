<?php
function FormatDate($raw_date) {
    $date = date('M d, Y', strtotime($raw_date));
    return $date;
}

function GetDateCategory($raw_date, $article_id, $conn) {
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
