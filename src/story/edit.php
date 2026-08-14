<?php
require_once "../koneksi.php";
require_once "../helpers/db.php";

try {
    $conn->beginTransaction();

    $old_slug = $_POST["old_slug"];

    $title = $_POST["title"];
    $img_url = $_POST["img_url"];
    $content = $_POST["content"];
    $category = $_POST["category"];
    $tags = $_POST["tags"];

    $artikel_id = db_fetch_col("
        SELECT id FROM artikel WHERE slug = ?
    ", [$old_slug]);

    if (!$artikel_id) {
        http_response_code(404);
        die("Story not found.");
    }

    $slug = strtolower(trim($title));
    $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
    $slug = trim($slug, '-');

    $query = "
        UPDATE artikel
        SET title = ?, slug = ?, content = ?, img_cover = ?, id_kategori = ?
        WHERE slug = ?
    ";

    db_query($query, [
        $title,
        $slug,
        $content,
        $img_url,
        $category,
        $old_slug
    ]);

    // remove old tags (since it's PK which is unique)
    db_query("
        DELETE FROM artikel_tag
        WHERE artikel_id = ?
    ", [$artikel_id]);

    $tag_ids = explode(",", $tags);

    foreach ($tag_ids as $tag_id) {
        db_query("
            INSERT INTO artikel_tag (artikel_id, tag_id)
            VALUES (?, ?)
        ", [$artikel_id, $tag_id]);
    }

    $conn->commit();

    header("Location: ./$slug");
}
catch (PDOException $e) {
    $conn->rollback();
    echo "Failed to create new story " . $e->getMessage();
}
