<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contactus.css">
    <title>Document</title>
</head>

<body>
    <main>
        <section>
            <div class="contactbox">
                <h2>Send us an EMAIL</h2>
                <form method="POST">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" placeholder="Type in your name..">

                    <label for="email">Your Email</label>
                    <input type="email" name="email" id="email" placeholder="Type in your Email..">

                    <label for="message">Message</label><br>
                    <textarea name="uzenet" rows="6" cols="50" placeholder="Write your message here.." id="message"></textarea><br><br>
                    
                    <button onclick="sendMail(event);">Submit</button>
                </form>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script src="contactus.js"></script>
</body>

</html>