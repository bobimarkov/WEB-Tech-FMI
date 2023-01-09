<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>PHP HW - FN 81985</title>
</head>
<body>
    <form id="form" method="POST">
        <input type="text" name="discipline" id="discipline" placeholder="Име на предмета" >
        <input type="text" name="teacher" id="teacher" placeholder="Преподавател" >
        <input type="text" name="description" id="description" placeholder="Описание" >
        <select name="group" id="group">
            <option value="М">М</option>
            <option value="ПМ">ПМ</option>
            <option value="ОКН">ОКН</option>
            <option value="ЯКН">ЯКН</option>
        </select>
        <input type="number" name="credits" id="credits" placeholder="Кредити" >
        <input type="submit" name="submit" value="Запиши">
    </form>
    
    <script src="script.js"></script>
</body>
</html>