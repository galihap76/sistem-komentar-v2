<?php
include 'db.php'; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Function security input
    function securityInput($data)
    {
        $data = htmlentities($data); // Mengonversi semua karakter khusus menjadi entitas HTML
        return $data;
    }

    $id = $_POST['id'];
    $name = securityInput($_POST["name"]);
    $comment = securityInput($_POST["comment"]);

    $query = "UPDATE tbl_comment SET name = :name, comment = :comment WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); // ID komentar yang akan diubah
    $stmt->execute();
} else {
    header("HTTP/1.1 404 Not Found");
}
