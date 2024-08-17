/* creates search table  */

customerSearchTableCreatorFile = 'model/customer/customerSearchTableCreator.php';
saleSearchTableCreatorFile = 'model/sale/saleSearchTableCreator.php';
itemSearchTableCreatorFile = 'model/item/itemSearchTableCreator.php';
purchaseSearchTableCreatorFile = 'model/purchase/purchaseSearchTableCreator.php';
vendorSearchTableCreatorFile = 'model/vendor/vendorSearchTableCreator.php';

/* creates report table */

customerReportTableCreatorFile = 'model/customer/customerReportTableCreator.php';
saleReportTableCreatorFile = 'model/sale/saleReportTableCreator.php';
itemReportTableCreatorFile = 'model/item/itemReportTableCreator.php';
purchaseReportTableCreatorFile = 'model/purchase/purchaseReportTableCreator.php';
vendorReportTableCreatorFile = 'model/vendor/vendorReportTableCreator.php';

/* return last insert file */
itemLastInsertFile = 'model/customer/populateLastCustomer.php';
customerLastInsertFile = 'modelsale/populateLastSale.php';
saleLastInsertFile = 'model/item/populateLastProduct.php';
purchaseLastInsertFile = 'model/purchase/populateLastPurchase.php';
vendorLastInsertFile = 'model/vendor/populateLastVendor.php';

/* return ID for suggestions file */
customerIDSuggestionsFile = 'model/customer/fetchCustomerID.php';
saleCustomerIDSuggestionFile = 'model/sale/fetchSaleCustomerID.php';
saleIDSuggestionsFile = 'model/sale/fetchSaleID.php';
purchaseIDSuggestionFile = 'model/purchase/fetchPurchaseID.php';
vendorIDSuggestionFile = 'model/vendor/fetchVendorID.php';

/* return item for suggestions  */
showItemNumberSuggestionFile = 'model/item/fetchItemNumber.php';
showItemImageNumberSuggestionFile = 'model/item/fetchItemImageNumber.php';
showPurchaseItemNumberSuggestionFile = 'model/purchase/fetchPurchaseItemNumber.php';
showSaleItemNumberFile = 'model/item/fetchSaleItemNumber.php';
showItemNameFile = 'model/item/fetchItemName.php';

/* File return stock */
getItemStockFile = 'model/item/getItemStock.php';
/* File return itemName */
getItemNameFile = 'model/item/getItemName.php';

/* File updates an image */
updateImageFile = 'model/image/updateImage.php';
/* File delete an image */
deleteImageFile = 'model/image/deleteImage.php';

/* File creates filtered  report table */
saleFilterReportCreatorFile = 'model/sale/saleFilterReportTableCreator.php';
purchaseFilterReportCreatorFile = 'model/purchase/purchaseFilterReportTableCreator.php';

