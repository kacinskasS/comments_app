<?php
function connectDb()
{
    @$db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATA);
    $db ->set_charset('utf8');
    if ($db->connect_errno) {
        // Custom error log here
        return false;
    }
    return $db;
}

function dbQuery($query, $types = [], $args = [], $mode = 'r', $lastId = false)
{
    // Check if types and arguments
    if (count($types) !== count($args)) {
        return ['fail' =>  __('Query parameters count failed.')];
    }

    // Most used steps to perform any query to db
    $db = connectDb();
    if (!$db) {
        return ['fail' => __('DB connection failed.')];
    }
    $run = $db->prepare($query);
    if (!$run) {
        return ['fail' => __('Bad query.')];
    }
    // If we have a parameterized query
    if (!empty($types) and !empty($args)) {
        $typeString = implode('', $types);
        @$bind = $run->bind_param($typeString, ...$args);
        if (!$bind) {
            return ['fail' => __('Parameters binding failed.')];
        }
    }
    // Exec query
    $exec = $run->execute();
    if (!$exec) {

        return ['fail' => __('Query execution failed.')];
    }
    // We have SELECT
    if ($mode === 'r') {
        $result = $run->get_result();
        $fetch  = $result->fetch_all(MYSQLI_ASSOC);
        $run->close();
        $db->close();
        return $fetch;
    }
    // We have INSERT or UPDATE and need last inserted id
    if ($lastId) {
        $lastId = $run->insert_id;
        $run->close();
        $db->close();
        return $lastId;
    }
    // We have INSERT, UPDATE, DELETE and do not need last inserted id
    return true;
}