<?php
session_start();

if (!isset($_SESSION["username"])) {
  header("Location: login.php");
  exit();
}

$message = "";

if (isset($_POST["name"]) && isset($_POST["genre"]) && isset($_POST["year"]) && isset($_POST["price"])) {
  $name = $_POST["name"];
  $genre = $_POST["genre"];
  $year = $_POST["year"];
  $price = $_POST["price"];

  $connect = mysqli_connect('us-cdbr-east-06.cleardb.net', 'bc320db816da92', '5a1d743a', 'heroku_21cc705331729fc');
  if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $name = mysqli_real_escape_string($connect, $name);
  $genre = mysqli_real_escape_string($connect, $genre);
  $year = mysqli_real_escape_string($connect, $year);
  $price = mysqli_real_escape_string($connect, $price);

  $query = "INSERT INTO `books` (`id`, `name`, `genre`, `year`, `price`) VALUES (NULL, '$name', '$genre', '$year', '$price')";
  $result = mysqli_query($connect, $query);

  if ($result && mysqli_affected_rows($connect) > 0) {
    $message = "Books added successfully!";
  } else {
    $message = "Error adding books: " . mysqli_error($connect);
  }

  mysqli_close($connect);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Books</title>
</head>
<body>
  <h1>Add books</h1>
  <?php echo $message; ?>
  <form method="post">
    <label for="make">Name book:</label>
    <input type="text" name="name" required><br>
    <label for="model">Genre of book:</label>
    <input type="text" name="genre" required><br>
    <label for="year">Year of book:</label>
    <input type="number" name="year" required><br>
    <label for="price">Price:</label>
    <input type="number" name="price" required><br>
    <input type="submit" value="Add">
  </form>
  <p><a href="index.php">Back to Home</a></p>
</body>
</html>
