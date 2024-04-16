// File that creates the purchase details search table
purchaseSearchTableCreatorFile = 'model/purchase/purchaseSearchTableCreator.php';


// File that creates the customer details search table
customerSearchTableCreatorFile = 'model/customer/customerSearchTableCreator.php';

// File that creates the item details search table
itemSearchTableCreatorFile = 'model/item/itemSearchTableCreator.php';

// File that creates the vendor details search table
vendorSearchtableCreatorFile = 'model/vendor/vendorSearchTableCreator.php';

// File that creates the sale details search table
saleSearchTableCreatorFile = 'model/sale/saleSearachTableCreator.php';


// File that creates the purchase reports search table
purchaseReportTableCreatorFile = 'model/purchase/purchaseReportTableCreator.php';

// File that creates the customer reports search table
customerReportTableCreatorFile = 'model/customer/customerReportTableCreator.php';

// File that creates the item reports search table
itemReportTableCreatorFile = 'model/item/itemReportTableCreator.php';

// File that creates the vendor reports search table
vendorReportTableCreatorFile = 'model/vendor/vendorReportTableCreator.php';

// File that creates the sale reports search table
saleReportTableCreatorFile = 'model/sale/saleReportTableCreator.php';


// File that returns the last inserted vendorID
vendorLastInsertedFile = 'model/vendor/popLastVendor.php';


// File that returns the last inserted customerID
customerLastInsertedFile = 'model/customer/popLastCustomer.php';

// File that returns the last inserted purchaseID
purchaseLastInsertedFile = 'model/purchase/popLastPurchase.php';

// File that returns the last inserted saleID
saleLastInsertedFile = 'model/sale/popLastSale.php';

// File that returns the last inserted productID for item details tab
itemLastInsertedFile = 'model/item/popLastProduct.php';


// File that returns purchaseIDs
showPurchaseIDAdviseFile = 'model/purchase/showPurchaseID.php';

// File that returns saleIDs
showSaleIDAdviseFile = 'model/sale/showSaleID.php';

// File that returns vendorIDs
showVendorIDAdviseFile = 'model/vendor/showVendorID.php';

// File that returns customerIDs
showCustomerIDAdviseFile = 'model/customer/showCustomerID.php';

// File that returns customerIDs for sale tab
showCustomerIDAdviseSaleFile = 'model/customer/showCustomerIDAdviseSale.php';



// File that returns itemNumbers
showItemNumberSuggestionsFile = 'model/item/showItemNumber.php';

// File that returns itemNumbers in image tab
showItemNumberSuggestionsForImageTabFile = 'model/item/showItemNumberForImageTab.php';

// File that returns itemNumbers for purchase tab
showItemNumberForPurchaseTabFile = 'model/item/showItemNumberForPurchaseTab.php';

// File that returns itemNumbers for sale tab
showItemNumberForSaleTabFile = 'model/item/showItemNumberForSaleTab.php';

// File that returns itemNames
showItemNamesFile = 'model/item/showItemNames.php';



// File that returns stock 
getItemStockFile = 'model/item/getItemNumber.php';

// File that returns item name
getItemNameFile = 'model/item/getItemName.php';

// File that updates an image
updateImageFile = 'model/image/updateImage.php';

// File that deletes an image
deleteImageFile = 'model/image/deleteImage.php';



// File that creates the filtered purchase report table
purchaseFilteredReportCreatorFile = 'model/purchase/purchaseFilteredReportTableCreator.php';

// File that creates the filtered sale report table
saleFilteredReportCreatorFile = 'model/sale/saleFilteredReportTableCreator.php';

