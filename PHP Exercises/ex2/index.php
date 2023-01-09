<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>PHP-CSS FORM EXERCISE - FN 81985</title>
    <script src="script.js"></script>
</head>
<body>
    <form method="POST" action="validate.php">
        <input type="text" name="discipline" placeholder="Име на предмета" >
        <input type="text" name="teacher" placeholder="Преподавател" >
        <input type="text" name="description" placeholder="Описание" >
        <select name="group">
            <option value="М">М</option>
            <option value="ПМ">ПМ</option>
            <option value="ОКН">ОКН</option>
            <option value="ЯКН">ЯКН</option>
        </select>
        <input type="number" name="credits" placeholder="Кредити" >
        <input type="submit" name="submit" value="Запиши">
    </form>
   
</body>
</html>