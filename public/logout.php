<?php
session_start();
session_unset(); //remove all the variables in the session
session_destroy(); // destroy the session
header("Location: ./login.php?action=logout");
die;
