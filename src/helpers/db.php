<?php

// just execute ;/
// execute prepared statement and returns the PDOStatement object
function db_query($query, $params = []): PDOStatement {
    global $conn;

    $stmt = $conn->prepare($query);
    $stmt->execute($params);
    return $stmt;
}

// maaany rows
// returns all matching rows as associative arrays
function db_fetch_all($query, $params = []): array {
    return db_query($query, $params)->fetchAll(PDO::FETCH_ASSOC);
}

// one row
// returns a single row as associative arrays
function db_fetch_row($query, $params = []): array|false {
    return db_query($query, $params)->fetch(PDO::FETCH_ASSOC);
}

// one value
// returns a single column value
function db_fetch_col($query, $params = []) {
    return db_query($query, $params)->fetchColumn();
}

// one column
// returns an entire column as flat array
function db_fetch_col_arr($query, $params = []): array {
    return db_query($query, $params)->fetchAll(PDO::FETCH_COLUMN);
}
