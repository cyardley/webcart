<?php session_start(); ?>
<!------------------------------------------------------------------
  -- Title:           showResults.php                             --
  -- Assignment:      CSCI 311 - Lab7                             --
  -- Date:            April 2011                                  --
  -- Author:          Casey Yardley                               --
  -- Purpose:         Displays search results to the user         --
  ------------------------------------------------------------------->
<html>
<head>
<title>311 Bookstore | Search Results</title>
</head>
<body>
<?php
    
    require_once("searchBar.php");

    //Get Search Hits
    if(array_key_exists('doSearch', $_GET)){
        unset($_SESSION['hits']);
		$titleRE = $_GET['title'];
        $authorRE = $_GET['author'];
        $fh = fopen('catalog.txt', 'r')
        or die ("<h1>Cannot open $filename for reading </h1></body></html>");
        $hits = array();
		do {
            $line = fgets($fh);
            $getID = explode("\t", $line);
            list($id, $detailSTR) = $getID;
            $details = explode('::', $detailSTR);
            list($title, $author, , , ) = $details;
            if(preg_match("/".$titleRE."/i", $title)
            && preg_match("/".$authorRE."/i", $author)
            && strcmp($detailSTR, "")!=0 ){
                $hits[$id] = $detailSTR;
            }
        }while (!feof($fh));
	}else{
		$hits = $_SESSION['hits'];
    }
    asort($hits);
	$_SESSION['hits'] = $hits;
    
    //Display Results
    $MAXDISPLAY = 5;
    if(array_key_exists('page', $_GET)){
         $page = $_GET['page'];
    }else{
        $page = 1;
    }
    
    //Get Vars
    $prevPage = $page-1;
    $nextPage = $page+1;
    $high = $page*$MAXDISPLAY;
    $low = $high - ($MAXDISPLAY-1);
    $total = count($hits);
    if($high>$total)$high=$total;
    $maxPage = ceil($total/$MAXDISPLAY); //ceiling function
    
    if($total==0){
        echo "<h2>There are no books matching your search criteria</h2></body</html>";
        exit(0);
    }
    
    //Page Info
    echo "Showing " . $low . " - " . $high . " of " . $total . " Results";
    echo "<p>Showing <select name=perPage><option>" . $MAXDISPLAY . "</option></select> results per page</p>";
    
    //Show Results
    $i=1;
	foreach($hits as $k=>$h){
	    if($i>=$low && $i<=$high+1){
	        $details = explode('::', $h);
	        list($title, $author, $price, $year, $numCopies) = $details;
	        echo $i . ": " . $title . "<br />";
            echo "<a href=oneItem.php?book=" . $k . ">Buy New</a>: Cdn$" . $price ."<p><hr /></p>";
        }
        $i++;
        if($i>$high)break;   
    }
    
    //Page Navigation
    if($page>1) echo "<a href=showResults.php?page=" . $prevPage . "> &laquo; Previous</a> | Page: ";
    else echo "&laquo; Previous | Page: ";    
    for($i=1; $i<=$maxPage; $i++){
        if($i==$page) echo $i . " ";
        else echo "<a href=showResults.php?page=" . $i . ">" . $i . "</a> ";
    }
    if($page<$maxPage) echo "| <a href=showResults.php?page=" . $nextPage . "> Next &raquo;</a>";
    else echo "| Next &raquo;";
?>

</body>
</html>
