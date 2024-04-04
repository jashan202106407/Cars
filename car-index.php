<?php
session_start();

include 'dbinfo.php';

$cars_query = "SELECT * FROM cars";
$cars_result = mysqli_query($con, $cars_query);

$background_image_url = "image1.png"; 
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cars Dashboard</title>
<style>
    body {
        background-image: url('<?php echo $background_image_url; ?>');
        background-size: cover;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 800px;
        margin: 20px auto;
        background-color: rgba(255, 255, 255, 0.8);
        padding: 20px;
        border-radius: 10px;
    }
    h1 {
        text-align: center;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    .add-form {
        margin-bottom: 20px;
    }
    .add-form label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .add-form input[type="text"],
    .add-form textarea {
        width: calc(100% - 18px);
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    .add-form input[type="submit"] {
        width: 100%;
        padding: 10px;
        border: none;
        background-color: #653b70;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .add-form input[type="submit"]:hover {
        background-color: #653b70
    }
</style>
</head>
<body>

<div class="container">
    <h1>Trending cars</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th>Image</th>
        </tr>
        <?php
        if ($cars_result->num_rows > 0) {
            while($row = $cars_result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["title"] . "</td>";
                echo "<td>" . substr($row["content"], 0, 100) . "...</td>";
                echo "<td><img src='" . $row["image_url"] . "' alt='car Image' style='max-width: 100px; max-height: 100px;'></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No cars found</td></tr>";
        }
        ?>
    </table>

    <div class="add-form">
        <h3>Add New car</h3>
        <form method="post" action="add-car.php">
            <label for="car_title">Title:</label><br>
            <input type="text" id="car_title" name="car_title" required><br>
            <label for="car_content">Content:</label><br>
            <textarea id="car_content" name="car_content" required></textarea><br>
            <label for="car_image_url">Image URL:</label><br>
            <input type="text" id="car_image_url" name="car_image_url"><br><br> 
            <input type="submit" name="add_car" value="Add car">
        </form>
    </div>
</div>
</body>
</html>
