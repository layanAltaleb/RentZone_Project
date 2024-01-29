
<!DOCTYPE html>
<html>
<head>
        <title>Login</title> 
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/Login.css"> <script src="https://kit.fontawesome.com/b23f7a360e.js" crossorigin="anonymous"></script>
</head>
    <body>
        <header>
            <img src="img/RentZoneLogo.png" alt="logo" height="200" width="200">
        </header>
        <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
       
        <form method="post" action="login_handler.php" id="loginForm">
            <h3>Login </h3>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br>

            <label id="r" for="role">Role:</label><br>
            <select id="role" name="role">
                <option value="HomeSeeker">Home Seeker</option>
                <option value="HomeOwner">Home Owner</option>
            </select><br><br>
            <?php if (isset($_GET['ERROR'])): ?>
            <p style="color: red;"><?php echo $_GET['ERROR'];  ?></p>
            <?php endif; ?>
            
            <input type="submit" value="Login">
        </form>
    </body>
</html>