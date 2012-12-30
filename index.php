<?php session_start(); ?>
<!------------------------------------------------------------------
  -- Title:           welcome.php                                 --
  -- Assignment:      CSCI 311 - Lab7                             --
  -- Date:            April 2011                                  --
  -- Author:          Casey Yardley                               --
  -- Purpose:         Welcome Page for the bookstore site.        --
  ------------------------------------------------------------------->
<html>
<head>
<title>311 Bookstore | Welcome</title>
</head>
<body>
<?php require_once("searchBar.php"); ?>
<h2>Welcome to the 311 Bookstore</h2>
<h3>by Casey Yardley</h3>
<?php
    if(array_key_exists('emptyCart', $_GET)){
        unset($_SESSION['cart']);
        echo "<h2>==Shopping Cart Emptied==</h2>";
    }
?>
</body>
</html>
