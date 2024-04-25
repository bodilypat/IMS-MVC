/* created purchase search table */
purchaseSearchTableCreatorFile = 'model/purchase/purchaseSearchTableCreator.php';
/* created customer search table */
customerSearchTableCreatorFile = 'model/customer/customerSearchTableCreator.php';
/* created item search table */
itemSearchTableCreatorFile = 'model/item/itemSearchTableCreator.php';
/* created vendor search table */
vendorSearchTableCreatorFile = 'model/vendor/vendorSearchTableCreator.php';
/* created sale search table */
saleSearchTableCreatorFile = 'model/sale/saleSearchTableCreator.php';


/* created purchase report table */
purchaseReportTableCreatorFile = 'model/purchase/purchaseReportTableCreator.php';
/* created customer report table */
customerReportSearchTableCreatorFile = 'model/customer/customerReportTableCreator.php';
/* created item report table */
itemReportTableCreatorFile = 'model/item/itemReportTableCreator.php';
/* created vendor report table */
vendorReportTableCreatorFile = 'model/vendor/vendorReportTableCreator.php';
/* created sale report table */
saleReportTableCreatorFile = 'model/sale/saleReportTableCreator.php';


/* populate return last vendorID */
vendorLastInsertedFile = 'model/vendor/populateLastVendor.php';
/* populate return last customerID */
customerLastInsertedFile = 'model/customer/populateLastCustomer.php';
/* populate return last purchaseID */
purchaseLastInsertedFile = 'model/purchase/populateLastPurchase.php';
/* populate return last saleID */
saleLastInsertedFile = 'model/sale/populateLastSale.php';
/* populate return last productID */
productItemLastInsertedFile = 'model/item/populateLastProduct.php';


/* return purchaseID */
showPurchaseIDAdviseFile = 'model/purchase/purchaseIDAdviseList.php';
/* return saleID */
showSaleIDAdviseFile = 'model/sale/saleIDAdviseList.php';
/* return vendorID */
showVendorIDAdviseFile = 'model/vendor/vendorIDAdviseList.php';
/* return customerID */
showCustomerIDAdviseFile = 'model/customer/customerIDAdviseList.php';
/* return customerID for sale */
showSaleCustomerIDAdviseFile = 'model/sale/saleCustomerIDAdviseList.php';


/* return itemNumber */
showItemNumberAdviseFile = 'model/item/itemNumberAdviseList.php';
/* return itemImageNumber  */
showItemImageNumberAdviseFile = 'model/item/itemImageNumberAdviseList.php';
/* return itemNubmer for purchase */
showPurchaseItemNumberAdviseFile = 'model/purchase/purchaseItemNumberAdviseList.php';
/* returns itemnumber for sale */
showSaleItemNumberAdviseFile = 'model/sale/saleItemNumberAdviseList.php';
/* return itemNames */
showItemNameAdviseFile = 'model/item/itemNameAdviseList.php';


/* return stock */
getItemStockFile = 'model/item/getItemStock.php';
/* return item name */
getItemNameFile = 'model/item/getItemName.php';
/* update image */
updateImageFile = 'model/image/updateImage.php';
/* delete image */
deleteImageFile = 'model/image/deleteImage.php';


/* create purchase table */
purchaseFilteredReportCreatorFile = 'model/purchase/purchaseFilteredReportCreator.php';
/* create sale table */
saleFilteredReportCreatorFile = 'model/sale/saleFilteredReportCreator.php';

