<?php
  $connect = mysqli_connect('us-cdbr-east-06.cleardb.net', 'bc320db816da92', '5a1d743a', 'heroku_21cc705331729fc');
$query = "SELECT * FROM books";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html>
<head>
  <title>bookStore</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="car-container">
    <h1>All book</h1>
    <table border="1">
      <tr>
        <th>ID</th>
        <th>Name of book</th>
        <th>Genre of book</th>
        <th>Year</th>
        <th>Price</th>
        <th>Details</th>
      </tr>
      <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php echo $row["id"]; ?></td>
          <td><?php echo $row["name"]; ?></td>
          <td><?php echo $row["genre"]; ?></td>
          <td><?php echo $row["year"]; ?></td>
          <td><?php echo $row["price"]; ?></td>
          <td><a href="book.php?id=<?php echo $row["id"]; ?>">View Details & Buy car</a></td>
        </tr>
      <?php } ?>
    </table>
  </div>
  <p><a href="logout.php">Logout</a></p>
</body>
</html>

