<?php session_start(); ?>
<!------------------------------------------------------------------
  -- Title:           viewCart.php                                --
  -- Assignment:      CSCI 311 - Lab7                             --
  -- Date:            April 2011                                  --
  -- Author:          Casey Yardley                               --
  -- Purpose:         Add books to and view the shopping cart     --
  ------------------------------------------------------------------->
<html>
<head>
<title>311 Bookstore | Shopping Cart</title>
</head>
<body>
<?php
    
    require_once("searchBar.php");
    
    //get info
    $id = $_GET['id'];    
    if(array_key_exists('cart', $_SESSION)){
        $cart = $_SESSION['cart'];
    }else{
        $cart = array();
    }
    
    //Add books/update quantity
    if(array_key_exists('buyBook', $_GET)){ 
        if(array_key_exists($id, $cart)){
		    $cart[$id]['quantity'] += $_GET['quantity'];
	    }else{
		    $cart[$id]['details']= $_GET['details'];
		    $cart[$id]['quantity']= $_GET['quantity'];
	    }
	}
    
    //Display cart
    echo "<h2>Your Shopping Cart</h2>";
    echo "<td><form method=\"get\" action=\"checkOut.php\">";
    echo "<input type=\"submit\" value=\"Proceed to Checkout\"></form></td></tr></table>";
    echo "<h3>Shopping Cart Items</h3>";
    
    if(count($cart)==0){
        echo "<h4>Your shopping cart is empty</h4>";
    }else{
        $totalPrice = 0;
        foreach($cart as $id=>$book){
            $details = explode('::', $book['details']);
            list($title, $author, $price, , ) = $details;
            echo "<p><a href=oneItem.php?book=" . $id . ">" . $title . "</a><br />";
            echo "Cdn $ " . $price . "<br />";
            echo "- Quantity: " . $book['quantity'] . "</p>";
            $totalPrice += $book['quantity']*$price;
        }
        echo "<h3>Subtotal: Cdn $" . $totalPrice . "<h3>";
    }
    echo "<hr />";
    echo "<table><tr><td><form method=\"get\" action=\"showResults.php\">";
    echo "<input type=\"submit\" value=\"Continue Shopping\"></form></td>";
    echo "<td><form method=\"get\" action=\"editCart.php\">";
    echo "<input type=\"submit\" value=\"Edit Shopping Cart\"></form></td>";
    echo "<td><form method=\"get\" action=\"checkOut.php\">";
    echo "<input type=\"submit\" value=\"Proceed to Checkout\"></form></td></tr></table>";
    //update session
    $_SESSION['cart'] = $cart;
?>
</body>
</html>