$(document).ready(function(){
	$('.chosenSelect').chosen({ width: "95%"});
	
	/* initiate tooltip */
	/* call function button click */
	$('.invTooltip').tooltip(); 
	
	$('#addCustomer').on('click', function(){
		addCustomer();
	});
	
	$('#addVendor').on('click', function(){
		addVendor();
	});
	
	$('#addItem').on('click', function(){
		addItem();
	});
	
	$('#addPurchase').on('click', function(){
		addPurchase();
	});
	
	$('#addSale').on('click', function(){
		addSale();
	});
	
	$('#updateItem').on('click', function(){
		updateItem();
	});
	
	$('#updateCustomer').on('click', function(){
		updateCustomer();
	});
	
	$('#updateVendor').on('click', function(){
		updateVendor();
	});
	
	$('#updatePurchase').on('click', function(){
		updatePurchase();
	});
	
	$('#updateSale').on('click', function(){
		updateSale();
	});
	
	$('#deleteItem').on('click', function(){
		bootbox.confirm('Are you sure you want to delete?', function(result){
			if(result){
				deleteItem();
			}
		});
	});
	
	$('#deleteCustomer').on('click', function(){
		
		bootbox.confirm('Are you sure you want to delete?', function(result){
			if(result){
				deleteCustomer();
			}
		});
	});
	

	$('#deleteVendor').on('click', function(){

		/* alert confirm  before delete */
		bootbox.confirm('Are you sure you want to delete?', function(result){
			if(result){
				deleteVendor();
			}
		});
	});
	
	
	$('#itemName').keyup(function(){
		showSuggestions('itemName', showItemNamesFile, 'itemNameAdviseDiv');
	});
	
	$(document).on('click', '#itemNameAdviseList li', function(){
		$('#itemName').val($(this).text());
		$('#itemNameAdviseList').fadeOut();
	});
	

	$('#itemNumber').keyup(function(){
		showSuggestions('itemNumber', showItemNameAdviseFile, 'itemNumberAdviseDiv');
	});
	

	$(document).on('click', '#itemNumberAdviseList li', function(){
		$('#itemNumber').val($(this).text());
		$('#itemNumberAdviseList').fadeOut();
		getPopulateItemNumber();
	});
	
	/* list item number from sale */
	$('#saleItemNumber').keyup(function(){
		showSuggestions('saleItemNumber', showSaleItemNumberFile, 'saleItemNumberAdviseDiv');
	});
	
	/* select item number */
	$(document).on('click', '#saleItemNumberAdviseList li', function(){
		$('#saleItemNumber').val($(this).text());
		$('#saleItemNumberAdviseList').fadeOut();
		getPopulateSaleItemNumber();
	});
	
	/* list item number text box */
	$('#itemImageNumber').keyup(function(){
		showSuggestions('itemImageNumber', showItemNumberAdvisebFile, 'itemImageNumberAdviseDiv');
	});
	
	/* select item Image number */
	$(document).on('click', '#itemImageNumberAdviseList li', function(){
		$('#itemImageNumber').val($(this).text());
		$('#itemImageNumberAdviseList').fadeOut();
		getItemName('itemImageNumber', getItemNameFile, 'itemImageName');
	});
	
	/* clear item */
	$('#itemClear').on('click', function(){
		$('#imageContainer').empty();
	});
	
	/* clear image form sale */
	$('#saleClear').on('click', function(){
		$('#saleImageContainer').empty();
	});
	
	/* refresh purchase report */
	$('#purchaseFilterClear').on('click', function(){
		reportsPurchaseTableCreator('purchaseReportTableDiv', purchaseReportCreatorFile, 'purchaseReportTable');
	});
	
	/* refresh sale report */
	$('#saleFilterClear').on('click', function(){
		reportsSaleTableCreator('saleReportTableDiv', saleReportCreatorFile, 'saleReportTable');
	});
	
	/* list item number form purchase */
	$('#purchaseItemNumber').keyup(function(){
		showSuggestions('purchaseItemNumber', showPurchaseItemNumberFile, 'purchaseItemNumberAdviseDiv');
	});
	
	/* remove item nubmer from purchase */
	$(document).on('click', '#purchaseItemNumberAdviseList li', function(){
		$('#purchaseItemNumber').val($(this).text());
		$('#purchaseItemNumberAdviseList').fadeOut();
		
		/* display item name */
		getItemName('purchaseItemNumber', getItemNameFile, 'purchaseItemName');
		
		/* display current stock */
		getPopulateItemStock('purchaseItemNumber', getItemStockFile, 'purchaseCurrentStock');
	});
	
	/* list customer  */
	$('#customerID').keyup(function(){
		showSuggestions('customerID', showCustomerIDAdviseFile, 'customerIDAdviseDiv');
	});
	
	/* remove customer */
	$(document).on('click', '#customerIDAdviseList li', function(){
		$('#customerID').val($(this).text());
		$('#customerIDAdviseList').fadeOut();
		getPopulateCustomer();
	});
	
	/* list customer from sale */
	$('#saleCustomerID').keyup(function(){
		showSuggestions('saleCustomerID', showSaleCustomerIDAdviseFile, 'saleCustomerIDAdviseDiv');
	});
	
	/* remove customer  */
	$(document).on('click', '#saleCustomerIDAdviseList li', function(){
		$('#salecustomerID').val($(this).text());
		$('#saleCustomerIDAdviseList').fadeOut();
		getPopulateSaleCustomerID();
	});
	
	/* list vendor */
	$('#vendorID').keyup(function(){
		showSuggestions('vendorID', showVendorIDAdviseFile, 'vendorIDAdviseDiv');
	});
	
	/* remove vendor */
	$(document).on('click', '#vendorIDAdviseList li', function(){
		$('#vendorID').val($(this).text());
		$('#vendorIDAdviseList').fadeOut();
		getPopulateVendor();
	});
	
	/* list purchase */
	$('#purchaseID').keyup(function(){
		showSuggestions('purchaseID', showPurchaseIDAdviseFile, 'purchaseIDAdviseDiv');
	});
	
	/* remove purchase */
	$(document).on('click', '#purchaseIDAdviseList li', function(){
		$('#purchaseID').val($(this).text());
		$('#purchaseIDAdviseList').fadeOut();
		getPopulatePurchase();
	});
	
	/* list sale */
	$('#saleID').keyup(function(){
		showSuggestions('saleID', showSaleIDAviseFile, 'saleIDAdviseDiv');
	});
	
	/* remove sale */
	$(document).on('click', '#saleIDAdviseList li', function(){
		$('#saleID').val($(this).text());
		$('#saleIDAdviseList').fadeOut();
		getPopulateSale();
	});

	$('#updateImage').on('click', function(){
		processImage('imageForm', updateImageFile, 'itemImageMessage');
	});

	$('#deleteImage').on('click', function(){
		processImage('imageForm', deleteImageFile, 'itemImageMessage');
	});
	
	/* initiate datepickers */
	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd',
		todayHighlight: true,
		todayBtn: 'linked',
		orientation: 'bottom left'
	});
	
	/* calculate total */
	$('#purchaseQuantity, #purchaseUnitPrice').change(function(){
		calculateTotalPurchase();
	});

	$('#saleDiscount, #saleQuantity, #saleUnitPrice').change(function(){
		calculateTotalSale();
	});
	
	/* close any list from page */
	$(document).on('click', function(){
		$('.adviseList').fadeOut();
	});
	
	/* load file search table */
	searchTableCreator('itemSearchTableDiv', itemSearchTableCreatorFile, 'itemSearchTable');
	searchTableCreator('purchaseDetailsTableDiv', purchaseSearchTableCreatorFile, 'purchaseSearchTable');
	searchTableCreator('customerDetailsTableDiv', customerSearchTableCreatorFile, 'customerSearchTable');
	searchTableCreator('saleDetailsTableDiv', saleSearchTableCreatorFile, 'saleSearchTable');
	searchTableCreator('vendorDetailsTableDiv', vendorSearchTableCreatorFile, 'vendorSearchTable');
	
	/* load file report table */
	reportTableCreator('itemReportTableDiv', itemReportTableCreatorFile, 'itemReportTable');
	reportPurchaseTableCreator('purchaseReportTableDiv', purchaseReportTableCreatorFile, 'purchaseReportTable');
	reportTableCreator('customerReportTableDiv', customerReportTableCreatorFile, 'customerReportTable');
	reportSaleTableCreator('saleReportTableDiv', saleReportTableCreatorFile, 'saleReportTable');
	reportTableCreator('vendorReportTableDiv', vendorReportTableCreatorFile, 'vendorReportTable');
	
	/* initiate popover */
	$(document).on('mouseover', '.itemDetailsHover', function(){
		/* create item popover */
		$('.itemHover').popover({
			container: 'body',
			title: 'Item Details',
			trigger: 'hover',
			html: true,
			placement: 'right',
			content: fetchData
		});
	});
	
	/* list file */
	$('#searchTableRefresh, #reportTableRefresh').on('click', function(){
		searchTableCreator('itemSearchTableDiv', itemSearchTableCreatorFile, 'itemSearchTable');
		searchTableCreator('purchaseSearchTableDiv', purchaseSearchTableCreatorFile, 'purchaseSearchTable');
		searchTableCreator('customerSearchTableDiv', customerSearchTableCreatorFile, 'customerSearchTable');
		searchTableCreator('vendorSearchTableDiv', vendorSearchTableCreatorFile, 'vendorSearchTable');
		searchTableCreator('saleSearchTableDiv', saleSearchTableCreatorFile, 'saleSearchTable');
		
		reportTableCreator('itemReportTableDiv', itemReportTableCreatorFile, 'itemReportTable');
		reportPurchaseTableCreator('purchaseReportTableDiv', purchaseReportTableCreatorFile, 'purchaseReportTable');
		reportTableCreator('customerReportTableDiv', customerReportTableCreatorFile, 'customerReportTable');
		reportTableCreator('vendorReportTableDiv', vendorReportTableCreatorFile, 'vendorReportTable');
		reportSaleTableCreator('saleReportTableDiv', saleReportTableCreatorFile, 'saleReportTable');
	});
	
	/* list purchase repot */
	$('#showPurchaseReport').on('click', function(){
		filteredPurchaseReportTableCreator('purchaseReportStartDate', 'purchaseReportEndDate', purchaseFilteredReportCreatorFile, 'purchaseReportsTableDiv', 'purchaseFilteredReportsTable');
	});
	
	/* list sale report */
	$('#showSaleReport').on('click', function(){
		filteredSaleReportTableCreator('saleReportStartDate', 'saleReportEndDate', saleFilteredReportCreatorFile, 'saleReportsTableDiv', 'saleFilteredReportsTable');
	});
});

