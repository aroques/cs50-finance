<?php
    
    // configuration
    require("../includes/config.php");
    
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("quote_form.php");
    }
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // Get stock data
        $stock = lookup($_POST["symbol"]);
        if (!(empty($stock)))
        {
            render("stock_price.php", $stock);
        }
        else
        {
            apologize("Symbol not found.");
        }
    }

    
?>