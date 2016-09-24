<?php

    // configuration
    require("../includes/config.php");
    
    // Get symbols of companies owned and pass into sell.php
    $rows = CS50::query("SELECT symbol, shares FROM portfolios WHERE user_id = ?", $_SESSION["id"]);

    
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // render form
        render("sell.php", ["rows" => $rows]);
    }
    else if ($_POST == NULL)
    {
        apologize("You must select a stock to sell.");
    }
    else
    {
        // Get name, symbol, and current price of selected stock
        $stock = lookup($_POST["symbol"]);
        
        // Get shares
        $shares_array = CS50::query("SELECT shares FROM portfolios WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
        $number_of_shares = $shares_array[0]["shares"];
        
        // Update cash
        $profit = ($stock["price"] * $number_of_shares);
        CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?", $profit, $_SESSION["id"]);
        
        // get date/time for history "4/30/16, 1:23pm"
        $timestamp = date("n/j/Y, g:ia");
        // update history table
        CS50::query("INSERT INTO history (user_id, transaction, datetime, symbol, shares, price) VALUES (?, ?, ?, ?, ?, ?)", $_SESSION["id"], "SELL", $timestamp, $stock["symbol"], $number_of_shares, $profit);
        
        // Delete from table
        CS50::query("DELETE FROM portfolios WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
        
        // redirect to index.php
        redirect("index.php");
        
    }
?>