<?php
    session_start();
    if(!isset($_SESSION['loggedIn']))
    {
        header('Location: login.php');
        exit();
    }
    require_once('define/config/constants.php');
    require_once('define/config/dbconnect.php');
    require_once('define/header.php');
?>
<body>
<?php
    require 'define/navigation.php';
?>
    <!-- page content -->
    <div class="container-fluid">
          <div class="row">
                <div class="col-lg-2">
                      <h1 class="my-4"></h1>
                      <div class="nav flex-column nav-pills" id="v-pills-tab">
                            <a id="v-pills-item"></a>
                            <a id="v-pills-customer"></a>
                            <a id="v-pills-sale"></a>
                            <a id="v-pills-purchase"></a>
                            <a id="v-pills-vendor"></a>
                            <a id="v-pills-search"></a>
                            <a id="v-pills-reports"></a>
                      </div>
                </div>
                <div class="col-lg-10">
                      <div id="v-pills-tabcontent">
                            <div id="v-pills-item">
                                  <div class="card-header">Item Details</div>
                                  <div class="card-body">
                                        <ul>
                                             <li><a href="#itemTab">Item</a></li>
                                             <li><a href="#imageTab">Upload Image</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="itemTab" class="container-fluid">
                                                <div id="itemMessage"></div>
                                                <form>
                                                    <div class="form-row">
                                                        <div class="form-group">
                                                            <label for="ItemNumber">Item Number</label>
                                                            <input id="itemNumber" name="itemNumber" class="form-control">
                                                        </div>
                                                        <div class="form-growp">
                                                            <label for="ItemProductID">Product ID</label>
                                                            <input id="itemProductID" name="itemProductID" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group">
                                                            <label for="ItemName">Item Name</label>
                                                            <input id="itemName" name="itemName" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ItemStatus">Item Status</label>
                                                            <select id="itemStatus" name="itemStatus" class="form-control" >
                                                                <?php include('define/statusLsit.html');?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group">
                                                            <label for="ItemDescription">Item Description</label>
                                                            <textarea id="itemDescription" name="itemDescription" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group">
                                                            <label for="ItemDiscount">Discount</label>
                                                            <input id="itemDiscount" name="itemDescount" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ItemQuantity">Quantity</label>
                                                            <input id="itemQuantity" name="itemQuantity" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ItemUnitPrice">Unit Price</label>
                                                            <input id="itemUnitPrice" name="itemUnitPrice" class="formContro">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ItemTotalStock">Total Stock</label>
                                                            <input id="itemTotalStock" name="itemTotalStock" class="form-control">
                                                        </div>
                                                    </div>
                                                    <button></button>
                                                    <button></button>
                                                    <button></button>
                                                    <button></button>
                                                </form>
                                            </div>
                                            <div id="itemImage" class="container-fluid">
                                                <div id="itemImageMessage"></div>
                                                    <form name="imageForm" id="imageForm" method="post">
                                                          <div class="form-row">
                                                                <div class="form-group">
                                                                     <label for="ItemImageNumber">Item Image Number</label>
                                                                     <input id="itemImageNumber" name="itemImageNumber" class="form-control" >
                                                                     <div id="itemNumberPresentation"></div>
                                                                </div>
                                                                <div class="form-group">
                                                                     <label for="ItemImageName">Item Image Name</label>
                                                                     <input id="itemImageName" name="itemImageName" class="form-control">
                                                                </div>
                                                          </div>
                                                          <div class="form-row">
                                                               <div class="form-group">
                                                                    <label for="itemImageFile">Select Image(<span class="blueText">jpg</span>,
                                                                                                            <span class="blueText">jpeg</span>,
                                                                                                            <span class="blueText">gif</span>,
                                                                                                            <span class="blueText">png</span> only )
                                                                    </label>
                                                                    <input type="file" id="itemImageFile" name="ItemImageFile" class="form-control">
                                                               </div>
                                                          </div>
                                                          <button></button>
                                                          <button></button>
                                                          <button></button>
                                                    </form>
                                              </div>
                                        </div>
                                  </div>
                            </div>
                      </div>
                      <div id="v-pills-customer" role="tabpanel">
                           <div class="card">
                                <div class="card-header">customer Details</div>
                                <div class="card-body">
                                       <div id="customerMessage"></div>
                                       <form>
                                            <div class="form-row">
                                                 <div class="form-group">
                                                      <label for="CustomerFullName">Full Name</label>
                                                      <input id="customerFullName" name="customerFullName" class="form-control" >
                                                 </div>
                                                 <div class="form-group">
                                                       <label for="customerStatus">Status</label>
                                                       <select id="customerStatus" name="customerStatus" class="form-control">
                                                             <?php include('define/statusList.php');?>
                                                       </select>
                                                 </div>
                                                 <div class="form-group">
                                                      <label for="customerMobile">Mobile</label>
                                                      <input id="customerID" name="customerID" class="form-control">
                                                      <div id="customerIDPresentation"></div>
                                                 </div>
                                            </div>
                                            <div class="form-row">
                                                 <div class="form-group">
                                                      <label for="CustomerMobile">Mobile</label>
                                                      <input id="customerMobile" name="customerMobile" class="form-control">
                                                 </div>
                                                 <div class="form-group">
                                                      <label for="CustomerPhone">Phone</label>
                                                      <input id="customerPhone" name="customerPhone" class="form-control">
                                                 </div>
                                                 <div class="form-group">
                                                      <label for="CustomerEmail">Email</label>
                                                      <input id="customerEmail" name="customerEmail" class="form-control">
                                                 </div>
                                            </div>
                                            <div class="form-group">
                                                 <label for="CustomerAddress">Address</label>
                                                 <input id="customerAddress" name="customerAddress" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                 <label for="CustomerAddress2">Address2</label>
                                                 <input id="customerAddress2" name="customerAddress2" class="form-control" > 
                                            </div>
                                            <div class="form-row">
                                                 <div class="form-group">
                                                       <label for="CustomerCity">City</label>
                                                       <input id="customerCity" name="customerCity" class="form-control" >
                                                 </div>
                                                 <div class="form-group">
                                                      <label for="CustomerDistrict">Distric</label>
                                                      <select id="customerDistrict" name="customerDistrict" class="form-control" >
                                                           <?php include('define/statusList.php'); ?>
                                                      </select>
                                                 </div>
                                            </div>
                                            <button type="btutton" id="addCustomer" class="btn btnn-success">Add customer</button>
                                            <button type="button" id="updateCustomer" class="btn btn-primary">Update</button>
                                            <button type="button" id="deleteCustomer" class="btn btn-danger">Delete</button>
                                            <button tyye="reset" class="btn">Clear</button>
                                       </form>
                                 </div>
                           </div>                           
                      </div>
                      <div id="v-pills-sale" role="sale">
                            <div class="card">
                                <div class="card-header">Sale Details</div>
                                <div class="card-body">
                                    <form>
                                        <div class="form-row">
                                            <div class="form-group">
                                                 <label for="SaleItemNumber"></label>
                                                 <input id="saleItemNumber" name="saleItemNumber" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                  <label for="SaleCustomerID">CustomerID</label>
                                                  <input id="saleCustomerID" name="saleCustomeID" class="form-control" >
                                            </div>
                                            <div class="form-group">
                                                  <label for="SaleCustomerName">Customer Name</label>
                                                  <input id="saleCustoemrName" name="saleCustomerName" class="form-control" >
                                            </div>
                                            <div class="form-group">
                                                  <label for="SaleID">Sale ID</label>
                                                  <input id="saleID" name="saleID" class="form-control">
                                                  <div id="saleIDPresentation"></div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group">
                                                  <label for="SaleItemName">Sale ItemName</label>
                                                  <input id="saleItemName" name="saleItemName" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                  <label for="SaleDate">Sale Date</label>
                                                  <input id="saleDate" name="saleDate" clas="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group">
                                                  <label for="SaleTotalStock">Total Stock</label>
                                                  <input id="saleTotalStock" name="saleTotalStock" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                  <label for="SaleDiscount">Discount %</label>
                                                  <input id="saleDiscount" name="saleDiscount" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                  <label for="SaleQuantity">Quantity</label>
                                                  <input id="saleQuantity" name="saleQuantity" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                  <label for="SaleUnitprice">UnitPrice</label>
                                                  <input id="saleUnitPrice" name="saleUnitPrice" class="form-control">
                                            </div>
                                        </div>                                            
                                        <button type="button" id="addSale" class="btn btn-success">Add Sale</button>
                                        <button type="button" id="updateSale" class="btn btn-primary">Update Sale</button>
                                        <button type="reset" class="btn">Clear</button>
                                    </form>
                                </div>
                            </div>
                      </div>
                      <div id="v-pills-purchase" role="tablist">
                            <div class="card">
                                  <div class="card-header">Purchase Details</div>
                                  <div class="card-body">
                                        <div id="purchaseMessage"></div>
                                        <form>
                                              <div class="form-row">
                                                    <div class="form-group">
                                                          <label for="PurchaseItemNumber">Item Number</label>
                                                          <input id="purchaseItemNumber" name="purchaseItemNumber" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                          <label for="PurchaseDate">Purchase Date</label>
                                                          <input id="purchaseDate" name="purchaseDate" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                          <label for="PurchaseID">Purchase ID</label>
                                                          <input id="purchaseID" name="purchaseID" class="form-control">
                                                    </div>
                                              </div>
                                              <div class="form-row">
                                                    <div class="form-group">
                                                          <label for="PurchaseItemName">Item Number</label>
                                                          <input id="purchaseItemName" name="purchaseItemName" class="form-control">                                                          
                                                    </div>
                                                    <div class="form-group">
                                                          <label for="PurchaseCurrentStock">Current Stock</label>
                                                          <input id="purchaseCurrentStock" name="purchaseCurrentStock" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                          <label for="PurchaseVendorName">Vendor Name</labe>
                                                          <input id="purchaseVendorName" name="purchaseVendorName" class="form-control">
                                                    </div>
                                              </div>
                                              <div class="form-row">
                                                    <div class="form-group">
                                                          <label for="PurchaseQuantity">Quantity</label>
                                                          <input id="purchaseQuantity" name="purchaseQuanity" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                          <label for="PurchaseUnitPrice">Unit Price</label>
                                                          <input id="purchaseUnitPrice" name="purchaseUnitPrice" class="form-control" >
                                                    </div>
                                                    <div class="form-group">
                                                          <label for="PurchaseTotalCost">Total Cost</label>
                                                          <input id="purchaseTotalCost" name="purchaseTotalCost" class="form-control">
                                                    </div>
                                              </div>
                                              <button type="button" id="addPurchase" class="btn btn-success">addPurchase</button>
                                              <button type="button" id="updatePurchase" class="btn btn-primary"></button>
                                              <button type="reset" class="btn">Clear</button>
                                        </form>
                                  </div>
                            </div>
                      </div>
                      <div id="v-pills-vendor">
                            <div class="card">
                                  <div class="card-header">Vendor Details</div>
                                  <div clas="card-body">
                                        <form>
                                               <div class="form-row">
                                                     <div class="form-group">
                                                          <label for="VendorFullName">Full Name</label>
                                                          <input id="vendorFullName" name="vendorFullName" class="form-control">
                                                     </div>
                                                     <div class="form-group">
                                                          <label for="VendorStatus">Status</label>
                                                          <select id="vendorStatus" name="vendorStatus" class="form-control">
                                                                 <?php include('define/statusList.html');?>
                                                          </select>
                                                     </div>
                                                     <div class="form-group">
                                                           <label for="vendorID">Vendor ID</label>
                                                           <input id="vendorID" name="vendorID" class="form-control">
                                                     </div>
                                               </div>
                                               <div class="form-row">
                                                     <div class="form-group">
                                                           <label for="vendorMobile">Mobile</label>
                                                           <input id="vendorMobile" name="vendorMobile" class="form-control" >
                                                     </div>
                                                     <div class="form-group">
                                                           <label for="vendorPhone">Phone</label>
                                                           <input id="vendorPhone" name="vendorPhone" class="form-control" >
                                                     </div>
                                                     <div class="form-group">
                                                           <label for="VendorEmail">Email</label>
                                                           <input id="vendorEmail" name="vendorEmail" class="form-control">
                                                     </div>
                                               </div>
                                               <div class="form-group">
                                                     <label for="VendorAddress">Address</label>
                                                     <input id="vendorAddress" name="vendorAddress" class="form-control">
                                               </div>
                                               <div class="form-group">
                                                     <label for="VendorAddress2">Address2</label>
                                                     <input id="vendorAddress2" name="vendorAddress2" class="form-control" >
                                               </div>
                                               <div class="form-row">
                                                     <div class="form-group">
                                                           <label for="VendorCity">City</label>
                                                           <input id="vendorCity" name="vendorCity" class="form-control" >
                                                     </div>
                                                     <div class="form-group">
                                                           <label for="VendorDistrict">District</label>
                                                           <input id="vendorDistrict" name="vendorDistrict" class="form-control" >
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
                      <div id="v-pills-search" role="tabpanel">
                            <div class="card">
                                  <div class="card-header">Search Invendtory
                                        <button id="searchTable" name="searchTable" class="btn btn-waring float-right btn-sm">Refresh</button>
                                  </div>
                                  <div class="card-body">
                                        <ul>
                                             <li><a href="#itemSearch"></a>Item</li>
                                             <li><a href="#customerSearch">Customer</a></li>
                                             <li><a href="#saleSearch"></a>Sale</li>
                                             <li><a href="#purchaseSearch">Purchase</a></li>
                                             <li><a href="#vendorSearch"></a>Vendor</li>
                                        </ul>
                                        <div class="container">
                                              <div id="itemSearch" class="container-fluid" >
                                                    <div id="itemSearchTable"></div>
                                              </div>
                                              <div id="customerSearch" class="container-fluid" >                                                 
                                                    <div id="customerSearchTable"></div>
                                              </div>
                                              <div id="saleSearch" class="container-fluid">
                                                    <div id="saleSearchTable"></div>
                                              </div>
                                              <div id="purchaseSearch" class="container-fluid" >
                                                    <div id="purchaseSearchTable"></div>
                                              </div>                                                
                                              <div id="vendorSearch" class="container-fluid">
                                                    <div id="vendorSearchTable"></div>
                                              </div>
                                        </div>
                                  </div>
                            </div>
                      </div>
                      <div id="v-pills-reports" role="tabpanel">
                            <div class="card">
                                  <div class="card-header">Reports
                                       <button id="reportTableRefresh" name="reportTableRefresh">Refresh</button>
                                  </div>
                                  <div class="card-body">
                                       <ul>
                                           <li><a href="#itemReport">Item</a></li>
                                           <li><a href="#customerReport">Customer</a></li>
                                           <li><a href="#saleReport"></a>Sale</li>
                                           <li><a href="#purchaseReport">Purchase</a></li>
                                           <li><a href="vendorReport"></a>Vendor</li>
                                       </ul>
                                       <div class="tab-content">
                                             <div id="itemReport" class="container-fluid">
                                                  <div id="itemReportTable"></div>
                                             </div>
                                             <div id="customerReport" class="container-fluid">
                                                  <div id="customerReportTable"></div>
                                             </div>
                                             <div id="saleReport" class="container-fluid">
                                                   <form>
                                                          <div class="form-row">
                                                                <div class="form-group">
                                                                     <label for="SaleStartDate">Start Date</label>
                                                                     <input id="saleStartDate" name="saleStartDate" class="">
                                                                </div>
                                                                <div class="form-group">
                                                                      <label for="SaleEndDate">End Date</label>
                                                                      <input id="saleEndDate" name="saleEndDate" class="">
                                                                </div>
                                                          </div>
                                                          <button type="button" id="saleReport" class="btn">Show Report</button>
                                                          <button type="reset" class="btn">Clear</button>
                                                   </form>
                                                   <div id="saleReportTable" class="table-responsive">
                                             </div>
                                             <div id="purchaseReport" class="container-fluid">
                                                   <form>
                                                          <div class="form-row">
                                                                <div class="form-group">
                                                                     <label for="purchaseStartDate">Start Date</label>
                                                                     <input id="purchaseStartDate" name="purchaseStartDate" class="">
                                                                </div>
                                                                <div class="form-group">
                                                                      <label for="purchaseEndDate">End Date</label>
                                                                      <input id="purchaseEndDate" name="purchaseEndDate" class="">
                                                                </div>
                                                          </div>
                                                          <button type="button" id="purchaseReportShow">Show Report</button>
                                                          <button type="reset" class="btn">Clear</button>
                                                   </form>
                                             </div>
                                             <div id="vendorReport">
                                                   <div id="vendorReportTable" class="table-responsive"></div>
                                             </div>
                                       </div>
                                  </div>
                            </div>
                      </div>
                </div>
          </div>
    </div>
</body>