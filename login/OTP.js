emailjs.init("2w8KrX-es6cBuW9Rt"); //User ID for EmailJS

let currentOTP = null;  //variable that stores OTP code

const d = new Date(); //calls current date

function generateOTP() {
  return Math.floor(100000 + Math.random() * 999999); //generate 6 digits OTP
}

//sends the email in the backend

function sendMail() {
  const emailInput = document.getElementById("email");
  const email = emailInput.value.trim();

  const nameInput = document.getElementById("name");
  const name = nameInput.value.trim();


  currentOTP = generateOTP();

  const params = {
    name: name,
    time: d.getFullYear(),
    user_email: email,
    message: currentOTP,
  };

  const serviceID = "service_7grce58"; //ID of the gmail service
  const templateID = "template_1j019ea"; //ID of the mail UI template

  emailjs.send(serviceID, templateID, params)
    .then(res => {
      alert("OTP sent to your email!");
      emailInput.value = "";
      clearOTPInputs();
      focusFirstOTP();
    })
    .catch(err => {
      console.error("Email sending error:", err);
      alert("Failed to send OTP. Please try again later.");
    });
}

//verifying OTP

function Verify() {
  if (!currentOTP) {
    alert("Please request an OTP first.");
    return;
  }
  const otpInputs = document.querySelectorAll('.otp-input');
  let otpEntered = '';
  otpInputs.forEach(input => {
    otpEntered += input.value.trim(); //puts all 6 numbers to one single string
  });

  if (otpEntered.length < 6) {
    alert("Please enter the full 6-digit OTP."); //checks if all 6 entered
    otpInputs[0].focus();
    return;
  }

  if (otpEntered === currentOTP.toString()) {
    alert("OTP Verified successfully!");
    sessionStorage.setItem("login", "true");
    window.location.replace("../home/home.php"); //redirection if successful verification
    clearOTPInputs();
  } else {
    alert("Invalid OTP. Please try again.");
  }
}

function clearOTPInputs() {
  document.querySelectorAll('.otp-input').forEach(input => input.value = ''); //clear OTP code fields
}

function focusFirstOTP() {
  const first = document.querySelector('.otp-input');
  first.focus(); //focusing on first number field
}