/* function fetch data for show popover*/
function fetchData(){
	var fetch_data = '';
	var element = $(this);
	var id = element.attr('id');
	
	$.ajax({
		url: 'model/item/getItemPopover.php',
		method: 'POST',
		async: false,
		data: {id:id},
		success: function(data){
			fetch_data = data;
		}
	});
	return fetch_data;
}

/* function call scriptPath  image */
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

/* create searchable database */
function searchTableCreator(tableContainerDiv, tableCreatorFileUrl, table){
	var tableContainerDivID = '#' + tableContainerDiv;
	var tableID = '#' + table;
	$(tableContainerDivID).load(tableCreatorFileUrl, function(){
		/* initiate datable plugin */
		$(tableID).DataTable();
	});
}

/* create reports  */
function reportsTableCreator(tableContainerDiv, tableCreatorFileUrl, table){
	var tableContainerDivID = '#' + tableContainerDiv;
	var tableID = '#' + table;
	$(tableContainerDivID).load(tableCreatorFileUrl, function(){
		/* initiate datable plugin  */
		$(tableID).DataTable({
			dom: 'lBfrtip',
			//dom: 'lfBrtip',
			//dom: 'Bfrtip',
			buttons: [
				'copy',
				'csv', 'excel',
				{extend: 'pdf', orientation: 'landscape', pageSize: 'LEGAL'},
				'print'
			]
		});
	});
}

