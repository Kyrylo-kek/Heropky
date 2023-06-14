<?php
session_start();
if(!isset($_SESSION["username"])){
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Books</title>
</head>
<body>
  <h1>Welcome to book store</h1>
  <p><a href="add_books.php">Add the book</a></p>
  <p><a href="view_books.php">View books</a></p>
  <p><a href="edit_portfolio.php">Edit Portfolio</a></p>
  <p><a href="logout.php">Logout</a></p>
</body>
</html>