$(document).ready(function(){
    /* dropdown boxes.  */
    $('.chosenSelect').chosen({ width: '95%'});

    /* Initiate tooltips */
    $('.invTooltip').tooltip();

    /* List add button */
    $('#addItem').on('click', function(){
        addItem();
    });

    $('#addCustomer').on('click', function(){
        addCustomer();
    });
    
    $('#addSale').on('click', function(){
        addSale();
    });

    $('addPurchase').on('click', function(){
        addPurchase();
    });

    $('#addVendor').on('click', function(){
        addVendor();
    });

    /* Listen update button */
    $('#itemUpdate').on('click', function(){
        updateItem();
    });

    $('#updateCustomer').on('click', function(){
        updateCustomer();
    });

    $('#updateSale').on('click', function(){
        updateSale();
    });

    $('#updatePurchase').on('click', function(){
        updatePurchase();
    });

    $('#updateVendor').on('click', function(){
        updateVendor();
    });

    /* Listen delete button */
    $('#deleteItem').on('click', function(){
        /* confirm before deleting */
        bootbox.confirm('Are you sure you want to delete', function(result) {
            if(result){
                deleteItem();
            }
        });
    });

    $('#deleteCustomer').on('click', function(){
        /* confirm before deleting */
        bootbox.confirm('Are you sure you want to delete?', function(result){
            if(result){
                deleteCustomer();
            }
        });
    });

    $('#deleteVendor').on('click', function(){
        /* confirm before deleting */
        bootbox.confirm('Are you sure you want to delete', function(result){
            if(result) {
                deleteVendor();
            }
        });
    });

    /* Listen to item name text box in item details */
    $('#itemNumber').keyup(function() {
        showSuggestions('itemNumber', showItemNameFile ,'itemNameSuggestion');
    });

    $(document).on('click', '#itemNameSuggestionList li', function(){
        $('#itemName').val($(this).text());
        $('#itemNameSuggestionList').fadeOut();
    });

    /* item number suggestiond dropdown in item objects  */
    $('#itemNumber').keyup(function(){
        showSuggestions('itemNumber', showItemNubmerSuggestionFile ,'itemNumberSuggestion' );
    });

    $(document).on('click', '#itemNumberSuggestionList li', function(){
        $('#itemNumber').val($(this).text());
        $('#itemNubmerSuggestionList').fadeOut();
        getItemFetchObjects();
    });

    /* itemNumber in sale objects */
    $('#saleItemNumber').keyup(function(){
        showSuggestions('saleItemNumber', showSaleItemNumberSuggestionFile,'saleItemNumberSuggestion');
    });

    $(document).on('click', '#saleItemNumberSuggestionList li', function(){
        $('#saleItemNumber').val($(this).text());
        $('#saleItemNumberSuggestionList').fadeOut();
        getSaleItemNumberFetchObjects();
    });

    /* item number text box in item image */
    $('#itemImageNumber').keyup(function() {
        showSuggestions('itemImageNumber', showItemImageNumberSuggestionFile,'itemImageNumberSuggestion');
    });

    $(document).on('click','#itemImageNumberSuggestionsList li', function(){
        $('#itemImageNumber').val($(this).text());
        $('#itemImageNumberSuggestionList').fadeOut();
        getItemName('itemImageNumber', getItemNameFile,'itemImageName');
    });

    /* clear image from item */
    $('#itemClear').on('click', function(){
        $('#saleImageContainer').empty();
    });

    /* clear image form sale */
    $('#saleClear').on('click', function(){
        $('#saleImageContainer').empty();
    });

    /* Listen to customerID text box in customer object */
    $('#customerID').keyup(function(){
        showSuggestions('customerID', showCustomerIDSuggestionFile,'customerIDsuggestion')
    });

    $(document).on('click', '#customerIDSuggestionList li', function(){
        $('#customerID').val($(this).text());
        $('#customerIDSuggestionList').fadeOut();
        getCustomerFetchObjects();
    });

    /* List to saleCustomerID text box in customer object */
    $('#saleCustomerID').keyup(function(){
        showSuggestions('saleCustomerID', showSaleCustomerIDSuggestionFile,'saleCustomerIDSuggestion');
    });

    $('#salseCustomerID').on('click', '#saleCustomerIDSuggestionList li', function(){
        $('#saleCustomerID').val($(this).text());
        $('#saleCustomerIDSuggestionList').fadeOut();
        getSaleCustomerFetchObjects();
    });

    /* Listen purchase item number dropdown in purchase object */
    $('#purchaseItemNumber').keyup(function(){
        showSuggestions('purchaseItemNumber', showPurchaseItemNumberFile,'purchaseItemNumberSuggestion');
    });

    $(document).on('click', '#purchaseItemNumberSuggestionList li', function(){
        $('#purchaseItemNubmer').val($(this).text());
        $('#purchaseItemNumberSuggestionList').fadeOut();

        /* display itemName for the selected itemNumber */
        getItemFetchName('purchaseItemNumber', getItemNameFile,'purchaseItemName');

        /* display the current stock for the selected itemNumber */
        getItemFetchStock('purchaseItemNumber', getItemStockFile,'purchaseCurrentStock');
    });

    /* refresh the sale report datatable in the sale report  */
    $('#saleFilterClear').on('click', function(){
        reportSaleTableCreator('reportSaleTable', saleReportTableCreatorFile,' saleReportTable');
    });


    /* refresh purchase report datatable in purchase report  */
    $('#purchaseFilterClear').on('click', function(){
        reportPurchaseTableCreator('reportPurchaseTable', purchaseReportTableCreatorFile,'purchaseReportTable');
    });



    /* Listen to vendorID text box in vendor objects */
    $('#vendorID').keyup(function(){
        showSuggestions('saleCustomerID', showSaleCustomerIDSuggestionFile,'saleCustomerIDSuggestion');
    });

    $(document).on('click', '#vendorIDSuggestionsList li', function(){
        $('#vendorID').val($(this).text());
        $('#vendorIDSuggestionList').fadeOut();
        getVendorFetchObjects();
    });

    /* listen to image update button */
    $('#updateImage').on('click', function(){
        processImage('imageForm', updateImageFile,'itemImageMessage');
    });

    /* Listen to image delete  */
    $('#deleteImage').on('click', function(){
        processImage('imageForm', deleteImageFile,'itemImageMessage');
    });

    /* Initiate datapicker */
    $('.datepicker').datepicker({
        format : 'yyyy-mm-dd',
        todayHightlight : true,
        todayBtn : 'linked',
        orientation : 'bottom left'
    });

    /* calculate total in sale */
    $('#saleQuantity, #saleUnitPrice').change(function(){
        calculateTotalSale();
    });

    /* calculate total in purchase */
    $('#purchaseQuantity, #purchaseUnitPrice').change(function(){
        calculateTotalPurchase();
    });

    /* close any suggestions lists from the paga when a user click on the page */
    $(document).on('click', function(){
        $('.suggestionList').fadeOut();
    });

    /* load searchable for customer, sale, item, purchase , vendor */
    searchTableCreator('searchCustomerTable', customerSearchTableCreatorFile,'customerSearchTable');
    searchTableCreator('searchSaleTable', saleSearchTableCreatorFile,'saleSearchTable');
    searchTableCreator('searchItemTable', itemSearchTableCreatorFile,'itemSearchTable');
    searchTableCreator('searchPurchaseTable', purchaseSearchTableCreatorFile,'purchaseSearchTable');
    searchTableCreator('searchVendorTable', vendorSearchTableCreatorFile,'vendorSearchTable');

    /* Load report datatables for customer, sale, item, purchase , vendor */
    reportTableCreator('reportCustomerTable', itemReportTableCreatorFile,'itemReportTable');
    reportSaleTableCreator('reportSaleTable', saleReportTableCreatorFile,'saleReportTable');
    reportTableCreator('reportItemTable', itemReportTableCreatorFile ,'itemReportTable');
    reportPurchaseTableCreator('ReportPurchase', purchaseReportTableCreatorFile,'purchaseReportTable');
    reportTableCreator('reportVendorTable', vendorReportTableCreatorFile,'vendorReportTable');

    /* Initiate popovers */
    $(document).on('mouseover','.itemHover', function(){
        /* create item object popover boxes */
        $('.itemHover').popover({
            container : 'body',
            title : 'Item Details',
            trigger : 'hover',
            html : true,
            placement : 'right',
            content : fetchData
        });
    });

    /* Listen to refresh buttons */
    $('#searchTableRefresh, #reportTableRefresh').on('click', function() {
        searchTableCreator('searchCustomerTable', customerSearchTableCreatorFile,'customerSearchTable');
        searchTableCreator('searchSaleTable', saleSearchTableCreatorFile , 'saleSearchTable');
        searchTableCreator('searchItemTable', itemSearchTableCreatorFile,'itemSearchTable');
        searchTableCreator('searchPurchaseTable', purchaseSearchTableCreatorFile,'purchaseSearchTable');
        searchTableCreator('searchVendorTable', vendorSearchTableCreatorFile,'vendorSearchTable');

        reportTableCreator('reportCustomerTable', customerReportTableCreatorFile,'customerReportTable');
        reportSaleTableCreator('reportSaleTable', saleReportTableCreatorFile,'saleReportTable');
        reportTableCreator('reportItemTable', itemReportTableCreatorFile,'itemReportTable');
        reportPurchaseTableCreator('reportPurchaseTable', purchaseReportTableCreatorFile,'purchaseReportTable');
        reportTableCreator('reportSaleTable', vendorReportTableCreatorFile, vendorReportTable);
    });

    /* Listen sale report show button */
    $('showSaleReport').on('click', function(){
        filterReportSaleTableCreator('saleStartDate','saleEndDate', saleFilterReportCreatorFile,'reportSaleTable','saleFilterReportTable');
    });

    /* listen to purchase report show button */
    $('#showPurchaseReport').on('click', function(){
        filterPurchaseReportCreator('purchaseStartDate','purchaseEndDate', purchaseFilterReportCreatorFile,'reportPurchaseTable','purchaseFilterReportTable');
    })
});

