/* file create object search table */
itemSearchTableCreatorFile = 'model/item/itemSearchTableCreator.php';
customerSearchTableCreatorFile = 'model/customer/customerSearchTableCreator.php';
saleSearchTableCreatorFile = 'model/sale/saleSearchTableCreator.php';
purchaseSearchTableCreatorFile = 'model/purchase/purchaseSearchTableCreator.php';
vendorSearchTableCreatorFilefunction = 'model/vendor/vendorSearchTableCreator.php';

/* file create object report table */
itemReportTableCreatorFile = 'model/item/itemReportTableCreator.php';
customerReportTableCreatorFile = 'model/customer/customerReportTableCreator.php';
saleReportTableCreatorFile = 'model/sale/saleReportTableCreator.php';
purchaseReportTableCreatorFile = 'model/purchase/purchaseReportTableCreator.php';
vendorReportTableCreatorFile = 'model/vendor/vendorReportTableCreator.php';

/* file return last ID inserted */
itemLastInsertFile = 'model/item/populateLastItemNumber.php';
customerLastInsertFile = 'model/customer/populateLastCustomer.php';
saleLastInsertFile = 'model/sale/populateLastSale.php';
purchaseLastInsertFile = 'model/purchase/populateLastPurchase.php';
vendorLastInsertFile = 'model/vendor/populateLastVendor.php';

/* file  return field ID */
itemIDPresentationFile = 'model/item/showItemNumber.php';
customerIDPresentationFile = 'model/customer/showCustomerID';
saleIDPresentationFile = 'model/sale/showSaleID.php';
purchaseIDPresentationFile = 'model/purchase/showPurchaseID.php';
vendorIDPresentationFile = 'model/vendor/showVendorID';

/* file return  */

