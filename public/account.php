<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("account.php");
    }
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if($_POST["password"] == $_POST["confirmation"])
        {
            // change password
            $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
            CS50::query("UPDATE users SET hash = ? WHERE id = ?", $hash, $_SESSION["id"]);
            // tell user password has been changed
            render("password_change.php");
        }
        else
        {
            apologize("Your passwords do not match.");
        }
    }

?>
