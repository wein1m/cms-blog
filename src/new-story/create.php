<?php
require_once "../koneksi.php";
require_once "../helpers/db.php";

try {
    $conn->beginTransaction();

    $title = $_POST["title"];
    $img_url = $_POST["img_url"];
    $content = $_POST["content"];
    $category = $_POST["category"];
    $tags = $_POST["tags"];

    $slug = strtolower(trim($title));
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    $slug = trim($slug, '-');

    $tag_ids = explode(",", $tags);

    db_query("
        INSERT INTO artikel
        (title, slug, content, img_cover,  id_kategori)
        VALUES
        (?, ?, ?, ?, ?)
    ", [$title, $slug, $content, $img_url, $category]);

    $artikel_id = $conn->lastInsertId();

    foreach ($tag_ids as $tag_id) {
        db_query("
            INSERT INTO artikel_tag (artikel_id, tag_id)
            VALUES (?, ?)
        ", [$artikel_id, $tag_id]);
    }

    $conn->commit();

    header("Location: ../index.php");
}
catch (PDOException $e) {
    $conn->rollback();
    echo "Failed to create new story " . $e->getMessage();
}
