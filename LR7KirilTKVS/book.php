<?php
session_start();

// check if user is logged in
if(!isset($_SESSION["username"])){
  header("Location: login.php");
  exit();
}

// get car id from url parameter
if(!isset($_GET["id"])){
  header("Location: books.php");
  exit();
}
$book_id = $_GET["id"];

// get car details from database
$connect = mysqli_connect('us-cdbr-east-06.cleardb.net', 'bc320db816da92', '5a1d743a', 'heroku_21cc705331729fc');
$car_query = "SELECT * FROM books WHERE id=$book_id";
$car_result = mysqli_query($connect, $car_query);
if($car_result->num_rows == 0){
  header("Location: book.php");
  exit();
}
$car = $car_result->fetch_assoc();

// handle form submission
$message = "";
if(isset($_POST["submit"])){
  $buyer_name = $_POST["buyer_name"];
  $buyer_email = $_POST["buyer_email"];
  $buyer_phone = $_POST["buyer_phone"];

  // insert order into database
  $insert_query = "INSERT INTO orders (car_id, buyer_name, buyer_email, buyer_phone) 
                   VALUES ($car_id, '$buyer_name', '$buyer_email', '$buyer_phone')";
  if(mysqli_query($connect, $insert_query)){
    // redirect to thank you page
    header("Location: thank_you.php");
    exit();
  } else {
    $message = "Error placing order. Please try again.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Order</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container">
    <h1>Order</h1>
    <p>Please fill in your details to purchase the following book:</p>
    <h3>Name of Book: <?php echo $car["name"]?></h3>
    <h4>Genre of Book: <?php echo $car["genre"]?></h4>
    <p>Price: $<?php echo $car["price"]; ?></p>
    
    <form method="post" style="
    display: flex;
    flex-direction: column;
    width: 231px;
    margin: 0 auto;
">
      <label for="buyer_name">Your Name:</label>
      <input type="text" id="buyer_name" name="buyer_name" required>
      
      <label for="buyer_email">Your Email:</label>
      <input type="email" id="buyer_email" name="buyer_email" required>
      
      <label for="buyer_phone">Your Phone Number:</label>
      <input type="tel" id="buyer_phone" name="buyer_phone" required>

      <input type="submit" name="submit" value="Purchase">
    </form>

    <div class="message"><?php echo $message; ?></div>
    <a href="index.php">Back to Home</a>
  </div>
</body>
</html>