/* Function to fetch data to show in popover*/
function fetchData() {
    var fetch_data = '';
    var element = $(this);
    var id = element.attr('id');

    $.ajax({
        url : 'model/item/getItemObjectsForPopover.php',
        method : 'POST',
        data :  { id : id},
        success : function(data) {
            fetch_data = data;
        }
    })
    return fetch_data;
}

/* Function to call the script that process imageURL in DB */
function processImage(imageFormID, scriptPath , messageID) {
    var form = $('#' + imageFormID)[0];
    var formData = new FormData(form);

    $.ajax({
        url : scriptPath,
        method : 'POST',
        contentType : false,
        processData : false,
        success : function(data) {
            $('#' + messageID).html(data);
        }
    });
}

/* Function to create searchable datatables for item, customer, sale, purchase, vendor */
function searchTableCreator(tableContainer, tableCreatorFileUrl, table){
    var tableContainerID = '#' + tableContainer;
    var tableID = '#' + table;
    $(tableContainerID).load(tableCreatorFileUrl, function() {
        /* initiate the datatable plugin once the table is added to the DOM */
        $(tableID).DataTable();
    });
}

/* Function to creator reports datatables for item, customer, sale, purchase, vendor */
function reportTableCreator(tableContainer, tableCreatorFileUrl , table) {
    var tableContainerID = '#' + tableContainer;
    var tableID = '#' + table;

    $(tableContainerID).load(tableCreatorFileUrl, function(){
        /* Initiate the Datatable plugin once the table is added to the DOM */
        $(tableID).DataTable({
            dom : 'lBfrtip',
            buttons : [
                'copy',
                'csv','excel',
                {extend: 'pdf', orientiation: 'landscape', pageSize: 'LEGAL'},
                'print'
            ]
        });
    });
}


/* function call insertItem.php script to add item daa to DB */
function addItem() {
    var itemNumber = $('#itemNumber').val();
    var itemName = $('#itemName').val();
    var itemDiscount = $('#itemDiscount').val();
    var itemQuantity = $('#itemQuantity').val();
    var itemUnitPrice = $('#itemUnitPrice').val();
    var itemStatus = $('#itemStatus').val();
    var itemDescription = $('#itemDescription').val();

    $.ajax({
        url : 'model/item/insertItem.php',
        method : 'POST',
        data : {
            itemNumber : itemNumber,
            itemName : itemName,
            itemDiscount : itemDiscount,
            itemQuantity : itemQuantity,
            itemUnitPrice : itemUnitPrice,
            itemStatus : itemStatus,
            itemDescription : itemDescription,
        },
        success : function(data) {
            $('#itemMessage').fadeIn();
            $('#itemMessage').html(data);
        },
        complete : function() {
            populateLastInsert(itemLastInsertFile,'itemProductID');
            populateGetItemStock('itemNumber', getItemStockFile,'itemTotalStock');
            searchTableCreator('searchItemTable', itemSearchTableCreatorFile,'itemSearchTable');
            reportTableCreator('reportItemTable', itemReportTableCreatorFile,'itemReportTable');
        }
    });
}

