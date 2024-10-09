<?php
    session_start();
    error_report(0);
    include('../includes/dbconnect.php');
    include('../includes/functions.php');

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
        <?php incldue('../includes/sidebar.php');?>
        <div class="app-content">
            <?php include('../includes/header.php');?>
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
                                            <a href="manage_customers.php">
                                                <?php
                                                    $qCust = getCustomers();
                                                    $numRows = mysqli_num_rows($qCust){
                                                ?>
                                                    Total Customers = <?php echo htmlentities($numRows);
                                                    } ?>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Categories panel-->
                            <div class="col-sm-4">
                                <div class="container-fluid contrainer-full bg-blue">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                                            <i class="fa fa-smail-o fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h2>Manage Categories</h2>
                                        <p class="links cl-effect-1">
                                            <a href="manage_categorys.php">
                                                <?php
                                                    $qCate = getCategories();
                                                    $numRows = mysqli_num_rows($qCat){
                                                ?>
                                                    Total Categories = <?php htmlentities($numRows);
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
                                            <a href="manage_products.php">
                                                <?php
                                                    $qPro = getProducts();
                                                    $numRows = mysqli_num_rows($qPro){
                                                ?>
                                                    Total Products = <?php echo htmlentities($numRows);
                                                } ?>
                                            </a>
                                        </p>
                                     </div>
                                </div>
                            </div>
                            <!-- Sale panel -->
                            <div class="col-sm-4">
                                <div class="panel panel-blue no-radius text-center">
                                    <div class="panel-body">
                                        <span class="fa-stack fa-2x">
                                            <i class="fa fa-square text-primary"></i>
                                            <i class="fa fa-smail-o fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h2 class="StepTitle">Manage Sales</h2>
                                        <p class="links cl-effect-1">
                                            <a href="manage_sales.php">
                                                <?php
                                                    $qSale = getSales();
                                                    $numRows = mysqli_num_rows($qSale){
                                                ?>
                                                    Total Sales = <?php echo htmlentities($numRows); 
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
                                            <a href="manage_purchases.php">
                                                <?php 
                                                    $qPur = getPurchases();
                                                    $numRows = mysqli_num_rows($qPur){
                                                ?>
                                                    Total purchases = <?php echo htmlentities($numRows);
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
                                            <i class="fa fa-square fa-stack-2x text-primary"></i>
                                            <i class="fa fa-smail-o fa-stack-1x fa-inverse"></i>
                                        </span>
                                        <h2 class="StepTitle">Manage Suppliers</h2>
                                        <p class="links cl-effect-1">
                                            <a href="manage_suppliers.php">
                                                <?php   
                                                    $qSup = getSupplier();
                                                    $numRows = mysqli_num_rows($qVen){
                                                ?>
                                                    Total Suppliers = <?php echo htmlentities($numRows); 
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
        <?php include('../includes/footer.php');?>
        <?php include('../includes/setting.php');?>
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
