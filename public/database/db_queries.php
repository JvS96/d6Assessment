<?php
function retrieve_items(){
    include 'db_connection.php';

    $retrieve_items = 'SELECT id, name, rate FROM tech_items';

    $sql = mysqli_query($connection, $retrieve_items);

    $sql_data = [];

    while ($row = mysqli_fetch_assoc($sql)) {
        // Add each row to the data array
        $sql_data[] = $row;
    }

    return $sql_data;
}

function retrieve_services(){
    include 'db_connection.php';

    $retrieve_services = 'SELECT DISTINCT * FROM tech_services';

    $result = $connection->query($retrieve_services); // Execute the query

    $data = []; // Array to store the fetched data

    if ($result) {
        // Loop through the rows of the result set
        while ($row = $result->fetch_assoc()) {
            // Add each row to the data array
            $data[] = $row;
        }

        $result->free(); // Free the result set
    } else {
        die('Query failed: ' . $connection->error);
    }

    return $data;
}




