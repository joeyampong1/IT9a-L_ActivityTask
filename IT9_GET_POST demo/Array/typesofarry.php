<?php

// Associative array
echo "name: " . $student["name"] . "<br>";
echo "age: " . $student["age"] . "<br>";
echo "course: " . $student["course"] . "<br>";
$student = array(
    array("name" => "John", "age" => 21, "course" => "IT"),
    array("name" => "Jane", "age" => 20, "course" => "CS"),
    array("name" => "Doe", "age" => 22, "course" => "Math")
);

// Multidimensional array
echo $students[0]["name"] . ", br>";
echo $students[1]["course"] . ", br>";
echo $students[2]["age"] . ", br>";

$text = "apple,banana,orange";
$fruites1 = explode(",", $text);
print_r($fruites1);
echo "<br><br>";

$fruites2 = array("apple", "banana", "orange");
$text = implode(", ", $fruites2);
echo $text;


?>