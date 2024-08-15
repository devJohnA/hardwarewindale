<?php
require_once 'include/initialize.php';

// Start the session
@session_start();

// Check if it's an AJAX request
$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

// Unset all the session variables
unset($_SESSION['CUSID']);
unset($_SESSION['CUSNAME']);
unset($_SESSION['CUSUNAME']);
unset($_SESSION['CUSUPASS']);
unset($_SESSION['gcCart']);
unset($_SESSION['fixnmixConfiremd']);
unset($_SESSION['gcNotify']);
unset($_SESSION['orderdetails']);

// Destroy the session
session_destroy();

if ($isAjax) {
    // If it's an AJAX request, return JSON response
    header('Content-Type: application/json');
    echo json_encode(['success' => true, 'message' => 'Logged out successfully']);
} else {
    // If it's a regular request, redirect
    redirect("index.php?logout=1");
}
?>