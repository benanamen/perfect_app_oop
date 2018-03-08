<?php
    session_start();
    session_unset(); //remove all the variables in the session
    session_destroy(); // destroy the session
   die(header("Location: ./login.php?logout"));
