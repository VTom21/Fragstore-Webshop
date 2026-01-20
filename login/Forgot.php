<?php
require_once dirname(__DIR__) . '/config.php'; //loading PDO from condig.php
include '../test.php';

//base variables

$email = '';
$new_pass = '';
$message = '';
include '../test.php';
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $email = $_POST["email"];
    $new_pass = $_POST["password"];

    if($email === '' || $new_pass === ''){
        $message = "Please fill in both fields.";
    }
    else{
        try{
            $stmt = $pdo->prepare('SELECT password_hash FROM users WHERE email = ? LIMIT 1');
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if(!$user){
              echo $twig->render('error.twig', [
                'title' => 'Unexpected Error',
                'message' => 'Something went wrong.',
                'details' => "Email does not exists!",
                'redirectUrl' => '../home/home.php'
            ]);
            exit;
            }

            if(password_verify($new_pass, $user["password_hash"])){
                die("Your new password cannot be the same as your current password!");
            }


            $new_hashed = password_hash($new_pass, PASSWORD_DEFAULT);
            $updateStmt = $pdo->prepare("UPDATE users SET password_hash  = ? WHERE email = ?");
            $updateStmt->execute([$new_hashed, $email]);

            $message = "Password updated successfully!";
            header("Location: Log In.php");
        }
        catch(PDOException $e){
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

<style>
.alert {
  background: rgba(0, 0, 0, .25);
  border: 1px solid rgba(255, 255, 255, .2);
  padding: .75rem 1rem;
  border-radius: 10px;
  margin-bottom: 1rem;
  text-align: center
}
</style>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Montserrat&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="Log In.css">
  <link rel="icon" type="image/x-icon" href="/icons/array.png"> 
  <title>Login | Fragstore</title>
</head>

<body>
  <div class="glow-particles"></div>
  <div class="container">
    <div class="card">
      <div class="title"><span class="frag">Frag</span><span class="store">store</span></div>

     <?php if ($message): ?><div class="alert"><?= $message ?></div><?php endif; ?>

      <form action="" method="POST" novalidate>
        <div class="form-group">
          <input type="email" id="email" name="email" placeholder=" " required class="form-control" value="" />
          <label for="email">Email address</label>
          <button type="button" class="clear-btn" onclick="document.getElementById('email').value=''; document.getElementById('email').focus();">&times;</button>
        </div>
        <div class="form-group">
          <input type="password" id="password" name="password" placeholder=" " required class="form-control" />
          <label for="password">New Password</label>
          <button type="button" class="clear-btn" onclick="document.getElementById('password').value=''; document.getElementById('password').focus();">&times;</button>
        </div>
        <button type="submit" class="btn-login login">Set Password</button>
      </form>
    </div>
  </div>

  <script>

    document.querySelectorAll('.form-control').forEach(input => {
      const clearBtn = input.parentElement.querySelector('.clear-btn');
      const toggle = () => clearBtn.style.display = input.value ? 'block' : 'none';
      input.addEventListener('input', toggle);
      toggle();
    });
  </script>
</body>

</html>