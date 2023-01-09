<?php
        session_start();

        $disciplineErr = $teacherErr = $descriptionErr = $groupErr = $creditsErr = "";
        $discipline = $teacher = $description = $group = $credits = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $discipline = $_POST['discipline'];
            $teacher = $_POST['teacher'];
            $description = $_POST['description'];
            $group = $_POST['group'];
            $credits = $_POST['credits'];

            if (strlen($discipline) > 150 || empty($discipline)) {
                $disciplineErr = "Името на дисциплината е твърде дълго или липсва!";
                echo $disciplineErr . "<br>";
            }
            if (strlen($teacher) > 150 || empty($teacher)) {
                $teacherErr = "Името на преподавателя е твърде дълго или липсва!";
                echo $teacherErr . "<br>";
            }
            if (strlen($description) < 10 || empty($description)) {
                $descriptionErr = "Описанието е твърде кратко или липсва!";
                echo $descriptionErr . "<br>";
            }
            if ($group !== "М" && $group !== "ПМ" && $group !== "ОКН" && $group !== "ЯКН") {
                $groupErr = "The chosen group is invalid!";
                echo $groupErr . "<br>";
            }
            if ($credits < 0) {
                $creditsErr = "The credits number is negative!";
                echo $creditsErr . "<br>";
            }
            
            if ($disciplineErr === "" && $teacherErr === "" && $descriptionErr === "" && $groupErr === "" && $creditsErr === "") {
                $_SESSION['discipline'] = $discipline;
                $_SESSION['teacher'] = $teacher;
                $_SESSION['description'] = $description;
                $_SESSION['group'] = $group;
                $_SESSION['credits'] = $credits;
            }

            echo "Data: ";
            print_r($_SESSION);
        }
?>