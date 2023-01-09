<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <table>
        <?php
            $array = [];
            for ($i = 1; $i <= 9; $i++) {
                array_push($array, range($i, $i*9, $i));
            }
            echo "<tr>";
            foreach($array[0] as $value) {
                echo "<th class=\"cell\">$value</th>";
            }
            echo "</tr>";
            for ($i = 1; $i < 9; $i++) {
                echo "<tr>";
                for ($j = 0; $j < 9; $j++) {
                    if ($j == 0) {
                        echo "<th class=\"cell\">".$array[$i][$j]."</th>"; 
                    }
                    else {
                        echo "<td class=\"cell\">".$array[$i][$j]."</td>";
                    }
                }
                echo "</tr>";
            }
        ?>
    </table>
</body>
</html>