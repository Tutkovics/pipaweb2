<?php
session_start();
include("includes/init.php");
include("includes/Users.php");
include("includes/Locations.php");
include("includes/Pipes.php");
$users = new Users();
$locations = new Locations();
$pipes = new Pipes();