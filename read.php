<?php
    if (!isset($_SESSION)){
        session_start();
    }

    include_once('connection.php');
    $con = connection();

    $sql = "SELECT 
            items.id AS ItemID,
            items.name AS ItemName,
            items.description,
            items.quantity,
            items.price,
            items.created_at,
            items.updated_at,
            items.category_id,
            categories.name AS CategoryName
        FROM 
            items
        INNER JOIN 
            categories ON items.category_id = categories.id";
    $itemrecords = $con->query($sql) or die ($con->error);

    $Search = "";

    $sql = 'SELECT * FROM categories';
    $categories = $con->query($sql) or die ($con->error);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISPSC - Library Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/navbar.css">
</head>
<body>
    <header>
        <h1 class="text-center text-white bg-dark">Simple Inventory Management System</h1>
    </header>
    <div class="container">
        <main>
            <form action="result.php" method="get">
                <input type="text" name="Search" id="search" placeholder="Search" value="<?php echo $Search?>">
                
                <div>
                    <label for="category">Category:</label>
                    <select name="CategoryID" id="category">
                        <option value="">Any</option>
                        <?php while ($categoryrow = $categories->fetch_assoc()) { ?>
                            <option value="<?php echo  $categoryrow['id'] ?>"><?php echo  $categoryrow['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div>
                    <label for="sort">Sort by:</label>
                    <select name="sort" id="sort">
                        <option value="items.name">Item Name</option>
                        <option value="items.quantity">Quantity</option>
                        <option value="items.price">Price</option>
                        <option value="categories.name">Category</option>
                        <option value="items.created_at">Date Added</option>
                    </select>
                </div>

                <div>
                    <button id="search-btn" class="btn btn-dark btn-sm" type="submit">Search</button>
                    <a class="btn btn-dark btn-sm add-btn" href="create.php">Add Item</a>
                </div>

                <a class="btn btn-outline-dark btn-sm logout" href="logout.php">LOGOUT</a>
            </form>
            <table class="table table-light table-hover text-center">
                <thead>
                    <tr class="table-dark">
                        <th>Name</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Date Added</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $itemrecords->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['ItemName']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td><?php echo $row['CategoryName']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td>
                                <a class="btn btn-outline-secondary" href="update.php?id=<?php echo $row['ItemID']; ?>">Edit</a>
                            </td>
                            <td>
                                <a class="btn btn-outline-danger" href="delete.php?id=<?php echo $row['ItemID']; ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                            </td>
                        </tr>
                    <?php }  ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>