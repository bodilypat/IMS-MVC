<?php
    /* redirect user page */
    if(isset($_SESSION['loggedIn'])){
        header('Location: login.php');
        exist();
    }
    require_once('assing/config/constant.php')
    require_once('assign/config/dbConnect.php');
    require_once('assign/header.html');
?>

<body>
<?php
    require 'assign/navigation.php';
?>
    <!-- page content -->
    <div class="row">
        <div class="row">
            <div class="col-lg-2">
                <h1 class="my-4"></h1>
                <div class="nav flex-column nav-pills" id="v-pills-tab" rowl="tablist">
                     <a href="#v-pill-item" id="item-tab" class="nav-link active" id="v-pills-item" >Item</a>
                     <a href="#v-pill-customer" id ="customer-tab"class="nav-link" role="tab">Customer</a>
                     <a href="#v-pill-sale" id="sale-tab" class="nav-link" role="tab">Sale</a>
                     <a href="#v-pill-purchase" id="purchase-tab" classs="nav-link" role="tab">Purchase</a>
                     <a href="#v-pill-vendor" id="vendor-tab" class="nav-link" role="tab">Vendor</a>
                     <a href="#v-pill-search" id="search-tab" class="nav-link" role="tab">Search</a>
                     <a href="#v-pill-report" id="report-tab" class="nav-link" role="tab">Reports</a>
                </div>
            </div>
            <div class="col-lg-10">
                <div id="tabContent" class="tab-content" >
                    <div id="itemPanel" class="tab-panel show active" role="tabpanel">
                         <div class="card card-outline-secondary my-4">
                              <div class="card-header">Item Details</div>
                              <div class="card-body">
                                   <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item"><a href="#itemRecord" class="nav-link">Item</a></li>
                                        <li class="nav-item"><a href="#itemImage" class="nav-link">Upload Image</a></li>
                                   </ul>
                                   <!-- tab panel for item record and image section -->
                                    <div class="tab-content">
                                        <div id="itemRecord" class="container-fluid tab-panel active">
                                            <div id="itemMessage"></div>
                                            <form>
                                                <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                        <label for="ItemNumber">Item Nubmer<span class="requiredIcon">*</span></label>
                                                        <input id="itemNubmer" name="itemName" type="text" class="form-control">
                                                        <div id="itemNumberSuggestion" class="customList"></div>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="ItemProductID">Item ProductID</label>
                                                        <input id="itemProductID" name="itemProductID" type="number" class="form-control invTooltip" readonly>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="ItemName">Item Name<span class="requiredIcon">*</span></label>
                                                        <input id="itemName" name="itemName" type="text" class="form-control">
                                                        <div id="itemNameSuggestions" class="customList"></div>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="ItemStatus">Status</label>
                                                        <select id="itemStatus" name="itemStatus" class="form-control chosenSelect">Status
                                                            <?php include('assign/statusList.html'); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <textarea id="itemDescription" name="itemDescription" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group ">
                                                        <label for="ItemDiscount">Discount %</label>
                                                        <input type="text" id="itemDiscount" name="itemDiscount" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ItemQuantity">Quantity<span class="requiredIcon">*</span></label>
                                                        <input type="text" id="itemQuantity" name="itemQuantity" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="ItemUnitPrice">Unit Price<span class="requiredIcon">*</label>
                                                        <input type="text" id="itemUnitPrice" name="itemUnitPrice" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="TotalStock">Total Stock</label>
                                                        <input type="text" id="itemTotalStock" name="itemTotalStock" class="form-control" readonly>
                                                    </div>
                                                </div>
                                                <button type="button" id="addItem" class="btn btn-success">Add Item</button>
                                                <button type="button" id="updateItem" class="btn btn-primary">Update</button>
                                                <button type="button" id="deleteItem" class="btn-btn-dnager">Delete</button>
                                                <button type="reset" id="itemClear">Clear</button>
                                            </form>
                                        </div>
                                        <div id="itemImage" class="container-fluid tab-panel fade">
                                            <div id="itemImageMessage"></div>
                                            <form id="itemImage" name="itemImage" method="post">
                                                 <div class="form-row">
                                                       <div class="form-group col-md-3">
                                                            <label for="ItemImageNumber">Item Number<span class="requiredIcon">*</span></label>
                                                            <input type="text" id="itemImageNumber" name="itemImageNumber" class="form-control" >
                                                            <div id="itemImageNumberSuggestion" class="customList"></div>
                                                       </div>
                                                       <div class="form-group">
                                                            <label for="itemImageName">Item Name</label>
                                                            <input type="text" id="itemImageName" name="itemImageName" class="form-control" readonly>
                                                       </div>                                                       
                                                 </div>
                                                 <div class="form-row">
                                                       <div class="form-group col-md-7">
                                                            <label for="itemImageFile">Select Image
                                                                                (<span class="blueText">jpg</span>
                                                                                 <span class="blueText">jpeg</span>
                                                                                 <span class="blueText">gif</span>
                                                                                 <span class="blueText">png</span> only )</label>
                                                            <input type="file" id="itemImageFile" name="itemImageFile" class="form-control-file btn btn-dark">
                                                       </div>
                                                 </div>
                                                 <button type="button" id="updateImage" class="btn btn-primary">Upload Image</button>
                                                 <button type="button" id="deleteImage" class="btn btn-danger">Delete Image</button>
                                                 <button type="reset" class="btn">Clear</button>
                                            </form>
                                        </div>
                                    </div>
                              </div>
                         </div>  
                    </div>
                    <div id="customerPanel" class="tab-panel fade" role="tabpanel">
                        <div class="card card-outline-secondary my-4">
                             <div class="card-header">Purchase Details</div>
                             <div class="card-body">
                                  <div id="customerMessage"></div>
                                  <form>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="CustomerFullName">Customer Name<span class="requiredIcon">*</span></labe>
                                                <input type="text" id="customerFullname" name="customerFullname" class="form-control">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="CustomerStatus">Status</label>
                                                <select id="customerStatus" name="customerStatus" class="form-control chosenSelect">
                                                       <?php include('assign/statusList.php');?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                 <lable for="CustomerID">CustomerID</label>
                                                 <input type="text" id="customerID" name="customerID" class="form-control invTooltip" >
                                                 <div id="customerIDSuggestion" class="customList"></div>
                                            </div>                                            
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="CustomerMobile">Mobile</label>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="form-group col-md-3">Phone</label>
                                                <input type="text" id="customerPhone" name="customerPhone" class="form-control invTooltip">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="CustomerEmail">Email</label>
                                                <input type="text" id="customerEmail" name="customerEmail" class="form-control invTooltip">
                                            </div>
                                        </div>
                                        <div class="form-group ">
                                              <label for="CustomerAddress">Address</label>
                                              <input type="text" id="customerAddress" name="customerAddress" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                              <label for="CustomerAddress2">Address2</label>
                                              <input type="text" id="customerAddress" name="customerAddress2" class="form-control">
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="CustomerCity">City</label>
                                                <input type="text" id="customerCity" name="customerCity" class="form-control">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="CustomerDistrict">District</label>
                                                <select id="customerDistrict" name="customerDistrict" class="form-control chosenSelect">
                                                      <?php include('assign/districtList.html'); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="button" id="addCustomer" name="btn btn-success">Add Customer</button>
                                        <button type="button" id="updateCustomer" name="btn btn-primary">Update </button>
                                        <button type="button" id="deleteCustomer" name="deleteCustomer">Delete</button>
                                        <button type="reset" class="btn">Clear</button>
                                  </form>
                             </div>
                        </div>
                    </div>
                    <div id="SalePanel" class="tab-panel fade" role="tabpanel">
                        <div class="card card-outline-secondary my-4">
                            <div class="card-body">
                                  <div id="saleMessage"></div>
                                  <form>
                                       <div class="form-row">
                                            <div class="form-group col-md-3">
                                                 <label for="SaleItemNumber">Item Number<span class="requireIcon">*</span></label>
                                                 <input type="text" id="saleItemNumber" name="saleItemNumber" class="form-control">
                                                 <div id="saleItemNumberSuggesstion" class="customList" ></div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="SaleCustomerID">Customer ID<span class="requiredIcon">*</span></label>
                                                <input type="text" id="saleCustomerID" name="customerID" class="form-control">
                                                <div id="saleCustomerIDSuggestion" class="customList"></div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="saleCustomerName">Customer Name</label>
                                                <input type="text" id="saleCustomerName" name="saleCustomerName" class="form-control">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="SaleID">sale ID</label>
                                                <input type="text" id="saleID" name="saleID" class="form-control invTooltip" >
                                                <div id="saleIDSuggestion" class="customList"></div>
                                            </div>
                                       </div>
                                       <div class="form-row">
                                            <div class="form-group col-md-5">
                                                <label for="SaleItemName">Item Name</label>
                                                <input type="text" id="saleItemName" name="saleItemName" class="form-control invTooltip" readonly>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="SaleDate">Sale Date</label>
                                                <input type="text" id="saleDate" name="saleDate" class="form-control datepicker" value="">
                                            </div>
                                       </div>
                                       <div class="form-row">
                                            <div class="form-group col-md-2">
                                                <label for="TotalStock">Total Stock</label>
                                                <input type="text" id="totalStock" name="totalStock" class="form-control" readonly>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="SaleDiscount">Discount %</label>
                                                <input type="number" id="saleDiscount" name="saleDiscount" class="form-control" value="0">                                                
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="SaleQuantity">Quantity<span class="requiredIcon">*</span></label>
                                                <input type="number" id="saleQuantity" name="saleQuantity" class="form-control" value="0">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="SaleUnitPrice">Unit Price</label>
                                                <input type="number" id="saleUnitPrice" name="saleUnitPrice" class="form-control" value="0">
                                            </div>
                                            <div class="form-group col-ml-3">
                                                <label for="SaleTotal">Total</label>
                                                <input type="text" id="saleTotal" name="saleTotal" class="form-control">
                                            </div>
                                       </div>
                                       <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <div id="saleImageContainer"></div>
                                            </div>
                                       </div>
                                       <button type="button" id="addsale" class="btn btn-success">Add Sale</button>
                                       <button type="button" id="updateSale" class="btn btn-primary">Update Sale</button>
                                       <button type="reset" id="saleClear" class="btn">Clear</button>
                                  </form>
                            </div>
                        </div>   
                    </div>
                    <div class="purchasePanel" class="tab-panel fade" role="tabpanel">
                        <div class="card card-outline-seccondary my-4">
                             <div class="card-header">Purchase Details</div>
                             <div class="card-body">
                                  <div id="purchaseMessage"></div>
                                  <form>
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="PurchaseItemNumber">Item Number<span class="requiredIcon">*</span></label>
                                                <input type="text" id="purchaseItemNumber" name="purchaseItemNumber" class="form-control">
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="PurchaseDate">Purchase Date<span class="requiredIDf">*</span></label>
                                                <input type="text" id="purchaseDate" name="purchaseDate" class="form-control datepicker">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="PurchaseID">Purchase ID</label>
                                                <input type="text" id="purchaseID" name="purchaseID" class="form-control invTooltip">
                                                <div id="purchaseIDSuggestion" class="customList"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="PurchaseItemName">Item Number<span class="requiredIcon">*</span></label>
                                                <input type="text" id="PurchaseItemName" name="purchaseItemName" class="form-control" readonly>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="PurchaseCurrentStock">Current Stock</label>
                                                <input type="text" id="purchaseCurrentstock" name="purchaseCurrentStock" class="form-control" readonly>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="PurchaseVendorName">Vendor Name<span class="requiredIcon">*</span></label>
                                                <select type="text" id="purchaseVendorName" name="purchaseVendorName" class="form-control">
                                                    <?php require ('model/vendor/getVendorName.php'); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-2">
                                                <label for="PurchaseQuantity">Quantity<span class="requiredIcon">*</span></label>
                                                <input type="text" id="purchaseQuantity" name="purchaseQuantity" class="form-control" value="0">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="PurchaseUnitPrice">Unit Price<span class="requiredIcon">*</span></label>
                                                <input type="number" id="purchaseUnitPrice" name="purchaseUnitPrice" class="form-control" value="0">
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="PurchaseTotalCost">Total Cost</label>
                                                <input type="text" id="purchaseTotalCost" name="purchaseTotalCost" class="form-control">
                                            </div>
                                        </div>
                                        <button type="button" id="addPurchase" class="btn btn-primary">Add Purchase</button>
                                        <button type="button" id="updatePurchase" class="btn btn-danger">Update Purchase</button>
                                        <button type="reset" class="btn">Clear</button>
                                  </form>
                             </div>
                        </div>
                    </div>
                    <div id="vendorPanel" class="tab-panel fade" role="panel">
                        <div class="card card-outline secondary my-4">
                            <div class="card-header">Vendor Details</div>
                            <div class="card-body">
                                  <div id="vendorMessage"></div>
                                  <form>
                                       <div class="form-row">
                                            <div class="form-group">
                                                <label for="VendorFullName">Vendor Name<span class="requiredIcon">*</span></label>
                                                <input type="text" id="VendorFullName" name="vendorFullName" class="form-control invTooltip" >
                                            </div>
                                            <div class="form-group">
                                                <label for="VendorStatus">Status</label>
                                                <select id="vendorStatus" name="vendorStatus" class="form-control chosenSelect">
                                                     <?php include('include/statusList.html'); ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="VendorEmail">Email</label>
                                                <input type="text" id="vendorEmail" name="vendorEmail" class="form-control">
                                            </div>
                                       </div>
                                       <div class="form-row">
                                            <div class="form-group">
                                                <label for="VendorMobile">Mobile Nunber<span class="requiredIcon">*</span></label>
                                                <input type="text" id="vendorMobile" name="vendorMobile" class="form-control invTooltip">
                                            </div>
                                            <div class="form-group">
                                                <label for="VendorPhone">Phone Number</label>
                                                <input type="text" id="vendorPhone" name="vendorPhone" class="form-control invTooltip">
                                            </div>
                                            <div class="form-group">
                                                <label for="VendorEmail">Email</label>
                                                <input type="text" id="vendorEmail" name="vendorEmail" class="form-control" >
                                            </div>
                                       </div>
                                       <div class="form-group">
                                            <label for="VendorAddress">Address<span class="requiredIcon">*</span></label>
                                            <input type="text" id="vendorAddress" name="vendorAddress2" class="form-control">
                                       </div>
                                       <div class="form-group">
                                            <label for="VendorAddress2">Address 2</label>
                                            <input type="text" id="vendorAddress2" name="vendorAddress2" class="form-control">
                                       </div>
                                       <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="VendorDistrict">City</label>
                                                <input type="text" id="vendorCity" name="vendorCity" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="VendorDistrict">District</label>
                                                <select id="vendorDistrict" name="vendorDistrict" class="form-control chosenSelect">
                                                    <?php include('include/districtList.html'); ?>
                                                </select>
                                            </div>
                                       </div>
                                       <button type="button" id="addVendor" class="btn btn-success">Add vendor</button>
                                       <button type="button" id="updateVendor" class="btn btn-primary">Update</button>
                                       <button type="button" id="deleteVendor" class="btn btn-danger">Delete</button>
                                       <button type="reset" class="btn">Clear</button>
                                  </form>
                            </div>
                        </div>
                    </div>
                    <!-- tab list search -->
                    <div id="searchPanel" class="tab-panel" role="tabpanel">
                        <div class="card card-outline secondary my-4">
                            <div class="card-header">Search Inventory
                                <button id="searchTableRefresh" name="searchTableRefresh" class="btn btn-warning float-right btn-sm">Refresh</button>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item"><a href="#searchItem" class="nav-link active" data-toggle="tab">Item</a></li>
                                    <li class="nav-item"><a href="#searchCustomer" class="nav-link" data-toggle="tab">Customer</a></li>
                                    <li class="nav-item"><a href="#searchSale" class="nav-link" data-toggle="tab">Sale</a></li>
                                    <li class="nav-item"><a href="#searchPurchase" class="nav-link" data-toggle="tab">Purchase</a></li>
                                    <li class="nav-item"><a href="#searchVendor" class="nav-link" data-toggle="tab">Vendor</a></li>
                                </ul>
                                <!-- tab panel search -->
                                <div class="tab-content">
                                    <div id="searchItem" class="container-fluid tab-panel active">
                                        <div id="searchItemTable" class="table-responsive"></div>
                                    </div>
                                    <div id="searchCustomer" class="container-fluid tab-panel">
                                        <div id="searchCustomerTable" class="table-responsive"></div>
                                    </div>
                                    <div id="searchSale" class="container-fluid tab-panel">
                                        <div id="searchSaleTable" class="table-responsive"></div>
                                    </div>
                                    <div id="searchPurchase" class="containerr-fluid tab-panel">
                                        <div id="searchPurchaseTable" class="table-responsive"></div>
                                    </div>
                                    <div id="searchVendor" class="container-fluid tab-panel">
                                        <div id="searchVendorTable" class="table-responsive"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
                <div id="reportPanel" class="tab-panel fade" role=""tabpanel>
                    <div class="card card-outline-secondary my-4">
                        <div class="card-header">
                            <button id="reportTableRefresh" id="reportTableRefresh" name="reportTableRefresh" class="btn btn-warning float-right btn-sm">Refresh</button>
                        </div>
                        <div class="card-body">
                             <ul class="nav nav-tabs" role="tablist">
                                  <li class="nav-item"><a href="#reportItem" class="nav-link active" data-toggle="tab">Item</a></li>
                                  <li class="nav-item"><a href="#reportCustomer" class="nav-link" data-toggle="tab">Customer</a></li>
                                  <li class="nav-item"><a href="#reportSale" class="nav-link" data-toggle="tab"></a>Sale</li>
                                  <li class="nav-item"><a href="#reportPurchase" class="nav-link" data-toggle="tab">Purchase</a></li>
                                  <li class="nav-item"><a href="#reportVendor" class="nav-link" data-toggle="tab">Vendor</a></li>
                             </ul>
                             <!-- tap panel report section -->
                              <div class="tabContent">
                                   <div id="reportItem" class="container-fluid tab-panel active">
                                        <div id="reportItemTable" class="table-responsive"></div>
                                   </div>
                                   <div id="reportCustomer" class="container-fluid tab-panel fade">
                                        <div id="reportCustomer" class="container-fluid tab-panel fade"></div>
                                   </div>
                                   <div id="reportSale" class="container-fluid tab-panel fade">
                                        <form>
                                            <div class="form-row">
                                                 <div class="form-group col-md-3">
                                                      <label for="reportStartDate">Start Date</label>
                                                      <input type="text" id="reportStartDate" name="reportStartDate" class="form-control datepicker" readonly>
                                                 </div>
                                                 <div class="form-group col-md-3">
                                                      <label for="reportEndDate">End Date</label>
                                                      <input type="text" id="reportEndDate" name="reportEndDate" class="form-control datepicker" readonly>
                                                 </div>
                                            </div>
                                            <button type="button" id="showSaleReport" class="btn btn-dark">Show Report</button>
                                            <button type="reset" id="saleFilterClear" class="btn">Clear</button>
                                        </form>
                                        <div id="reportSaleTable" class="table-reponsive"></div>
                                   </div>
                                   <div id="reportPurchase" class="container-fluid tab-panel fade">
                                        <form>
                                            <div class="form-row">
                                                 <div class="form-group col-md-3">
                                                      <label for="PurchaseStartDate">Start Date</label>
                                                      <input type="text" id="purchaseStartDate" name="purchaseStartDate" class="form-control datepicker" readonly>
                                                 </div>
                                                 <div class="form-group col-md-3">
                                                      <label for="PurchaseEndDate">End Date</label>
                                                      <input type="text" id="purchaseEndDate" name="purchaseEndDate" class="form-control datepicker" readonly>
                                                 </div>
                                            </div>
                                            <button type="button" id="showSaleReport" class="btn btn-dark">Show Report</button>
                                            <button typpe="reset" id="saleFilterClear" class="btn">Clear</button>
                                        </form>
                                        <div id="reprotPurchaseTable" class="container-fluid tab-panel fade"></div>
                                   </div>
                                   <div id="reportVendor" class="container-fluid tabpanel fade">
                                        <div id="reportVendorTable" class="container-fluid tab-panel fade"></div>
                                   </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require 'assign/foodter.php'; ?>
</body>
