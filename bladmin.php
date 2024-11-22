<!DOCTYPE html>

    <?php
    require_once 'func.php';
    //------------------------------Connect to database
    $host="localhost";
    $user="root";
    $pass="";
    $db ="dbsData";
    $conn=mysqli_connect($host, $user, $pass, $db);
    //------------------------------------------------

    //--------------------------------If FORM is sent, 
    //---take data from textbox and put it in database
    if(isset($_POST['btnNewBlog'])){
        $txtHeader=$_POST['txtHeader'];
        $txtIngress=$_POST['txtIngress'];
        $txtText=$_POST['txtText'];
        $intAuthor=intval($_SESSION['id']);
        $sql="INSERT INTO tblblog (header, ingress, text, author) VALUES ('$txtHeader', '$txtIngress', '$txtText', $intAuthor)";
        $result=mysqli_query($conn, $sql);
    }
    //-----------------------------------------------
    
    if(isset($_GET['del'])){
        $delid=$_GET["del"];
        $sql="DELETE FROM `tblblog` WHERE blogID=$delid";
        $result=mysqli_query($conn, $sql);
    }

    if(isset($_POST['btnEditBlog'])){
        $editid=$_POST['blogID'];
        $txtHeader=$_POST['txtHeader'];
        $txtIngress=$_POST['txtIngress'];
        $txtText=$_POST['txtText'];
        $intAuthor=intval($_POST['intAuthor']);
        $txtAdded=$_POST['txtAdded'];
        $sql="UPDATE `tblblog` SET header='$txtHeader', ingress='$txtIngress', text='$txtText' WHERE blogID=$editid";
        $result=mysqli_query($conn, $sql);
    }

?>
<html>
<head>
<meta charset="UTF-8">
    <title><?=$strHomeTitle?></title>
    <link rel="stylesheet" href="style.css">
    <script src="app.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/u2cxn1qvd0jif3rld6d4depkcjjw8vu3rjb8scmprd72zkoh/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
    <div class="userinfo">
        <?=showLoginStatus()?>
    </div>
    <nav id='menu'>
  <input type='checkbox' id='responsive-menu'><label></label>
  <ul>
    <li><a href='index.php'><?=$strHome?></a></li>
    <?php if(isLevel(100)){ ?>
    <li><a><?=$strAdmin?></a>
      <ul class='sub-menus'>
        <li><a href='usadmin.php'><?=$strUserAdmin?></a></li>
        <li><a href='bladmin.php'><?=$strBlogAdmin?></a></li>
      </ul>
    </li>
    <?php } ?>
    <li><a href='about.php'><?=$strAbout?></a></li>
  </ul>
</nav>
<?php  if(isset($_GET['edit'])){ 
        $editid=$_GET["edit"];
        $sql="SELECT * FROM `tblblog` WHERE blogID=$editid";
        $result=mysqli_query($conn, $sql);
        $row=mysqli_fetch_assoc($result);
    ?>
    <form method="post" action="bladmin.php" name="bladmin">
        <input type="text" name="txtHeader" id="txtHeader" value="<?=$row['header'];?>" autocomplete="off">
        <textarea name="txtIngress" rows="3"><?=$row['ingress'];?></textarea>
        <textarea name="txtText" id="txtEditText" rows="6"><?=$row['text'];?></textarea>
        <script>
    tinymce.init({
      selector: '#txtEditText',
      plugins: 'link list image table',
      contextmenu: 'link list image table',
      mode: 'textarea',
      menubar: false,
      resize: false,
      branding: false
   });
  </script>
  <div class="bladminBottomBox">
        <input type="text" name="txtAuthor" id="txtAuthor" value="<?=getRealName($row['author']);?>" autocomplete="off" readonly>
        <input type="hidden" name="intAuthor" value="<?=$row['author']?>">
        <input type="text" name="txtAdded" id="txtAdded" value="<?=$row['added'];?>" autocomplete="off" readonly>
        <input type="hidden" name="blogID" value="<?=$row['blogID']?>">
        <button type="submit" name="btnEditBlog" value="."><?=$strBtnEditBlog?></button>
    </div>

    </form>
<?php }else{ ?> 
    <?php if(isLevel(100)){ ?>
<details>
<summary>Add blog</summary>      
    <form method="post" action="bladmin.php" name="bladmin">
    <input type="text" name="txtHeader" id="txtHeader" required placeholder="<?=$placeholderHeader?>" autocomplete="off">
    <textarea name="txtIngress" rows="3"></textarea>
        <textarea name="txtText" id="txtNewText" rows="6"></textarea>
    <script>
    tinymce.init({
      selector: '#txtNewText',
      plugins: 'link lists image table',
      mode: 'textarea',
      menubar: false,
      toolbar_mode: 'floating', 
      branding: false,
      elementpath: false
   });
  </script>
<div class="bladminBottomBox"><button type="submit" name="btnNewBlog" value="."><?=$strBtnNewBlog?></button></div>
        
    </form></details> <?php } ?>
<?php } ?>    
<?php if(isLevel(100)){ ?>
    <div class="bladminruta">
    <?php 
        //-------------------Get all data from table, and print it
        $sql="SELECT * FROM tblblog ORDER BY added DESC";
        $result=mysqli_query($conn, $sql);
        while($row=mysqli_fetch_assoc($result)){ ?>
        <details class="bladmindetails">
            <summary>
                <?=$row['header']?>&nbsp;&nbsp;<?php if(isLevel(1000)){?><span class="toolicon"><a href='bladmin.php?del="<?=$row['blogID']?>"'><img class='icon' src='icons/del.png'></a>&nbsp;&nbsp;<a href='bladmin.php?edit="<?=$row['blogID']?>"'><img class='icon' src='icons/edit.png'></a></span><?php }?>
            </summary>
            <div class="blogbox">
                <h1><?=$row['header']?></h1>
                <p class="ingress">L<?=$row['ingress']?></p>
                <p class="text"><?=$row['text']?></p>
                <div class="byline">- by <?=getRealName($row['author'])?></div>
            </div>
        </details>
       <?php }
        //--------------------------------------------------------
    ?>
    </div><?php } ?>
    
</body>
</html>