<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_all') {
    $password = $_POST['password'];

    // Check the password
    if ($password === '0000') {
        $host = 'localhost';
        $dbname = 'surveydb';
        $username = 'root';
        $password = '';

        // Connect to the database
        $conn = mysqli_connect($host, $username, $password, $dbname);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // SQL query to delete all data
        $sql = "DELETE FROM questionare";
        if (mysqli_query($conn, $sql)) {
            echo "All data has been deleted.";
            // Reset auto-increment to 1 after deletion
            $resetAutoIncrementSql = "ALTER TABLE questionare AUTO_INCREMENT = 1";
            mysqli_query($conn, $resetAutoIncrementSql);
        } else {
            echo "Error deleting data: " . mysqli_error($conn);
        }

        // Close connection
        mysqli_close($conn);
    } else {
        echo "Incorrect password.";
    }
}
?>