$(document).ready(function(){
	$('.chosenSelect').chosen({width: "95%"});

	$('.invTooltip').tooltip();

	$('#addCustomer').on('click', function(){
		addCustomer();
	});

	$('#addItem').on('click', function(){
		addItem();
	});

	$('#addItem').on('click', function(){
		addItem();
	});

	$('#addPurchase').on('click', function(){
		addPurchase();
	});

	$('addSale').on('click', funcion(){
		addSale();
	});

	$('updateCustomer').on('click', function(){
		updateCustomer();
	});

	$('updateVender').on('click',function(){
		updatePurchase();
	});

	$('#updateSale').on('click', funcion(){
		updateSale();
	});

	$('$deleteItem').on('click', function(){
		bootbox.confirm('Are you sure you want to delete?', function(result){
			if(result){
				deleteItem();
			}
		});
	});

	$('#deleteCustomer').on('click',function(){
		bootbox.confirm('Are you sure you want to delete?', function(result){
			if(result){
				deleteCustomer();
			}
		});
	});

	$('#itemNumber').keyup(function(){
		showAdvise('itemName', showItemNameFile,'itemNameAdviseDiv');
	});

	$(document).on('click', '#itemNameAdviseList li', function(){
		$('#itemName').val($(this).text());
		$('#itemNameAdviseList').fadeOut();
	});

	$('#itemNumber').keyup(function(){
		showAdvise('itemNumber', showItemNumberAdviseFile,' itemNumberAdviseDiv');
	});

	$(document).on('click','#itemNumberAdviseList li', function(){
		$('#itemNumber').val($(this).text());
		$('#itemNumberAdviseList').fadeOut();
		getPopulateItem();
	});

	$('#saleItemNumber').keyup(function(){
		showAdvise('saleItemNumber', showItemNumberForSaleFile,'saleItemNumberAdviseDiv');
	});

	$(ducument).on('click', '#saleItemNumberAdvise li', function(){
		$('#saleItemNumber').val($(this).text());
		$('#saleItemNumberAdviseList').fadeOut();
		getPopulateItemForSale();
	});
	
	($'#itemImageNumber').keyup(function(){
		showAdvise('itemImageNumber', showItemNumberAdviseImageFile,'itemImageNumberAdviseDiv');
	});
	
	$(document).on('click','#imageImageNumberAdviseList li', function(){
		$('#itemImageItemNumber').val($this(this).text());
		$('#itemImageItemNumberAdviseList').fadeout();
		getItemName('itemImageNumber', getItemName,'itemImageItemName');
	});
	
	$('#itemClear').on('click', function(){
		$('#imagecontainer').empty();
	});

	$('#saleClear').on('click', function(){
		$('saleImageContainer').empty();
	});

	$('#purchaseFilterClear').on('click',function(){
		reportPurchaseTableCreator('purchaseReportTableDiv', purchaseReportSearchTableCreatorFile,'purchaseReportTable');
	});

	$('saleFilterClear').on('click', function(){
		reportSaleTableCreator('saleReportTableDiv', saleReportSearchTableCreatorFile,'saleReportTable');
	});

	$('#purchaseItemNumber').keyup(function(){
		showAdvise('purchaseItemNumber', showItemNumberForPurchaseFile,'purchaseItemNumberAdviseDiv');
	});

	$(document).on('click', '#purchaseItemNumberAdvise li', function(){
		$('#purchaseItemNumber').val($(this).text());
		$('#purchaseItemNubmerAdviseList').fadeOut();
		getPopulateItemStock('purchaseItember', showCustomerIDAdviseFile,'customerIDAdviseDiv');
	});

	$(document).on('click','#customerIDAdviseList LI', function(){
		$('#customerID').val($(this).text());
		$('#customerIDAdviseList').fadeOut()
		getPopulateCustomer();
	});

	$(#saleCustomerID).keyup(function(){
		showAdvise('saleCustomerID', showCustomerIDAdviseSaleFile,'saleCustomerIDAdviseDiv');
	});

	$(document).on('click','saleCustomerIDAdviseList li', function(){
		$('#saleCustoner').val($(this).text());
		$('saleCustomerIDAdviseList').fadeOut();
		getPopulateCustomerForSale();
	});

	$('#vendorID').keyup(function(){
		showAdvise('vendorID', showVendorIDAdviseFile,'vendorIDAdviseDiv');
	});

	$(document).on('click', '$vendorIDAdviseList li', function(){
		$('#vendorID').val($(this).text());
		$('#vendorIDAdviseList').fadeOut();
		getPopulateVendor();
	});

	$('#purchaseID').keyup(function(){
		showAdvise('purchaseID', showPurchaseIDAdviseFile,'purchaseIDAdviseDiv');
	});

	$(document).on('click','#purchaseIDAdviseList li', function(){
		$('#purchaseID').val($(this).text());
		$('#purchaseIDAdviseList').fadeOut();
		getPopulatePurchase();
	});

	$('#saleID').keyup(function() {
		showAdvise('saleID,' showSaleIDAdviseFile,'saleIDAdviseDiv');
	});

	$(document).on('click', '#saleIDAdviseList li', function(){
		$('#saleID').val($(this).text());
		$('#saleIDAdviseList').fadeOut();
		getPopulateSale();
	});

	$('#updateImage').on('click', function(){
		processImage('imageForm', updateImageFile,'itemImageMessaage');
	});

	$('#deleteImage').on('click', function(){
		processImage('imageForm', deleteImageFile,'itemImageMessage');
	});

	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd',
		todayHightlight: true,
		todayBtn: 'linked',
		oreintation: 'bottom left'
	});

	$('#purchaseQuantity, #purchaseUnitPrice').change(function(){
		calculateTotalPurchase();
	});

	$('#saleDiscount, #saleQuantity, #saleUnitPrice').change(function(){
		calculateTotalSale();
	});

	$(document).on('click', function(){
		$('.adviseList').fadeOut();
	});

	searchTableCreator('itemtablediv', itemSearchTableCreatorFile,'itemSearchTable');
	searchTableCreator('purchaseTableDiv', purchaseSearchTableCreatorFile,'purchasseSearchTable');
	searchTableCreator('customerTableDiv', customerSearchTableCreatorFile,'customerSearchTable');
	searchTableCreator('saleTableDiv', saleReportTableCreatorFile,'SaleReportTable');
	reportTableCreator('vendorReportTableDiv', vendorReportTableCreatorFile,'vendorReportTable');

	$(document).on('mouseover','itemHover', function(){
		//create item details popover boxes
		$('.itemHoover').popover({
			container: 'body',
			title: 'Item Details',
			trigger: 'hover',
			html : true,
			placement: 'right',
			content: fetchdata
		});
	});

	// list to refresh buttons
	$('#saleFilterClear').on('click'function(){
		reportSaleTablecreator('saleReportTableDiv', saleReportTableCreatorFile,'saleReportTable');
	});

	$('#purchaseItemNumber').keyup(function(){
		showAdvise('purchaseItemNumber', showItemNumberPurchaseFile,'purchaseItemNumberAdviseDiv');
	});

	$(document).on('click','pruchaseItemNumberAdviseList li', function(){
		$('#purchaseItemNumber').val($(this).text());
		$('#purchaseItemNumberAdviseList').fadeOut();

		//display the item name for the saleted item number
		getItemName('purchaseItemNumber', getItemNameFile,' purchaseItemNumber');

		//display the current stoct for the selected item number
		getPopulateItemStock('purchaseItemNumber', getItemStockFile,'purchaseCurrentStock');
	});

	//listen to customer text box in customer details tab
	$('#customerID').keyup(function(){
		showAdvvise('customerID', showCustomerIDAdviseFile,'customerIDAdviseDiv');		
	});

	$(document).on('click','$customerIDAdviseList li', function(){
		$('#customerID').val($(this).text());
		$('#customerIDAdviseList').fadeOut();
		getPopulateCustomer();
	});

	$('#vendorID').keyup(function(){
		showAdvise('vendorID', showVendorIDAdviseFile,'vendorIDAdviseDiv');
	});

	$(document).on('click','#vendorIDAdviseList li', function(){
		$('#vendorID').val($(this).text());
		$('#vendIDAdviseList').fadeOut();
		getPopulateVendor();
	});

	$('#purchaseID').keyup(function(){
		showAdvise('purchaseID', showPurchaseIDAdviseFile,'purchaseIDAdviseDiv');
	});

	$(document).on('click', '#purchaseIDAdviseList li', function(){
		$('#purchaseID').val($(this).text());
		$('#purchaseIDAdviseList').fadeOut();
		getPopulatePurchase();
	});

	$('#saleID').keyup(function(){
		showAdvise('saleID','showSaleIDAdviseFile', 'saleIDAdviseDiv');
	});

	$(document).on('click','saleIDAdviseList lis', function(){
		$('#saleID').VAL($(this).text());
		$('#saleIDAdviseList').fadeOut();
		getPopulateSale();
	});

	$('#updateImage').on('click', function(){
		processImage('imageForm', updateImageFile,'itemImageMessage');;
	});
	//list to image delete button
	$('#deleteImage').on('click', function(){
		processinImage('ImageForm', deleteImageFile,'itemImageMessage');
	});

	//initiate datepickers
	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd',
		todayHiglight: true,
		todayBtn: 'linked',
		orientation: 'bottm left',
	});

	//calculate total in sale tab
	$('#saleDiscount, #saleQuantity, #saleUnitPrice').change(function(){
		calculateTotalSale();
	});

	//close any suggestions lists from the page when the user clicker on the page
	$(document).on('click', function(){
		$('.adviseList').fadeOut();
	});

	//load searchable datatables for customer, purchase, item, vendor, sale
	searchTableCreator('itemSearchTableDiv', itemSearchTableCreatorFile,' itemSearchTable');
	searchTableCreator('purchaseSearchTableDiv', purchaseSearchTableCreatorFile,'pruchaseSearchTable');
	searchTableCreator('customerSearchTableDiv', customerSearchTableCreatorFile,'custoemrSearchTable');
	searchTableCreator('saleSearchTableDiv', saleSearchTableCreatorFile,'saleSearchTable');
	searchTableCreator('vendorSearchTableDiv', vendorSearchTableCreatorFile,'vendorSearchTable');

	//load search datatable for customer purchase, item, vendor, sale, reports
	reportTableCreator('itemReportTableDiv', itemReportTableCreatorFile,'itemReportTable');
	reportPurchaseTableCreator('purchaseReportTableDiv',purchaseReportTableCreatorFile,'purchaseReportTable');
	reportTableCreator('customerReportTableDiv', customerReportTableCreatorFile,'customerReportTable');
	reportSaleTablCreator('saleReportTableDiv', saleReportTableCreatorFile,'saleReportTable');
	reportTableCreator('vendorReportTableDiv', vendorReportTableCreatorFile,'vendorReportTable');

	//initiate popover
	$(document).on('mouseiover','.itemHover', function(){
		//create item details popover boxes
		$('.itemHover').popover({
			container: 'body',
			title: 'Item Details',
			trigger: 'hover',
			html: true,
			placement: 'right',
			content: fetchData
		});
	});
	//list to refresh buttons
	$('#searchTableRefresh, #reportTableRefresh').on('click', function(){
		searchTableCreator('itemSearchTableDiv', itemSearchTableCreatorFile,'itemSearchTable');
		searchTableCreator('purchaseSearchTableDiv', purchaseSearchTableCreatorFile,'purchaseSearchTable');
		searchTableCreator('customerSearchTableDiv', customerSearchTableCreatorFile,'custonerSearchTable');
		searchTableCreator('vendorSearchTableDiv', vendorSearchTableCreatorFile,'vendorSearchTable');
		searchTableCreator('saleSearchTableDiv', saleSearchTableCreatorFile,'saleSearchTable');

		reportTableCreator('itemReportTableDiv', itemReportTableCreatorFile,'itemReportTable');
		reportPurchaseTableCreator('purchaseReportTableDiv', purchaseReportTableFile,'purchaseReportTable');
		reportTableCreator('customerReportTableDiv', customerReportTableCreatorFile,'customerReportTable');
		reportTableCreator('vendorReportTableDiv', vendorReportTabeCreatorFile,'vendorReportTable');
		reportSaleTableCreator('saleRepotTableDiv', saleReportTableCreatorFile,'saleReportTable');
	});

	//list to purchase report show button
	$('#showPurchaseReport').on('click', function(){
		filterPurchaseReportTableCreator('purchaseReportStartDate', 'purchaseReportEndDate', purchaseFilterdReportCreatorFile,'purchaseReportTableDiv','purchaseFilteredReportTable');	
	});
	//listen to sale report show button
	$('#showSaleReport').on('click', function(){
		filteredSaleReportTableCreator('saleReportStartDate','saleReportEndDate', saleFilteredReportFile,'saleReportTableDiv','saleFilteredReportTable');
	});
});

