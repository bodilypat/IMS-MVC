<?php
    session_start();
    error_report(0);
    include('../config/dbconnect.php');

    if(strlen($_SESSION['id'] == 0 ))
    { 
        header('location:logout.php');
    } else {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin | Dashboard</title>
        <!-- Custom css -->
        <link rel="stylesheet" href="../assets/css/styles.css">
    </head>
<body>
    <!-- SECTION APP -->
    <div id="app">
        <?php incldue('layouts/sidebar.php');?>
        <div class="app-content">
            <?php include('layouts/header.php');?>
            <div class="main-content">
                <div id="container" class="wrapper-content container" >
                    <!-- PAGE TITLE -->
                    <section id="page-title">
                        <div class="row">
                            <div class="col-sm-8"><h1 class="mainTitle">Admin | Dashboard</div>
                            <ol class="breadcrumb">
                                <li><span>Admin</span></li>
                                <li class="active"><span>Dashboard</span></li>
                            </ol>
                        </div>
                     </section>
                    <!-- SECTION PANEL -->
                    <div class="container-fluid container-full bg-blue">
                        <div class="row">
                            <!-- Customer panel -->
                            <div class="col-sm-4">
                                <div class="panel panel-blue no-radius text-center">
                                    <div class="pane-body">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                                            <i class="fa fa-smaile-0 fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h2 class="StepTitle">Manage Products</h2>
                                        <p class="links cl-effect-1">
                                            <a href="Manage-products.php">
                                                <?php
                                                    $qCust = mysqli_query($dbcon,"SELECT * FROM customers");
                                                    $numRows = mysqli_num_rows($qCust){
                                                ?>
                                                    Total Products = <?php echo htmlentities($numRows);
                                                    } ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Sales panel-->
                            <div class="col-sm-4">
                                <div class="container-fluid contrainer-full bg-blue">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                                            <i class="fa fa-smail-o fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h2>Manage Sales</h2>
                                        <p class="links cl-effect-1">
                                            <a href="manage-sales.php">
                                                <?php
                                                    $qSale = mysqli_query($dbcon,"SELECT * FROM sales");
                                                    $numRows = mysqli_num_rows($qSale){
                                                ?>
                                                    Total Sales = <?php htmlentities($numRows);
                                                    } ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Product panel -->
                            <div class="col-sm-4">
                                <div class="panel panel-blue no-radus text-center">
                                     <div class="panel-body">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-square fa-stacck-2x text-primary"></i>
                                            <i class="fa fa-smaile-o fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h2 class="StepTitle">Manage Products</h2>
                                        <p class="links cl-effect-1">
                                            <a href="manage-products.php">
                                                <?php
                                                    $qPro = mysqli_query($dbcon,"SELECT * FROM products");
                                                    $numRows = mysqli_num_rows($qPro){
                                                ?>
                                                    Total Products = <?php echo htmlentities($numRows);
                                                } ?>
                                            </a>
                                        </p>
                                     </div>
                                </div>
                            </div>
                            <!-- Supplier panel -->
                            <div class="col-sm-4">
                                <div class="panel panel-blue no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-square text-primary"></i>
                                            <i class="fa fa-smail-o fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h2 class="StepTitle">Manage Suppliers</h2>
                                        <p class="links cl-effect-1">
                                            <a href="manage-subpliers.php">
                                                <?php
                                                    $qSup = mysqli_query($dbcon,"SELECT * FROM suppliers");
                                                    $numRows = mysqli_num_rows($qSup){
                                                ?>
                                                    Total Supliers = <?php echo htmlentities($qSup); 
                                                    } ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Purchase panel -->
                            <div class="col-sm-4">
                                <div class="panel panel-blue no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                                            <i class="fa fa-smail-o fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h2 class="StepTitle">Manage Purchases</h2>
                                        <p class="links cl-effect-1">
                                            <a href="manage-purchases.php">
                                                <?php 
                                                    $qPur = mysqli_query($dbcon,"SELECT * FROM purchases");
                                                    $numRows = mysqli_num_rows($qPur){
                                                ?>
                                                    Total purchases = <?php echo htmlentities($numRows);
                                                    } ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Vendor panel -->
                            <div class="col-sm-4">
                                <div class="panel panel-blue no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                                            <i class="fa fa-smail-o fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h2 class="StepTitle">Manage Vendors</h2>
                                        <p class="links cl-effect-1">
                                            <a href="manage-vendors.php">
                                                <?php   
                                                    $qVen = mysqli_query($dbcon,"SELECT * FORM vendors");
                                                    $numRows = mysqli_num_rows($qVen){
                                                ?>
                                                    Total Vendors = <?php echo htmlentities($numRows); 
                                                    } ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Item panel -->
                            <div class="col-sm-4">
                                <div class="panel panel-blue no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                                            <i class="fa fa-smail fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h2 class="stepTitle">Manage Items</h2>
                                        <p class="links cl-effect-1">
                                            <a href="manage-items.php">
                                                <?php   
                                                    $qItem = mysql_query($dbcon,"SELECT * FROM items");
                                                    $numRows = mysqli_num_rows($qItem){
                                                ?>
                                                    Total Items = <?php echo htmlentties($numRows);
                                                    } ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Categories panel -->
                            <div class="col-sm-4">
                                <div class="panel panel-blue noo-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                                            <i class="fa fa-smail fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h2 class="StepTitle">Manage Categories</h2>
                                        <p class="links cl-effect-1">
                                            <a href="manage-categories.php">
                                                <?php
                                                    $qCat = mysqli_query($dbconn,"SELECT * FROM categories");
                                                    $numRows = mysqli_num_rows($qCat){
                                                ?>
                                                    Total Categories = <?php echo htmlentities($numRows);
                                                    } ?>

                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('../layout/footer.php');?>
        <?php include('../layouts/setting.php');?>
    </div>
    <script src="../asset/js/main.js"></script>
    <script src="../asset/js/form-element.js"></script>
    <script>
        jQuery(document).ready(function(){
            Main.init();
            Form-elements.init();
        });
    </script>
</body>
</html>
<?php
    } 
?>
