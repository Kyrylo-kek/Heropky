<?php
session_start();

if(!isset($_SESSION["username"])){
  header("Location: login.php");
  exit();
}
$connect = mysqli_connect('us-cdbr-east-06.cleardb.net', 'bc320db816da92', '5a1d743a', 'heroku_21cc705331729fc');
$table_name = "books";
$query = "SELECT * FROM $table_name";
$response = mysqli_query($connect, $query);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Books</title>
</head>
<body>
  <h1>Book Store</h1>
  <table border="1">
    <tr>
      <th>ID</th>
      <th>Name of book</th>
      <th>Genre of book</th>
      <th>Year</th>
      <th>Price</th>
    </tr>
    <?php while($row = $response->fetch_assoc()): ?>
      <tr>
        <td><?php echo $row["id"]; ?></td>
        <td><?php echo $row["name"]; ?></td>
        <td><?php echo $row["genre"]; ?></td>
        <td><?php echo $row["year"]; ?></td>
        <td><?php echo $row["price"]; ?></td>
      </tr>
    <?php endwhile; ?>
  </table>
  <p><a href="index.php">Back to Home</a></p>
</body>
</html>