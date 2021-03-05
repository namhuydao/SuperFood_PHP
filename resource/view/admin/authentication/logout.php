<?php

session_start();

unset($_SESSION['user']);

header('Location:../authentication/login.php');