//function to fetch data to show in popovers
function fetchDate()
{
	var fetch_data = '';
	var element = $(this);
	var id = element.attr('id');

	$.ajax({
		url: 'model/item/getPopoverItem.php',
		method: 'POST',
		async: false,
		data: {id:id},
		success: function(data)
		{
			fetch_data = data;
		}
	});
	return fetch_data;
}

//function to call the scriot that process imageURL in DB
function processImage(imageFormID, scritPath, messageDivID){
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

//function to create searchable datatables for customer, item, purchase, sale

function searchTableCreator(tableContainerDiv, tableCreatorFileUrl, table)
{
	var tablecontainerDivID ='#' + tableContainerDiv;
	var tableID = '#' + table;
	$(tableContainerDivID).load(tableCreatorFileUrl, function(){
		//intiate the datatable plugin once the table os added to the DOM
		$(tableID).DataTable();
	});
}

//function to create reports datatables for customer, item, purchase, sale
function reportTablecreator(tableContainerDiv, tableCreatorFileUrl,table){
	var tableContainerDivID = '#' + tableContainerDiv;
	var tableID = '#' + table;
	$(tableContainerDivID).load(tableCreatorFileUrl, function(){
		//initiate the datatable plugin once tehe table is added to the DOM
		$(tableID).DataTable({
			dom: 'lBfrtip',
			buttons :[
				'copy',
				'csv',
				{extend: 'pdf', orientation: 'landscape', pageSize : 'LEGAL'},
				'print'
			]
		});
	});
}

//function to create report datatable for purchase 
function reportPurchaseTableCreator(tableContainerDiv, tableCreatorFileUrl,table){
	var tableContainerDivID = '#' + tableContainerDiv;
	var tableID = '#' + table;
	$(tableContainerDivID).load(ableCreatorFileUrl, function(){
		//initiate the datatable plugin once the table is added to teh DOM
		$(tableID).DataTable({
			dom: 'lBfrtip',
			buttons: [
				'copy',
				{extend: 'csv', footer: true, title: 'Purchase Report'},
				{extend: 'excel', footer: true, title: 'Purchase Reprot'},
				{extend: 'pdf', footer: true, orientation: 'landscape', pageSize: 'LEGAL', title: 'Purchase Report'},
				{extend: 'print', footer:true, title: 'Purchase Report'},
			],
			"footerCallback": function (roow, data, start, end, display){
				var api =  this.api(), data;
				//remove the formatting to get integer data for summation
				var intVal = function ( i) {
					return typeof i === 'string' ?
					i.replace(/[\$,]/g, '')*1:
					typeof i === 'number' ?
					i : 0;
				};
				//Quantity total over all pages
				quantityTotal = api
					.column( 6 ) 
					.data()
					.reduce( function (a, b){
						return intVal(a) + intVal(b);
					}, 0);
				// Quantity for current page
				quantityFilteredTotal = api
					.column(6, { page: 'current'} )	
					.data()
					.reduce ( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0)
				// quantity for current page
				quantityFilteredTotal = api
					.column( 6, { page: 'current'} )
					.data()
					.reduce( function (a ,b){
						return intVal(a) + intVal(b);
					}, 0);
				// Unit price total over all page
				unitPriceTotal = api	
					.column( 7 )
					.data()
					.reduce( function(a, b){
						return intVal(a) + intVal(b);
					}, 0);
				//Unit price for current page
				unitPriceFilteredTotal = api
					.column( 7, { page: 'current'} )
					.data()
					.reduce( function(a, b){
						return intVal(a) + intVal(b);
					}, 0);
				//full price total over all pages
				fullPriceTotal = api
				    .column( 8 )
					.data()
					.reduce( function (a, b){
						reuturn intVal(a) + intVal(b);
					}, 0);
				//full price for current page
				fullPriceFilteredTotal = api
					.column( 8, { page: 'current'} )
					.data()
					.reduce( function(a, b){
						return intVal(a) +  intVal(b);
					}, 0);
				//Update footer columns
				$( api.column( 6 ).footer() ).html(quantityFilteredTotal + ' ('+ quantityTotal +' total)');
				$( api.column( 7 ).footer() ).html(unitPriceFilteredTotal + ' ('+ unitPriceTotal +' total)');
				$( api.column( 8 ).footer() ).html(fullPriceFilteredTotal + ' ('+ fullPriceTotal +' total)');
			}
		});
	});
}

/* function to create report database for sale */
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
				{extend: 'excel', footer: true, title: 'Sale Report'},
				{extend: 'pdf', footer: true, orientation: 'landscape', pageSize: 'LEGAL', title: 'Sale Report'},
			],
			"footerCallback": function(row, data, start, end, display){
				var api = this.api(), data;
				/* remove the formatting to get integer data for summation */
				var intVal = function ( i ){
					return typeof i === 'string' ?
					i.replace(/[\$,]/g, '')*1 :
					typeof i === 'number' ?
					    i : 0;
				};
				/* Quantity Total over all page */
				quantitytotal = api
					.column( 7 )
					.data()
					.reduce ( function (a, b){
						return intVal(a) + intVal(b);
					}, 0 );
				//Quantity Total over this page
				quantityFilteredTotal = api
					.column( 7, { page: 'current'} )
					.data()
					.reduce( function (a, b){
						return intVal(a) + intVal(b);
					}, 0 );
				/* Unit price total over all apges */
				unitPriceTotal = api
					.column( 8 )
					.data()
					.reduce( function (a, b){
						return intVal(a) + intVal(b);
					}, 0 );
				/* Unit price total over current page */
				unitPriceFilteredTotal = api
					.column( 8, { page: 'current'} )
					.data()
					.reduce( function (a, b){
						return intVal(a) + intVal(b);
					}, 0);
				/* Full price Total over all pages */
				fullPricetotal = api
					.column( 9 )
					.data()
					.reduce( function (a, b){
						return intVal(a) + intVal(b);
					} , 0);
				/* Update footer columns */
				$( api.column( 7 ).footer() ).html(quantityFilteredToal + '(' + quantityTotal + ' total)');
				$( api.column( 8 ).footer() ).html(unitPriceFilteredToal + '(' + unitPriceTotal + ' total)');
				$( api.column( 9 ).footer() ).html(fullPriceFilteredToal + '(' + fullPriceTotal + ' total)');
			}
		});
	});
}

