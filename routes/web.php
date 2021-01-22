<?php

use Illuminate\Support\Facades\Route;
Route::get('/mail', 'MailController@Test');
Route::get('/test', 'ProjectAccount@test');

Route::get('/ipl', 'PagesController@ipl');
Route::get('/football', 'PagesController@football');

Auth::routes();
Route::get('/', 'PagesController@index')->name('dashboard');
Route::get('/cash/detail', 'DashboardController@Balance')->name('dash.detail');
Route::post('/cash/detail', 'DashboardController@ProcessModal')->name('dash.detail');

Route::group(['prefix' => 'project'], function(){
    Route::get('/', 'ProjectController@index')->name('project.index');
    Route::get('/delevery', 'ProjectController@DeleveryIndex')->name('project.delevery'); 
    Route::get('/account/{id}', 'ProjectAccount@Account')->name('project.account'); 
    Route::get('/bill/{id}', 'ProjectAccount@BillDetail')->name('project.bill.detail'); 
    
    //ajax
    Route::post('/StoreProject', 'ProjectController@StoreProject')->name('project.store');
    Route::get('/ProjectList', 'ProjectController@ProjectList')->name('project.list');
    Route::post('/ProjectInformation', 'ProjectController@InfoById')->name('project.details'); 
    Route::post('/ProjectUpdate', 'ProjectController@UpdateProject')->name('project.update'); 
    Route::post('/ProjectStoreSell', 'ProjectController@StoreSell')->name('project.sell'); 
    Route::post('/CheckProject', 'ProjectController@CheckProject')->name('project.delevery.checkId'); 
    Route::post('/ProjectInfo', 'ProjectController@ProjectInfo')->name('project.delevery.cinfo'); 
    Route::post('/ProjectProducts', 'ProjectController@ProjectProducts')->name('project.delevery.products'); 
    Route::post('/StoreDelevery', 'ProjectController@StoreDelevery')->name('project.delevery.store'); 
    Route::post('/DeleveryTable', 'ProjectController@DeleveryTable')->name('project.delevery.table'); 
    Route::post('/CheckDate', 'ProjectAccount@CheckDate')->name('project.account.dates'); 
    Route::post('/StoreBill', 'ProjectAccount@StoreBill')->name('project.bill.store'); 
    Route::post('/BillsTable', 'ProjectAccount@BillsTable')->name('project.account.bills'); 
    Route::post('/SuggestDate', 'ProjectAccount@SuggestDate')->name('project.account.firstDate'); 
    Route::post('/storePayment', 'ProjectAccount@StorePayment')->name('project.account.storePayment'); 
    Route::post('/PaymentTable', 'ProjectAccount@PaymentTable')->name('project.account.payments'); 
    Route::post('/AdvanceTable', 'ProjectAccount@AdvanceTable')->name('project.account.advances'); 
    Route::post('/storeAdvance', 'ProjectAccount@storeAdvance')->name('project.account.storeAdvance'); 
    Route::post('/deleteBill', 'ProjectAccount@deleteBill')->name('project.bill.delete'); 
    Route::post('/DeleveryInfo', 'ProjectController@DeleveryInfo')->name('project.delevery.info'); 
    Route::post('/UpdateDelevery', 'ProjectController@UpdateDelevery')->name('project.delevery.update'); 
    Route::post('/DeleteDelevery', 'ProjectController@DeleteDelevery')->name('project.delevery.delete'); 
    Route::post('/PaymentInfo', 'ProjectBillController@PaymentInfo')->name('project.payment.info'); 
    Route::post('/UpdatePayment', 'ProjectBillController@UpdatePayment')->name('project.payment.update'); 
    Route::post('/DeletePayment', 'ProjectBillController@DeletePayment')->name('project.payment.delete'); 
    Route::post('/AdvanceDetail', 'ProjectBillController@AdvanceDetail')->name('project.advance.info'); 
    Route::post('/UpdateAdvance', 'ProjectBillController@UpdateAdvance')->name('project.advance.update'); 
    Route::post('/DeleteAdvance', 'ProjectBillController@DeleteAdvance')->name('project.advance.delete'); 
});
// sells section
Route::group(['prefix' => 'sell'], function () {
    Route::get('/', 'SellsController@insertSell')->name('sells.form');
    Route::get('/view-all', 'SellsController@viewAll')->name('sells.viewAll');
    Route::post('/newref', 'SellsController@NewReference')->name('new_ref');

    // ajax
    Route::post('/', 'SellsController@NewReference');
    Route::post('/processing', 'SellsController@store')->name('addSell');
    Route::post('/laskdjf', 'SellsController@LastSell')->name('lastsell');
});


