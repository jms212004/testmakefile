<?php

use jms212004\testmakefile\Deduplication;

include_once 'Deduplication.php';

$people = [
    ["name" => "John", "email" => "john@example.com"],
    ["name" => "Jane", "email" => "jane@example.com"],
    ["name" => "John", "email" => "john@example.com"],
    ["name" => "Bob", "email" => "bob@example.com"],
    ["name" => "Jane", "email" => "jane@example.com"],
];

//instantiating a new class
$deduplication = new Deduplication();

$result = $deduplication->detectedDuplication($people);

print_r($result);