/* function to create filtered datatable for sale details with total values */
function filteredSaleReportTableCreator(startDate, endDate, scriptPath, tableDIV, tableID)
{
	var startDate = $('#' + startDate).val();
	var endDate = $('#', endDate).val();
	$.ajax({
		url: scriptPath,
		method: 'POST',
		data: {
			startDate: startDate,
			endDate: endDate,
		},
		complete: function(){
			/* intiate the datatable plugin once the table is added to the DOM */
			$('#' + tableID).DataTable({
				dom:'lbfrtip',
				buttons: [
					'copy',
					{extend: 'csv', footer: true, title: 'Sale Report'},
					{extend: 'excel', footer: true, title: 'Sale Report'},
					{extend: 'pdf', footer: true, orientation: 'landscape', pageSize: 'LEGAL', title: 'Sale Report'},
					{extend: 'print', footer: true, title: 'Sale report'},
				],
				"footerCallback": function ( row, data, start, end, display){
					var api= this.api, data;
					/* remove the formatting to get integer data */
					var intVal = function ( i ){
						return typeof i === 'string' ?
						i.replace(/[\$,]/g,'')*1:
						typeof i === 'number' ?
							i : 0;
					};
					/* Total over all page */
					quantityTotal = api
					    .column( 7 )
						.data()
						.reduce ( function (a, b){
							return intVal(a) + intVal(b);
						}, 0 );
					/* total over this page */
					quantityFilteredtotal = api
						.column ( 7, { page: 'current'} )
						.data()
						.reduce( function(a, b) {
							return intVal(a) + intVal(b);
						},0 );
					/* total over all page */
					unitPriceTotal = api
						.column( 8 )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0);
					/* quantity total */
					unitPriceFilterTotal = api
						.column( 8 )
						.data()
						.reduce( function (a, b){
							return intVal(a) + intVal(b);
						}, 0 );
					/* quantity  total*/
					unitPriceFilterTotal = api
						.column( 8, { page: 'current'} )
						.data()
						.reduce( function (a, b){
							return intVal(a) + intVal(b);
						}, 0 );
					/* full total over all pages */
					fullPriceTotal = api
						.column( 9 )
						.data()
						.reduce( function(a, b){
							return intVal(a) + intVal(b);
						}, 0 );
					// update footer columns
					$( api.column( 7 ).footer() ).html(quantityFilteredTotal + ' (' + quantityTotal + ' total)');
					$( api.column( 8 ).footer() ).html(unitPriceFilteredTotal + ' (' + unitPriceTotal + ' total)');
					$( api.column( 7 ).footer() ).html(fullPriceFilteredTotal + ' (' + fullPriceTotal + ' total)');
				}
			});
		}
	});
}

// Function to create filtered datatable for purchase details with total values
function filteredPurchaseReportTableCreator(startDate, endDate, scriptPath, tableDIV, tableID){
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
			// Initiate the Datatable plugin once the table is added to the DOM
			$('#' + tableID).DataTable({
				dom: 'lBfrtip',
				buttons: [
					'copy',
					{extend: 'csv', footer: true, title: 'Purchase Report'},
					{extend: 'excel', footer: true, title: 'Purchase Report'},
					{extend: 'pdf', footer: true, orientation: 'landscape', pageSize: 'LEGAL', title: 'Purchase Report'},
					{extend: 'print', footer: true, title: 'Purchase Report'}
				],
				"footerCallback": function ( row, data, start, end, display ) {
					var api = this.api(), data;
		 
					// Remove the formatting to get integer data for summation
					var intVal = function ( i ) {
						return typeof i === 'string' ?
							i.replace(/[\$,]/g, '')*1 :
							typeof i === 'number' ?
								i : 0;
					};
		 
					// Quantity total over all pages
					quantityTotal = api
						.column( 6 )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
		 
					// Quantity for current page
					quantityFilteredTotal = api
						.column( 6, { page: 'current'} )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
					
					// Unit price total over all pages
					unitPriceTotal = api
						.column( 7 )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
					
					// Unit price for current page
					unitPriceFilteredTotal = api
						.column( 7, { page: 'current'} )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
					
					// Full price total over all pages
					fullPriceTotal = api
						.column( 8 )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
					
					// Full price for current page
					fullPriceFilteredTotal = api
						.column( 8, { page: 'current'} )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
		 
					// Update footer columns
					$( api.column( 6 ).footer() ).html(quantityFilteredTotal +' ('+ quantityTotal +' total)');
					$( api.column( 7 ).footer() ).html(unitPriceFilteredTotal +' ('+ unitPriceTotal +' total)');
					$( api.column( 8 ).footer() ).html(fullPriceFilteredTotal +' ('+ fullPriceTotal +' total)');
				}
			});
		}
	});
}