$(document).ready(function(){
    $('.chosenSelect').chosen({width: '95%'});

    /* initiate tooltips */
    $('.invTootip').tooltip();

    /* call function add object */
    $('#addItem').on('click', function(){
        addItem();
    });

    $('#addCustomer').on('click', function(){
        addCustomer();
    });

    $('#addSale').on('click', function(){
        addSale();
    });

    $('#addPurchase').on('click', function(){
        addPurchase();
    });

    $('#addVendor').on('click', function(){
        addVendor();
    });

    /* call function update object */
    $('#updateItem').on('click', function(){
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

    $('#updateVendr').on('click', function(){
        updateVendor();
    });

    $('#deleteItem').on('click', function(){
        /* confirm message delete */
        bootbox.confirm('Are you sure you want to delete?', function(result){
            if(result){
                deleteItem();
            }
        });
    });

    $('#deleteCustomer').on('click', function(){
        /* confirm message delete */
        bootbox.confirm('Are you sure you want to delete?', function(result){
            if(result){
                deleteCustomer();
            }
        });
    });

    $('#deleteSale').on('click', function(){
        /* confirm message delete */
        bootbox.confirm('Are you sure you want to delete?', function(result){
            if(result){
                deleteSale();
            }
        });
    });

    $('#deletePurchase').on('click', function(){
        /* confirm message delete */
        bootbox.confirm('Are you sure you want to delete?', function(result){
            if(result){
                deletePurchase();
            }
        });
    });
    $('#deleteVendor').on('click', function(){
        /* confirm message delete */
        bootbox.confirm('Are you sure you want to delete', function(result){
            if(result){
                deleteVendor();
            }
        });
    });

    $('#itemName').keyup(function(){
        /* return itemName */
        showPresentations('itemName', showItemNameFile,'itemNamePresentations');
    });

    $(document).on('click','#itemNamePresentationsList li', function(){
        $('#itemName').val($(this).text());
        $('#itemNamePresentationsList').fadeOut();
    });

    $('#itemNumber').keyup(function(){
        /* return itemNumber */
        showPresentations('itemNumber', showItemNumberFile, 'itemNumberPresentations');
    });

    $('#itemNumber').on('click', '#itemNamePresentationList li', function(){
        $('#itemNumber').val($(this).text());
        $('#itemNumberPresentationsList').fadeOut();
        getPoupulateItem()
    });

    $('#saleItemNumber').keyup(function(){
        showPresentations('#saleItemNumber', showSaleItemNumberFile,' saleItemNumberPresentations');
    });

    $('document').on('click', '#saleItemNumberPresentationList li', function(){
        $('#saleItemnumber').val($(this).text());
        $('#saleItemNumberPresentationList').fadeOut();
        getPopulateSaleItemNumber();
    });

    $('#itemImageNumber').keyup(function(){
        showPresentations('itemImageNumber', showPopulateItemImageNumberFile,'itemImageNumberPresentation');
    });

    $('document').on('click', '#itemImageNumberPresentationsList li', function(){
        $('#itemImageNumber').val($(this).next());
        $('#itemImageNumberPresentation').fadeOut();
        getItemName('itemImageNumber', getItemNameFile,'itemImageName');
    });

    $('#customerID').keyup(function(){
        showPresentations('customerID', showCustomerIDPresentationsFile,' customerIDPresentations');
    });

    $(document).on('click','#customerIDPresentationsList li', function(){
        $('#customerID').val($(this).text());
        $('#customerIDPresentationsList').fadeOut();
        getPopulateCustomer();
    });

    $('#saleCustomerID').keyup(function(){
        showPresentations('saleCustomerID', showSaleCustomerIDPresentationsFile,'saleCustomerIDPresentations');
    });

    $(document).on('click', '#saleCustomerIDPresentationsList li', function(){
        $('#saleCustomerID').val($(this).text());
        $('#saleCustomerIDPresentationsList').fadeOut();
        getPopulateSaleCustomer();
    });

    $('#purchaseID').keyup(function(){
        showPresentations('purchaseID', showPurchaseIDPresentationsFile,'purchaseIDPresentations');
    });

    $(document).on('click', '#purchaseIDPresentationsList li', function(){
        $('#purchaseID').val($(this).text());
        $('#purchaseIDPresentationList').fadeOut();
        getPopulatePurchaseObject();
    });

    $('#vendorID').keyup(function(){
        showPresentations('vendorID', showVendorIDPresentationsFile,'vendorIDPresentations');
    });

    $(document).on('click', '#vendorIDPresentationsList li', function(){
        $('#vendorID').val($(this).text());
        $('#vendorIDPresentationsList').fadeOut();
        getPopulateVendorObject();
    });

    /* reset data */
    $('#itemClear').on('click', function(){
        $('imageContainer').empty();
    });

    $('#saleClear').on('click', function(){
        $('#saleImageContainer').empty();
    });

    $('#purchaseFilterClear').on('click', function(){
        reportPurchaseTableCreator('purchaseReportTableDiv', purchaseReportTableCreatorFile,'purchaseReportTable');
    });

    $('#saleFilterClear').on('click', function(){
        reportSaleTableCreator('saleReportTablediv', saleReportTableCreatorFile,'saleReportTable');
    });

    $('#updateImage').on('click', function(){
        processImage('imageForm', updateImageFile,'itemImageMessage');
    });

    $('#deleteImage').on('click', function(){
        processImage('imageForm', deleteImageFile,'itemImageMessage');
    });
    
    /* initiate datepicker */
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        todayHightlight: true,
        todayBtn: 'linked',
        orientation: 'bottom left'
    });

    /* calculate total  */
    $('#purchaseQuantity, #purchaseUnitPrice').change(function(){
        calculatePurchaseTotal();
    });

    $('#saleDiscount, #saleQuantity, #saleUnitPrice').change(function(){
        calculateTotalSale();
    });

    $(document).on('click', function(){
        $('.presentationsList').fadeOut();
    });
    /* create search table */
    searchTableCreator('itemSearchTableDiv', itemSearchTableCreatorFile,'itemSearchTable');
    searchTableCretor('customerSearchTableDiv', customerSearchTableCreatorFile,'customerSearchTable');
    searchTableCreator('saleSearchTableDiv', saleSearchTableCreatorFile,'saleSearchTable');
    searchTableCreator('purchaseSearchTableDiv', purchaseSearchTableCreatorFile,'purchaseSearchTable');
    searchTableCreator('vendorSearchTableDiv', vendorSearchTableCreatorFile,'vendorSearchTable');

    /* create report table */
    reportTableCreator('itemReportTableDiv', itemReportTableCreatorFile,'itemReportTable');
    reportTableCreator('customerReportTableDiv', customerReportTableCreatorFile,'customerReportTable');
    reportTableCreator('saleReportTableDiv', saleReportTableCreatorFile,'saleReportTable');
    reportTableCreator('purchaseReportTableDiv', reportPurchaseTableCreatorFile,'purchaseReportTable');
    reportTableCreator('vendorReportTableDiv', reportVendorTableCreatorFile,'vendorReportTable');

    /* initiate popovers */
    $(document).on('mouseover', 'itemHover', function(){
        /* create item object popover boxes */
        $('.itemHover').popover({
            container: 'body',
            title: 'Item details',
            trigger: 'hover',
            html: true,
            placement: 'right',
            content: fetchData
        });
    });

    /* refresh */
    $('#searchTableRefresh, #reportTableRefresh').on('click', function(){
        searchTableCreator('itemSearchTableDiv', itemSearchTableCreatorFile,'itemSearchTable');
        searchTableCreator('customerSearchTableDiv', customerSearchTableCreatorFile,'customerSearchTable');
        searchTableCreator('saleSearchTableDiv', saleSearchTableCreatorFile,'customerSearchTable');
        searchTableCreator('purchaseSearchTableDiv', purchaseSearchTableCreatorFile,'purchaseSearchTable');
        searchTableCreator('vendorSearchTableDiv', vendorSearchTableCreatorFile,'vendorSearchTable');

        reportTableCreator('itemReportTableDiv', itemReportTableCreatorFile,'itemReportTable');
        reportTableCreator('customerReportTableDiv', customerReportTableCreatorFile,'itemReportTable');
        reportTableCreator('saleReportTableDiv', saleReportTableCreatorFile,'saleReportTable');
        reportTableCreator('purchaseReportTableDiv', purchaseReportTableCreatorFile,'itemReportTable');
        reportTableCreator('vendorReportTableDiv', vendorReportTableCreatorFile,'vendorReportTable');
    });

    $('#showPurchaseReport').on('click', function(){
        filteredPurchaseReportTableCreator('purchaseReportStartDate', 'purchaseReportEndDate', purchaseFitlerReportCreatorFile,'purchaseReportTableDiv', 'purchaseFilterReportTable');
    });

    $('#showSaleReport').on('click', function(){
        filterSaleReportTableCreator('saleReportStartDate', 'purchaseReportEndDate', saleFitlerReportCreatorFile,'saleReportTableDiv', 'saleFilterReportTable');
    });

});

/* fetch data show */
function fetchDate(){
    var fetch_data = '';
    var element = $(this);
    var id = element.attr('id');

    $.ajax({
        url: 'model/item/getItemObjectPopover.php';
        method: 'POST',
        async: false,
        data: {id:id},
        success: function(data){
            fetch_data = data;
        }
    });
    return fetch_data;
}

function processImage(imageFormID, scriptPath, messageDivID){
    var form = $('#' + imageFormID)[0];
    var formData = new FormData(form);
    
    $.ajax({
        url: scriptPath,
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data){
            $('#' + messageDivID).html(data);
        }
    });
}

