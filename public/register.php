<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // DONE
        if(empty($_POST["username"]))
        {
            // inform user to enter username
            apologize("You must provide a username.");
        }
        else if (empty($_POST["password"]))
        {
            // inform user to enter password
            apologize("You must provide a password.");
        }
        else if ($_POST["password"] != $_POST["confirmation"])
        {
            // inform user to make sure passwords are matching
            apologize("Your passwords do not match.");
        }
        else
        {
            // add user to database storing result in database
            $result = CS50::query("INSERT IGNORE INTO users (username, hash, cash) VALUES(?, ?, 10000.0000)", $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT));
            if (result == false)
            {
                // please select a different username
                apologize("That username is already taken.");
            }
            else
            {
                // Find out the users ID
                $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
                $id = $rows[0]["id"];
                
                // Get user id
                $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
                $id = $rows[0]["id"];
                
                // Log in the user and redirect to index.php
                $_SESSION["id"] = $id;
                redirect("index.php");
            }
            
        }
    }

?>