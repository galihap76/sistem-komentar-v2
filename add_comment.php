<?php
include 'db.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Function security input
    function securityInput($data)
    {
        $data = htmlentities($data); // Mengonversi semua karakter khusus menjadi entitas HTML
        return $data;
    }

    $name = securityInput($_POST["name"]);
    $comment = securityInput($_POST["comment"]);
    $parent_id = $_POST["parent_id"];

    $date = date('Y-m-d H:i:s');

    $query = "INSERT INTO tbl_comment (name, comment, parent_id, comment_date) VALUES (:name, :comment, :parent_id, :date)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindParam(':parent_id', $parent_id, PDO::PARAM_INT);
    $stmt->bindParam(':date', $date, PDO::PARAM_STR);
    $stmt->execute();
} else {
    header("HTTP/1.1 404 Not Found");
}