function reportsPurchaseTableCreator(tableContainerDiv, tableCreatorFileUrl, table){
	var tableContainerDivID = '#' + tableContainerDiv;
	var tableID = '#' + table;
	$(tableContainerDivID).load(tableCreatorFileUrl, function(){
		/* initate datable plugin */
		$(tableID).DataTable({
			dom: 'lBfrtip',
			buttons: [
				'copy',
				{extend: 'csv', footer: true, title: 'Purchase Report'},
				{extend: 'excel', footer: true, title: 'Purchase Report'},
				{extend: 'pdf', footer: true, orientation: 'landscape', pageSize: 'LEGAL', title: 'Purchase Report'},
				{extend: 'print', footer: true, title: 'Purchase Report'},
			],
			"footerCallback": function ( row, data, start, end, display ) {
				var api = this.api(), data;
	 
				/*Remove the formatting to get integer data for summation  */
				var intVal = function ( i ) {
					return typeof i === 'string' ?
						i.replace(/[\$,]/g, '')*1 :
						typeof i === 'number' ?
							i : 0;
				};
	 			
				/*  Quantity total over all pages */
				quantityTotal = api
					.column( 6 )
					.data()
					.reduce( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0 );
	 				
				/* Quantity for current page */
				quantityFilteredTotal = api
					.column( 6, { page: 'current'} )
					.data()
					.reduce( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0 );
				
				/* Unit price total over all pages  */
				unitPriceTotal = api
					.column( 7 )
					.data()
					.reduce( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0 );
				
				/* Unit price for current page */
				unitPriceFilteredTotal = api
					.column( 7, { page: 'current'} )
					.data()
					.reduce( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0 );
					
				/* Full price total over all pages */
				fullPriceTotal = api
					.column( 8 )
					.data()
					.reduce( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0 );
				
				/* Full price for current page */
				fullPriceFilteredTotal = api
					.column( 8, { page: 'current'} )
					.data()
					.reduce( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0 );
	 			
				/* Update footer columns */
				$( api.column( 6 ).footer() ).html(quantityFilteredTotal +' ('+ quantityTotal +' total)');
				$( api.column( 7 ).footer() ).html(unitPriceFilteredTotal +' ('+ unitPriceTotal +' total)');
				$( api.column( 8 ).footer() ).html(fullPriceFilteredTotal +' ('+ fullPriceTotal +' total)');
			}
		});
	});
}

/* Function to create reports datatables for sale */
function reportsSaleTableCreator(tableContainerDiv, tableCreatorFileUrl, table){
	var tableContainerDivID = '#' + tableContainerDiv;
	var tableID = '#' + table;
	$(tableContainerDivID).load(tableCreatorFileUrl, function(){
		
		/* Initiate the Datatable plugin once the table is added to the DOM */
		$(tableID).DataTable({
			dom: 'lBfrtip',
			buttons: [
				'copy',
				{extend: 'csv', footer: true, title: 'Sale Report'},
				{extend: 'excel', footer: true, title: 'Sale Report'},
				{extend: 'pdf', footer: true, orientation: 'landscape', pageSize: 'LEGAL', title: 'Sale Report'},
				{extend: 'print', footer: true, title: 'Sale Report'},
			],
			"footerCallback": function ( row, data, start, end, display ) {
				var api = this.api(), data;
	 
				/* Remove the formatting to get integer data for summation */
				var intVal = function ( i ) {
					return typeof i === 'string' ?
						i.replace(/[\$,]/g, '')*1 :
						typeof i === 'number' ?
							i : 0;
				};
	
				/* Quantity Total over all pages */
				quantityTotal = api
					.column( 7 )
					.data()
					.reduce( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0 );
	 				
				/* Quantity Total over this page */
				quantityFilteredTotal = api
					.column( 7, { page: 'current'} )
					.data()
					.reduce( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0 );
			
				/* Unit price Total over all pages*/
				unitPriceTotal = api
					.column( 8 )
					.data()
					.reduce( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0 );
				
				/* Unit price total over current page */
				unitPriceFilteredTotal = api
					.column( 8, { page: 'current'} )
					.data()
					.reduce( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0 );

				/* Full price Total over all pages*/
				fullPriceTotal = api
					.column( 9 )
					.data()
					.reduce( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0 );
				/* Full price total over current page */
				fullPriceFilteredTotal = api
					.column( 9, { page: 'current'} )
					.data()
					.reduce( function (a, b) {
						return intVal(a) + intVal(b);
					}, 0 );
	 
				/* Update footer columns*/
				$( api.column( 7 ).footer() ).html(quantityFilteredTotal +' ('+ quantityTotal +' total)');
				$( api.column( 8 ).footer() ).html(unitPriceFilteredTotal +' ('+ unitPriceTotal +' total)');
				$( api.column( 9 ).footer() ).html(fullPriceFilteredTotal +' ('+ fullPriceTotal +' total)');
			}
		});
	});
}

