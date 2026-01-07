emailjs.init("2w8KrX-es6cBuW9Rt");

function sendMail(e) {
    e.preventDefault(); 

    const emailInput = document.getElementById("email");
    const nameInput = document.getElementById("name");
    const messageInput = document.getElementById("message");

    const email = emailInput.value.trim();
    const name = nameInput.value.trim();
    const message = messageInput.value.trim();

    const d = new Date();

    const params = {
        name: name,
        title: "Contact Email",
        introduction: "You have received a new contact form submission. Please respond at your earliest convenience.",
        source: "From:",
        time: d.getFullYear(),
        user_email: "fragstore63@gmail.com",
        from_email:email,
        message: message,
        system_type:"Contact",
        content_subtitle: "Message"
    };

    const serviceID = "service_7grce58";
    const templateID = "template_sqmrmho";

    emailjs.send(serviceID, templateID, params)
        .then(res => {
            alert("Email sent!");
            emailInput.value = "";
            nameInput.value = "";
            messageInput.value = "";
        })
        .catch(err => {
            console.error("Email sending error:", err);
            alert("Failed to send Email. Please try again later.");
        });
}
