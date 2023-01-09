<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>JS PHP EXERCISE</title>
</head>

<body>
    <p id="result"></p>
    <section>
        <form id="form" method="POST" action="register.php" >
            <input type="text" name="username" id="username" placeholder="Username" minlength="3" maxlength="10" pattern="[a-zA-Z0-9_]+" required>
            <label id="username_error" for="username"></label>
            <input type="password" name="password" id="password" placeholder="Password" minlength="6" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$" required>
            <label id="password_error" for="password"></label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$" required>
            <label id="password_confirmation_error" for="password_confirmation"></label>
            <input type="submit" id="submit" value="Submit">
        </form>
    </section>
    
    <script src="script.js"></script>
</body>

</html>