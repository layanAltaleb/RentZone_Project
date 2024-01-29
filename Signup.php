<!DOCTYPE html>
<html>
  <head>
    <title>Home Seeker Sign Up</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/Signup.css">
    <script src="https://kit.fontawesome.com/b23f7a360e.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <header>
      <img src="img/RentZoneLogo.png" alt="logo" height="200" widt
           h="200">
    </header>
    <div class="background">
      <div class="shape"></div>
      <div class="shape"></div>
    </div>
    
    <form action="signup_handler.php" method="post">
      <h1>Sign Up</h1>
      
      <?php if (isset($_GET['ERROR'])): ?>
      <p style="color: red;"><?php echo $_GET['ERROR'];  ?></p>
      <?php endif; ?>
      
      <label for="firstName">First Name:</label>
      <input type="text" id="firstName" name="firstName" pattern="[A-Za-z0-9 _]{3,}"
              title="the Name should be at lees 3 letters" required><br><br>

      <label for="lastName">Last Name:</label>
      <input type="text" id="lastName" name="lastName" pattern="[A-Za-z0-9 _]{3,}"
              title="the Name should be at lees 3 letters" required><br><br>

      <label for="age">Age:</label>
      <input type="number" id="age" name="age" min="18" max="99" required><br><br>

      <label for="familyMembers">Number of Family Members:</label>
      <input type="number" id="familyMembers" name="familyMembers" required><br><br>

      <label for="income">Income:</label>
      <input type="number" id="income" name="income" required><br><br>

      <label for="job">Job:</label>
      <input type="text" id="job" name="job" pattern="[A-Za-z0-9 _]{3,}"
              title="the Job should be at lees 3 letters" required><br><br>

      <label for="phone">Phone Number:</label>
      <input type="tel" id="phone" name="phone" pattern="[0]{1}[5]{1}[0-9]{8}"
            title="the phone number should start with 05 and contain 10 number in total like 05XXXXXXXX"
            required><br><br>

      <label for="email">Email Address:</label>
      <input type="email" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required ><br><br>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*_=+-]).{8,}"
            title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
            required><br><br>
      
          <label id="r" for="role">Role:</label><br>
    <select id="role" name="role">
        <option value="HomeSeeker">Home Seeker</option>
        <option value="HomeOwner">Home Owner</option>
    </select><br><br>

      <input type="submit" value="Sign Up" class="signup">
    </form>
    <br>
  </body>
</html>