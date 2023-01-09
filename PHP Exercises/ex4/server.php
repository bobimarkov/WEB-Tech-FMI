<?php

require 'db.php';

function processInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

$database = new Db();
$titleErr = $descriptionErr = $lecturerErr = "";
$title = $description = $lecturer = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = processInput($_POST["title"]);
    $description = processInput($_POST["description"]);
    $lecturer = processInput($_POST["lecturer"]);

    if (mb_strlen($title) > 128 || mb_strlen($title) == 0) {
        $titleErr = "Title: Invalid length!";
    }
    if (mb_strlen($description) > 1024 || mb_strlen($description) == 0) {
        $descriptionErr = "Description: Invalid length!";
    }
    if (mb_strlen($lecturer) > 128 || mb_strlen($lecturer) == 0) {
        $lecturerErr = "Lecturer: Invalid length!";
    }

    if ($descriptionErr === "" && $lecturerErr === "" && $titleErr === "") {
        if (array_key_exists("PATH_INFO", $_SERVER)) {
            $ID = preg_split("/[\/]+/", trim(processInput($_SERVER["PATH_INFO"]), '/'))[0];
            $database -> updateDataByID($ID, $title, $description, $lecturer);
        } else {
            $database -> postData($title, $description, $lecturer);
        }
    } else {
        echo $titleErr . '\n' . $descriptionErr . '\n' . $lecturerErr;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (array_key_exists("PATH_INFO", $_SERVER)) {
        $ID = preg_split("/[\/]+/", trim(processInput($_SERVER["PATH_INFO"]), '/'))[0];
        echo json_encode($database->getDataByID($ID));
    }
}

?>