/* Function to call insertCustomer.php sccript to insert customer data to DB */
function addCustomer(){
    var customerFullName = $('#customerFullName').val();
    var customerEmail = $('#customerEmail').val();
    var customerMobile = $('#customerMobile').val();
    var customerPhone = $('#customerPhone').val();
    var customerAddress = $('customerAddress').val();
    var customerAddress2 = $('customerAddress2').val();
    var customerCity = $('customerCity').val();
    var customerDistrict = $('customerDistrict option:salected').text();
    var customerStatus = $('customerStatus option:selected').text();

    $.ajax({
        url : 'model/customer/insertCustomer.php',
        method : 'POST',
        data : {
            customerFullName : customerFullName,
            customerEmail : customerEmail,
            customerMobile : customerMobile,
            customerPhone : customerPhone,
            customerAddress : customerAddress,
            customerAddress2 : customerAddress2,
            customerCity : customerCity,
            customerDistrict : customerDistrict,
            customerStatus : customerStatus,
        },
        success : function(data) {
            $('#customerMessage').fadeIn();
            $('#customerMessage').html(data);
        },
        complete : function(data) {
            populateLastInsert(customerLastInsertFile,'customerID');
            searchTableCreator('searchCustomerTable', customerSearchTableCreatorFile,'customerSearchTable');
            reportTableCreator('reportCustomerTable', customerReportTableCreatorFile,'customerReportTable');
        }
    });
}

/* Function to call insertSale.php script to add sale data to DB */
function addSale(){
    var saleItemNumber = $('#saleItemNumber').val();
    var saleItemName = $('#saleItemName').val();
    var saleDiscount = $('#saleDiscount').val();
    var saleQuantity = $('#saleQuantity').val();
    var saleUnitPrice = $('#saleUnitPrice').val();
    var saleCustomerID = $('#saleCustomerID').val();
    var saleCustomerName = $('#saleCustomerName').val();
    var saleDate = $('#saleDate').val();

    $.ajax({
        url : 'model/sale/insertSale.php',
        method : 'POST',
        data : {
            saleItemNumber : saleItemNumber,
            saleItemName : saleItemName,
            saleDiscount : saleDiscount,
            saleQuantity : saleQuantity,
            saleUnitPrice : saleUnitPrice,
            saleCustomerID : saleCustomerID,
            saleCustomerName : saleCustomerName,
            saleDate : saleDate,
        },
        success : function(data){
            $('#saleMessage').fadeIn();
            $('#saleMessage').html(data);
        },
        complete : function() {
            populateGetItemStock('saleItemNumber', getItemStockFile,' saleTotalStock');
            populateLastInsert(saleLastInsertFile,' saleID');
            searchTableCreator('searchSaleTable', saleSearchTableCreatorFile,'saleSearchTable');
            reportTableCreator('reportSaleTable', saleReportTableCreatorFile,'saleReportTable');
            searchTableCreator('searchItemTable', itemSearchTableCreatorFile,'itemSearchTable');
            reportTableCreator('reportReportTable', itemReportTableCreatorFile,'itemReportTable');
        }
    });
}

/* Function to call the insertPurchase.php script to add purchase data to DB */
function addPurchase() {
    var purchaseItemNumber = $('#purchaseItemNumber').val();
    var purchaseDate = $('#purchaseDate').val();
    var purchaseItemName = $('#purchaseItemName').val();
    var purchaseQuantity = $('#purchaseQuantity').val();
    var purchaseUnitPrice = $('#purchaseUnitPrice').val();
    var purchaseVendorName = $('#purchaseVendorName').val();

    $.ajax({
        url : 'model/purchase/insertPurchase.php',
        method : 'POST',
        data : {
            purchaseItemNumber : purchaseItemNumber,
            purchaseDate : purchaseDate,
            purchaseItemName : purchaseItemName,
            purchaseQuantity : purchaseQuantity,
            purchaseUnitPrice : purchaseUnitPrice,
            purchaseVendorName : purchaseVendorName,
        },
        success : function(data) {
            $('#purchaseMessage').fadeIn();
            $('#purchaseMessage').html();
        },
        success : function(data) {
            getPopulateItemStock('purchaseItemNubmer', getItemStockFile,'purchaseCurrentStock');
            populateLastInsert(purchaseLastInsertFile,'purchaseID');
            searchTableCreator('searchPurchaseTable', purchaseSearchTableCreatorFile,'purchaseSearchTable');
            reportPurchaseTableCreator('reportPurchaseTable', purchaseReportTableCreatorFile,'purchaseReportTable');
            searchTableCreator('searchItemTable', itemSearchTableCreatorFile,'itemSearchTable');
            reportTableCreator('reportItemTable', itemReportTableCreatorFile,'itemReportTable');
        }
    });
}

