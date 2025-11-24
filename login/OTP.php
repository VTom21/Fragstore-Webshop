<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>OTP Verification</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Montserrat&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="OTP.css">
  <link rel="icon" type="image/x-icon" href="/icons/array.png">
</head>

<body>

  <div class="container" role="main" aria-label="Contact form with OTP verification">
    <div class="card">
      <div class="title">OTP <span>Verification</span></div>

      <form autocomplete="off" novalidate>
        <div class="form-group">
          <input type="email" id="email" placeholder=" " required spellcheck="false" />
          <label for="email">Email Address</label>
        </div>

        <div class="form-group">
          <input type="text" id="name" placeholder=" " required spellcheck="false" />
          <label for="email">Name</label>
        </div>

        <div class="form-group" style="margin-bottom: 0;">
          <div id="otp" role="group">
            <input type="text" maxlength="1" class="otp-input" inputmode="numeric" pattern="[0-9]*" />
            <input type="text" maxlength="1" class="otp-input" inputmode="numeric" pattern="[0-9]*" />
            <input type="text" maxlength="1" class="otp-input" inputmode="numeric" pattern="[0-9]*" />
            <input type="text" maxlength="1" class="otp-input" inputmode="numeric" pattern="[0-9]*" />
            <input type="text" maxlength="1" class="otp-input" inputmode="numeric" pattern="[0-9]*" />
            <input type="text" maxlength="1" class="otp-input" inputmode="numeric" pattern="[0-9]*" />
          </div>
        </div>

        <div class="btn-group">
          <button type="button" onclick="sendMail()">Send OTP</button>
          <button type="button" onclick="Verify()">Verify OTP</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>

  <script src="OTP.js"></script>

  <script>
    localStorage.setItem("name", <?= json_encode($_SESSION['username']); ?>);
  </script>

</body>

</html>