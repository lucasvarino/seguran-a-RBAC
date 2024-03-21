<?php
# Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'seguranca01');

# Logout the user
session_start();
session_destroy();
header('Location: /');