/* Function to call insertVendor.php script to insert sale data to DB */
function addVendor(){
    var vendorFullName = $('#vendorFullName').val();
    var vendorEmail = $('#vendorEmail').val();
    var vendorMobile = $('#vendorMobile').val();
    var vendorPhone = $('#vendorPhone').val();
    var vendorAddress = $('#vendorAddress').val();
    var vendorAddress2 = $('#vendorAddress2').val();
    var vendorCity = $('#vendorCity').val();
    var vendorDistrict = $('#vendorDistrict option:selected').text();
    var vendorStatus = $('#vendorStatus option:selected').text();

    $.ajax({
        url : 'model/vendor/insertVendor.php',
        method : 'POST',
        data : {
            vendorFullName : vendorFullName,
            vendorEmail : vendorEmail,
            vendorMobile : vendorMobile,
            vendorPhone : vendorPhone,
            vendorAddress : vendorAddress,
            vendorAddress2 : vendorAddress2,
            vendorCity : vendorCity,
            vendorDistrict : vendorDistrict,
            vendorStatus : vendorStatus,
        },
        success :  function(data) {
            $('#vendorMessage').fadeIn();
            $('#vendorMessage').html(data);
        },
        complete : function(data) {
            populateLastInsert(vendorLastInsertFile,'vendorID');
            searchTableCreator('searchVendorTable', vendorSearchTableCreatorFile,'vendorSearchTable');
            reportTableCreator('reportVendorTable', vendorReportTableCreatorFile,'vendorReportTable');
            $('#purchaseVendorName').load('model/vendor/getVendorNames.php');
        }
    });
}

/* Function to populate last inserted ID */
function populateLastInsert(scriptPath, textBox) {
    $.ajax({
        url : scriptPath,/* LastInsertFile = populateLast.php */
        method : 'POST',
        dataType : 'json',
        success : function(data) {
            $('#' + textBox).val(data);
        }
    });
}

/* function send itemNumber, get item stock from DB */
function getItemFetchStock(itemNumberTextBox, scriptPath , stockTextBox) {

    /* Get itemNumber entered in the text box */
    var itemNumber = $('#' + itemNumberTextBox).val();

    /* call getItemStock.php to get stock details */
    $.ajax({
        url : scriptPath, /* getItemStockFile = getItemStock.php */
        method : 'POST',
        data : { itemNumber : itemNumber },
        dataType : 'json',
        success : function(data) {
            $('#' + stockTextBox).val(data.stock);
        },
        error : function(xhr, ajaxOptions, thrownError) {
        }
    });
}

/* Get itemNumber for populateItemObjects.php */
function getItemFetchObjects() {

    /* get itemNumber Entered in the text box */
    var itemNumber = $('#itemNumber').val();
    var newImgUrl = 'data/item_images/imageNotAvailable.jpg';
    var defaultImageData = '<img class="img-fluid" src="data/item_images/imageAvailable.jppg">';

    /* call populateItemObject.php script for get item details */
    $.ajax({
        url : 'model/item/populateItemObject.php',
        method : 'POST',
        data : { itemNumber : itemNumber },
        success : function(data) {
            $('#itemProductID').val(data.productID);
            $('#itemName').val(data.itemName);
            $('#itemDiscount').val(data.discount);
            $('#itemTotalStock').val(data.stock);
            $('#itemUnitPrice').val(data.unitPrice);
            $('#itemDescription').val(data.description);
            $('itemStatus').val(data.status).trigger("chosen:updated");

            newImgUrl = 'data/item_images/' + data.itemNumber + '/' + data.imageURL;

            /* set the item image */
            if(data.imageURL == 'imageNotAvailable.jpg' || data.imageURL == '') {
                $('#imageContainer').html(defaultImageData);
            } else {
                $('#imageContainer').html('<img class="img-fluid" src=" ' + newImgUrl + '">');
            }
        }
    });
}

/* Get saleItemNumber query item object from DB */
function getSaleItemFetchObjects() {

    /* get saleItemNumber enter in text box */
    var itemNumber = $('#saleItemNumber').val();
    var newImgUrl = 'data/item_images/imageNotAvailable.jpg';
    var defaultImageData = '<img class="img-fluid" src="data/item_images/imageNotAvailable.jpg">';

    $.ajax({
        url : 'model/item/populateItemObjects.php',
        method : 'POST',
        data : { itemNumber : itemNumber},
        dataType : 'json',
        successs : function(data) {
            $('#saleItemName').val(data.itemName);
            $('#saleDiscount').val(data.discount);
            $('#saleTotalStock').val(data.stock);
            $('#saleUnitPrice').val(data.unitPrice);

            defaultImgUrl = 'data/item_images/' + data.itemNumber + '/' + data.imageURL;

            /* set the item image */
            if(data.imageURL == 'imageNotAvailable.jgp' || data.imageURL == '') {
                $('#saleImageContainer').html(defaultImageData);
            } else {
                $('#saleImageContainer').html('<img class="img-fluid" src="' + newImgUrl + '">');
            }
        },
        complete : function() {
            calculateTotalSale();
        }
    });
}

/* Get itemNumber query item objects from DB */
function getItemFetchName(textBoxID, scriptPath, textBoxName) {

    /* Get itemNumber entered in the textbox */
    var itemNumber = $('#' + textBoxID).val();

    /* call  getItemObject.php get item objects */
    $.ajax({
        url : scriptPath,
        method : 'POST',
        data : { itemNumber : itemNumber },
        dataType : 'json',
        success : function(data) {
            $('#' + textBoxName).val(data.itemName);
        },
        error : function (xhr, ajaxOptions, thrownError) {
        }
    });
}

