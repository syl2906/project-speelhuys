      <?php

      include "sessie.php";
      include "gebruiker.php";

      if (isset($_POST["gebruiker"])) {
        $gebruiker = User::allUsers($_POST["gebruiker"], $_POST["wachtwoord"]);

        if ($gebruiker == null) {
          header("location: index.php");

          exit;
        } else {
          $key = md5(uniqid(rand(), true));

          $sessie = new Sessie ();
          $sessie->userId = $gebruiker->userId;
          $sessie->key = $key;
          $sessie->start =  date("Y-m-d H:i:s");
          $sessie->end =  date("Y-m-d H:i:s", strtotime("+1 month"));
          $sessie->insert();

          setcookie("speelhuys-session", $key, strtotime("1 month"), "/");
          header("location: ../admin/overzichtpakketten.php");
        }
      }
      ?>
      <!DOCTYPE html>
      <html lang="en">

      <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Form in HTML and CSS | Codehal</title>
        <link rel="stylesheet" href="style.css">
        <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
      </head>

      <body>
        <div class="wrapper">
          <form method="post">
            <h1>Login</h1>
            <div class="input-box">
              <input type="text" id="gebruiker" name="gebruiker" placeholder="gebruiker" required>
              <box-icon type='solid' name='user'></box-icon>
            </div>

            <div class="input-box">
              <input type="wachtwoord" id="wachtwoord" name="wachtwoord" placeholder="wachtwoord" required>
              <box-icon name='lock-alt' type='solid'></box-icon>
            </div>

            <div class="remember-forgot">
              <label><input type="checkbox"> Remember me</label>
              <a href="#">Forgot password?</a>
            </div>

            <input type="submit" class="btn">Login</input>

            <div class="register-link">
              <p>Don't have an account? <a href="#">Register</a></p>
            </div>

          </form>
        </div>
      </body>

      </html>