// Calculate Total Purchase value in purchase details tab
function calculateTotalPurchase(){
	var purchQuantity = $('#purchaseQuantity').val();
	var purchUnitPrice = $('#purchaseUnitPrice').val();
	$('#purchaseTotal').val(Number(purchQuantity) * Number(purchUnitPrice));
}


// Calculate Total sale value in sale details tab
function calculateTotalSale(){
	var saleQuantity = $('#saleQuantity').val();
	var saleUnitPrice = $('#saleUnitPrice').val();
	var saleDiscount = $('#saleDiscount').val();
	$('#saleTotal').val(Number(saleUnitPrice) * ((100 - Number(saleDiscount)) / 100) * Number(saleQuantity));
}


// Function to call the insertCustomer.php script to insert customer data to db
function addCustomer() {
	var customerFullName = $('#customerFullName').val();
	var customerEmail = $('#customerEmail').val();
	var customerMobile = $('#customerMobile').val();
	var customerPhone = $('#customerPhone').val();
	var customerAddress = $('#customerAddress').val();
	var customerAddress2 = $('#customerAddress2').val();
	var customerCity = $('#custotmerCity').val();
	var customerDistrict = $('#customerDistrict option:selected').text();
	var customerStatus = $('#customerStatus option:selected').text();
	
	$.ajax({
		url: 'model/customer/insertCustomer.php',
		method: 'POST',
		data: {
			customerFullName:customerFullName,
			customerEmail:customerEmail,
			customerMobile:cusomertMobile,
			customerPhone:customerPhone,
			customerAddress:customerAddress,
			customerAddress2:customerAddress2,
			customerCity:customerCity,
			custoemrDistrict:customerDistrict,
			custoemrStatus:customerStatus,
		},
		success: function(data){
			$('#customerMessage').fadeIn();
			$('#customerMessage').html(data);
		},
		complete: function(data){
			populateLastInserted(customerLastInsertedFile, 'customerID');
			searchTableCreator('customerSearchTableDiv', customerSearchTableCreatorFile, 'customerSearchTable');
			reportTableCreator('customerReportTableDiv', customerReportTableCreatorFile, 'customerReportTable');
		}
	});
}


// Function to call the insertVendor.php script to insert vendor data to db
function addVendor() {
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
		url: 'model/vendor/insertVendor.php',
		method: 'POST',
		data: {
			vendorFullName:vendorFullName,
			vendorEmail:vendorEmail,
			vendorMobile:vendorMobile,
			vendorPhone:vendorPhone,
			vendorAddress:vendorAddress,
			vendorAddress2:vendorAddress2,
			vendorCity:vendorCity,
			vendorDistrict:vendorDistrict,
			vendorStatus:vendorStatus,
		},
		success: function(data){
			$('#vendorMessage').fadeIn();
			$('#vendorMessage').html(data);
		},
		complete: function(data){
			populateLastInserted(vendorLastInsertedFile, 'vendorID');
			searchTableCreator('vendorSearchTableDiv', vendorSearchTableCreatorFile, 'vendorSearchTable');
			reportsTableCreator('vendorReportsTableDiv', vendorReportTableCreatorFile, 'vendorReportTable');
			$('#purchaseVendorName').load('model/vendor/getVendorNames.php');
		}
	});
}


// Function to call the insertItem.php script to insert item data to db
function addItem() {
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
			$('#itemMessage').fadeIn();
			$('#itemMessage').html(data);
		},
		complete: function(){
			populateLastInserted(itemLastInsertedFile, 'itemProductID');
			getPopulateItemStock('itemNumber', getItemStockFile, itemTotalStock);
			searchTableCreator('itemSearchTableDiv', itemSearchTableCreatorFile, 'itemSearchTable');
			reportTableCreator('itemReportTableDiv', itemReportTableCreatorFile, 'itemReportTable');
		}
	});
}


// Function to call the insertPurchase.php script to insert purchase data to db
function addPurchase() {
	var purchaseItemNumber = $('#purchaseItemNumber').val();
	var purchaseDate = $('#purchaseDate').val();
	var purchaseItemName = $('#purchaseItemName').val();
	var purchaseQuantity = $('#purchaseQuantity').val();
	var purchaseUnitPrice = $('#purchaseUnitPrice').val();
	var purchaseVendorName = $('#purchaseVendorName').val();
	
	$.ajax({
		url: 'model/purchase/insertPurchase.php',
		method: 'POST',
		data: {
			purchaseItemNumber:purchaseItemNumber,
			purchaseDate:purchaseDate,
			purchaseItemName:purchaseItemName,
			purchaseQuantity:purchaseQuantity,
			purchaseUnitPrice:purchaseUnitPrice,
			purchaseVendorName:purchaseVendorName,
		},
		success: function(data){
			$('#purchaseMessage').fadeIn();
			$('#purchaseMessage').html(data);
		},
		complete: function(){
			getPopulateItemStock('purchaseItemNumber', getItemStockFile, 'purchaseCurrentStock');
			populateLastInserted(purchaseLastInsertedFile, 'purchaseID');
			searchTableCreator('purchaseSearchTableDiv', purchaseSearchTableCreatorFile, 'purchaseSearchTable');
			reportPurchaseTableCreator('purchaseReportTableDiv', purchaseReportTableCreatorFile, 'purchaseReportTable');
			searchTableCreator('itemSearchTableDiv', itemSearchTableCreatorFile, 'itemSearchTable');
			reportTableCreator('itemReportsTableDiv', itemReportTableCreatorFile, 'itemReportsTable');
		}
	});
}


