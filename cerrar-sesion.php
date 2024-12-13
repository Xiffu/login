<?php
session_start();
session_destroy();
// Reridecciona al login
header('Location: login.php');
