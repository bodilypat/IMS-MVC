<?php
     session_start();
     if(!isset($_SESSION['loggedIn']))
     {
        header('Location: login.php');
        exit();
     }
     require_once('assign/config/constant.php');
     require_once('assign/config/dbconnect.php');
     require_once('assign/header.html');
?>
<body>
    <?php
         require 'include/navigation.php';
    ?>
    <!-- page content -->
    <div class="row">
          <div class="col-lg-2">
               <h1 class="my-4"></h1>
                <div id="v-pills-tab" role="tablist">
                    <a id="v-pills-item-tab" href="#v-pills-item">Item</a>
                    <a id="v-pills-purchase-tab" href="#v-pills-purchase">Purchase</a>
                    <a id="v-pills-vendor-tab" href="#v-pills-vendor">Vendor</a>
                    <a id="v-pills-sale-tab" href="#v-pills-sale">Sale</a>
                    <a id="v-pills-customer-tab" href="#v-pills-customer">Customer</a>
                    <a id="v-pills-search-tab" href="#v-pills-search">Search</a>
                    <a id="v-pills-report-tab" href="#v-report-tab">Repport</a>
                </div>            
          </div>
          <div class="col-lg-10">
                <div id="v-pills-tabContent">
                      <div id="v-pills-item" role="tabpanel">
                            <div class="card card-outline-secondary my-4">
                                  <div class="card-header">Item Details</div>
                                  <div class="card-body">
                                        <ul role="tablist">
                                            <li>
                                                <a href="#itemTab">Item</a>
                                            </li>
                                            <li><a href="#itemImageTab"></li>
                                        </ul>
                                        <!-- tab panel for item details and image sections  -->
                                        <div class="tab-content">
                                             <div id="itemTab">
                                                   <br>
                                                   <!-- Div to show the ajax messaage form validations/db submission -->
                                                   <div id="itemMessage"></div>
                                                   <form>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-3">
                                                                <label for="ItemNumber">Item Number</label>
                                                                <input id="itemNumber" name="itemNumber">
                                                                <div id="itemItemNumberAdviseDiv"></div>
                                                            </div>
                                                            <div class="form-group col-md-3">
                                                                  <label for="ItemProductID">Product ID</label>
                                                                  <input id="itemProductID" name="itemProductID">
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                             <div class="form-group col-md-6">
                                                                  <label for="ItemName">Item Name</label>
                                                                  <input id="itemName" name="itemName">
                                                                  <div id="itemNameAdvise"></div>     
                                                             </div>
                                                             <div class="form-group col-md-2">
                                                                   <label for="ItemStatus">Status</label>
                                                                   <select id="itemStatus" name="itemStatus">
                                                                        <?php include('include/statusList.html')?>
                                                                   </select>                                                                   
                                                             </div>
                                                        </div>
                                                        <div class="for-row">
                                                              <div class="form-group col-md-6">
                                                                   <textarea id="itemDescription"></textarea>
                                                              </div>
                                                        </div>
                                                        <div class="form-row">
                                                             <div class="form-group col-md-3">
                                                                  <label for="ItemDiscount">Discount %</label>
                                                                  <input id="itemDiscount" name="itemDiscount">
                                                             </div>
                                                             <div class="form-group col-md-3">
                                                                   <label for="itemQuantity"></label>
                                                                   <input id="itemQuantity" name="itemQuantity">                                                                
                                                             </div>
                                                             <div class="form-group col-md-3">
                                                                   <label for="ItemUnitPrice">Item Unit price</label>
                                                                   <input id="itemUnitPrice" name="itemUnitPrice">
                                                             </div>
                                                             <div class="form-group col-md-3">
                                                                   <label for="ItemTotalStock">Total Stock</label>
                                                                   <input id="itemTotalStock" name="itemTotalStock">
                                                             </div>
                                                             <div class="form-group col-md-3">
                                                                  <div id="imageContainer"></div>
                                                             </div>
                                                        </div>
                                                        <button id="addItem" type="button" class="btn btn-success">Add Item</button>
                                                        <button id="updateItem" type="button">Update</button>
                                                        <button id="deleteItem" type="button">Delete</button>
                                                        <button id="itemClear" type="reset" class="btn">Clear</button>
                                                   </form>
                                             </div>
                                             <div id="itemImageTab">
                                                  <br>
                                                  <div id="itemImageMessage"></div>
                                                  <p></p>
                                                  <p></p>
                                                  <br>
                                                  <form id="itemForm" name="imageForm" method="post">
                                                        <div class="form-row">
                                                             <div class="form-group col-md-3">
                                                                   <label for="ItemImageNumber">Item ImageNumber</label>
                                                                   <input id="itemImageNumber" name="itemImageNumber">
                                                                   <div id="itemImageNumberAdviseDiv"></div>
                                                             </div>
                                                             <div class="form-group col-md-4">
                                                                  <label for="ItemImageName">Item Name</label>
                                                                  <input id="itemImageName" name="itemImageName">
                                                             </div>
                                                        </div>
                                                        <br>
                                                        <div class="form-row">
                                                             <div class="form-group col-md-7">
                                                                  <label for="itemImageFile">Select image
                                                                         ( <span class="blueText">jpg</span>
                                                                           <span class="blueText">jpeg</span>
                                                                           <span class="blueText">gif</span>
                                                                           <span class="blueText">png</span> only)
                                                                  </label>
                                                                  <input id="itemImageFile" name="itemImageFile">
                                                             </div>
                                                        </div>
                                                        <br>
                                                        <button id="updateImage" type="button">Upload Image</button>
                                                        <button id="deleteImage" type="button">Delete Image</button>
                                                        <button type="Reset" class="btn">Clear</button>
                                                  </form>
                                             </div>
                                        </div>
                                  </div>
                            </div>
                      </div>
                      <div id="v-pills-purchase" role="tabpanel">
                            <div class="card card-outline-secondary my-4">
                                  <div class="card-header">Purchase Details</div>
                                  <div class="card-body">
                                        <div id="purchaseMessage"></div>
                                        <form>
                                               <div class="form-row">
                                                    <div class="form-group col-md-3">
                                                         <label for="PurchaseItemNumber">Purchase Item Number</label>
                                                         <input id="purchaseItemNumber" name="purchaseItemNumber">
                                                         <div id="purchaseItemNumberAdviseDiv"></div>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                          <label for="PurchaseDate">Purchase Date</label>
                                                          <input id="purchaseDate" name="purchaseDate">                                                        
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                          <label for="purchaseID">Purchase ID</label>
                                                          <input id="purchaeID" name="purchaseID">
                                                          <div id="purchaseIDAdviseDiv"></div>
                                                    </div>
                                               </div>
                                               <div class="form-row">
                                                     <div class="form-group col-md-4">
                                                           <label for="PurchaseItemName">Item Name</label>
                                                           <input id="purchaseItemName" name="purchaseItemName">
                                                     </div>
                                                     <div class="form-group col-md-2">
                                                           <label for="PurchaseCurrentStock">Current Stock</label>
                                                           <input id="purchaseCurrentStock" name="purchaseCurrentStock">
                                                     </div>
                                                     <div class="form-group col-md-4">
                                                           <label for="PurchaseVendorName">Vendor Name<label>
                                                           <select id="purchaseVendorName" name="purchaseVendorName">
                                                                <?php 
                                                                      require('model/vendor/getVendorName.php');
                                                                ?>
                                                           </select>
                                                     </div>
                                               </div>
                                               <div class="form-row">
                                                     <div class="form-group col-md-2">
                                                          <label for="PurchaseQuantity">Quantity</label>
                                                          <input id="purchaseQuantity" name="purchaseQuantity">
                                                     </div>
                                                     <div class="form-group col-md-2">
                                                           <label for="PurchaseUnitPrice">Unit Price</label>
                                                           <input id="purchaseUnitPrice" name="purchaseUnitPrice">
                                                     </div>
                                                     <div class="form-group col-md-2">
                                                           <label for="PurchaseTotalStock">Total Cost</label>
                                                           <input id="purchaseTotalStock" name="purchaseTotalStock">
                                                     </div>
                                               </div>
                                               <button id="addPurchase" type="button">Add Purchase</button>
                                               <button id="updatePurchase" type="button">Update</button>
                                               <button type="reset" class="btn">Clear</button>
                                        </form>
                                  </div>
                            </div>
                      </div>
                      <div id="v-pills-vendor" role="tabpanel">
                            <div class="card card-outline-secondary my-4">
                                 <div class="card-header">Vendor Details</div>
                                 <div class="card-body">
                                <!-- Div to show the ajax message form validation/db submission -->
                                       <div id="vendorMessage"></div>
                                       <form>
                                              <div class="form-row">
                                                   <div class="form-group col-md-6">
                                                        <label for="VendorFullName">Vendor FullName</label>
                                                        <input id="vendorFullName" name="vendorFullName">
                                                   </div>
                                                   <div class="form-group col-md-2">
                                                         <label for="VendorStatus">Status</label>
                                                         <select id="vendorStatus" name="vendorStatus">
                                                               <?php include('include/status.html');?>
                                                         </section>
                                                   </div>
                                                   <div class="form-group col-md-3">
                                                         <label for="VendorMobile">Mobile</label>
                                                         <input id="vendorMobile" name="vendorMobile">
                                                   </div>
                                                   <div class="form-group col-md-3">
                                                         <label for="VendorEmail">Email</label>
                                                         <input id="vendorEmail" name="vendorEmail">
                                                   </div>
                                              <div>
                                              <div class="form-group">
                                                    <label for="VendorAddress">Address</label>
                                                    <input id="vendorAddress" name="vendorAddress">
                                              </div>
                                              <div class="form-group">
                                                    <label for="VendorAddress2">Address2</label>
                                                    <input id="vendorAddress2" name="vendorAddress2">                                                
                                              </div>
                                              <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                         <label for="VendorCity">City</label>
                                                         <input id="vendorCity" name="vendorCity">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                          <label for="VendorDistrict">District</label>
                                                          <select id="vendorDistrict" name="vendorDistrict">
                                                                 <?php include('include/districList.html'); ?>
                                                          </select>
                                                    </div>
                                              </div>
                                              <button id="addVendor" name="addVendor" type="button">Add Vendor</button>
                                              <button id="updateVendor" type="button">Update</button>
                                              <button id="deleteVendor" type="button">Delete</button>
                                              <button type="reset" class="btn">Clear</button>
                                       </form>
                                 </div>
                            </div>
                      </div>
                      <div id="v-pills-sale" role="tabpanel">
                            <div class="card card-outline-secondary my-4">
                                 <div class="card-header">Sale Details</div>
                                 <div class="card-body">
                                       <div id="saleMessage"></div>
                                       <form>
                                             <div class="form-row">
                                                   <div class="form-group col-md-3">
                                                        <label for="SaleItemNumber">Sale ItemNumber</label>
                                                        <input id="saleItemNumber" name="saleItemNumber">
                                                        <div id="saleItemNumberAdviseDiv"></div>
                                                   </div>
                                                   <div class="form-group col-md-3">
                                                        <label for="SaleCustomerID">Sale CustomerID</label>
                                                        <input id="saleCustomerID" name="saleCustomerID">
                                                        <div id="saleCustomerIDAdviseDiv"></div>
                                                   </div>
                                                   <div class="form-group col-md-4">
                                                        <label for="saleCustmerName">Customer Name</label>
                                                        <input id="saleCustomerName" name="saleCustomerName">
                                                   </div>
                                                   <div class="form-group col-md-2">
                                                         <label for="SaleID">Sale ID</label>
                                                         <input id="saleID" name="saleID">
                                                         <div id="saleIDAdviseDiv"></div>
                                                   </div>
                                             </div>
                                             <div class="form-row">
                                                   <div class="form-group col-md-5">
                                                        <label for="SaleItemName">Sale ItemName</label>
                                                        <input id="saleItemName" name="saleItemName">                                                        
                                                   </div>
                                             </div>
                                             <div class="form-row">
                                                   <div class="form-group col-md-2">
                                                        <label for="SaleTotalStock">Total Stock</label>
                                                        <input id="saleTotalStoc" name="saleTotalStock">
                                                   </div>
                                                   <div class="form-group col-md-2">
                                                         <label for="saleDiscount">Discount %</label>
                                                         <input id="saleDiscount" name="saleDiscount">
                                                   </div>
                                                   <div class="form-group col-md-2">
                                                         <label for="SaleQuantity">Quantity</label>
                                                         <input id="saleQuantity" name="saleQuantity">
                                                   </div>
                                                   <div class="form-group col-md-2">
                                                         <label for="saleUnitPrice">Unit Price</label>
                                                         <input id="saleUnitPrice" name="saleUnitPrice">
                                                   </div>
                                                   <div class="form-group col-md-3">
                                                         <label for="SaleTotal">Total</label>
                                                         <input class="saleTotal" name="saleTotal">
                                                   </div>
                                             </div>
                                             <div class="form-row">
                                                  <div class="form-group col-md-3">
                                                       <div id="saleImageContainer"></div>
                                                  </div>
                                             </div>
                                             <button id="addSale" type="button">Add Sale</button>
                                             <button id="updateSale" type="button">Update</button>
                                             <button id="saleClear" type="reset" class="btn">Clear</button>
                                       </form>
                                 </div>
                            </div>
                      </div>
                      <div id="v-pills-customer" role="tabpanel">
                            <div class="card card-outline-secondary my-4">
                                 <div class="card-header">Customer Detials</div>
                                 <div class="card-body">
                                <!-- Div to the ajax message form validation/db submission -->
                                       <div id="customerMessage"></div>
                                       <form>
                                             <div class="form-row">
                                                   <div class="form-group col-md-6">
                                                         <label for="CustomerFullName">Customer FullName</label>
                                                         <input id="customerFullName" name="customerFullName">
                                                   </div>
                                                   <div class="form-group col-md-2">
                                                        <label for="CustomerStatus">Customer Status</label>
                                                        <selec id="customerStatus" name="customerStatus">
                                                              <?php include('include/statusList.html');?>                                                            
                                                        </select>
                                                   </div>
                                                   <div class="form-group col-md-3">
                                                         <label for="CustomerID">Customer ID</label>
                                                         <input id="customerID" name="customerID">
                                                         <div id="customerIDAdviseDiv"></div>
                                                   </div>                                                                                                      
                                             </div>
                                             <div class="form-row">
                                                   <div class="form-group col-md-3">
                                                        <label for="CustomerMobile">Mobile</label>
                                                        <input id="customerMobile" name="customerMobile">
                                                   </div>
                                                   <div class="form-group col-md-3">
                                                        <label for="customerPhone">Phone</label>
                                                        <input id="customerPhone" name="customerPhone">
                                                   </div>
                                                   <div class="form-group col-md-6">
                                                         <label for="customerEmail">Email</label>
                                                         <input id="customerEmail" name="customerEmail">
                                                   </div>                                                   
                                             </div>
                                             <div class="form-group">
                                                  <label for="CustomerAddress">Address</label>
                                                  <input id="customerAddress" name="customerAddress">
                                             </div>
                                             <div class="form-group">
                                                   <label for="CustomerAddress2">Address2</label>
                                                   <input id="customerAddress2" name="customerAddress2">
                                             </div>
                                             <div class="form-row">
                                                  <div class="form-group col-md-6">
                                                       <label for="CustomerCity"></label>
                                                       <input id="customerCity" name="customerCity">
                                                  </div>
                                                  <div class="form-group col-md-4">
                                                        <label for="customerDistrict">District</label>
                                                        <select id="customerDistrict" name="customerDisctrict">
                                                               <?php include('include/districtList.html');?>
                                                        </select>
                                                  </div>                                                  
                                             </div>
                                             <button id="addCustomer" name="addCustomer" type="button">Add Customer</button>
                                             <button id="updateCustomer" type="button">Update</button>
                                             <button id="deleteCustomer" type="deleteCustomer">Delete</button>
                                             <button type="reset" class="btn"></button>
                                       </form>
                                 </div>
                            </div>
                      </div>
                      <div id="v-pills-search" role="tabpanel">
                            <div class="card card-outline-secondary my-4">
                                 <div class="card-header">Search Inventory
                                       <button id="searchInventory">
                                               Refresh
                                        </button>
                                 </div>
                                 <div class="card-body">
                                       <ul>
                                            <li>
                                                 <a href="#itemSearch">Item</a>
                                            </li>
                                            <li>
                                                 <a href="#customerSearch">Customer</a>
                                            </li>
                                            <li>
                                                 <a href="#saleSearch">Sale</a>
                                            </li>
                                            <li>
                                                 <a href="#purchaseSearch">Purchase</a>
                                            </li>
                                            <li>
                                                 <a href="#vendorSearch">Vendor</a>
                                            </li>
                                       </ul>
                                       <!-- Tab panes -->
                                       <div class="tab-content">
                                            <div id="itemSearchTab">
                                                  <br>
                                                  <p></p>
                                                  <div id="itemSearchTableDiv"></div>
                                            </div>
                                            <div id="customerSeaerchTab">
                                                  <br>
                                                  <p></p>
                                                  <div id="customerSearchTableDiv"></div>
                                            </div>
                                            <div id="SaleSearchTab">
                                                 <br>
                                                 <p></p>
                                                 <div id="saleSearchTableDiv"></div>
                                            </div>
                                            <div id="purchaseSearchTab">
                                                  <br>
                                                  <p></p>
                                                  <div id="purchaseSearchTableDiv"></div>
                                            </div>
                                            <div id="vendorSearchTabl">
                                                  <br>
                                                  <p></p>
                                                  <div id="vendorSearchTableDiv"></div>
                                            </div>
                                       </div>
                                 </div>
                            </div>
                      </div>
                      <div id="v-pill-report" role="tabpanel">
                            <div class="card card-outline-secondary my-4">
                                  <div class="card-header">Reports
                                        <button id="reportTableRefresh" name="reportTablerefresh">
                                                refresh
                                        </button>
                                  </div>
                                  <div class="card-body">
                                        <ul class="nav nav-tabs" role="tablist">
                                             <li>
                                                  <a href="#itemReportTab"></a>
                                             </li>
                                             <li>
                                                  <a href="#customerReportTab"></a>
                                             </li>
                                             <li>
                                                  <a href="saleReportTab"></a>
                                             </li>
                                             <li>
                                                  <a href="purchaseReport"></a>
                                             </li>
                                             <li>
                                                  <a href="#vendorReportTab"></a>
                                             </li>
                                        </ul>
                                        <!-- Tab panes for reports sections -->
                                        <div class="tab-content">
                                              <div id="itemReportTap">
                                                    <br>
                                                    <p></p>
                                                    <div id="itemReportTableDiv"></div>
                                              </div>
                                              <div id="customerReportTab">
                                                    <br>
                                                    <p></p>
                                                    <div id="customerReportTableDiv"></div>
                                              </div>
                                              <div id="saleReportTab">
                                                    <br>
                                                    <!-- Use the grid below to reports for sales -->
                                                    <form>
                                                          <div class="form-row">
                                                               <div class="form-group col-md-3">
                                                                    <label for="SaleReportStartDate">Start Date</label>
                                                                    <input id="saleReportStartDate" name="saleReportEndDate">
                                                               </div>
                                                               <div class="form-group col-md-3">
                                                                     <label for="SaleReportEndDate">End Date</label>
                                                                     <input id="saleReportEndDate" name="saleReportEndDate">
                                                               </div>
                                                          </div>
                                                          <button id="showSaleReport" type="button">Show Report</button>
                                                          <button id="saleFilterClear" type="reset" class="brn"></button>
                                                    </form>
                                                    <br></br>
                                                    <div id="saleReportTableDiv"></div>
                                              </div>
                                              <div id="purchaseReportTab">
                                                    <br>
                                                    <!-- Use the grid below to get reports for purchases -->
                                                    <form>
                                                          <div class="form-row">
                                                               <div class="form-group col-md-3">
                                                                     <label for="PurchaseReportStartDate">Start Date</label>
                                                                     <input id="purchaseReportStartDate" name="purchaseReportStartDate">
                                                               </div>
                                                               <div class="form-group col-md-3">
                                                                     <label for="purchaseReportEndDate">End Date</label>
                                                                     <input id="purchaseReportEndDate" name="purchaseReportEndDate">
                                                               </div>
                                                          </div>
                                                          <button id="showPurchaseReport">Show Report</button>
                                                          <button id="purchaseFilterClear" type="reset" >Clear</button>
                                                    </form>
                                                    <br></br>
                                                    <div id="purchaseReportTableDiv"></div>                                                    
                                              </div>
                                              <div id="vendorReportTab">
                                                    <br>
                                                    <p></p>
                                                    <div id="vendorReportTableDiv"></div>
                                              </div>
                                        </div>
                                  </div>
                            </div>
                      </div>
                </div>
          </div>
    </div>
 <?php 
      require 'include/footer.php';
?>
</body>
</html>