// delevery section
Route::group(['prefix' => 'delevery'], function () {
    Route::get('/', 'DeleveryProductController@insertDelevery')->name('delivery.add');
    Route::get('/view-all', 'DeleveryProductController@viewAll')->name('delivery.viewAll');
    Route::post('/ChechRef', 'DeleveryProductController@ChechRef')->name('ChechRef');
    Route::post('/CustomerInfo', 'DeleveryProductController@deliveryNext')->name('deliveryNext');
    Route::post('/newDRef', 'DeleveryProductController@newDRef')->name('newDRef');
    Route::post('/SaveDelivery', 'DeleveryProductController@SaveDelivery')->name('SaveDelivery');
    Route::post('/DeliveryHistory', 'DeleveryProductController@DeliveryHistory')->name('delivery.table');
});

// due section
Route::group(['prefix' => 'due'], function () {
    Route::get('/', 'DuePayController@index')->name('due.add');
    Route::get('/view-all', 'DuePayController@show')->name('due.viewAll');
    Route::post('/CustomerDetail', 'DuePayController@CustomerDetail')->name('due.detail');
    Route::post('/SaveDue', 'DuePayController@SaveDue')->name('due.save');
    Route::post('/DuePayHistory', 'DuePayController@DuePayHistory')->name('due.table');
});


// cost section
Route::group(['prefix' => 'cost'], function () {
    Route::get('/', 'CostController@index')->name('cost.add');
    Route::post('/ProcessCost', 'CostController@create')->name('cost.create');
    Route::get('/view-today', 'CostController@showToday')->name('cost.viewToday');
    Route::get('/view-all', 'CostController@showAll')->name('cost.viewAll');
});

//submit cash
Route::group(['prefix' => 'submitCash'], function(){
    Route::post('/StoreSumitCash', 'SubmitCashController@store')->name('SubmitCash.store');
});

// outcash section
Route::group(['prefix' => 'outcash'], function () {
    Route::get('/', 'OutcashController@index')->name('outcash.add');
    Route::get('/view-all', 'OutcashController@showAll')->name('outcash.viewAll');
    Route::get('/pay', 'OutcashPaymentController@index')->name('outcash.payment.index');
    Route::post('/save', 'OutcashController@Store')->name('outcash.store');
});

// staff section
Route::group(['prefix' => 'staff'], function () {
    Route::get('/', 'StaffController@index')->name('staff.all');
    Route::get('/account/{id}', 'StaffController@accounts');
    Route::get('/payments', 'StaffController@payments')->name('staff.payments');
    Route::post('/StoreStaff', 'StaffController@store')->name('staff.store');
    Route::get('/GetStaffs', 'StaffController@DisplayTable')->name('staff.table');
    Route::post('/StoreStaffPayment', 'StaffPaymentController@store')->name('StaffPayment.store');
});

// dealer section
Route::group(['prefix' => 'dealers'], function () {
    Route::get('/', 'DealerController@index')->name('dealer.all');
    Route::get('/accounts/{id}', 'DealerController@accounts');
    Route::get('/payments', 'DealerController@payments')->name('dealer.payments');
    Route::post('/StoreDealer', 'DealerController@Store')->name('dealer.store');
    Route::get('/DealersList', 'DealerController@DealerTable')->name('dealer.table');
    // dealer payment routes
    Route::post('/DealerPaymentStore', 'DealerPaymentController@Store')->name('dealerPayment.store');
});

// worker section
Route::group(['prefix' => 'workers'], function () {
    Route::get('/', 'WorkersController@index')->name('worker.all');
    Route::get('/accounts/{id}', 'WorkerAccountController@index')->name('worker.account');
    Route::post('/StoreWorker', 'WorkersController@Store')->name('worker.store');
    Route::post('/UpdateWorker', 'WorkersController@UpdateWorker')->name('worker.edit');
    Route::post('/WorkerDetails', 'WorkersController@DetailsById')->name('worker.detail');
    Route::post('/attendaneStatus', 'WorkersController@attendaneStatus')->name('worker.attendaneStatus');
    Route::post('/storeAttendance', 'WorkersController@storeAttendance')->name('worker.storeAttendance');
    Route::get('/payments', 'WorkersController@payments')->name('worker.payments');
    Route::get('/WorkersList', 'WorkersController@WorkerList')->name('worker.table');
    Route::post('/WorkerPaymentStore', 'WorkerPaymentController@Store')->name('workerPayment.store');
    
    //ajax
    Route::post('/accountDetail', 'WorkerAccountController@accountDetail')->name('worker.accountDetail');
});