/* create searchable  */
function searchTableCreator(tableContainerDiv, tableCreatorFileUrl, table){
    var tableContainerDiv = '#' + tableContainerDiv;
    var tableID = '#' + table;
    $(tableContainerDivID).load(tableCreatorFileUrl, function(){
        /* datatable plugin once the table */
        $(tableID).DataTable();
    });
}

function reportTableCreator(tableContainerDiv, tableCreatorFileUrl, table){
    var tableContainerDivID = '#' + tableContainerDiv;
    var tableID = '#' + table;

    $(tableContainerDivID).load(tableContainerUrl, function(){
        $(tableID).DataTable({
            dom: 'lBfrtip',
            buttons: [
                'copy':
                'csv','excel',
                {extend: 'pdf', orientation: 'landscpe', pageSize: 'LEGAL'},
                'print'
            ]
        });
    });
}

/* create reports datatables for purchase */
function reportPurchaseTableCreator(tableContainerDiv, tableCreatorFileUrl, table){
    var tableContainerDiv = '#' + tableContainerDiv;
    var tableID = '#' + table;
    $(tableContainerDivID).load(tableCreatorFileUrl, function(){
        $(tableID).DataTable({
            dom: 'lBfrtip',
            buttons:[
                'copy',
                {extend: 'cs', footer: true, title: 'Purchase Report'},
                {extend: 'excel', footer: true, title: 'Purchase Report'},
                {extend: 'pdf', footer: true, orientation: 'loadscape', pageSize: 'LEGAL', title: 'Purchase  Report'},
                {extend: 'print', footer: true, title: 'Purchase Report'},
            ],
            "footerCallback": function (row, data, start, end, display ){
                var api = this.api(), data;
                /* remove formatting to get integer data for summation */
                var intVal = function( i ){
                    return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
                };
                /* Quantity total over all pages */
                quantityTotal = api
                    .column( 6 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                /* Quantity for current page */
                quantityFilterTotal = api 
                    .column( 6, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                /* Unit price for current page */
                unitPriceFilterTotal = api 
                    .column( 7, { page: 'current'} )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                /* full price total over all pages */
                fullPriceTotal = api
                    .column( 8 )
                    .data()
                    .reduce( function(a, b){
                        return intVal(a) + intVal(b);
                    }, 0 );
                /* full price for current page */
                fullPriceFilterTotal = api
                    .column( 8, { page: 'current'} )
                    .data()
                    .reduce( function (a, b){
                        return intVal(a) + intVal(b);
                    }, 0 );
                    /* update footer column */
                $( api.column( 6 ).footer() ).htnl(quantityFilterTotal + '(' + quantityTotal + ' total )');
                $( api.column( 7 ).footer() ).html(unitPriceFilterTotal + '(' + unitPriceTotal + ' total)');
                $( api.column( 8 ).footer() ).html(fullPriceFilterTotal + '(' + fullPriceTotal + ' total)');
            }
        });
    });
}

function reportSaleTableCreator(tableContainerDiv, tableCreatorFileUrl, table){
    var tableContainerDivID = '#' + tableContainerDiv;
    var tableID = '#' + table;
    $(tableContainerDivID).load(tableCreatorFileUrl, function(){
        /* initiate the datatable plugin once the table is added to the DOM */
        $(tableID).DataTable({
            dom: 'lBfrtip',
            buttons: [
                'copy',
                {extend: 'csv', footer: true, title: 'Sale Report'},
                {extend: 'excel', footer: true, title: 'Sale Reprot'},
                {extend: 'pdf', footer: true, orientation: 'landscape', pageSize: 'LEGAL', title: 'Sale Report'},
                {extend: 'print', footer: true, title: 'Sale Report'},
            ],
            "footerCallback": function (row, data, start, end, display){
                var api =  this.api(), data;
                /* remove the formatting to get integer data for summation */
                var intVal = function ( i ){
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                        typeof i === 'number' ?
                            i : 0;
                };
                /* Quantity total over all page */
                quantityTotal = api 
                    .column( 7 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                /* Quantity Total over this page */
                quantityFilterTotal = api 
                    .column( 7, { page: 'current'})
                    .data()
                    .reduce( function (a, b){
                        return intVal(a) + intVal(b);
                    }, 0 );
                /* Unit Price Total over all page */
                unitPriceTotal = api
                    .column( 8 )
                    .data()
                    .reduce( function(a , b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                /* Full price total over all pages */
                fullPriceTotal = api 
                    .column( 9 )
                    .data()
                    .reduce( function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0 );
                /* update footer column */
                $( api.column( 7 ).footer() ).html(quantityFilterTotal + '(' + quantityTotal + ' total)');
                $( api.column( 8 ).footer() ).html(unitPriceFilterTotal + '(' + unitPriceTotal + ' total)');
                $( api.column( 9 ).footer() ).html(fullPriceFilterTotal + '(' + fullPriceTotal + 'total)');
            }
        });
    });
}

/* create filter datatable for sale details with total values */
function filterSaleReportTableCreator(startDate, endDate, scriptPath, tableDIV, tableID){
    var startDate = $('#' + startDate).val();
    var endDate = $('#' + endDate).val();

    $.ajax({
        url: scriptPath,
        method: 'POST',
        data: {
            startDate:startDate,
            endDate:endDate,
        },
        success: function(data){
            $('#' + tableDiv).empty();
            $('#' + tableDIV).html();
        },
        complete: function(){
            /* initiate datatable plugin once the table is added to the DOM */
            $('#' + tableID).DataTable({
                dom: 'lBfrtip',
                buttons: [
                    'copy',
                    {extend: 'csv', footer: true, title: 'Sale Report'},
                    {extend: 'excel', footer: true, title: 'Sale Report'},
                    {extend: 'pdf', footer: true, orientation: 'landscape', pageSize: 'LEGAL', title: 'Sale Report'},
                    {extend: 'print', footer: true, title: 'Sale Report'},
                ],
                "footerCallBack": function (row, data, start, end, display){
                    var api = this.api(), data;
                    /* remove the formatting to get integer data for summation */
                    var intVal = function ( i ){
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                            i : 0;
                    };
                    /* Total over all over */
                    quantityTotal = api
                        .column( 7 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    /* Quantity total */
                    unitPriceFilterTotal = api 
                        .column( 8, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    /* full total over all pages  */
                    fullPriceFilterTotal = api 
                        .column( 9 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    /* full total over current page */
                    fullPriceFilterTotal = api
                        .column( 9, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        } , 0 );
                    /* update footer column */
                    $( api.column( 7 ).footer() ).html(quantityFilterTotal + '('quantityTotal + 'total)');
                    $( api.column( 8 ).footer() ).html(unitPriceFilterTotal + '('unitPriceTotal + 'total)');
                    $( api.column( 9 ).footer() ).html(fullPriceFilterTotal + '('fullPriceTotal + 'total)');
                }
            });
        }
    });
}

function filterPurchaseReportTableCreator(startDate, endDate, scriptPath, tableDIV, tableID){
    var startDate = $('#' + startDate).val();
    var endDate = $('#' + endDate).val();

    $.ajax({
        url: scriptPath,
        method: 'POST',
        data: {
            startDate:startDate,
            endDate:endDate,
        },
        success: function(data){
            $('#' + tableDIV).empty();
            $('#' + tableDIV).html(data);
        },
        complete: function(){
            /* initiate datatable plugin once table is added to the DOM */
            $('#'+ tableID).DataTable({
                dom: 'lBfrtip',
                buttons: [
                    'copy',
                    {extend: 'csv', footer: true, title: 'Purchase Report'},
                    {extend: 'excel', footer: true, title: 'Purchase Report'},
                    {extend: 'pdf', footer: true, orientation: 'landscape', pageSize: 'LEGAL', title: 'Purchase Report'},
                    {extend: 'print', footer: true, title: 'Purchase Report'}
                ],
                "footerCallback": function (row, data, start, end, display){
                    var api = this.api(), data;
                    /* remove the formtting to get integer data for summation */
                    var intVal = function ( i ){
                        return typeof i === 'string' ?
                        i.replace(/[\$,]/g,'')*1 :
                        typeof i === 'number' ?
                           i : 0;
                    };
                    /* Quantity total over all pages */
                    quantityTotal = api
                        .column( 6 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        } , 0);
                    /* Quantity for current page */
                    quantityFilterTotal = api
                        .column( 6, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    /* Unit price total over all pages */
                    unitPriceTotal = api
                        .column( 7 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    /* Unit price for current page */
                    unitPriceFilterTotal = api 
                        .column( 7, { page: 'current' } )
                        .data()
                        .reduce ( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    /* full price total over all page */
                    fullPriceTotal = api
                        .column(8)
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    /* full price for current page */
                    fullPriceFilterTotal = api
                        .column( 8, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
                    /* update footer column */
                    $( api.column( 6 ).footer() ).html(quantityFilterTotal + '('+ quantityTotal + ' total)');
                    $( api.column( 7 ).footer() ).html(unitPriceFilterTotal + '('+ unitPriceTotal + ' total)');
                    $( api.column( 8 ).footer() ).html(fullPriceFilterTotal + '('+ fullPriceTotal + 'total)');
                }
            });
        }
    });
}

/* calculate total purchase value in purchase details tab */
function calculateTotalPurchase(){
    var purchQuantity = $('#purchaseQuantity').val();
    var purchUnitPrice = $('#purchaseUnitPrice').val();
    $('#purchaseTotal').val(Number(purchQuantity) * Number(unitPrice));
}

/* calculate total sale value in sale details */
function calculateTotalSale(){
    var saleQuantity = $('#saleQuantity').val();
    var saleUnitPrice = $('#saleUnitPrice').val();
    var saleDistcount = $('#saleDiscount').val();
    $('#saleTotal').val(Number(saleUnitPrice)* ((100 - Number(saleDiscount)) / 100) * Number(saleQuantity));
}

/* insertCustomer */
addItem(){
    var itemNumber = $('#itemNumber').val();
    var itemName = $('#itemName').val();
    var itemDiscount = $('#itemDiscount').val();
    var itemQuantity = $('#itemQuantity').val();
    var itemUnitPrice = $('#itemUnitPrice').val();
    var itemStatus = $('#itemStatus').val();
    var itemDescription = $('#itemDescription').val();

    $.ajax({
        url: 'model/item/insertItem.php',
        method: 'POST',
        data : {
            itemNumber:itemNumber,
            itemName:itemName,
            itemDiscount:itemDiscount,
            itemQuantity:itemQuantity,
            itemUnitPrice:itemUnitPrice,
            itemStatus:itemStatus,
            itemDescription:itemDescription,
        },
        success: function(data){
            $('#itemMessage').fadeIn();
            $('#itemMessage').html(data);
        },
        complate: function(){
            populateLastInsert(itemLastInsertFile,'itemProductID');
            getPopulateItemStock('itemNumber', getItemStockFile, itemTotalStock);
            searchTableCreator('itemSearchTable', itemSearchTableCreatorFile,'itemSearchTable');
            reportTableCreator('itemReportTable', itemReportTableCreatorFile,'itemReportTable');
        }
    });
}

function addCustomer(){
    var customerFullName = $('#customerFullName').val();
    var customerEmail = $('#custonerEmail').val();
    var customerMobile = $('#custoemrMobile').val();
    var customerPhone = $('customerPhone').val();
    var customerAddress = $('customerAddress').val();
    var customerAddress2 = $('customerAddress2').val();
    var customerCity = $('customerCity').val();
    var customerDistrict = $('#customerDistrict option:selected').text();
    var customerStatus = $('customerStatus option:selected').text();

    $.ajax({
        url: 'model/customer/insertCustomer.php',
        method: 'POST',
        data: {
            customerFullName:customerFullName,
            customerEmail:customerEmail,
            customerMobile:customerMobile,
            customerPhone:customerPhone,
            customerAddress:customerAddress,
            customerAddress2:customerAddress2,
            customerCity:customerCity,
            customerStatus:customerStatus,
            customerDistrict:customerDistrict,
        },
        success: function(data){
            $('#customerMessage').fadeIn();
            $('#customerMessage').html(data);
        },
        complete: function(data){
            populateLastInsert(customerLastInsertFile,'customerID');
            searchTableCreator('customerSearchTable', customerSearchTableCreatorFile,'customerSearchTable');
            reportTableCreator('customerReportTable', customerReportTableCreatorFile,'customerReportTable');
        }
    });
}

function addSale(){
    var saleItemNum = $('#saleItemNumber').val();
    var saleItemName = $('#saleItemName').val();
    var saleDiscount = $('#saleDiscount').val();
    var saleQuantity = $('#saleQuantity').val();
    var saleUnitPrice = $('$saleUnitPrice').val();
    var saleCustID = $('#saleCustID');
    var saleCustName = $('#saleCustName').val();
    var saleDate = $('#saleDate').val();

    $.ajax({
        url: 'model/sale/insertSale.php',
        method: 'POST',
        data : {
            saleItemNum:saleItemNum,
            saleItemName:saleItemName,
            saleDiscount:saleDiscount,
            saleQuantity:saleQuantity,
            saleUnitprice:saleUnitPrice,
            saleCustID:saleCustID,
            saleCustName:saleCustName,
            saleDate:saleDate
        },
        success: function(data){
            $('#saleMessage').fadeIn();
            $('#saleMessage').html(data);
        },
        complete : function(){
            getPopulateItemStock('saleItemNumber', getItemStockFile,'saleTotalStock');
            populateLastInsert(saleLastInsertFile,'saleID');
            searchTableCreator('saleSearchTableDiv', saleSearchTableCreatorFile,'saleSearchTable');
            reportSaleTableCreator('saleReportTableDiv', saleReportTableCreatorFile,'saleReportTable');
            searchTableCreator('itemSearchTableDiv', itemSearchTableCreatorFile,'itemSearchTable');
            reportTableCreator('itemReportTableDiv', itemReportTableCreatorFile,'itemReportTable');
        }
    });
}

function addPurchase(){
    var purchItemNumber = $('#purchaseItemNumber').val();
    var purchDate = $('#purchaseDate').val();
    var purchItemName = $('#purchaseItemName').val();
    var purchQuantity = $('#purchaseQuantity').val();
    var purchUnitPrice = $('#purchaseUnitPrice').val();
    var purchVendorName = $('#purchaseVendorName').val();

    $.ajax({
        url: 'model/purchase/inserPurchase.php',
        method: 'POST',
        data: {
            purchItemNumber:purchItemNumber,
            purchDate:purchDate,
            purchItemName:purchItemName,
            purchQuantity:purchQuantity,
            purchUnitPrice:purchUnitPrice,
            purchVendorName:purchVendorName,
        },
        success: function(data){
            $('#purchaseMessage').fadeIn();
            $('#purchaseMessage').html(data);
        },
        complete: function(){
            getPopulateItemStock('purchaseItemNumber', getItemStockFile,'purchaseCurrentStock');
            populateLastInsert(purchaseLastInsertFile,'purchaseID');
            searchTableCreator('purchaseSearchTableDiv', purchaseSearchTableCreatorFile,'purchaseSearchTable');
            reportPurchaseTableCreator('purchaseReportTableDiv', purchaseReportTableCreatorFile,'purchaseReportTable');
            searchTableCreator('itemSearchTableDiv', itemSearchTableCreatorFile,'itemSearchTable');
            reportTableCreator('itemReportTableDiv', itemReportTableCreatorFile,'itemReportTable');
        }
    });
}

function addVendor(){
    var venFullName = $('#vendorFullName').val();
    var venEmail = $('#vendorEmail').val();
    var venMobile = $('#vendorMobile').val();
    var venPhone = $('#vendorPhone').val();
    var venAddress = $('#vendorAddress').val();
    var venAddress2 = $('#vendorAddress2').val();
    var venCity = $('#vendorCity').val();
    var venDistrict = $('#vendorDistrict option:selected').text();
    var venStatus = $('#vendorStatus option:selected').text();

    $.ajax({
        url: 'model/vendor/inserVendor.php',
        method: 'POST',
        data: {
            venFullName:venFullName,
            venEmail:venEmail,
            venMobile:venMobile,
            venPhone:venPhone,
            venAddress:venAddress,
            venAddress2:venAddress2,
            venCity:venCity,
            venDistrict:venDistrict,
            venStatus:venStatus,
        },
        success: function(data){
            $('#vendorMessage').fadeIn();
            $('#vendorMessage').html(data);
        },
        complete: function(data){
            populateLastInsert(vendorLastInsertFile,'vendorID');
            searchTableCreator('vendorSearchTableDiv', vendorSearchTableCreatorFile,'vendorSearchTable');
            reportTableCreator('vendorReportTableDiv', vendorReportTableCreatorFile,'vendorReportTable');
            $('purchaseVendorName').load('model/vender/getVendorName.php');
        }
    });
}

/* get item object */
function getPopulateItemObject(){
    /* get itemNumber  */
    var itemNumber = $('#itemNumber').val();
    var defaultImgUrl = 'data/item_images/imageNotAbailable.jpg';
    var defaultImageData = '<img class="img-fluid" src="data/item_images/imageNotAvailable.jpg">';

    $.ajax({
        url : 'model/item/populateItem.php',
        method: 'POST',
        data: {itemNubmer:itemNumber},
        dataType: 'json',
        success: function(data){
            $('#itemProductID').val(data.productID);
            $('#itemName').val(data.itemName);
            $('#itemDiscount').val(data.discount);
            $('#itemTotalStock').val(data.stock);
            $('#itemUnitPrice').val(data.unitPrice);
            $('#itemDescription').val(data.description);
            $('#itemStatus').val(data.status).trigger("chosen:updated");

            newImgUrl = 'data/item_images/' + data.itemNumber + '/' + data.imgURL;
            if(data.imageURL == defaultImgUrl || data.imageURL == ''){
                $('#imageContaner').html(defaultImageData);
            } else {
                $('#imageContainer').html('<img class="img-fluid" src="' + newImgUrl + '">');
            }
        }
    });
}

/* get item object for sale */
function getItemObjectForSale(){
    var saleItemNumber = $('#saleItemNumber').val();
    var defaultImgUrl = 'data/item_images/imageNotAvailable.jpg';
    var defaultImageData = '<data class="img-fluid" src="data/item_images/imageNotAvailable.jpg';

    $.ajax({
        url: 'model/item/populateItemObject.php';
        data: 'POST',
        data: {saleItemNumber:saleItemNumber},
        dataType: 'json',
        success: function(data){
            $('#saleItemName').val(data.itemName);
            $('#saleDiscount').val(data.discount);
            $('#saleTotalStock').val(data.stock);
            $('#saleUnitPrice').val(data.unitPrice);

            newImgUrl = 'data/item_images' + data.itemNumber + '/' + data.imageURL;
            /* set item image */
            if(data.imageURL == defaultImgUrl || data.imageURL == ''){
                $('#saleImageContainer').html(defaultImageData);
            } else {
                $('#saleImageContainer').html('<img class="img-fluid" src="' + newImgUrl + '">');
            }            
        },
        complete: function(){
            calculateTotalSale();
        }
    });
}

/* get itemName */
function getItemName(itemNumberTextBox, scriptPath, itemNameTextBox){
    /* get itemNumber */
    var itemNumber = $('#' + itemNumberTextBox).val();
    $.ajax({
        url: scriptPath, /* getItemName.php */
        method: 'POST',
        data: {itemNumber:itemNumber},
        dataType: 'json',
        success: function(data){
            $('#' + itemNameTextBox).val(data.itemName);
        },
        error: function (xhr, ajaxOptions, throwError){

        }
    });
}

/* get last ID */
function populateLastInsert(scriptPath, textBoxID)
{
    $.ajax({
        url: scriptPath, /* populateLastID.php */
        method: 'POST',
        dataType: 'json',
        success: function (data){
            $('#' + textBoxID).val(data);
        }
    });
}

/* presentation */
function showPresentation(textBoxID, scriptPath, presentationID){
    var textBoxValue = $('#' + textBoxID).val();
    if(textBoxVal != ''){
        $.ajax({
            url: scriptPath,
            method: 'POST',
            data: {textBoxValue:textBoxValue},
            success: function(data){
                $('#' + presentationID).fadeIn();
                $('#' + presentationID).html(data);
            }
        });
    }
}

/* delete item  from db */
function deleteItem(){
    /* get item number */
    var itemNubmer = $('#itemNumber').val();

    if(itemNumber != ''){
        $.ajax({
            url: 'model/item/deleteItem.php',
            method: 'POST',
            data: {itemNumber:itemNumber},
            success: function(data){
                $('#itemMessage').fadeIn();
                $('#itemMessage').html(data);
            },
            complete: function(){
                searchTableCreator('itemSearchTableDiv', itemSearchTableCreatorFile,'itemSearchTable');
                reportTableCreator('itemReportTableDiv', itemReportTableCreatorFile,'itemReportTable');
            }
        });
    }
}

function deleteCustomer(){
    /* get CustomerID  */
    var customerID = $('#customerID').val();

    if(customerID != ''){
        $.ajax({
            url: 'model/customer/deleteCustomer.php',
            method: 'POST',
            data: {customerID:customerID},
            success: function(data){
                $('#customerMessage').fadeId();
                $('#customerMessage').html(data);
            },
            complete: function(){
                searchTableCreator('customerSearchTableDiv', customerSearchTableCreator,'customerSearchTable');
                reportTableCreator('vendorReportTableDiv', customerReportTableCreatorFile,'customerReportTable');
            }
        });
    }
}

function deleteVendor(){
    /* get vendorID */
    var vendorID = $('#vendorID').val();

    if(vendorID != ''){
        $.ajax({
            url: 'model/vendor/deleteVendor.php',
            method: 'POST',
            data: {vendorID:vendorID},
            success: function(data){
                $('#vendorMessage').fadeIn();
                $('#vendorMessage').html(data);
            },
            complete: function(){
                searchTableCreator('vendorSearchTableDiv', vendorSearchTableCreatorFile,'vendorSearchTable');
                reportTableCreator('vendorReportTableDiv', vendorReportTableCreatorFile,'vendorReportTable');
            }
        });
    }
}

/* get customer object */
function getPopulateCustomerObject(){
    /* get customerID */
    var customerID = $('#customerID').val();

    $.ajax({
        url: 'model/customer/populateCustomerObject.php',
        method: 'POST',
        data: {customerID:customerID},
        dataType: 'json',
        success: function(data){
            $('#customerFullName').val(data.fullname);
            $('#customerMobile').val(data.mobile);
            $('#customerPhone').val(data.phone);
            $('#customerEmail').val(data.email);
            $('#customerAddress').val(data.address);
            $('#customerAddress2').val(data.address2);
            $('#customerCity').val(data.city);
            $('#customerDistrict').val(data.district).trigger("chosen:updated");
            $('#customerStatus').val(data.status).trigger("chosen.updated");
        }
    });
}

function getCustomerObjectforSale(){
    /* get customerID  */
    var saleCustomerID = $('#saleCustomerID').val();

    $.ajax({
        url: 'model/customer/populateCustomerObject.php',
        method: 'POST',
        data: {customerID:customerID},
        dataType: 'json',
        success: function(data){
            $('#saleCustomerID').val(data.fullName);
        }
    });
}

/* get vendor object */
function getPopulateVendorObject(){
    /* get vendorID  */
    var vendorID = $('#vendorID').val();

    $.ajax({
        url: 'model/vendor/populateVendorObject.php',
        method: 'POST',
        data: {vendorID:vendorID},
        dataType: 'json',
        success: function(data){
            $('#vendorFullName').val(data.fullName);
            $('#vendorMobile').val(data.mobile);
            $('#vendorPhone').val(data.phone);
            $('#vendorAddress').val(data.address);
            $('#vendorAddress2').val(data.address2);
            $('#vendorCity').val(data.city);
            $('#vendorDistrict').val(data.district).trigger("chosen:updated");
            $('#vendorStatus').val(data.status).trigger("chosen:updated");
        }
    });
}

function getPopulatePurchaseObject(){
    /* get purchaseID */
    var purchaseID = $('#purchaseID').val();

    $.ajax({
        url: 'model/purchase/populatePurchaseObject.php',
        method: ' POST',
        data: {purchaseID:purhaseID},
        dataType: 'json',
        success: function(data){
            $('purchaseItemNumber').val(data.itemNumber);
            $('purcahseDate').val(data.purchaseDate);
            $('purchaseItemName').val(data.itemName);
            $('purcahseQuantity').val(data.quantity);
            $('#purchaseUnitPrice').val(data.unitPrice);
            $('#purchaseVendorName').val(data.vendorName).trigger("chosen:updated");
        },
        complete: function(){
            calculateTotalPurchase();
            getPopulateItemStock('purchaseItemNumber', getItemStockFile,'purchaseCurrentStock');
        }
    });
}

function getPopulateSaleObject(){
    /* get saleID */
    var saleID = $('#saleID').val();

    $.ajax({
        url: 'model/sale/populateSaleObject.php',
        method: 'POST',
        data: {saleID:saleID},
        dataType: 'json',
        success: function(data){
            $('#saleItemNumber').val(data.itemNumber);
            $('#saleCustomerID').val(data.customerID);
            $('#saleCustomerName').val(data.customerName);
            $('#saleItemName').val(data.itemName);
            $('#saleDate').val(data.saleDate);
            $('#saleDiscount').val(data.discount);
            $('#saleQuantity').vsl(data.quantity);
            $('#saleUnitPrice').val(data.UnitPrice);
        },
        complete: function(){
            calculateTotalSale();
            getPopulateItemStock('saleItemNumber', getItemStockFile,'saleTotalStock');
        }
    });
}

/* update  */
function updateItem(){
    var itemNumber = $('#itemNumber').val();
    var itemName = $('#itemName').val();
    var itemDiscount = $('#itemDiscount').val();
    var itemQuantity = $('#itemQuantity').val();
    var itemUnitPrice = $('#itemUnitPrice').val();
    var itemStatus = $('#itemStatus').val();
    var itemDescription = $('#itemDescription').val();

    $.ajax({
        url: 'model/item/updateItemObject.php',
        method: 'POST',
        data: {
            itemNumber:itemNumber,
            itemName:itemName,
            itemDiscount:itemDiscount,
            itemQuantity:itemQuantity,
            itemUnitPrice:itemUnitPrice,
            itemStatus:itemStatus,
            itemDescription:itemDescription,
        },
        success: function(data){
            var result = $.parseJSON(data);
            $('#itemMessage').fadeIn();
            $('#itemMessage').html(result.alertMessage);
            if(result.newStock != null){
                $('#itemTotalStock').val(result.newStock);
            }
        },
        complete: function(){
            searchTableCreator('itemSearchTableDiv', itemSearchTableCreatorFile,'itemSearchTable');
            searchTableCreator('purchaseSearchTableDiv', purchaseSearchTableCreatorFile,'purchaseSearchTable');
            searchTableCreator('saleSearchTableDiv', saleSearchTableCreatorFile,'saleSearchTable');
            reportTableCreator('itemReportTableDiv', itemReportTableCreatorFile,'itemSearchTable');
            reportPurchaseTableCreator('purchaseReportTableDiv', purchaseReportTableCreatorFile,'purchaseReportTable');
            reportSaleTableCreator('saleReportTableDiv', saleReportTableCreatorFile,'saleReportTable');
        }
    });
}

function updateCustomer(){
    var custID = $('#customerID').val();
    var custFullName = $('#customerFullName').val();
    var custMobile = $('#customerMobile').val();
    var custPhone = $('#customerPhone').val();
    var custAddress = $('#customerAddress').val();
    var custAddress2 = $('#customerAddress2').val();
    var custCity= $('customerCity').val();
    var custDistrict = $('#customerDistrict').val();
    var custStatus = $('#customerStatus option:selected').text();

    $.ajax({
        url: 'model/customer/updateCustomerObject.php',
        method: 'POST',
        data: {
            custID:custID,
            custFullName:custFullName,
            custMobile:custMobile,
            custPhone:custPhone,
            custAddress:custAddress,
            custAddress2:custAddress2,
            custCity:custCity,
            custDistrict:custDistrict,
            custStatus:custStatus,
        },
        success: function(data){
            $('#customerMessage').fadeIn();
            $('#customerMessage').html(data);
        },
        complete: function(){
            searchTableCreator('customerSearchTableDiv', customerSearchTableCreatorFile,'customerSearchTable');
            reportTableCreator('customerReportTableDiv', customerReportTableCreatorFile,'customerReportTable');
            searchTableCreator('saleSearchTableDiv', saleSearchTableCreatorFile,'saleSearchTable');
            reportSaleTableCreator('saleReportTableDiv', saleReportTableCreatorFile,'saleReportTable');
        }
    })
}

function updateSale(){
    var saleItemNumber = $('#saleItemNumber').val();
    var saleDate = $('#saleDate').val();
    var saleItemName = $('#saleItemName').val();
    var saleQuantity = $('#saleQuantity').val();
    var saleUnitPrice = $('#saleUnitPrice').val();
    var saleDiscount = $('#saleDistcount').val();
    var saleID = $('#saleID').val();
    var saleCustomerID = $('#saleCustomerID').val();
    var saleCustomerName = $('#saleCustomerName').val();

    $.ajax({
        url: 'model/sale/updateSale.php',
        method: 'POST',
        data: {
            saleItemNumber:saleItemNumber,
            saleDate:saleDate,
            saleItemName:saleItemName,
            saleQuantity:saleQuantity,
            saleUnitPrice:saleUnitPrice,
            saleDiscount:saleDiscount,
            saleID:saleID,
            saleCustomerID:saleCustomerID,
            saleCustomerName:saleCustomerName,
        }, 
        success: function(data){
            $('#saleMessage').fadeIn();
            $('#saleMessage').htm(data);
        },
        complete: function(){
            getPopulateItemStock('saleItemNumber', getItemStockFile,'saleTotalStock');
            searchTableCreator('saleSearchTableDiv', saleSearchTableCreatorFile,'saleSearchTable');
            reportSaletableCreator('saleReportTableDiv', saleReportTableCreatorFile,'SaleReportTable');
            searchTableCreator('itemSearchTableDiv', itemSearchTableCreatorFile,'itemSearchTable');
            reportTableCreator('itemReportTablediv', itemReportTableCreatorFile,'itemReportTable');
        }
    });
}

function updatePurchase(){
    var purchItemNumber = $('#purchaseItemNumber').val();
    var purchDate = $('#purchaseDate').val();
    var purchItemName = $('#purchaseItemName').val();
    var purchQuantity = $('#purchaseQuantity').val();
    var purchUnitPrice = $('#purchaseUnitPrice').val();
    var purchID = $('#purchaseID').val();
    var purchVendorName = $('#purchaseVendorName').val();

    $.ajax({
        url: 'model/purchase/updatePurchase.php',
        method: 'POST',
        data: {
            purchItemNumber:purchItemNumber,
            purchDate:purchDate,
            purchItemName:purchItemName,
            purchQuantity:purchQuantity,
            purchUnitPrice:purchUnitPrice,
            purchID:purchID,
            purchVendorName:purchVendorName,
        },
        success: function(data){
            $('#purchaseMessage').fadeIn();
            $('#purchaseMessage').html(data);
        },
        complete: function(){
            getPopulateItemNumber('purchItemNumber', getItemStockFile,'purchaseCurrentStock');
            searchTableCreator('purchSearchTableDiv', purchaseSearchTableCreatorFile,'purchaseSearchTable');
            reportPurchaseTableCreator('purchaseReportTableDiv', purchaseReportTableCreatorFile,'purchaseReportTable');
            searchTableCreator('itemSearchTableDiv', itemSearchTableCreatorFile,'itemSearchTable');
            reportTableCreator('itemReportTableDiv', itemReportTableCreatorFile,'itemReportTable');
        }
    });
}

function updateVendor(){
    var venID = $('#vandorID').val();
    var venFullName = $('#vendorFullName').val();
    var venMobile = $('#vendorMobile').val();
    var venPhone = $('#vendorPhone').val();
    var venEmail = $('#vendorEmail').val();
    var venAddress = $('#vendorAddress').val();
    var venAddress2 = $('#vendorAddress2').val();
    var venCity = $('#vendorCity').val();
    var venDistrict = $('#vendorDistrict').val();
    var venStatus = $('#vendorStatus').val();

    $.ajax({
        url: 'model/update/vendorObject.php',
        method: 'POST',
        data: {
                venID:venID,
                venFullName:venFullName,
                venMobile:venMobile,
                venPhone:venPhone,
                venEmail:venEmail,
                venAddress:venAddress,
                venAddress2:venAddress2,
                venCity:venCity,
                venDistrict:venDistrict,
                venStatus:venStatus,
            },        
        success: function(data){
            $('#vendorMessage').fadeIn();
            $('#vendorMessage').html(data);
        },
        complete: function(){
            searchTableCreator('purchaseSearchTableDiv', purchaseSearchTableCreatorFile,'purchaseSearchTable');
            searchTableCreator('vendorSearchTableDiv', vendorSearchTableCreatorFile,'purchaseReportTable');
            reportPurchaseTableCreator('purchaseReportTableDiv', purchaseReportTableCreatorFile,'purchaseReportTable');
            reportTableCreator('vendorReportTableDiv', purchaseReportTableCreatorFile,'purchaseReportTable');
        }
    });
}
