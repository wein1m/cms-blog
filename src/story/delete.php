<?php

require_once "../koneksi.php";
require_once "../helpers/db.php";

try {
    $conn->beginTransaction();

    $id = $_GET["id"];

    db_query("
        DELETE FROM artikel
        WHERE id = ?
    ", [$id]);

    $conn->commit();
    header("Location:../index.php");
}
catch (PDOException $e) {
    $conn->rollback();
    echo "Failed to delete story. " . $e->getMessage();
}
