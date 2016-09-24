<?php
    
    // Format price
    $price = number_format($price, 2, '.', ',');
    // Display info
    echo("<p>A share of {$name} ({$symbol}) costs <strong>\${$price}</strong>.</p>");

?>