/* Function to create filtered datatable for sale details with total values */
function filteredSaleReportTableCreator(startDate, endDate, scriptPath, tableDIV, tableID){
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
			/* Initiate the Datatable plugin once the table is added to the DOM */
			$('#' + tableID).DataTable({
				dom: 'lBfrtip',
				buttons: [
					'copy',
					{extend: 'csv', footer: true, title: 'Sale Report'},
					{extend: 'excel', footer: true, title: 'Sale Report'},
					{extend: 'pdf', footer: true, orientation: 'landscape', pageSize: 'LEGAL', title: 'Sale Report'},
					{extend: 'print', footer: true, title: 'Sale Report'},
				],
				"footerCallback": function ( row, data, start, end, display ) {
					var api = this.api(), data;
		 
					/* Remove the formatting to get integer data for summation */
					var intVal = function ( i ) {
						return typeof i === 'string' ?
							i.replace(/[\$,]/g, '')*1 :
							typeof i === 'number' ?
								i : 0;
					};
		 
					/* Total over all pages */
					quantityTotal = api
						.column( 7 )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
		 
					/* Total over this page */
					quantityFilteredTotal = api
						.column( 7, { page: 'current'} )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
					
					/* Total over all pages */
					unitPriceTotal = api
						.column( 8 )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
					
					/* Quantity total */
					unitPriceFilteredTotal = api
						.column( 8, { page: 'current'} )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
						
					/* Full total over all pages */
					fullPriceTotal = api
						.column( 9 )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
					
					/* Full total over current page */
					fullPriceFilteredTotal = api
						.column( 9, { page: 'current'} )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
		 
					/* Update footer columns */
					$( api.column( 7 ).footer() ).html(quantityFilteredTotal +' ('+ quantityTotal +' total)');
					$( api.column( 8 ).footer() ).html(unitPriceFilteredTotal +' ('+ unitPriceTotal +' total)');
					$( api.column( 9 ).footer() ).html(fullPriceFilteredTotal +' ('+ fullPriceTotal +' total)');
				}
			});
		}
	});
}

/* Function to create filtered datatable for purchase details with total values */
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
			/* Initiate the Datatable plugin once the table is added to the DOM */
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
		 
					/* Remove the formatting to get integer data for summation */
					var intVal = function ( i ) {
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
					quantityFilteredTotal = api
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
					unitPriceFilteredTotal = api
						.column( 7, { page: 'current'} )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
					
					/* Full price total over all pages */
					fullPriceTotal = api
						.column( 8 )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
					
					/* Full price for current page */
					fullPriceFilteredTotal = api
						.column( 8, { page: 'current'} )
						.data()
						.reduce( function (a, b) {
							return intVal(a) + intVal(b);
						}, 0 );
		 
					/*Update footer columns  */
					$( api.column( 6 ).footer() ).html(quantityFilteredTotal +' ('+ quantityTotal +' total)');
					$( api.column( 7 ).footer() ).html(unitPriceFilteredTotal +' ('+ unitPriceTotal +' total)');
					$( api.column( 8 ).footer() ).html(fullPriceFilteredTotal +' ('+ fullPriceTotal +' total)');
				}
			});
		}
	});
}

/* Calculate Total Purchase value in purchase details tab */
function calculatePurchaseTotal(){
	var purQuantity = $('#purchaseQuantity').val();
	var purUnitPrice = $('#purchaseUnitPrice').val();
	$('#purchaseTotal').val(Number(purQuantity) * Number(purUnitPrice));
}

/* Calculate Total sale value in sale details tab */
function calculateSaleTotal(){
	var saleQuantity = $('#saleQuantity').val();
	var saleUnitPrice = $('#saleUnitPrice').val();
	var saleDiscount = $('#saleDiscount').val();
	$('#saleTotal').val(Number(saleUnitPrice) * ((100 - Number(saleDiscount)) / 100) * Number(saleQuantity));
}

