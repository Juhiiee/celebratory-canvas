<?php
session_start();

session_unset();
header("Location: vendor-login.php");
