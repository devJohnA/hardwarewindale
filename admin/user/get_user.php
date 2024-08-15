<?php
include('dbcon/conn.php'); // Include your database connection

if (isset($_GET['USERID'])) {
    $userId = $_GET['USERID'];
    $query = "SELECT * FROM tbluseraccount WHERE USERID = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo json_encode($user); // Return user data as JSON
    } else {
        echo json_encode(['error' => 'User not found']);
    }
}
?>
