<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Call the desired function with the submitted data
    process_Data();
}

function process_Data() {
    echo "Hello";
}
