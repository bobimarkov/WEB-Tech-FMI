<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>DB PHP EXERCISE</title>
</head>
<body>
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        $title = $description = $lecturer = "";
        $id = "";

        if (array_key_exists("id", $_GET) && !empty($_GET["id"])) {
            $id = htmlspecialchars($_GET["id"]);
            $url = 'http://localhost/mystuff/ex4/server.php/' . $id;

            $options = array(
                'http' => array(
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'GET'
                )
            );

            $context = stream_context_create($options);
            $result = json_decode(file_get_contents($url, false, $context), true);

            if (!empty($result)) {
                $result = $result[0];

                $title = $result["TITLE"];
                $description = $result["DESCRIPTION"];
                $lecturer = $result["LECTURER"];
            }
        }
    }

    ?>

        <section>
            <form id="form1" method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>"  >
                <input type="number" name="id" id="id" placeholder="ID" pattern="^[\d]*$" min="1" value="<?php echo $id?>" >
                <input type="submit" id="submit" value="Load Elective">
            </form>
            <form id="form2" method="POST" action="<?php echo "server.php/" . $id ?>" >
                <input type="text" name="title" id="title" placeholder="Title" pattern="^[a-zA-Z]{,128}$" value="<?php echo $title ?>" required>
                <textarea name="description" id="description" placeholder="Description" pattern="^[a-zA-Z]{,1024}$" required><?php echo $description ?></textarea>
                <input type="text" name="lecturer" id="lecturer" placeholder="Lecturer" pattern="^[a-zA-Z]{,128}$" value="<?php echo $lecturer ?>" required>
                <input type="submit" id="submit" value="Submit">
            </form>
        </section>
</body>
</html>