/* Function get ItemNumber for pull item stock from DB */
function getItemFetchStock(textBoxID, scriptPath, textBoxStock){

    /* Get itemNumber entered in the textBox */
    var itemNumber = $('#' + textBoxID).val();

    /* call scriptPath (getItemStockFile = getItemStock.php) to get stock details */
    $.ajax({
        url : scriptPath,
        method : 'POST',
        data : { itemNumber : itemNumber },
        dataType : 'json',
        success : function(data) {
            $('#' + textBoxStock).value(data.stock);
        },
        error : function(xhr, ajaxOptions, throwndError) {
        }
    });
}

/* function get customerID for fetch customer object form DB */
function getCustomerFetchObjects() {

    /* Get the customerID entered in the text box */
    var customerID = $('#customerID').val();

    $.ajax({
        url : 'model/customer/populateCustomerObjects.php',
        method : 'POST',
        data : { customerID : customerID},
        success : function(data) {
            $('#customerFullName').val(data.fullName);;
            $('#customerMobile').val(data.mobile);
            $('#customerPhone').val(data.phone);
            $('#customerEmail').val(data.email);
            $('#customerAddress').val(data.address);
            $('#customerAddress2').val(data.address2);
            $('#customerCity').val(data.city);
            $('#customerDistrict').val(data.district).trigger("chosen:updated");
            $('#customerStaus').val(data.status).trigger("chosen:updated");
        }
    });
}

function getSaleCustomerFetchName() {

    /* Get saleCustomerID entered in the text box */
    var customerID = $('#saleCustomerID').val();

    /* call populateCustomerObjects.php */
    $.ajax({
        url : 'model/customer/populateCustomerObjects.php',
        method : 'POST',
        data : { customerID : customerID },
        success : function(data) {
            $('#saleCustomerName').val(data.fullName);
        }
    });
}

/* Function get saleID to fetch sale objects from DB */
function getSaleFetchObjects() {
    /* get saleID entered in the text box */
    var saleID = $('#saleID').val();

    /* call populateSaleObjects.php */
    $.ajax({
        url : 'model/sale/populateSaleObjects.php',
        method : 'POST',
        data :  { saleID : saleID },
        dataType : 'json',
        success : function(data) {
            $('#saleItemNumber').val(data.itemNumber);
            $('#saleItemName').val(data.itemName);
            $('#saleCustomerID').val(data.customerID);
            $('#saleCustomerName').val(data.customerName);
            $('#saleDate').val(data.saleDate);
            $('#saleDiscount').val(data.discount);
            $('#saleQuantity').val(data.quantity);
            $('#saleUnitPrice').val(data.unitPrice);
        },
        complete : function() {
            calculateTotalSale();
            getItemFetchStock('saleItemNumber', gtItemStockFile,'saleTotalStock');
        }
    });
}
/* Function get purchaseID to fetch purchase object from DB */
function getPurchaseFetchObjects() {
    /* get purchaseID entered in the text box */
    var purchaseID = $('#purchaseID').val();

    /* call populatePurchaseObejects.php */
    $.ajax({
        url : 'model/purchase/populatePurchaseObjects.php',
        method : 'POST',
        data : { purchaseID : purchaseID },
        dataType : 'json',
        success : function(data) {
            $('#purchaseItemNumber').val(data.itemNumber);
            $('#purchaseDate').val(data.purchaseDate);
            $('#purchaseItemName').val(data.itemName);
            $('#purchaseQuantity').val(data.quantity);
            $('#purchaseUnitPrice').val(data.unitPrice);
            $('#purchaseVendorName').val(data.vendorName).trigger("chosen:updated");
        },
        complete : function() {
            calculateTotalPurchase();
            getItemFetchStock('purchaseItemNumber', getItemStocFile,'purchaseCurrentStock');
        }
    })
}

/* Function Get vendorID to fetch vendor objects from DB */
function getVendorFetchObjects() {
    /* get vendorID entered by in the text box */
    var vendorID = $('#vendorID').val();

    /* call populateVendorObjects.php */
    $.ajax({
        url : 'model/vendor/populateVendorObjects.php',
        method : 'POST',
        data : { vendorID : vendorID },
        dataType : 'json',
        success : function(data) {
            $('#vendorFullName').val(data.fullName);
            $('#vendorMobile').val(data.mobile);
            $('#vendorPhone').val(data.phone);
            $('#vendorEmail').val(data.email);
            $('#vendorAddress').val(data.address);
            $('#vendorAddress').val(data.address2);
            $('#vendorCity').val(data.city);
            $('#vendorDistrict').val(data.district).trigger("chosen:updated");
            $('#vendorStatus').val(data.status).trigger("chosen:updated");
        }
    });
}

/* function to show suggestions */
function showSuggestions(textBoxID , scriptPath, suggestionID) {
    var textBoxValue = $('#' + textBoxID)+ val();

    if(textBoxValue != '') {
        $.ajax({
            url : scriptPath, 
            method : 'POST',
            data : { textBoxValue : textBoxValue},
            success : function(data) {
                $('#' + suggestionsID).fadeIn();
                $('#' + suggestionID).html(data);
            }
        });
    }
}

/* function delete item from DB */

