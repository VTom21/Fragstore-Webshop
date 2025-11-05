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
                <form action="submit.php" method="POST">
                    <label for="name">Your Name</label>
                    <input type="text" placeholder="Type in your name..">

                    <label for="email">Your Email</label>
                    <input type="email" name="email" id="email" placeholder="Type in your Email..">

                    <label for="massage">Massage</label><br>
                    <textarea name="uzenet" rows="6" cols="50" placeholder="Write your massage here.."></textarea><br><br>
                    
                    <button type="submit">Submit</button>
                </form>
            </div>
        </section>
    </main>
</body>

</html>