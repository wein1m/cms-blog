<?php

include_once "../koneksi.php";

try {
    $conn->beginTransaction();

    $id = $_GET["id"];

    $stmt = $conn->prepare("
        DELETE FROM artikel
        WHERE id = ?
    ");
    $stmt->execute([$id]);

    $conn->commit();
    header("Location:../index.php");
}
catch (PDOException $e) {
    $conn->rollback();
    echo "Failed to delete story. " . $e->getMessage();
}
