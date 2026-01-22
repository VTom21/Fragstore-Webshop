<?php

//starts a new session, initializes $_SESSION superglobal array -> used for retrieving data across multiple pages
session_start();

require_once dirname(__DIR__) . '/config.php'; //loads PDO from config.php


//helper function for removing special characters
function e($s)
{
  return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

//base variables

$message = '';
$email = '';

//form uses post method -> waits for the user's submit

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email    = trim($_POST['email'] ?? '');
  $password = $_POST['password'] ?? '';

  //checks if values are empty
  if ($email === '' || $password === '') {
    $message = 'Please fill in both fields.';
  } else {
    try { //retrieves username, e-mail, hashed password
      $stmt = $pdo->prepare('SELECT id, username, email, password_hash FROM users WHERE email = ? LIMIT 1');
      $stmt->execute([$email]);
      $user = $stmt->fetch();

      //verifies user written password with the password has from the database
      if ($user && password_verify($password, $user['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['user_id']  = (int)$user['id']; //stores user_id in the session
        $_SESSION['username'] = $user['username']; //stores username in the session

        $token = bin2hex(random_bytes(32)); // generate secure token
        $stmt = $pdo->prepare("UPDATE users SET remember_token = ? WHERE id = ?");
        $stmt->execute([$token, $user['id']]);

      setcookie(
        'remember_me', 
        $token, 
        time() + 60*60*24*30, // valid for 30 days
        '/', 
        '', 
        true, // secure, only over HTTPS
        true  // HttpOnly
      );
      
        header("Location: OTP.php");
        exit;
      } else {
        $message = 'Invalid email or password.';
      }
    } catch (PDOException $e) {
      echo $twig->render('error.twig', [
        'title' => 'Unexpected Error',
        'message' => 'Something went wrong.',
        'details' => $e->getMessage(),
        'redirectUrl' => '../home/home.php'
      ]);
      exit;
    }
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Montserrat&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="Log In.css">
  <link rel="icon" type="image/x-icon" href="/icons/array.png">
  <script src="https://accounts.google.com/gsi/client" async defer></script>
  <title>Login | Fragstore</title>
</head>

<body>
  <div class="glow-particles"></div>
  <div class="container">
    <div class="card">
      <div class="title"><span class="frag">Frag</span><span class="store">store</span></div>

      <?php if ($message): ?><div class="alert"><?= e($message) ?></div><?php endif; ?>

      <form action="" id="loginForm" method="POST" novalidate>
        <div class="form-group">
          <input type="email" id="email" name="email" placeholder=" " required class="form-control" value="<?= e($email) ?>" />
          <label for="email">Email address</label>
          <button type="button" class="clear-btn" onclick="document.getElementById('email').value=''; document.getElementById('email').focus();">&times;</button>
        </div>
        <div class="form-group">
          <input type="password" id="password" name="password" placeholder=" " required class="form-control" />
          <label for="password">Password</label>
          <button type="button" class="clear-btn" onclick="document.getElementById('password').value=''; document.getElementById('password').focus();">&times;</button>
        </div>
        <button type="submit" class="btn-login login">Login</button>

        <div class="cf-turnstile captcha" id="captcha" data-sitekey="0x4AAAAAACLE_NHQQP922tRh" data-callback="Captcha_Success"></div>
      </form>


      <div class="small-text mt-3">
        <a href="./Forgot.php">Forgot password?</a><br /><br>
        Don't have an account?
        <a href="../signup/Sign Up.php">Register here</a>
      </div>

    </div>
  </div>

  <script>

let captcha_passed = false;

function Captcha_Success(){
  captcha_passed = true;
}

document.getElementById("loginForm").addEventListener("submit", function(e){
  if (!captcha_passed){
    e.preventDefault();
    alert("Please complete the CAPTCHA first!");
    return;
  }
});

  </script>
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>


</body>

</html>