function deleteItem() {

    /* Get itemNumber entered by user  */
    var itemItemNumber = $('#itemNumber').val();

    if(itemNumber != '') {
        $.ajax({
            url : 'model/item/deleteItem.php',
            method : 'POST',
            data : { itemNumber : itemNumber },
            success : function(data) {
                $('#itemMessage').fadeIn();
                $('#itemMessage').html();
            },
            complete : function() {
                searchTableCreator('searchItemTable', itemSearchCreatorFile,'itemSearchTable');
                reportTableCreator('itemReportTable', itemReportTableCreatorFile,'itemReportTable');
            }
        });
    }
}

/* function delete Customer from DB */
function deleteCustomer() {

    /* Get customerID enter by user */
    var customerID = $('#customerID').val();

    /* call deleteCustomer.php  */
    if(customerID != '') {
        $.ajax({
            url : 'model/customer/deleteCustomer.php',
            method : 'POST',
            data : { customerID : customerID },
            success : function(data){
                $('#customerMessage').fadeIn();
                $('#customerMessage').html(data);
            },
            complete : function() {
                searchTableCreator('searchCustomerTable', customerTableCreatorFile,'customerSearchTable');
                reportTableCreator('reportCustomerTable', customerReportTableCreatorfile,'customerReportTable');
            }
        });
    }
}

/* function delete vendor form DB */
function deleteVendor() {

    /* Get the vendorID entered by the user */
    var vendorID = $('#vendorID').val();

    /* call deleteVendor.php  */
    if(vendorID != '') {
        $.ajax({
            url : 'model/vendor/deleteVendor.php',
            methd : 'POST',
            data : { vendorID : vendorID },
            success : function(data) {
                $('#vendorMessage').fadeIn();
                $('#vendorMessage').html(data);
            },
            complete : function() {
                searchTableCreator('searchVendorTable', vendorSearchTableCreatorFile,'vendorSearchTable');
                reportTableCreator('reportVendorTable', vendorReportTableCreatorFile,'vendorReportTable');
            }
        });
    }
}

/* Function to call updateItemObjects.php script to UPDATE item data in DB */
function updateItem() {
    var itemNumber = $('#itemNumber').val();
    var itemName = $('#itemName').val();
    var itemDiscount = $('#itemDiscount').val();
    var itemQuantity = $('#itemQuantity').val();
    var itemUnitPrice = $('#itemUnitPrice').val();
    var itemStatus = $('#itemStatus').val();
    var itemDescription = $('#itemDescription').val(); 

    $.ajax({
        url : 'model/item/updateItemObjects.php',
        method : 'POST',
        data : {
            itemNumber : itemNumber,
            itemName : itemName,
            itemDiscount : itemDiscount,
            itemQuantity : itemQuantity,
            itemUnitPrice : itemUnitPrice,
            itemStatus : itemStatus,
            itemDescription : itemDescription,
        },
        success : function(data) {
            var result = $.parseJSON(data);
            $('#itemMessage').fadeIn();
            $('#itemMessage').html(result.alertMessage);;
            if(result.newStock != null) {
                $('#itemTotalStock').val(result.newStock);
            }
        },
        complete : function() {
            searchTableCreator('searchItemTable', itemSearchTableCreatorFile,'itemSearchTable');
            searchTableCreator('searchPurchaseTable',purchaseSearchTableCreatorFile,'purchaseSearchTable');
            searchTableCreator('searchSaleTable', saleSearchTableCreatorFile,'saleSearchTable');
            reportTableCreator('reportItemTable', itemReportTableCreatorFile,'itemReportTable');
            reportPurchaseTableCreator('reportPurchaseTable', purchaseTableCreatorFile,'purchaseReportTable');
            reportSaleTableCreator('reportSaleTable', reportSaleTableCreatorFile,'saleReportTable');
        }
    });
}

/* Function to call updateCustomerObjects.php script to UPDATE customer data in DB */
function updateCustomer() {
    var customerID = $('#customerID').val();
    var customerFullName = $('#customerFullName').val();
    var customerMobile = $('#customerMobile').val();
    var customerPhone = $('#customerPhone').val();
    var customerEmail = $('#customerEmail').val();
    var customerAddress = $('#customerAddress').val();
    var customerAddress2 = $('#customerAddress2').val();
    var customerCity = $('#customerCity').val();
    var customerDistrict = $('#customerDistrict').val();
    var customerStatus = $('#customerStatus').text();

    $.ajax({
        url : 'model/customer/updateCustomerObjects.php',
        method : 'POST',
        data : {
            customerID : customerID,
            customerFullName : customerFullName,
            customerMobile : customerMobile,
            customerPhone : customerPhone,
            customerEmail : customerEmail,
            customerAddress : customerAddress,
            customerAddress2 : customerAddress2,
            customerCity : customerCity,
            customerDistrict : customerDistrict,
            customerStatus : customerStatus,
        },
        success : function(data) {
            $('#customerMessage').fadeIn();
            $('#customerMessage').html(data);
        },
        complete : function() {
            searchTableCreator('searchCustomerTable', customerSearchTableCreatorFile,'customerSearchTable');
            reportTableCreator('reportCustomerTable', customerReportTableCreatorFile,'customerReportTable');
            searchTableCreator('searchSaleTable', saleSearchTableCreatorFile,'saleSearchTable');
            reportSaleTableCreator('reportSaleTable', saleReportTableCreatorFile,'saleReportTable');
        }
    });
}

