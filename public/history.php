<?php
    
    // configuration
    require("../includes/config.php");
    
    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $rows = CS50::query("SELECT * FROM history WHERE user_id = ?", $_SESSION["id"]);
        render("history.php", ["rows" => $rows]);
    }

?>