<?php
require_once dirname(__DIR__) . '/config.php'; //loads PDO from config.php

//helper function for removing special characters
function e($s)
{
  return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}


//base variables

$message = '';
$email = '';
$username = '';
$success = false;

//form uses post method -> waits for the user's submit

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email    = trim($_POST['email'] ?? '');
  $username = trim($_POST['username'] ?? '');
  $password = $_POST['password'] ?? '';

  //checks if values are empty, otherwise it checks length of password and validates e-mail

  if ($email === '' || $username === '' || $password === '') {
    $message = 'Please fill in all fields.';
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $message = 'Invalid email address.';
  } elseif (strlen($password) < 8) {
    $message = 'Password must be at least 8 characters.';
  } else {
    try { //if all values are correct, it pushes the hash value to the pass into the database alongside the username and e-mail
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $pdo->prepare("INSERT INTO users (email, username, password_hash) VALUES (?, ?, ?)"); //prepared placeholders with temporary ? values
      $stmt->execute([$email, $username, $hash]);
      $success = true;
    } catch (PDOException $e) {
      // Duplicate email/username -> SQLSTATE 23000
      if ($e->getCode() === '23000') {
        $message = 'Email or username already exists.';
      } else {
        $message = 'Error: ' . e($e->getMessage());
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Montserrat&display=swap" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>

  <title>Sign Up | Fragstore</title>

  <link rel="stylesheet" href="Sign Up.css">
  <link rel="icon" type="image/x-icon" href="/icons/array.png">
</head>

<body>
  <div class="glow-particles"></div>

  <div class="container" role="main" aria-label="Sign Up Form">
    <div class="card">
      <div class="title"><span class="frag">Frag</span><span class="store">store</span></div>

      <?php if ($message): ?>
        <div class="alert"><?= e($message) ?></div>
      <?php endif; ?>

      <!-- SIMPLE self-posting form -->
      <form action="" method="POST" novalidate>
        <div class="form-group">
          <input type="email" id="email" name="email" placeholder=" " required class="form-control" value="<?= e($email) ?>" />
          <label for="email">Email address</label>
          <button type="button" class="clear-btn" onclick="document.getElementById('email').value=''; document.getElementById('email').focus();">&times;</button>
        </div>

        <div class="form-group">
          <input type="text" maxlength="16" id="username" name="username" placeholder=" " required class="form-control" value="<?= e($username) ?>" />
          <label for="username">Username</label>
          <button type="button" class="clear-btn" onclick="document.getElementById('username').value=''; document.getElementById('username').focus();">&times;</button>
        </div>

        <div class="form-group">
          <input type="password" id="password" name="password" placeholder=" " required class="form-control" />
          <label for="password">Password</label>
          <button type="button" class="clear-btn" onclick="document.getElementById('password').value=''; document.getElementById('password').focus();">&times;</button>
        </div>

        <button type="submit" class="btn-login">Create Account</button>
      </form>

      <div class="small-text mt-3">
        Already have an account? <a href="../login/Log In.php">Login here</a>
      </div>
    </div>
  </div>


  <script>

    function Welcome() {
      emailjs.init("2w8KrX-es6cBuW9Rt");

      const params = {
        title: "Welcome",
        welcome: "Welcome to Fragstore — Game On!",
        introduction: "Welcome to Fragstore, and thanks for joining our community! Your account has been successfully created, and you’re now ready to dive into a world packed with games, deals, and digital goodness.",
        user_email: "<?= $email ?>",
        message: `At Fragstore, we’re all about great games and smooth gameplay.`,
        system_type: "sign up",
        username: "<?= $username ?>",
        email_heading: "What do we offer?",
        logos: `<div style="display: flex; gap:12px; justify-content: center; align-items: center;">
  <img src="https://cdn-icons-png.flaticon.com/512/3224/3224178.png" style="height:90px; width:90px;" alt="">
  <img src="https://logoeps.com/wp-content/uploads/2013/04/pac-man-character-vector.png" style="height:90px; width:90px;" alt="">
  <img src="https://purepng.com/public/uploads/thumbnail//purepng.com-mario-basedmariosuper-mariovideo-gamefictional-characternintendoshigeru-miyamotomario-franchise-1701528638226fbmbg.png" style="height:90px; width:90px;" alt="">
</div>
`
      };

      const serviceID = "service_7grce58";
      const templateID = "template_sqmrmho";

      emailjs.send(serviceID, templateID, params)
      .then(() => {

      window.location.href = "../login/Log In.php?registered=1";
    })
    .catch(err => console.error("EmailJS error:", err));
    }


    <?php if ($success): ?>
      Welcome();
    <?php endif; ?>


        //clear button logic
    document.querySelectorAll('.form-control').forEach(input => {
      const clearBtn = input.querySelector('.clear-btn');
      const toggle = () => clearBtn.style.display = input.value ? 'block' : 'none';
      input.addEventListener('input', toggle);
      toggle();
    });
  </script>

</body>

</html>