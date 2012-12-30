<?php session_start(); ?>
<!------------------------------------------------------------------
  -- Title:           oneItem.php                                 --
  -- Assignment:      CSCI 311 - Lab7                             --
  -- Date:            April 2011                                  --
  -- Author:          Casey Yardley                               --
  -- Purpose:         Displays info about one book to the user    --
  ------------------------------------------------------------------->
<html>
<head>
<title>311 Bookstore | Book Details</title>
</head>
<body>
<?php
    
    require_once("searchBar.php");
    $getID = $_GET["book"];
    
    //Get Book Details
    $fh = fopen('catalog.txt', 'r')
        or die ("<h1>Cannot open $filename for reading </h1></body></html>");
    $details = NULL;
    do{
        $line = fgets($fh);
        $id = explode("\t", $line);
        list($id, $detailSTR) = $id;
        if(strcmp($id, $getID)==0){
            $details = explode('::', $detailSTR);
            break;
        }
    }while (!feof($fh));
    
    list($title, $author, $price, $year, $numCopies) = $details;
    
    //Dispay Page
    echo "<h3>" . $title . "</h3>";
    echo "<p>by <a href=showResults.php?doSearch=yes&author=" . urlencode($author)
         . ">" . $author . "</a> (". $year . ")</p>";
    echo "<p>Price: Cdn $ " . $price . "</p>";
    
    if($numCopies > 10){
        echo "<p><b>In Stock</b></p>";
    }else{
        echo "<p><b>Only ". $numCopies . " left in stock - order soon</b></p>";
    }
    
    if($numCopies<=0){
        echo "<p><b>Out of Stock!</b></p>";
    }else{
        echo "<p><form method=\"get\" action=\"viewCart.php\">";
        echo "<input type=\"hidden\" name=\"buyBook\" value=\"yes\" />";
        echo "<input type=\"hidden\" name=\"id\" value=\"" . $getID . "\" />";
        echo "<input type=\"hidden\" name=\"details\" value=\"". $detailSTR . "\" />";
        echo "Quantity <select name=quantity>";
        if($numCopies<20) $upperCopies=$numCopies; else $upperCopies=20;
        for($i=1; $i<=$upperCopies; $i++){
            echo "<option>" . $i . "</option>";
        }
        echo "</select><br />";
        echo "<input type=submit value=\"Add to Shopping Cart\" /></form></p>";
    }
    
?>

</body>
</html>