// Function to call the insertSale.php script to insert sale data to db
function addSale() {
	var saleItemNumber = $('#saleItemNumber').val();
	var saleItemName = $('#saleItemName').val();
	var saleDiscount = $('#saleDiscount').val();
	var saleQuantity = $('#saleQuantity').val();
	var saleUnitPrice = $('#saleUnitPrice').val();
	var saleCustomerID = $('#saleCustomerID').val();
	var saleCustomerName = $('#saleCustomerName').val();
	var saleDate = $('#saleDate').val();
	
	$.ajax({
		url: 'model/sale/insertSale.php',
		method: 'POST',
		data: {
			saleItemNumber:saleItemNumber,
			saleItemName:saleItemName,
			saleDiscount:saleDiscount,
			saleQuantity:saleQuantity,
			saleUnitPrice:saleUnitPrice,
			saleCustomerID:saleCustomerID,
			saleCustomerName:saleCustomerName,
			saleDate:saleDate,
		},
		success: function(data){
			$('#saleMessage').fadeIn();
			$('#saleMessage').html(data);
		},
		complete: function(){
			getPopulateItemStock('saleItemNumber', getItemStockFile, 'saleTotalStock');
			populateLastInserted(saleLastInsertedFile, 'saleID');
			searchTableCreator('saleSearchTableDiv', saleSearchTableCreatorFile, 'saleSearchTable');
			reportSaleTableCreator('saleReportTableDiv', saleReportTableCreatorFile, 'saleReportTable');
			searchTableCreator('itemSearchTableDiv', itemSearchTableCreatorFile, 'itemSearchTable');
			reportTableCreator('itemReportTableDiv', itemReportTableCreatorFile, 'itemReportTable');
		}
	});
}


// Function to send itemNumber so that item details can be pulled from db
// to be displayed on item details tab
function getPopulateItem(){
	// Get the itemNumber entered in the text box
	var itemNumber = $('#itemNumber').val();
	var defaultImgUrl = 'data/item_images/imageNotAvailable.jpg';
	var defaultImageData = '<img class="img-fluid" src="data/item_images/imageNotAvailable.jpg">';
	
	// Call the populateItemDetails.php script to get item details
	// relevant to the itemNumber which the user entered
	$.ajax({
		url: 'model/item/populateItem.php',
		method: 'POST',
		data: {itemNumber:itemNumber},
		dataType: 'json',
		success: function(data){
			$('#itemProductID').val(data.productID);
			$('#itemItemName').val(data.itemName);
			$('#itemDiscount').val(data.discount);
			$('#itemTotalStock').val(data.stock);
			$('#itemUnitPrice').val(data.unitPrice);
			$('#itemDescription').val(data.description);
			$('#itemStatus').val(data.status).trigger("chosen:updated");

			newImgUrl = 'data/item_images/' + data.itemNumber + '/' + data.imageURL;
			
			// Set the item image
			if(data.imageURL == 'imageNotAvailable.jpg' || data.imageURL == ''){
				$('#imageContainer').html(defaultImageData);
			} else {
				$('#imageContainer').html('<img class="img-fluid" src="' + newImgUrl + '">');
			}
		}
	});
}


// Function to send itemNumber so that item details can be pulled from db
// to be displayed on sale details tab
function getPopolateItemForSale(){
	// Get the itemNumber entered in the text box
	var itemNumber = $('#saleItemNumber').val();
	var defaultImgUrl = 'data/item_images/imageNotAvailable.jpg';
	var defaultImageData = '<img class="img-fluid" src="data/item_images/imageNotAvailable.jpg">';
	
	// Call the populateItemDetails.php script to get item details
	// relevant to the itemNumber which the user entered
	$.ajax({
		url: 'model/item/populateItem.php',
		method: 'POST',
		data: {itemNumber:itemNumber},
		dataType: 'json',
		success: function(data){
			$('#saleItemName').val(data.itemName);
			$('#saleDiscount').val(data.discount);
			$('#saleTotalStock').val(data.stock);
			$('#saleUnitPrice').val(data.unitPrice);

			newImgUrl = 'data/item_images/' + data.itemNumber + '/' + data.imageURL;
			
			// Set the item image
			if(data.imageURL == 'imageNotAvailable.jpg' || data.imageURL == ''){
				$('#saleImageContainer').html(defaultImageData);
			} else {
				$('#saleImageContainer').html('<img class="img-fluid" src="' + newImgUrl + '">');
			}
		},
		complete: function() {			
			calculateTotalSale();
		}
	});
}


// Function to send itemNumber so that item name can be pulled from db
function getItemName(itemNumberTextBoxID, scriptPath, itemNameTextbox){
	// Get the itemNumber entered in the text box
	var itemNumber = $('#' + itemNumberTextBoxID).val();

	// Call the script to get item details
	$.ajax({
		url: scriptPath,
		method: 'POST',
		data: {itemNumber:itemNumber},
		dataType: 'json',
		success: function(data){
			$('#' + itemNameTextbox).val(data.itemName);
		},
		error: function (xhr, ajaxOptions, thrownError) {
      }
	});
}


// Function to send itemNumber so that item stock can be pulled from db
function getPopulateItemStock(itemNumberTextbox, scriptPath, stockTextbox){
	// Get the itemNumber entered in the text box
	var itemNumber = $('#' + itemNumberTextbox).val();
	
	// Call the script to get stock details
	$.ajax({
		url: scriptPath,
		method: 'POST',
		data: {itemNumber:itemNumber},
		dataType: 'json',
		success: function(data){
			$('#' + stockTextbox).val(data.stock);
		},
		error: function (xhr, ajaxOptions, thrownError) {
        //alert(xhr.status);
        //alert(thrownError);
		//console.warn(xhr.responseText)
      }
	});
}


// Function to populate last inserted ID
function populateLastInserted(scriptPath, textBoxID){
	$.ajax({
		url: scriptPath,
		method: 'POST',
		dataType: 'json',
		success: function(data){
			$('#' + textBoxID).val(data);
		}
	});
}


// Function to show suggestions
function showSuggestions(textBoxID, scriptPath, suggestionsDivID){
	// Get the value entered by the user
	var textBoxValue = $('#' + textBoxID).val();
	
	// Call the showPurchaseIDs.php script only if there is a value in the
	// purchase ID textbox
	if(textBoxValue != ''){
		$.ajax({
			url: scriptPath,
			method: 'POST',
			data: {textBoxValue:textBoxValue},
			success: function(data){
				$('#' + suggestionsDivID).fadeIn();
				$('#' + suggestionsDivID).html(data);
			}
		});
	}
}


// Function to delte item from db
function deleteItem(){
	// Get the item number entered by the user
	var itemNumber = $('#itemNumber').val();
	
	// Call the deleteItem.php script only if there is a value in the
	// item number textbox
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
				searchTableCreator('itemSearchTableDiv', itemSearchTableCreatorFile, 'itemSearchTable');
				reportTableCreator('itemReportTableDiv', itemReportTableCreatorFile, 'itemReportTable');
			}
		});
	}
}


