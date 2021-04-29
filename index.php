<!DOCTYPE html>
<?php require_once('func.php'); ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="content">
    <form method="post" action="index.php" name="frmLogin" autocomplete="off">
        <input type="text" name="username" placeholder="Användarnamn" required autocomplete="off">
        <input type="password" onblur="this.setAttribute('readonly', 'readonly');" onfocus="this.removeAttribute('readonly');" readonly name="password" required autocomplete="off">
        <button type="submit" name="login">Logga in</button>
    </form>

    <?php for($vdo=0;$vdo<3;$vdo++){ ?>
        <section>
            <h1>Lorem, ipsum.</h1>
            <p class="ingress">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aperiam porro consequuntur architecto ipsa a praesentium!</p>
            <p class="text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sapiente numquam aliquid vitae libero odio molestiae minus consequatur voluptas fugiat consectetur, similique alias minima obcaecati incidunt sunt dolorum fugit unde, veniam accusantium. Itaque eveniet voluptates dolorem fuga, quam quos possimus vel officiis impedit, tenetur nemo iusto alias dicta eos, voluptas obcaecati.</p>
            <div class="byline">- by Charlie Jarl</div>
        </section>
<?php } ?>
<?php for($vdo=0;$vdo<5;$vdo++){ ?>
    <details>
            <summary>Exempel</summary>
            <div class="txtBox">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corporis quo fugiat vel.</div>
            
        </details>
<?php } ?>

    </div>
</body>
</html>