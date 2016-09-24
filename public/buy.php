<?php 

    // configuration
    require("../includes/config.php"); 
    
    if($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("buy.php");
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
            // get stock data
            $stock = lookup($_POST["symbol"]);
            // get amount of user's cash
            $cash_array = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
            $cash = $cash_array[0]["cash"];
            // calculate price to buy
            $price = $stock["price"] * $_POST["shares"];
            
            // check if user wishes to buy a whole non-negative integer # of stock
            if(preg_match("/^\d+$/", $_POST["shares"]) == false)
            {
                apologize("Invalid number of shares.");
            }
            else if (empty($stock))
            {
                apologize("Symbol not found.");
            }
            else if ($price > $cash)
            {
                apologize("You can't afford that.");
            }
            else
            {
                // buy some stock
                // get date/time for history "4/30/16, 1:23pm"
                $timestamp = date("n/j/Y, g:ia");
                // update history table
                CS50::query("INSERT INTO history (user_id, transaction, datetime, symbol, shares, price) VALUES (?, ?, ?, ?, ?, ?)", $_SESSION["id"], "BUY", $timestamp, $stock["symbol"], $_POST["shares"], $price);
                // add stock to user's portfoio
                CS50::query("INSERT INTO portfolios (user_id, symbol, shares) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $_SESSION["id"], $stock["symbol"], $_POST["shares"]);
                // update user's cash
                CS50::query("UPDATE users SET cash = cash - ? WHERE id = ?", $price, $_SESSION["id"]);
                // redirect to homepage
                redirect("index.php");
            }
    }

?>