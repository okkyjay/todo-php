<?php
include "function.php";
unset($_SESSION['user']);
session_destroy();
header("location:index.php");

