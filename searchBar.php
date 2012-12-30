<!--SEARCH BAR------------------------------------------------------>
    <h1>311 Bookstore</h1>
    <p><a href="">Your Account</a></p>
    <br />
    <table><tr><td>
    <form method="get" action="viewCart.php">
        <input type="submit" value="Your Shopping Cart" />
    </form>
    </td><td>
    <form method="get" action="">
        <input type="submit" value="Your Wish List" />
        <input type="hidden" name="wishSubmit" value="yes"  />
    </form>
    </td></tr></table>
    <br />
    <form method="get" action="showResults.php">
        Search Title <input type="text" name="title" />
        Author <input type="text" name="author" />
        <input type="hidden" name="doSearch" value="yes" />
        <input type="submit" value="GO!" />
    </form>
    <hr>
<!------------------------------------------------------------------>