/* call insertCustomer insert customer data into Database */
function addCustomer() {
	var custFullName = $('#customerFullName').val();
	var custEmail = $('#customerEmail').val();
	var custMobile = $('#customerMobile').val();
	var custPhone = $('#customerPhone').val();
	var custAddress = $('#customerAddress').val();
	var custAddress2 = $('#customerAddress2').val();
	var custCity = $('#customerCity').val();
	var custDistrict = $('#customerDistrict option:selected').text();
	var custStatus = $('#customerStatus option:selected').text();
	
	$.ajax({
		url: 'model/customer/insertCustomer.php',
		method: 'POST',
		data: {
			custFullName:custFullName,
			custEmail:custEmail,
			custMobile:custMobile,
			custPhone:custPhone,
			custAddress:customerAddress,
			custAddress2:custAddress2,
			custCity:custCity,
			custDistrict:custDistrict,
			custStatus:custStatus,
		},
		success: function(data){
			$('#customerMessage').fadeIn();
			$('#customerMessage').html(data);
		},
		complete: function(data){
			populateLastInserted(customerLastInsertedFile,'customerID');
			searchTableCreator('customerSearchTableDiv', customerSearchTableCreatorFile, 'customerSearchTable');
			reportsTableCreator('customerReportTableDiv', customerReportTableCreatorFile, 'customerReportTable');
		}
	});
}


/* call function add vendor */
function addVendor() {
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
		url: 'model/vendor/insertVendor.php',
		method: 'POST',
		data: {
			venFullName:venFullName,
			venEmail:venEmail,
			venMobile:venMobile,
			venPhone:venPhone,
			venAddress:venAddress,
			venAddress2:venAddress2,
			venVendorCity:venCity,
			venDistrict:venDistrict,
			venStatus:venStatus,
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


/* call insert item , get item and show data */
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
			getItemStockToPopulate('itemNumber', getItemStockFile, itemTotalStock);
			searchTableCreator('itemSearchTableDiv', itemSearchTableCreatorFile, 'itemSearchTable');
			reportTableCreator('itemReportTableDiv', itemReportTableCreatorFile, 'itemReportTable');
		}
	});
}


/* call insert purchase , get and show data */
function addPurchase() {
	var purchItemNumber = $('#purchaseItemNumber').val();
	var purchDate = $('#purchaseDate').val();
	var purchItemName = $('#purchaseItemName').val();
	var purchQuantity = $('#purchaseQuantity').val();
	var purchUnitPrice = $('#purchaseUnitPrice').val();
	var purchVendorName = $('#purchaseVendorName').val();
	
	$.ajax({
		url: 'model/purchase/insertPurchase.php',
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
			getPopulateItemStock('purchaseItemNumber',getItemStockFile, 'purchaseCurrentStock');
			populateLastInserted(purchaseLastInsertedFile, 'purchaseID');
			searchTableCreator('purchaseSearchTableDiv', purchaseSearchTableCreatorFile, 'purchaseSearchTable');
			reportsPurchaseTableCreator('purchasReportTableDiv', purchaseReportTableCreatorFile, 'purchaseReportsTable');
			searchTableCreator('itemSearchTableDiv', itemSearchTableCreatorFile, 'itemSearchTable');
			reportsTableCreator('itemReportTableDiv', itemReportTableCreatorFile, 'itemReportTable');
		}
	});
}


/* function call insertSale, get and report sale */
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

function getPopulateItem(){
	// Get the itemNumber entered in the text box
	var itemNumber = $('#itemNumber').val();
	var defaultImgUrl = 'data/item_images/imageNotAvailable.jpg';
	var defaultImageData = '<img class="img-fluid" src="data/item_images/imageNotAvailable.jpg">';
	
	/* call populateItem for get item object */
	$.ajax({
		url: 'model/item/populateItem.php',
		method: 'POST',
		data: {itemNumber:itemNumber},
		dataType: 'json',
		success: function(data){
			$('#itemProductID').val(data.productID);
			$('#itemName').val(data.itemName);
			$('#itemDiscount').val(data.discount);
			$('#itemTotalStock').val(data.stock);
			$('#itemUnitPrice').val(data.unitPrice);
			$('#itemDescription').val(data.description);
			$('#itemStatus').val(data.status).trigger("chosen:updated");

			newImgUrl = 'data/item_images/' + data.itemNumber + '/' + data.imageURL;
			
			/* set item image */
			if(data.imageURL == 'imageNotAvailable.jpg' || data.imageURL == ''){
				$('#imageContainer').html(defaultImageData);
			} else {
				$('#imageContainer').html('<img class="img-fluid" src="' + newImgUrl + '">');
			}
		}
	});
}



