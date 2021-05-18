<!DOCTYPE html>
<?php
    require_once 'func.php';
?>
<html>
<head>
<meta charset="UTF-8">
    <title>Administrera användare</title>
    <link rel="stylesheet" href="style.css">
    <script src="app.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/srexkpzekefu66apyfw5nysikbwmyg6izx8lei0wre50s16e/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
    <div class="userinfo">
        <?=showLoginStatus()?>
    </div>
    <nav id='menu'>
  <input type='checkbox' id='responsive-menu'><label></label>
  <ul>
    <li><a href='index.php'>Home</a></li>
    <?php if(isLevel(100)){ ?>
    <li><a>Admin</a>
      <ul class='sub-menus'>
        <li><a href='usadmin.php'>Users</a></li>
        <li><a href='bladmin.php'>Blogg</a></li>
      </ul>
    </li>
    <?php } ?>
    <li><a href='about.php'>About</a></li>
  </ul>
</nav>
<div class="content">
    <h1>Lorem, ipsum dolor.</h1>
    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad, aliquid error! Odit voluptas fugiat quisquam nemo impedit aperiam sapiente esse repellendus consequatur aliquam totam deleniti illum recusandae, odio delectus aliquid doloremque et explicabo tempore dolorem, quas omnis. Ducimus, beatae laborum!</p>
    <p>Illo labore temporibus quis quidem illum totam, corrupti ullam eveniet repellendus quos blanditiis non reprehenderit adipisci esse cumque sint dolorem placeat, perspiciatis nam ipsa unde nesciunt quae. Placeat at asperiores illo dolore impedit repellendus tempore dolor et magnam! Nemo, ad!</p>
    <p>Debitis labore delectus quidem provident voluptas. Dolor corporis recusandae cupiditate harum consectetur sint debitis consequatur optio voluptate quaerat voluptatibus facere fugiat cumque rerum, tempore quidem temporibus sunt? Numquam id libero ad mollitia provident quod. Hic odit eligendi neque corporis eius.</p>
</div>
</body>
</html>