// party section
Route::group(['prefix' => 'party'], function () {
    Route::get('/', 'PartyController@index')->name('party.all');

    Route::get('/accounts/{id}', 'PartyController@accounts')->name('party.account');
    Route::get('/production', 'PartyController@production')->name('party.production');
    Route::get('/payments', 'PartyController@payment')->name('party.payments');
    
    Route::post('/partyStore', 'PartyController@Store')->name('party.store');
    Route::get('/partyList', 'PartyController@PartyList')->name('party.list');
    Route::post('/partyList', 'PartyController@PartyListSelect')->name('party.list.select');
    // party type 
    Route::get('/PartyTypes', "PartyTypeController@index")->name('party.party_type');
    Route::post('/PartyTypeStore', "PartyTypeController@Store")->name('partytype.store');
    Route::get('/PartyTypelist', "PartyTypeController@GetList")->name('partytype.list');
    Route::get('/PartyTypelist', "PartyTypeController@GetList")->name('partytype.list');
    Route::post('/PartyTypedata', "PartyTypeController@GetPartyData")->name('partytype.data');
    // party bill
    Route::post('/PartyBillStore', "PartyBillController@Store")->name('party.bill.store');
    // party payment
    Route::post('/PartyDailyAdvanceStore', "PartyDailyAdvanceController@Store")->name('party.daily_advance.store');
    
    // production
    Route::post('/StorePartyProduction', 'PartyProductionController@Store')->name('party.production.store');
    Route::post('/storepreload', 'PreloadController@Store')->name('party.preload.store');
    
    //account
    Route::post('/PartyDetails', 'PartyController@PartyDetails')->name('party.account.pdetail');
    Route::post('/PartyDetailsAfterBill', 'PartyController@PartyDetailsAfterBill')->name('party.account.pdAfterBill');
});

Route::group(['prefix' => 'item'],function (){
    Route::post('/rate', 'ItemController@Rate')->name('item.rate');
});

Route::group(['prefix' => 'users'],function (){
    Route::get('/', 'UserController@index')->name('users');
    Route::put('/', 'UserController@update');
});

Route::group(['prefix' => 'products'],function(){
    Route::get('/', 'ProductsController@index')->name('products');
    Route::post('/insert-product', 'ProductsController@store')->name('product.create');
    Route::get('/getProducts', 'ProductsController@ProductList')->name('product.list');
    Route::post('/getRate', 'ProductsController@Rate')->name('product.rate');
    Route::post('/ProductDetails', 'ProductsController@ProductDetails')->name('ProductDetails');

    Route::post('/editProduct', 'ProductsController@UpdateProduct')->name('UpdateProduct');
    Route::delete('/DeleteProduct', 'ProductsController@DeleteProduct')->name('DeleteProduct');
});

Route::get('/rules', 'RuleController@index')->name('rules');
Route::post('/rules', 'RuleController@store');
Route::put('/rules', 'RuleController@update');

Route::get('/permission','RuleController@permission')->name('permission');
Route::post('/permission', 'RuleController@createPermission');

Route::group(['prefix' => 'setting'], function(){
    Route::get('/', 'SettingController@index')->name('setting.index');
    Route::post('/user/update/date', 'SettingController@UpdateDate')->name('setting.date.update');
});

Route::group(['prefix' => 'Invoice'], function (){
    Route::get('/ProjectBill/{id}', 'InvoiceController@ProjectBill')->name('invoice.project');
    Route::get('/SellInvoice/{id}', 'InvoiceController@SellInvoice')->name('invoice.sell');
});

Route::group(['prefix' => 'notes'], function (){
    Route::get('/', 'NoteController@index');
    Route::post('/Store', 'NoteController@Store')->name('note.store');
    Route::get('/NoteList', 'NoteController@NotesTable')->name('note.list');
    Route::post('/NoteList', 'NoteController@getNote')->name('note.detail');
    Route::post('/update', 'NoteController@update')->name('note.update');
});