function getPopulateItemForSale(){
	/* get itemNumber from textbox saleItemNumber  */
	var itemNumber = $('#saleItemNumber').val();
	var defaultImgUrl = 'data/item_images/imageNotAvailable.jpg';
	var defaultImageData = '<img class="img-fluid" src="data/item_images/imageNotAvailable.jpg">';
	
	/* get item object for sale  */
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
			
			/* set item image */
			if(data.imageURL == 'imageNotAvailable.jpg' || data.imageURL == ''){
				$('#saleImageContainer').html(defaultImageData);
			} else {
				$('#saleImageContainer').html('<img class="img-fluid" src="' + newImgUrl + '">');
			}
		},
		complete: function() {
			calculateSaleTotal();
		}
	});
}

function getItemName(itemNumberTextBoxID, scriptPath, itemNameTextbox){

	/* get itemNumber form textbox  */
	var itemNumber = $('#' + itemNumberTextBoxID).val();

	/* get item object by scriptPath */
	$.ajax({
		url: scriptPath,
		method: 'POST',
		data: {itemNumber:itemNumber},
		dataType: 'json',
		/* get itemName */
		success: function(data){
			$('#' + itemNameTextbox).val(data.itemName);
		},
		error: function (xhr, ajaxOptions, thrownError) {
      }
	});
}

function getPopulateItemStock(itemNumberTextbox, scriptPath, stockTextbox){
	/* get itemNumber from text box  */
	var itemNumber = $('#' + itemNumberTextbox).val();
	
	/* get item object  by itemNumber */
	$.ajax({
		url: scriptPath,
		method: 'POST',
		data: {itemNumber:itemNumber},
		dataType: 'json',
		success: function(data){
			$('#' + stockTextbox).val(data.stock);
		},
		error: function (xhr, ajaxOptions, thrownError) {
        
      }
	});
}

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

function showAdvise(textBoxID, scriptPath, suggestionsDivID){
	/* get value from textbox value */
	var textBoxValue = $('#' + textBoxID).val();
	
	if(textBoxValue != ''){
		$.ajax({
			url: scriptPath,
			method: 'POST',
			data: {textBoxValue:textBoxValue},
			success: function(data){
				$('#' + adviseDivID).fadeIn();
				$('#' + adviseDivID).html(data);
			}
		});
	}
}

function deleteItem(){
	/* get itemNumber */
	var itemNumber = $('#itemNumber').val();
	
	/* call delete item object by itemNumber */
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
				reportsTableCreator('itemReportTableDiv', itemReportTableCreatorFile, 'itemReportTable');
			}
		});
	}
}

function deleteCustomer(){
	/* get customerID form textbox */
	var customerDetailsCustomerID = $('#customerID').val();
	
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
				reportTableCreator('customerReportTableDiv', customerReportTableCreatorFile, 'customerReportTable');
			}
		});
	}
}

function deleteVendor(){
	/* get vendorID from textbox */
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
				searchTableCreator('vendorSearchTableDiv', vendorSearchTableCreatorFile, 'vendorSearchTable');
				reportTableCreator('vendorReportTableDiv', vendorReportTableCreatorFile, 'vendorReportTable');
			}
		});
	}
}