// Function to delete item from db
function deleteCustomer(){
	// Get the customerID entered by the user
	var customerID = $('#customerID').val();
	
	// Call the deleteCustomer.php script only if there is a value in the
	// item number textbox
	if(customerID != ''){
		$.ajax({
			url: 'model/customer/deleteCustomer.php',
			method: 'POST',
			data: {customerID:customerID},
			success: function(data){
				$('#customerMessage').fadeIn();
				$('#customerMessage').html(data);
			},
			complete: function(){
				searchTableCreator('customerSearchTableDiv', customerSearchTableCreatorFile, 'customerSearchTable');
				reportsTableCreator('customerReportTableDiv', customerReportTableCreatorFile, 'customerReportTable');
			}
		});
	}
}


// Function to delete vendor from db
function deleteVendor(){
	// Get the vendorID entered by the user
	var vendorID = $('#vendorID').val();
	
	// Call the deleteVendor.php script only if there is a value in the
	// vendor ID textbox
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
				searchTableCreator('vendorSearchTableDiv', vendorSearchTableCreatorFile, 'vendorSearchTable');
				reportTableCreator('vendorReportTableDiv', vendorReportTableCreatorFile, 'vendorReportTable');
			}
		});
	}
}


// Function to send customerID so that customer details can be pulled from db
// to be displayed on customer details tab
function getPopulateCustomer(){
	// Get the customerID entered in the text box
	var customerID = $('#customerID').val();
	
	// Call the populateItemDetails.php script to get item details
	// relevant to the itemNumber which the user entered
	$.ajax({
		url: 'model/customer/populateCustomer.php',
		method: 'POST',
		data: {customerID:customerID},
		dataType: 'json',
		success: function(data){
			//$('#customerDetailsCustomerID').val(data.customerID);
			$('#customerFullName').val(data.fullName);
			$('#customerMobile').val(data.mobile);
			$('#customerPhone').val(data.phone);
			$('#customerEmail').val(data.email);
			$('#customerAddress').val(data.address);
			$('#customerAddress2').val(data.address2);
			$('#customerCity').val(data.city);
			$('#customerDistrict').val(data.district).trigger("chosen:updated");
			$('#customerStatus').val(data.status).trigger("chosen:updated");
		}
	});
}


// Function to send customerID so that customer details can be pulled from db
// to be displayed on sale details tab
function getPopulateCustomerForSale(){
	// Get the customerID entered in the text box
	var customerID = $('#saleCustomerID').val();
	
	// Call the populateCustomerDetails.php script to get customer details
	// relevant to the customerID which the user entered
	$.ajax({
		url: 'model/customer/populateCustomer.php',
		method: 'POST',
		data: {customerID:customerID},
		dataType: 'json',
		success: function(data){
			$('#saleCustomerName').val(data.fullName);
		}
	});
}


// Function to send vendorID so that vendor details can be pulled from db
// to be displayed on vendor details tab
function getPopulateVendor(){
	// Get the vendorID entered in the text box
	var vendorID = $('#vendorID').val();
	
	// Call the populateVendorDetails.php script to get vendor details
	// relevant to the vendorID which the user entered
	$.ajax({
		url: 'model/vendor/populateVendor.php',
		method: 'POST',
		data: {vendorID:vendorID},
		dataType: 'json',
		success: function(data){
			//$('#vendorDetailsVendorID').val(data.vendorID);
			$('#vendorFullName').val(data.fullName);
			$('#vendorMobile').val(data.mobile);
			$('#vendorPhone').val(data.phone2);
			$('#vendorEmail').val(data.email);
			$('#vendorAddress').val(data.address);
			$('#vendorAddress2').val(data.address2);
			$('#vendorCity').val(data.city);
			$('#vendorDistrict').val(data.district).trigger("chosen:updated");
			$('#vendorStatus').val(data.status).trigger("chosen:updated");
		}
	});
}


// Function to send purchaseID so that purchase details can be pulled from db
// to be displayed on purchase details tab
function getPopulatePurchase(){
	// Get the purchaseID entered in the text box
	var purchaseDetailsPurchaseID = $('#purchaseID').val();
	
	// Call the populatePurchaseDetails.php script to get item details
	// relevant to the itemNumber which the user entered
	$.ajax({
		url: 'model/purchase/populatePurchase.php',
		method: 'POST',
		data: {purchaseID:purchaseID},
		dataType: 'json',
		success: function(data){
			$('#purchaseItemNumber').val(data.itemNumber);
			$('#purchaseDate').val(data.purchaseDate);
			$('#purchaseItemName').val(data.itemName);
			$('#purchaseQuantity').val(data.quantity);
			$('#purchaseUnitPrice').val(data.unitPrice);
			$('#purchaseVendorName').val(data.vendorName).trigger("chosen:updated");
		},
		complete: function(){
			calculateTotalPurchase();
			getPopulateItemStock('purchaseItemNumber', getItemStockFile, 'purchaseCurrentStock');
		}
	});
}


// Function to send saleID so that sale details can be pulled from db
// to be displayed on sale details tab
function getPopulateSale(){
	// Get the saleID entered in the text box
	var saleID = $('#saleID').val();
	
	// Call the populateSaleDetails.php script to get item details
	// relevant to the itemNumber which the user entered
	$.ajax({
		url: 'model/sale/populateSale.php',
		method: 'POST',
		data: {saleID:saleID},
		dataType: 'json',
		success: function(data){
			//$('#saleDetailsSaleID').val(data.saleID);
			$('#saleItemNumber').val(data.itemNumber);
			$('#saleCustomerID').val(data.customerID);
			$('#saleCustomerName').val(data.customerName);
			$('#saleItemName').val(data.itemName);
			$('#saleDate').val(data.saleDate);
			$('#saleDiscount').val(data.discount);
			$('#saleQuantity').val(data.quantity);
			$('#saleUnitPrice').val(data.unitPrice);
		},
		complete: function(){
			calculateTotalSale();
			getPopulateItemStock('saleItemNumber', getItemStockFile, 'saleTotalStock');
		}
	});
}


// Function to call the upateItemDetails.php script to UPDATE item data in db
function updateItem() {
	var itemNumber = $('#itemNumber').val();
	var itemName = $('#itemName').val();
	var itemDiscount = $('#itemDiscount').val();
	var itemQuantity = $('#itemQuantity').val();
	var itemUnitPrice = $('#itemUnitPrice').val();
	var itemStatus = $('#itemStatus').val();
	var itemDescription = $('#itemDescription').val();
	
	$.ajax({
		url: 'model/item/updateItem.php',
		method: 'POST',
		data: {
			itemNumber:itemNumber,
			itemItemName:itemName,
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
			searchTableCreator('itemSearchTableDiv', itemSearchTableCreatorFile, 'itemSearchTable');			
			searchTableCreator('purchaseTableDiv', purchaseSearchTableCreatorFile, 'purchaseSearchTable');
			searchTableCreator('saleSearchTableDiv', saleSearchTableCreatorFile, 'saleSearchTable');
			reportsTableCreator('itemReportTableDiv', itemReportTableCreatorFile, 'itemReportTable');
			reportsPurchaseTableCreator('purchaseReportTableDiv', purchaseReportTableCreatorFile, 'purchaseReportsTable');
			reportsSaleTableCreator('saleReportTableDiv', saleReportTableCreatorFile, 'saleReportTable');
		}
	});
}


