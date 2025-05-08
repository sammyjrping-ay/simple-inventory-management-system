<?php
    if (!isset($_SESSION)){
        session_start();
    }

    include_once('connection.php');
    $con = connection();

    $sql = 'SELECT * FROM items';
    $items = $con->query($sql) or die($con->error);
    $row = $items->fetch_assoc();

    $sql = 'SELECT * FROM categories';
    $categories = $con->query($sql) or die($con->error);

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];

        $categoryselect = $_POST['categoryselect'];
        $categoryinput = $_POST['categoryinput'];

        $sql = "INSERT INTO `items`(`name`, `description`, `quantity`, `price`, `category_id`) 
                VALUES ('$name', '$description', '$quantity', '$price', 1)";
        $con->query($sql) or die($con->error);

        $sql = "SELECT * FROM `items` 
                WHERE `name` = '$name' AND `description` = '$description' 
                AND `quantity` = $quantity AND `price` = $price 
                ORDER BY `id` DESC LIMIT 1";
        $newitem = $con->query($sql) or die($con->error);
        $newitem = $newitem->fetch_assoc();
        $newitemID = $newitem['id'];

        if ($categoryinput == '') {
            $sql = "UPDATE `items` SET `category_id` = '$categoryselect' WHERE `id` = '$newitemID'";
            $con->query($sql) or die($con->error);
        } else {
            $sql = "INSERT INTO `categories`(`name`) VALUES ('$categoryinput')";
            $con->query($sql) or die($con->error);

            $sql = "SELECT * FROM `categories` WHERE `name` = '$categoryinput'";
            $result = $con->query($sql) or die($con->error);
            $category = $result->fetch_assoc();

            $sql = "UPDATE `items` SET `category_id` = '{$category['id']}' WHERE `id` = '$newitemID'";
            $con->query($sql) or die($con->error);
        }

        header("Location: read.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/create.css">
</head>
<body>
    <header>
        <h1 class="bg-dark text-white">Simple Inventory Management System</h1>
    </header>
    <main>
    <form class="card" method="post">
        <h2 class="card-title text-center">Add Item</h2>

        <label class="form-label-sm" for="name">Item Name:</label>
        <input class="form-control-sm" type="text" name="name" required>

        <label class="form-label-sm" for="description">Description:</label>
        <input class="form-control-sm" type="text" name="description">

        <label class="form-label-sm" for="quantity">Quantity:</label>
        <input class="form-control-sm" type="number" name="quantity" min="0" value="0" required>

        <label class="form-label-sm" for="price">Price:</label>
        <input class="form-control-sm" type="number" name="price" step="0.01" min="0" value="0" required>

        <div class="row mt-2">
            <label class="form-label-sm" for="category">Category:</label>
            <select class="form-select-sm col-11" name="categoryselect" id="categoryselect">
                <?php while ($categoryrow = $categories->fetch_assoc()) { ?>
                    <option value="<?php echo $categoryrow['id'] ?>"><?php echo $categoryrow['name'] ?></option>
                <?php } ?>
            </select>
            <input class="form-control-sm col-11 mt-1" type="text" name="categoryinput" style="display: none;" id="categoryinput" placeholder="New Category">
            <button class="btn btn-dark col-1 btn-sm" type="button" id="categorybutton">New</button>
        </div>

        <div class="btns mt-3">
            <a id="back" class="btn btn-outline-dark" href="read.php">Back</a>
            <input id="add" class="btn btn-dark col-1" type="submit" name="submit" value="Add Item">
        </div>
    </form>
    </main>
    <script>
        document.getElementById("categorybutton").addEventListener("click", function(event) {
            event.preventDefault(); 

            var button = document.getElementById('categorybutton');

            var selectelement = document.getElementById("categoryselect");
            var inputelement = document.getElementById("categoryinput");

            if(button.textContent == "New"){
                selectelement.style.display = "none";
                inputelement.style.display = "inline-block";
                button.textContent = "Cancel";
            } else {
                selectelement.style.display = "inline-block";
                inputelement.style.display = "none";
                inputelement.value = "";
                button.textContent = "New";
            }
        });
    </script>
</body>
</html>