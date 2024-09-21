<?php include('config/dbconnect');?>
<?php include ('define/header.php');?>
<div class="container-mt-5">
    <h1>Item Inventory</h1>
    <!-- add item form -->
    <form method="POST" action="add_item.php" class="mb-4">
        <div class="form-group">
            <input class="text" id="name" name="name" placeholder="Item Name" class="form-control"  required>
        </div>
        <div class="form-group">
            <input type="text"  id="name" name="description" placeholder="Description" class="form-control" required>
        </div>
        <div class="form-group">
            <input type="number" id="name" name="quantity" placeholder="Quantity" class="form-control" requried>
        </div>
        <div class="form-group">
            <input type="text" id="name" name="price" placeholder="Price" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Item</button>
    </form>
    <!-- Display Items -->
    <table class="table table-bordered">
        <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Actions</th>
        </thead>
        <tbody>
        <?php
            $qItem = mysqli_query($handle,"SELECT * FROM items");
            $count=1;
            while($result=mysqli_fetch_array($qItem))
            {
        ?>
            <tr>
                 <td><?php echo $result['id'];?></td>
                 <td><?php echo $result['name'];?></td>
                 <td><?php echo $result['description'];?></td>
                 <td><?php echo $result['quantity'];?></td>
                 <td><?php echo $result['price'];?></td>
                 <td>
                    <a href="edit_item.php?edit=" >Edit</a>
                    <a href="delete_item.php?delid = ">Delete</a> 
                 </td>
            </tr>  
        <?php    } ?>

        </tbody>
    </table>
</div>