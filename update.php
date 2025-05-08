<?php
    if (!isset($_SESSION)){
        session_start();
    }

    include_once('connection.php');
    $con = connection();

    $itemID = $_GET['id'];

    $sql = "SELECT * FROM items WHERE id = $itemID";
    $item = $con->query($sql) or die($con->error);
    $item = $item->fetch_assoc();
    
    $sql = "SELECT * FROM categories";
    $categories = $con->query($sql) or die($con->error);
    
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
    
        $categoryselect = $_POST['categoryselect'];
        $categoryinput = $_POST['categoryinput'];
    
        // Set temporary category ID
        $tempCategoryID = 1;
    
        // First, update the item with placeholder/default category
        $sql = "UPDATE items SET 
            name = '$name', 
            description = '$description', 
            quantity = '$quantity', 
            price = '$price', 
            category_id = $tempCategoryID 
            WHERE id = $itemID";
        $con->query($sql) or die($con->error);
    
        // Category handling
        if ($categoryinput == '') {
            $sql = "UPDATE items SET category_id = '$categoryselect' WHERE id = $itemID";
            $con->query($sql) or die($con->error);
        } else {
            $sql = "INSERT INTO categories(name) VALUES ('$categoryinput')";
            $con->query($sql) or die($con->error);
    
            $sql = "SELECT * FROM categories WHERE name = '$categoryinput'";
            $category = $con->query($sql) or die($con->error);
            $category = $category->fetch_assoc();
    
            $sql = "UPDATE items SET category_id = '{$category['id']}' WHERE id = $itemID";
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
        <h2 class="text-center card-title">Edit Item</h2>

        <label class="form-label-sm" for="name">Name:</label>
        <input class="form-control-sm" type="text" name="name" value="<?php echo $item['name']; ?>" required>

        <label class="form-label-sm" for="description">Description:</label>
        <input class="form-control-sm" type="text" name="description" value="<?php echo $item['description']; ?>">

        <label class="form-label-sm" for="quantity">Quantity:</label>
        <input class="form-control-sm" type="number" name="quantity" min="0" value="<?php echo $item['quantity']; ?>" required>

        <label class="form-label-sm" for="price">Price:</label>
        <input class="form-control-sm" type="number" name="price" min="0" step="0.01" value="<?php echo $item['price']; ?>" required>

        <div class="row">
            <label class="form-label-sm" for="category">Category:</label>
            <select class="form-select-sm col-11" name="categoryselect" id="categoryselect">
                <?php while ($categoryrow = $categories->fetch_assoc()) { ?>
                    <option value="<?php echo $categoryrow['id']; ?>" <?php echo ($categoryrow['id'] == $item['category_id']) ? 'selected' : ''; ?>>
                        <?php echo $categoryrow['name']; ?>
                    </option>
                <?php } ?>
            </select>
            <input class="form-control-sm col-11" type="text" name="categoryinput" style="display: none;" id="categoryinput">
            <button class="btn btn-dark btn-sm col-1" id="categorybutton">New</button>
        </div>

        <div class="btns mt-2">
            <a id="back" class="btn btn-outline-dark btn-sm" href="read.php">Back</a>
            <input id="save" class="btn btn-dark btn-sm" type="submit" name="submit" value="Save">
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