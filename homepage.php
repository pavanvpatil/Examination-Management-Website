<?php
    session_start();
    if(!isset($_SESSION['loggedin']))
    {
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Extra/letter_q.png">
    <title>Compete</title>
<style>
.topnav {
  overflow: hidden;
  background-color:#cfcccc;
}

.topnav a {
  float: left;
  color:black;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 22px;
}

.topnav a:hover {
  background-color:skyblue;
  color: black;
}
</style>
</head>
<body>
<div class="topnav">
  <a href="#homepage.php">Home</a>
  <a href="contact.html">Contact</a>
  <a href="about.html">About</a>
  <a href="logout.php">Log-out</a>
</div>
</body>
</html>