/* function get object from database  */
function getPopulateCustomer(){
	/* get customerID from textbox */
	var customerID = $('#customerID').val();
	
	$.ajax({
		url: 'model/customer/populateCustomer.php',
		method: 'POST',
		data: {customerID:customerID},
		dataType: 'json',
		/* get customer object turn back form database */
		success: function(data){
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

function getPopulateCustomer(){
	/* get saleCustomerID from  textbox */
	var customerID = $('#saleCustomerID').val();
	
	$.ajax({
		url: 'model/customer/populateCustomer.php',
		method: 'POST',
		data: {customerID:customerID},
		dataType: 'json',
		/* get data object  turn back from database */
		success: function(data){
			$('#saleCustomerName').val(data.fullName);
		}
	});
}

function getPopulateVendor(){
	/* get vendorId from text box */
	var vendorID = $('#vendorID').val();
	
	$.ajax({
		url: 'model/vendor/populateVendor.php',
		method: 'POST',
		data: {vendorID:vendorID},
		dataType: 'json',
		/* get vendor object turn back from database */
		success: function(data){
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

function getPopulatePurchase(){
	/* get purchaseID from text box */
	var purchaseID = $('#purchaseID').val();
	
	$.ajax({
		url: 'model/purchase/populatePurchase.php',
		method: 'POST',
		data: {purchaseID:purchaseID},
		dataType: 'json',
		/* get purchase object turn back from database */
		success: function(data){
			$('#purchaseItemNumber').val(data.itemNumber);
			$('#purchaseDate').val(data.purchaseDate);
			$('#purchaseItemName').val(data.itemName);
			$('#purchaseQuantity').val(data.quantity);
			$('#purchaseUnitPrice').val(data.unitPrice);
			$('#purchaseVendorName').val(data.vendorName).trigger("chosen:updated");
		},
		complete: function(){
			calculatePurchaseTotal();
			getPopulateItemStock('purchaseItemNumber', getItemStockFile, 'purchaseCurrentStock');
		}
	});
}

function getPopulateSale(){
	/* get saleID from text box */
	var saleID = $('#saleID').val();
	
	$.ajax({
		url: 'model/sale/populateSale.php',
		method: 'POST',
		data: {saleID:saleID},
		dataType: 'json',
		/* get sale object turn back form database */
		success: function(data){
			$('#saleItemNumber').val(data.itemNumber);
			$('#saleCustomerID').val(data.customerID);
			$('#saleCustomerName').val(data.customerName);
			$('#saleItemName').val(data.itemName);
			$('#saleSaleDate').val(data.saleDate);
			$('#saleDiscount').val(data.discount);
			$('#saleQuantity').val(data.quantity);
			$('#saleUnitPrice').val(data.unitPrice);
		},
		complete: function(){
			calculateSaleTotal();
			getPopulateItemStock('saleItemNumber', getItemStockFile, 'saleTotalStock');
		}
	});
}

/* function update database */
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
			searchTableCreator('itemSearchTableDiv', itemSearchTableCreatorFile, 'itemSearchTable');			
			searchTableCreator('purchaseSearchTableDiv', purchaseSearchTableCreatorFile, 'purchaseSearchTable');
			searchTableCreator('saleDetailsTableDiv', saleSearchTableCreatorFile, 'saleSearchTable');
			reportsTableCreator('itemReportTableDiv', itemReportTableCreatorFile, 'itemReportTable');
			reportPurchaseTableCreator('purchaseReportTableDiv', purchaseReportTableCreatorFile, 'purchaseReportTable');
			reportSaleTableCreator('saleReportTableDiv', saleReportTableCreatorFile, 'saleReportTable');
		}
	});
}

/* update customer in database */
function updateCustomer() {
	var customerID = $('#customerID').val();
	var customerFullName = $('#customerFullName').val();
	var customerMobile = $('#customerMobile').val();
	var customerPhone = $('#customerPhone').val();
	var customerAddress = $('#customerAddress').val();
	var customerEmail = $('#customerEmail').val();
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
			customerPhone:customerPhone,
			customerAddress:customerAddress,
			customerEmail:customerEmail,
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
			reportTableCreator('customerReportTableDiv', customerReportTableCreatorFile, 'customerReportTable');
			searchTableCreator('saleSearchTableDiv', saleSearchTableCreatorFile, 'saleSearchTable');
			reportSaleTableCreator('saleReportTableDiv', saleReportTableCreatorFile, 'saleReportTable');
		}
	});
}

/* update vendor in database */
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
			reportsPurchaseTableCreator('purchaseReportTableDiv', purchaseReportTableCreatorFile, 'purchaseReportTable');
			reportsTableCreator('vendorReportTableDiv', vendorReportTableCreatorFile, 'vendorReportTable');
		}
	});
}
/* update purchase in DB */
function updatePurchase() {
	var purchaseItemNumber = $('#purchaseItemNumber').val();
	var purchaseDate = $('#purchaseDate').val();
	var purchaseItemName = $('#purchaseItemName').val();
	var purchaseQuantity = $('#purchaseQuantity').val();
	var purchaseUnitPrice = $('#purchaseUnitPrice').val();
	var purchaseID = $('#purchaseID').val();
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
			$('#purchaseDetailsMessage').fadeIn();
			$('#purchaseDetailsMessage').html(data);
		},
		complete: function(){
			getPopulateItemStock('purchaseItemNumber', getItemStockFile, 'purchaseCurrentStock');
			searchTableCreator('purchaseSearchTableDiv', purchaseSearchTableCreatorFile, 'purchaseSearchTable');
			reportPurchaseTableCreator('purchaseReportTableDiv', purchaseReportTableCreatorFile, 'purchaseReportTable');
			searchTableCreator('itemSearchTableDiv', itemSearchTableCreatorFile, 'itemSearchTable');
			reportTableCreator('itemReportTableDiv', itemReportTableCreatorFile, 'itemReportTable');
		}
	});
}

/* update Sale in DB */
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
			getPopulateItemStock('saleItemNumber', getItemStockFile, 'saleTotalStock');
			searchTableCreator('saleSearchTableDiv', saleSearchTableCreatorFile, 'saleSearchTable');
			reportSaleTableCreator('saleReportTableDiv', saleReportTableCreatorFile, 'saleReportTable');
			searchTableCreator('itemSearchTableDiv', itemSearchTableCreatorFile, 'itemReportTable');
			reportTableCreator('itemReportTableDiv', itemReportTableCreatorFile, 'itemReportTable');
		}
	});
}



