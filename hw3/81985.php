<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $discipline = $teacher = $description = $group = $credits = "";

    $errors = [];
    $result = ["success" => true];

    if (array_key_exists("discipline", $data)) {
        $discipline = $data["discipline"];
    } else {
        $disciplineErr = "Името на дисциплината е задължително поле.";
        $errors += ["discipline" => $disciplineErr];
    }
    if (array_key_exists("teacher", $data)) {
        $teacher = $data["teacher"];
    } else {
        $teacherErr = "Името на преподавателя е задължително поле.";
        $errors += ["teacher" => $teacherErr];
    }
    if (array_key_exists("description", $data)) {
        $description = $data["description"];
    } else {
        $descriptionErr = "Описанието е задължително поле.";
        $errors += ["description" => $descriptionErr];
    }
    if (array_key_exists("group", $data)) {
        $group = $data["group"];
    } else {
        $groupErr = "Групата, към която спада дисциплината, е задължително поле.";
        $errors += ["group" => $groupErr];
    }
    if (array_key_exists("credits", $data)) {
        $credits = $data["credits"];
    } else {
        $creditsErr = "Броят на кредитите е задължително поле.";
        $errors += ["credits" => $creditsErr];
    }

    if (array_key_exists("discipline", $data) && !preg_match("/^.{2,150}$/", $discipline)) {
        $disciplineErr = "Името на дисциплината трябва да бъде с дължина между 2 и 150 символа. Сега е " . strlen($discipline) . ".";
        $errors += ["discipline" => $disciplineErr];
    }
    if (array_key_exists("teacher", $data) && !preg_match("/^.{3,200}$/", $teacher)) {
        $teacherErr = "Името на преподавателя трябва да бъде с дължина между 3 и 200 символа. Сега е " . strlen($teacher) . ".";
        $errors += ["teacher" => $teacherErr];
    }
    if (array_key_exists("description", $data) && !preg_match("/^.{10,}$/", $description)) {
        $descriptionErr = "Описанието трябва да бъде с дължина поне 10 символа. Сега е " . strlen($description) . ".";
        $errors += ["description" => $descriptionErr];
    }
    if (array_key_exists("group", $data) && $group !== "М" && $group !== "ПМ" && $group !== "ОКН" && $group !== "ЯКН") {
        $groupErr = "Невалидна група. Изберете между М, ПМ, ОКН и ЯКН.";
        $errors += ["group" => $groupErr];
    }
    if (array_key_exists("credits", $data) && !preg_match("/^([1-9]\d*)$/", $credits)) {
        $creditsErr = "Кредитите трябва да представляват цяло положително число";
        $errors += ["credits" => $creditsErr];
    }

    if (!empty($errors)) {
        $result["success"] = false;
        $result += ["errors" => $errors];
    }

    echo json_encode($result, JSON_UNESCAPED_UNICODE);
}
?>