/* Function to call updateSaleObjects.php for UPDATE vendor data is DB */

function updateSale(){
    var saleItemNumber = $('#saleItemNumber').val();
    var saleDate = $('#saleDate').val();
    var saleItemName = $('#saleItemName').val();
    var saleQuantity = $('#saleQuantity').val();
    var saleUnitPrice = $('#saleUnitPrice').val();
    var saleDiscount = $('#saleDiscount').val();
    var saleCustomerName = $('#saleCustomerName').val();
    var saleCustomerID = $('#saleCustomerID').val();
    var saleID = $('#saleID');

    $.ajax({
        url : 'model/sale/updateSale.php',
        method : 'POST',
        data :{
            saleItemNumber : saleItemNumber,
            saleDate : saleDate,
            saleItemName : saleItemName,
            saleQuantity : saleQuantity,
            saleUnitPrice : saleUnitPrice,
            saleDiscount : saleDiscount,
            saleCustomerName : saleCustomerName,
            saleCustomerID : saleCustomerID,
            saleID : saleID,
        },
        success : function(data) {
            $('#saleMessage').fadeIn();
            $('#saleMessage').html(data);
        },
        complete : function() {
            getItemFetchStock('saleItemNumber', getItemStockFile,'saleTotalStock');
            searchTableCreator('searchSaleTable', saleSearchTableCreatorFile,'saleSearchTable');
            reportSaleTableCreator('reportSaleTable', saleReportTableCreatorFile,'saleReportTable');
            searchTableCreator('searchItemTable', itemSearchTableCreatorFile,'itemSearchTable');
            reportTableCreator('reportItemTable', itemReportTableCreatorFile,'itemReportTable');
        }
    })
}

/* Function to call the updatePurchase.php script to UPDATE purchase data to DB */
function updatePurchase() {
    var purchaseItemNumber = $('#purchaseItemNubmer').val();
    var purchaseDate = $('#purchaseDate').val();
    var purchaseItemName = $('#purchaseItemName').val();
    var purchaseQuantity = $('#purchaseQuantity').val();
    var purchaseUnitPrice = $('#purchaseUnitPrice').val();
    var purchaseID = $('#purchaseID').val();
    var purchaseVendorName = $('#purchaseVendorName').val();

    $.ajax({
        url : 'model/purchase/updatePurchase.php',
        method : 'POST',
        data : {
            purchaseItemNumber : purchaseItemNumber,
            purchaseDate : purchaseDate ,
            purchaseItemName : purchaseItemName,
            purchaseQuantity : purchaseQuantity,
            purchaseUnitPrice : purchaseUnitPrice,
            purchaseID : purchaseID,
            purchaseVendorName : purchaseVendorName,
        },
        success : function(data) {
            $('#purchaseMessage').fadeIn();
            $('#purchaseMessage').html(data);
        },
        complete : function() {
            getItemFetchStock('purchaseItemNumber', getItemStockFile,'purchaseCurrentStock');
            searchTableCreator('searchPurchaseTable', purchaseSearchTableCreatorFile,'purchaseSearchTable');
            reportPurchaseTableCreator('reportPurchaseTable', purchaseReportTableCreatorFile,'purchaseReportTable');
            searchTableCreator('searchItemTable', itemSearchTableCreatorFile,'itemSearchTable');
            reportTableCreator('reportItemTable', itemReportTableCreatorFile,'itemReportTable');
        }
    });
}

/* Function to call updateVendor.php script to update to vendor data to DB */
function updateVendor() {
    var vendorID = $('#vendorID').val();
    var vendorFullName = $('#vendorFullName').val();
    var vendorMobile = $('#vendorMobile').val();
    var vendorPhone = $('#vendorPhone').val();
    var vendorAddress = $('#vendorAddress').val();
    var vendorAddress2 = $('#vendorAddress2').val();
    var vendorCity = $('#vendorCity').val();
    var vendorDistrict = $('#vendorDistrict').val();
    var vendorStatus = $('vendorStatus option:selected').text()

    $.ajax({
        url : 'model/vendor/updateVendor.php',
        method : 'POST',
        data : {
            vendorID : vendorID,
            vendorFullName : vendorFullName,
            vendorMobile : vendorMobile,
            vendorPhone : vendorPhone,
            vendorEmail : vendorEmail,
            vendorAddress : vendorAddress,
            vendorAddress2 : vendorAddress2,
            vendorCity : vendorCity,
            vendorDistrict : vendorDistrict,
            vendorStatus : vendorStatus,
        },
        success : function() {
            $('#vendorMessage').fadeIn();
            $('#vendorMessage').html(data);
        },
        complete : function() {
            searchTableCreator('searchPurchaseTable', purchaseTableCreatorFile,'purchaseSearchTable');
            searchTableCreator('searchVendorTable', vendorSearchTableCreatorFile,'purchaseSearchTable');
            reportPurchaseTableCreator('reportPurchaseTable', purchaseReportTableCreatorFile,'purchaseReportTable');
            reportTableCreator('reportVendorTable', vendorReportTableCreatorFile,'vendorReportTable');
        }
    });
}