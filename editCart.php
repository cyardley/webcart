<?php session_start(); ?>
<!------------------------------------------------------------------
  -- Title:           editCart.php                                --
  -- Assignment:      CSCI 311 - Lab7                             --
  -- Date:            April 2011                                  --
  -- Author:          Casey Yardley                               --
  -- Purpose:         Change number of books, or remove books.    --
  ------------------------------------------------------------------->
<html>
<head>
<title>311 Bookstore | Edit Shopping Cart</title>
</head>
<body>
<?php
    require_once("searchBar.php");
    
    //get cart info
    if(array_key_exists('cart', $_SESSION)){
        $cart = $_SESSION['cart'];
    }else{
        $cart = array();
    }
    
    //Edit Cart
    if(array_key_exists('delete', $_GET)){
        unset($cart[$_GET['delete']]);
    }
    if(array_key_exists('updateCart', $_GET)){
        foreach($cart as $id=>$book){
            if(array_key_exists($id, $_GET)){
                echo $_GET[$id] . "<br />";
                $cart[$id]['quantity'] = $_GET[$id];
            }
        }
    }
    
    //update session
    $_SESSION['cart'] = $cart;
    
    //Display cart
    echo "<h2>Your Shopping Cart</h2>";
    if(count($cart)==0){
        echo "<h4>Your shopping cart is empty</h4>";
    }else{
        //subtotal
        $totalPrice = 0;
        foreach($cart as $book){
            $details = explode('::', $book['details']);
            list(, , $price, , ) = $details;
            $totalPrice += $book['quantity']*$price;
        }
        echo "<h3>Subtotal: Cdn $" . $totalPrice . "</h3>";
        
        echo "<form method=\"get\" action=\"editCart.php\">";
        echo "<input type=\"hidden\" name=\"updateCart\" value=\"yes\" />";
        echo "<p>Did you make any changes below? <input type=\"submit\" value=\"Update\" /></form></p>";
        echo "<table width=\"90%\" cellspacing=\"10\"><tr><td><b>Shopping Cart Items</b></td><td><b>Price</b></td><td><b>Quantity</b></td></tr>";
        foreach($cart as $id=>$book){
            $details = explode('::', $book['details']);
            list($title, $author, $price, , ) = $details;
            echo "<tr><td><a href=oneItem.php?book=" . $id . ">" . $title . "</a><br />";
            echo "<form method=\"get\" action=\"editCart.php\"><input type=\"submit\" value=\"Delete\" />";
            echo "<input type=\"hidden\" name=\"delete\" value=\"" . $id . "\" /></form></td>";
            echo "<td>Cdn $ " . $price . "</td>";
            echo "<td><input size=\"5\" type=\"text\" name=\"".$id."\" value=" . $book['quantity'] . " /></td></tr>";
        }
        echo "</table>";
    }
    echo "<hr />";
    echo "<table><tr><td><form method=\"get\" action=\"showResults.php\">";
    echo "<input type=\"submit\" value=\"Continue Shopping\"></form></td>";
    echo "<td><form method=\"get\" action=\"checkOut.php\">";
    echo "<input type=\"submit\" value=\"Proceed to Checkout\"></form></td></tr></table>";
?>