// Function to call the upateCustomerDetails.php script to UPDATE customer data in db
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
	var customerStatus = $('#customerStatus option:selected').text();
	
	$.ajax({
		url: 'model/customer/updateCustomer.php',
		method: 'POST',
		data: {
			customerID:customerID,
			customerFullName:customerFullName,
			customerMobile:customerMobile,
			custPhone:customerPhone,
			customerEmail:customerEmail,
			customerAddress:customerAddress,			
			customerAddress2:customerAddress2,
			customerCity:customerCity,
			customerDistrict:customerDistrict,
			customerStatus:customerStatus,
		},
		success: function(data){
			$('#customerMessage').fadeIn();
			$('#customerMessage').html(data);
		},
		complete: function(){
			searchTableCreator('customerSearchTableDiv', customerSearchTableCreatorFile, 'customerSearchTable');
			reportsTableCreator('customerReportTableDiv', customerReportTableCreatorFile, 'customerReportTable');
			searchTableCreator('saleSearchTableDiv', saleSearchTableCreatorFile, 'saleSearchTable');
			reportsSaleTableCreator('saleReportTableDiv', saleReportTableCreatorFile, 'saleReportTable');
		}
	});
}


// Function to call the upateVendorDetails.php script to UPDATE vendor data in db
function updateVendor() {
	var vendorID = $('#vendorID').val();
	var vendorFullName = $('#vendorFullName').val();
	var vendorMobile = $('#vendorMobile').val();
	var vendorPhone = $('#vendorPhone').val();
	var vendorAddress = $('#vendorAddress').val();
	var vendorEmail = $('#vendorEmail').val();
	var vendorAddress2 = $('#vendorAddress2').val();
	var vendorCity = $('#vendorCity').val();
	var vendorDistrict = $('#vendorDistrict').val();
	var vendorStatus = $('#vendorStatus option:selected').text();
	
	$.ajax({
		url: 'model/vendor/updateVendor.php',
		method: 'POST',
		data: {
			vendorID:vendorID,
			vendorFullName:vendorFullName,
			vendorMobile:vendorMobile,
			vendorPhone:vendorPhone,
			vendorAddress:vendorAddress,
			vendorEmail:vendorEmail,
			vendorAddress2:vendorAddress2,
			vendorCity:vendorCity,
			vendorDistrict:vendorDistrict,
			vendorStatus:vendorStatus,
		},
		success: function(data){
			$('#vendorMessage').fadeIn();
			$('#vendorMessage').html(data);
		},
		complete: function(){
			searchTableCreator('purchaseSearchTableDiv', purchaseSearchTableCreatorFile, 'purchaseSearchTable');
			searchTableCreator('vendorSearchTableDiv', vendorSearchTableCreatorFile, 'vendorSearchTable');
			reportPurchaseTableCreator('purchaseReportTableDiv', purchaseReportTableCreatorFile, 'purchaseReportTable');
			reportTableCreator('vendorReportTableDiv', vendorReportTableCreatorFile, 'vendorReportTable');
		}
	});
}


// Function to call the updatePurchase.php script to update purchase data to db
function updatePurchase() {
	var purchaseItemNumber = $('#purchaseItemNumber').val();
	var purchaseDate = $('#purchaseDate').val();
	var purchaseItemName = $('#purchaseItemName').val();
	var purchaseQuantity = $('#purchaseQuantity').val();
	var purchaseUnitPrice = $('#purchaseUnitPrice').val();
	var purchaseID = $('#purchasePurchaseID').val();
	var purchaseVendorName = $('#purchaseVendorName').val();
	
	$.ajax({
		url: 'model/purchase/updatePurchase.php',
		method: 'POST',
		data: {
			purchaseItemNumber:purchaseItemNumber,
			purchaseDate:purchaseDate,
			purchaseItemName:purchaseItemName,
			purchaseQuantity:purchaseQuantity,
			purchaseUnitPrice:purchaseUnitPrice,
			purchaseID:purchaseID,
			purchaseVendorName:purchaseVendorName,
		},
		success: function(data){
			$('#purchaseMessage').fadeIn();
			$('#purchaseMessage').html(data);
		},
		complete: function(){
			getPopulateItemStock('purchaseItemNumber', getItemStockFile, 'purchaseCurrentStock');
			searchTableCreator('purchaseSearchTableDiv', purchaseSearchTableCreatorFile, 'purchaseSearchTable');
			reportsPurchaseTableCreator('purchaseReportTableDiv', purchaseReportTableCreatorFile, 'purchaseReportTable');
			searchTableCreator('itemSearchTableDiv', itemSearchTableCreatorFile, 'itemSearchTable');
			reportsTableCreator('itemReportTableDiv', itemReportTableCreatorFile, 'itemReportTable');
		}
	});
}


// Function to call the updateSale.php script to update sale data to db
function updateSale() {
	var saleItemNumber = $('#saleItemNumber').val();
	var saleDate = $('#saleDate').val();
	var saleItemName = $('#saleItemName').val();
	var saleQuantity = $('#saleQuantity').val();
	var saleUnitPrice = $('#saleUnitPrice').val();
	var saleID = $('#saleID').val();
	var saleCustomerName = $('#saleCustomerName').val();
	var saleDiscount = $('#saleDiscount').val();
	var saleCustomerID = $('#saleCustomerID').val();
	
	$.ajax({
		url: 'model/sale/updateSale.php',
		method: 'POST',
		data: {
			saleItemNumber:saleItemNumber,
			saleDate:saleDate,
			saleItemName:saleItemName,
			saleQuantity:saleQuantity,
			saleUnitPrice:saleUnitPrice,
			saleID:saleID,
			saleCustomerName:saleCustomerName,
			saleDiscount:saleDiscount,
			saleCustomerID:saleCustomerID,
		},
		success: function(data){
			$('#saleMessage').fadeIn();
			$('#saleMessage').html(data);
		},
		complete: function(){			
			getPopulateItemStock('saleSearchItemNumber', getItemStockFile, 'saleTotalStock');
			searchTableCreator('saleSearchTableDiv', saleSearchTableCreatorFile, 'saleSearchTable');
			reportSaleTableCreator('saleReportTableDiv', saleReportTableCreatorFile, 'saleReportsTable');
			searchTableCreator('itemSearchTableDiv', itemSearchTableCreatorFile, 'itemSearchTable');
			reportsTableCreator('itemReportTableDiv', itemReportTableCreatorFile, 'itemReportTable');
		}
	});
}