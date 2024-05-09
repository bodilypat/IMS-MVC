<?php
    session_start();
    if(!isset($_SESSION['loggedIn'])){
        header('location:login.php');
        exit();
    }
    require_once('define/config/constants.php');
    require_once('define/config/dbconnect.php');
    require_once('define/header.php');
?>
<body>
    <?php 'define/navigation.php'; ?>
    <!-- page content -->
       <div class="container-fluid">
            <div class="row">
                  <div class="col-lg-2">
                        <h1 class="my-4"></h1>
                        <div id="v-pills-tab" role="tablist">
                              <a id="v-pills-tab" href="#v-pills-item" ></a>
                              <a id="v-pills-purchase-tab" href="#v-pills-purchase"></a>
                              <a id="v-pills-vendor-tab" href="#v-pills-vendor"></a>
                              <a id="v-pills-sale-tab" href="#v-pills-vendor"></a>
                              <a id="v-pills-customer-tab" href="#v-pills-customer"></a>
                              <a id="v-pills-search-tab" href="#v-pills-search"></a>
                              <a id="v-pills-report-tab" href="#v-pills-report"></a>
                        </div>
                  </div>
                  <div class="col-lg-10">
                        <div id="v-pills-tabContent">
                              <div id="v-pills-item" rol="tabpanel">
                                    <div class="card">
                                        <div class="card-header">Item Details</div>
                                        <div class="card-body">
                                            <ul>
                                                <li><a href="#itemTab"></a></li>
                                                <li><a href="#itemTab"></a></li>
                                            </ul>
                                                <!-- tab panes for item -->
                                            <div class="tab-content">
                                                <div id="itemTab">
                                                    <div id="itemMessage">
                                                        <form>
                                                            <div class="form-row">
                                                                <div class="form-group">
                                                                    <label for="ItemNumber">Item Number</label>
                                                                    <input id="itemNumber" name="itemNumber">
                                                                    <div id="itemNumberPresentation"></div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="ItemProductID">Product ID</label>                                                                             
                                                                    <input id="itemProductID" name="itemProductID">
                                                                </div>                                                                            
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group">
                                                                    <label for="ItemName">Item Name</label>
                                                                    <input id="itemName" name="itemName">
                                                                    <div id="itemNamePresentation"></div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="ItemStatus">Status</label>
                                                                    <select id="itemStatus" name="itemStatus">
                                                                        <?php include('define/statusList.html');?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-row">
                                                                <div class="form-group">
                                                                    <textarea name="itemDescription" name="itemDescription"></textarea>
                                                                </div>
                                                            </div>
                                                                <div class="form-row">
                                                                    <div class="form-group">
                                                                        <label for="ItemDiscount">Item Discount %</label>
                                                                        <input name="itemDiscount" id="itemDiscount">
                                                                        </div>
                                                                        <div class="form-group">
                                                                              <label for="ItemQuantity">Item Quantity</label>
                                                                              <input name="itemQuantity" id="itemQuantity">
                                                                        </div>
                                                                        <div class="form-group">
                                                                              <label for="ItemUnitPrice">Item UnitPrice</label>
                                                                              <input name="itemUnitPrice" id="itemUnitPrice" >
                                                                        </div>
                                                                        <div class="form-group">
                                                                              <label for="ItemTotalStock">Total Stock</label>
                                                                              <input id="itemTotolStock" name="itemTotalStock">
                                                                        </div>
                                                                        <div class="form-group">
                                                                              <div  id="ImageContainer"></div>                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row"></div>
                                                                    <button type="button" id="addItem"></button>
                                                                    <button type="button" id="updateItem"></button>
                                                                    <button type="button" id="itemDelete"></button>
                                                                    <button type="reset"></button>
                                                                </form>
                                                            </div>
                                                            <div id="itemImageTab">
                                                                <div id="itemImageMessage"></div>
                                                                <form>
                                                                      <div class="form-row">
                                                                            <div class="form-group">
                                                                                <label for="ItemImageNumber">Item Image Number</label>
                                                                                <input name="itemImageNumber" id="itemImageNumber">
                                                                                <div id="itemImageNumberPresentation"></div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                 <label for="ItemImageName">Item Name</label>
                                                                                 <input name="itemImageName" id="itemImageName" >
                                                                            </div>
                                                                      </div>
                                                                      <div class="form-row">
                                                                            <div class="form-group">
                                                                                <label for="ItemImageFile">
                                                                                    Select Image(<span class="blueText">jpg</span>,
                                                                                                 <span class="blueText">jpeg</span>,
                                                                                                 <span class="blueText">gif</span>,
                                                                                                 <span class="blueText">png</span>,
                                                                                            only )
                                                                                </label>
                                                                                <input id="itemImageFile" name="itemImageFile">
                                                                            </div>
                                                                      </div>
                                                                      <button type="button" id="updateImage">Upload Image</button>
                                                                      <button type="button" id="deleteImage">Delete Image</button>
                                                                      <button type="reset" class="btn">Clear</button>
                                                                </form>
                                                            </div>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                                    <div id="v-pills-purchase" role="tabpanel">
                                        <div class="card card-outline">
                                              <div class="card-header">Purchase Details</div>
                                              <div class="card-body">
                                                    <div id="purchaseMessage"></div>
                                                    <form>
                                                          <div class="form-row">
                                                               <div class="form-group">
                                                                    <label for="PurchaseItemNumber">ItemNumber</label>
                                                                    <input id="purchaseItemNumber" name="purchaseItemNumber">
                                                                    <div id="purchaseItemNumberPresentation"></div>
                                                               </div>
                                                               <div class="form-group">
                                                                    <label for="PurchaseDate">Purchase Date</label>
                                                                    <input id="purchaseDate" name="purchaseDate">
                                                               </div>
                                                               <div class="form-group">
                                                                    <label for="purchaseID">Purchase ID</label>
                                                                    <input id="purchaseID" name="purchaseID" >
                                                                    <div id="purchaseIDPresentation"></div>
                                                               </div>
                                                          </div>
                                                          <div class="form-row">
                                                               <div class="form-group">
                                                                    <label for="PurchaseItemName">Item Name</label>
                                                                    <input id="purchaseItemName" name="purchaseItemName">
                                                               </div>
                                                               <div class="form-group">
                                                                    <label for="PurchaseCurrentStock">Current Stock</label>
                                                                    <input id="purchaseCurrentStock" name="purchaseCurrentStock">
                                                               </div>
                                                               <div class="form-group">
                                                                    <label for="PurchaseVendorName">Vendor Name</label>
                                                                    <select id="purchaseVendorName" name="purchaseVendorName">
                                                                         <?php require('model/vendor/getVendorNames.php'); ?>
                                                                    </select>
                                                               </div>
                                                          </div>
                                                          <div class="form-row">
                                                               <div class="form-group">
                                                                    <label for="PurchaseQuantity">Quantity</label>
                                                                    <input id="purchaseQuantity" name="purchaseQuantity">
                                                               </div>
                                                               <div class="form-group">
                                                                    <label for="PurchaseUnitPrice">Unit Price</label>
                                                                    <input id="purchaseUnitPrice" name="purchaseUnitPrice">                                                                    
                                                               </div>
                                                               <div class="form-group">
                                                                    <label for="PurchaseTotal">Total Cost</label>
                                                                    <input id="purchaseTotal" name="purchaseTotal">
                                                               </div>
                                                          </div>
                                                          <button type="button" id="addPurchase">Add Purchase</button>
                                                          <button type="button" id="updatePurchase">Update</button>
                                                          <button type="reset" class="btn">Clear</button>
                                                    </form>
                                              </div>
                                        </div>
                                    </div>
                                    <div id="v-pills-vendor" role="tabpanel">
                                         <div class="card card-outline-secondary my-4">
                                               <div class="card-header">Vendor Details</div>
                                               <div class="card-body">
                                                     <div id="vendorMessage"></div>
                                                     <form>
                                                           <div class="form-row">
                                                                <div class="form-group">
                                                                     <label for="vendorFullName">Full Name</label>
                                                                     <input id="vendorFullName" name="vendorFullName">
                                                                </div>
                                                                <div class="form-group">
                                                                     <label for="VendorStatus">Status</label>
                                                                     <select id="vendorStatus" name="vendorStatus">
                                                                           <?php include('define/statusList.html');?>
                                                                     </select>
                                                                </div>
                                                                <div class="form-group">
                                                                     <label for="VendorID">Vendor ID</label>
                                                                     <input id="vendorID" name="vendorID">
                                                                     <div id="vendorIDPresentation"></div>
                                                                </div>
                                                           </div>
                                                           <div class="form-row">
                                                                <div class="form-group">
                                                                     <label for="VendorMobile">Mobile</label>
                                                                     <input id="vedorMobile" name="vendorMobile">
                                                                </div>
                                                                <div class="form-group">
                                                                     <label for="VendorPhne">Phone</label>
                                                                     <input id="vendorPhone" name="vendorPhone"> 
                                                                </div>
                                                                <div class="form-group">
                                                                     <label for="VendorEmail">Email</labbel>
                                                                     <input id="vendorEmail" name="vendorEmail">
                                                                </div>
                                                           </div>
                                                           <div class="form-group">
                                                                 <label for="VendorAddress">Address</label>
                                                                 <input id="vendorAddress" name="vendorAddress">
                                                           </div>
                                                           <div class="form-group">
                                                                 <label for="VendorAddress2">Address2</label>
                                                                 <input id="vendorAddress2" name="vendorAddress2">
                                                           </div>
                                                           <div class="form-row">
                                                                <div class="form-group">
                                                                    <label for="VendorCity">City</label>
                                                                    <input id="vendorCity" name="vendorCity">
                                                                </div>
                                                                <div class="form-group">
                                                                     <label for="vendorDistrict">District</label>
                                                                     <select id="vendorDistrict" name="vendorDistrict">Add Vendor
                                                                            <?php include('define/district.html'); ?>
                                                                     </select>
                                                                </div>
                                                           </div>
                                                           <button type="button" id="addVendor">Add Vendor</button>
                                                           <button type="button" id="updateDetail">Update</button>
                                                           <button type="button" id="deleteVendor" >Delete</button>
                                                           <button type="reset" class="brn">clear</button>
                                                     </form>
                                               </div>
                                         </div>
                                    </div>
                                    <div id="v-pills-sale" role="tabpanel">
                                          <div class="card">
                                               <div class="card-header">Sale Details</div>
                                               <div class="card-body">
                                                    <div id="saleMessage"></div>
                                                    <form>
                                                         <div class="form-row">
                                                              <div class="form-group">
                                                                   <label for="SaleItemNumber">Item Number</label>
                                                                   <input id="saleItemNumber" name="saleItemNumber" >
                                                                   <div id="saleItemNumberPresentation"></div>
                                                              </div>
                                                              <div class="form-group">
                                                                   <label for="SaleCustoemrID">CustomerID</label>
                                                                   <input is_dir="saleCustoemrID" name="saleCustomerID">
                                                                   <div id="saleCustomerIDPresentation"></div>
                                                              </div>
                                                              <div class="form-group">
                                                                    <label for="SaleCustomerName">Customer Name</label>
                                                                    <input id="saleCustomerName" name="saleCustomerName">
                                                              </div>
                                                              <div class="form-group">
                                                                    <label for="SaleID">Sale ID</label>
                                                                    <input id="saleID" name="saleID">
                                                                    <div id="saleIDPresentation"></div>
                                                              </div>
                                                         </div>
                                                         <div class="form-row">
                                                              <div class="form-group">
                                                                    <label for="SaleItemName">Item Name</label>
                                                                    <input id="saleItemName" name="saleItemName" >
                                                              </div>
                                                              <div class="form-group">
                                                                    <label for="SaleDate">Sale Date</label>
                                                                    <input id="saleDate" name="saleDate">
                                                              </div>
                                                         </div>
                                                         <div class="form-row">
                                                               <div class="form-group">
                                                                     <label for="SaleTotalStock">Total Stock</label>
                                                                     <input id="saleTotalStock" name="saleTotalStock" class="form-control">
                                                               </div>
                                                               <div class="form-group">
                                                                     <label for="SaleDiscount">Discount %</label>
                                                                     <input id="saleDiscount" name="saleDiscout" class="form-control">>
                                                               </div>
                                                               <div class="form-group">
                                                                     <label for="SaleQuantity">Quantity</label>
                                                                     <input id="saleQuantity" name="saleQuantity" class="form-control">
                                                               </div>
                                                               <div class="form-group">
                                                                     <label></label>
                                                                     <input id="saleUnitPrice" name="saleUnitPrice" class="form-control">
                                                               </div>
                                                               <div class="form-group">
                                                                     <label for="SaleTotal">Total</label>
                                                                     <input id="saleTotal" name="saleTotal" class="formControl">
                                                               </div>
                                                         </div>
                                                         <div class="form-row">
                                                              <div class="saleImageContanier"></div>
                                                         </div>
                                                         <button type="button" id="addSale">Add Sale</button>
                                                         <button type="button" id="updateSale">Update Sale</button>
                                                         <button type="reset" id="saleClear" class="btn">Clear</button>
                                                    </form>
                                               </div>
                                          </div>
                                    </div>
                              </div>
                              <div id="v-pills-customer" role="tabpanel">
                                   <div class="card">
                                        <div class="card-headr">Customer Details</div>
                                        <div class="card-body">
                                              <div id="customerMessage"></div>
                                              <form>
                                                    <div class="form-row">
                                                        <div class="form-group">
                                                             <label for="CustomerFullName">Full Name</label>
                                                             <input id="customerFullName" name="customerFullName">
                                                        </div>
                                                        <div class="form-group">
                                                             <label for="CustomerStatus">Status</label>
                                                             <select>
                                                                   <?php include('define/statusList.php'); ?>
                                                             </select>
                                                        </div>
                                                        <div class="form-group">
                                                             <label for="CustomerID">Customer ID</label>
                                                             <input id="customerID" name="customerID" class="form-control">
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
                                                          <input id="customerAddress2" name="customerAddress2" class="form-control">
                                                    </div>
                                                    <div class="form-row">
                                                          <div class="form-group">
                                                                <label for="CustomerCity">District</label>
                                                                <input id="customerCity" name="customerCity" class="form-control">
                                                          </div>
                                                          <div class="form-group">
                                                                <label for="CustomerDistrict">District</label>
                                                                <select id="customerDistrict" name="customerDistrict" class="form-control">
                                                          </div>
                                                    </div>
                                                    <buyyon type="button" id="addCustomer" class="btn btn-success">Add Customer</button>
                                                    <button type="button" id="updateCustomer" class="btn btn-primary">Customer</button>
                                                    <button type="button" id="deleteCustomer" class="btn btn-danger">Delete</button>
                                                    <button type="reset" class="btn">Clear</button>
                                              </form>
                                        </div>
                                   </div>
                              </div>
                              <div id="v-pills-search" role="tabpanel">
                                   <div class="card">
                                        <div class="card-header">Search Inventory
                                              <button type="button" id="searchTable" name="searchTable" class="btn">Refresh</button>
                                        </div>
                                        <div class="card-body">
                                             <ul>
                                                  <li><a href="#itemSearch">Item</a></li>
                                                  <li><a href="#customerSearch">Customer</a></li>
                                                  <li><a href="#saleSearch">Sale</a></li>
                                                  <li><a href="#purchaseSearch">Purchase</a></li>
                                                  <il><a href="#vendorSearch">Vendor</a></li>
                                             </ul>
                                             <div class="tab-content">
                                                   <div id="itemSearch" class="container-fluid">
                                                         <div id="itemSearchTable"></div>
                                                   </div>
                                                   <div id="customerSearch" class="container-fluid">
                                                         <div id="customerSearchTable"></div>
                                                   </div>
                                                   <div id="saleSearch" class="container-fluid">
                                                         <div id="saleSearchTable"></div>
                                                   </div>
                                                   <div id="purchaseSearch" class="container-fluid">
                                                         <div id="purchaseSearchTable"></div>
                                                   </div>
                                                   <div id="vendorSearch" class="container-fluid">
                                                         <div id="vendorSearchTable"></div>
                                                   </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div id="v-pills-report" role="tabpanel">
                                   <div class="card">
                                         <div class="card-header">Reports
                                               <button id="reportTable">Refresh</button>
                                         </div>
                                         <div class="card-body">
                                               <ul>
                                                    <li><a href="#itemReport">Item</a></li>
                                                    <li><a href="#customerReport">Customer</a></li>
                                                    <li><a href="#saleReport">Sale</a></li>
                                                    <li><a href="#purchaseReport">Purchase</a></li>
                                                    <li><a href="#vendorReport">Vendor</a></li>
                                               </ul>
                                               <div class="tab-content">
                                                    <div id="itemReport">
                                                        <div id="itemReportTable"></div>
                                                    </div>
                                                    <div id="customerReport">
                                                        <div id="CustomerReportTable"></div>
                                                    </div>
                                                    <div id="saleReport">                                                        
                                                        <form>
                                                            <div class="form-row">
                                                                <div class="form-group">
                                                                    <label for="SaleReportStartDate">Start Date</label>
                                                                    <input id="saleReportStartDate" name="saleReportStartDate" >
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="saleReportEndDate">End Date</label>
                                                                    <input id="saleReportEndDate" name="saleReportEndDate" >
                                                                </div>
                                                            </div>
                                                            <button type="button" id="showSaleReport">Show Report</button>
                                                            <button type="reset" id="saleFilterClear">Clear</button>
                                                        </form>  
                                                        <div id="saleReportTable" class="table-responsive"></div>                                                            
                                                    </div>
                                                    <div id="purchaseReport">                                                        
                                                        <form>
                                                            <div class="form-row">
                                                                <div class="form-group">
                                                                    <label for="PurchaseReportStartDate"></label>
                                                                    <input id="purchaseReportStartDate" name="purchaseReportStartDate">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="PurchaseReportEndDate">End Date</label>
                                                                    <input id="purchaseReportEndDate" name="purchaseReportEndDate">
                                                                </div>
                                                            </div>
                                                            <button type="button" id="showPurchaseReport" class="btn">Show Report</button>
                                                            <button type="button" id="purchaseFilterClear" class="btn">Clear</button>
                                                        </form>
                                                        <div id="purchaseReportTable" class="table-responsive"></div>                                                    
                                                    </div>
                                                    <div id="vendorReport">
                                                        <div id="vendorReportTable" class="table-reponsive"></div>
                                                    </div>
                                               </div>
                                         </div>
                                   </div>
                              </div>
                        </div>
                  </div>
            </div>
       </div>
<?php
    require 'define/footer.php'; 
?>
</body>