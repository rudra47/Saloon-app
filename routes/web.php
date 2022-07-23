<?php

use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\MoneyReceiver\MoneyReceiverController;
use App\Http\Controllers\Admin\MoneyReceiver\PaymentMethodController;
use App\Http\Controllers\Admin\Offer\OfferController;
use App\Http\Controllers\Admin\Package\PackageController;
use App\Http\Controllers\Admin\Package\PackageProductController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Roles\RolesController;
use App\Http\Controllers\Admin\Roles\RoleAssignController;
use App\Http\Controllers\Admin\Store\StoreController;
use App\Http\Controllers\Admin\Tag\TagController;
use App\Http\Controllers\Admin\Slider\SliderController;
use App\Http\Controllers\Admin\Ticket\TicketController;
use App\Http\Controllers\Admin\Coupon\CouponController;
use App\Http\Controllers\Admin\Configuration\ConfigurationController;
use App\Http\Controllers\Admin\MoneyReceiver\ConditionalMoneyReceiverController;
use App\Http\Controllers\Admin\MoneyReceiver\WuReceiverController;
use App\Http\Controllers\Admin\MoneyReceiver\MgReceiverController;
use App\Http\Controllers\Admin\MoneyReceiver\BtcReceiverController;

//INVENTORY CONTROLLERS
use App\Http\Controllers\Admin\Inventory\Shipper\ShipperController;
use App\Http\Controllers\Admin\Inventory\StockManagement\StockManagementController;
use App\Http\Controllers\Admin\Inventory\LabelManagement\LabelManagementController;
use App\Http\Controllers\Admin\Inventory\ActivityLog\ActivityLogController;
use App\Http\Controllers\Admin\Inventory\OrderManagement\OrderManagementController;
use App\Http\Controllers\Admin\Inventory\StockManagement\PostageManagementController;

//SHIPPER CONTROLLERS
use App\Http\Controllers\Shipper\ShipperOrderController;
use App\Http\Controllers\Shipper\Product\ShipperProductController;
use App\Http\Controllers\Shipper\Product\ShipperProductLabelController;
use App\Http\Controllers\Shipper\ShipperProductStatusController;
use App\Http\Controllers\Shipper\ShipperActivityLogController;
use App\Http\Controllers\Shipper\ShipperPostageController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);
// DASHBOARD
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('admin')->group(function () {
    Route::prefix('admin')->as('admin.')->group(function () {
        Route::prefix('orders')->as('orders.')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('index');
            Route::get('/view-order/{order_no}', [OrderController::class, 'viewOrder'])->name('viewOrder');
            Route::get('/edit-order/{order_no}', [OrderController::class, 'editOrder'])->name('editOrder');
            Route::get('/set-tracking-no/{order_no}', [OrderController::class, 'setTrackingNo'])->name('setTrackingNo');
            Route::post('/set-tracking-no-store/{order_no}', [OrderController::class, 'setTrackingNoStore'])->name('setTrackingNoStore');
            Route::delete('/remove-product/{cart_item_id}/{order_id}', [OrderController::class, 'removeProduct'])->name('removeProduct');
            Route::post('/status-update-action/{order_id}', [OrderController::class, 'updateStatusAction'])->name('updateStatusAction');
            Route::post('/coupon-action/{order_no}', [OrderController::class, 'couponAction'])->name('couponAction');
            Route::post('/update-order/{order_no}', [OrderController::class, 'updateOrder'])->name('updateOrder');
            Route::post('/add-product-action/{order_id}', [OrderController::class, 'addProductAction'])->name('addProductAction');
            Route::post('/add-product-action/{order_id}', [OrderController::class, 'addProductAction'])->name('addProductAction');
            Route::post('/update-quantity/{order_id}/{product_id}', [OrderController::class, 'quantityUpdate'])->name('quantityUpdate');
            Route::post('/order-type-update/{order_id}', [OrderController::class, 'orderTypeUpdate'])->name('orderTypeUpdate');
        });
        // ROLES
        Route::resource('/roles', RolesController::class);
        // ROLES ASSIGN
        Route::resource('/roleAssign', RoleAssignController::class);
        // STORES
        Route::resource('/stores', StoreController::class);
        // CATEGORIES
        Route::resource('/categories', CategoryController::class);
        // PACKAGES
        Route::resource('/packages', PackageController::class);
        // PRODUCTS
        Route::resource('/products', ProductController::class);
        //MONEY RECEIVERS
        Route::prefix('money-receivers')->as('money-receivers.')->group(function () {
            Route::resource('/', MoneyReceiverController::class);
            //CONDITIONAL MONEY RECEIVERS
            Route::get('/set-limit', [ConditionalMoneyReceiverController::class, 'setLimit'])->name('setLimit');
            Route::post('/set-limit-store', [ConditionalMoneyReceiverController::class, 'setLimitStore'])->name('setLimitStore');
            //WU RECEIVERS
            Route::get('/wu-receivers', [WuReceiverController::class, 'wuReceivers'])->name('wuReceivers');
            //MG RECEIVERS
            Route::get('/mg-receivers', [MgReceiverController::class, 'mgReceivers'])->name('mgReceivers');
            //BTC RECEIVERS
            Route::get('/btc-receivers', [BtcReceiverController::class, 'btcReceivers'])->name('btcReceivers');
        });
        //PAYMENT METHODS
        Route::resource('/payment-methods', PaymentMethodController::class)->only('index', 'edit', 'update');
        Route::get('/payment-method/change-status/{id}', [PaymentMethodController::class, 'changeStatus'])->name('payment-method.change-status');
        // TAGS
        Route::resource('/tags', TagController::class);
        // PACKAGE PRODUCTS
        Route::resource('/package-products', PackageProductController::class);
        // OFFERS
        Route::resource('/offers', OfferController::class);
        Route::get('/offer-active/{id}', [OfferController::class, 'active'])->name('offer.active');
        Route::get('/offer-inactive/{id}', [OfferController::class, 'inactive'])->name('offer.inactive');
        // SLIDERS
        Route::resource('/sliders', SliderController::class);
        // TICKETS
        Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
        Route::get('/tickets/reply/{ticket_id}', [TicketController::class, 'reply'])->name('tickets.reply');
        Route::post('/tickets/reply/{ticket_id}', [TicketController::class, 'replyStore'])->name('tickets.replyStore');
        Route::get('/tickets/close/{token}', [TicketController::class, 'ticketClose'])->name('tickets.ticketClose');
        // COUPON
        Route::resource('/coupons', CouponController::class);
        //CONFIGURATION
        Route::get('/configuration/create', [ConfigurationController::class, 'create'])->name('configurations.create');
        Route::post('/configuration/update', [ConfigurationController::class, 'update'])->name('configurations.update');
    });

    //INVENTORY
    Route::prefix('admin/inventory')->as('admin.inventory.')->group(function () {
        //SHIPPER
        Route::resource('/shippers', ShipperController::class);
        //STOCK-MANAGEMENT
        Route::prefix('stock-management')->as('stockManagement.')->group(function () {
            Route::get('/', [StockManagementController::class, 'index'])->name('index');
            Route::get('/product-manage', [StockManagementController::class, 'productManage'])->name('productManage');
            Route::post('/product-manage-store', [StockManagementController::class, 'productManageStore'])->name('productManageStore');
            Route::get('/label-manage', [StockManagementController::class, 'labelManage'])->name('labelManage');
            Route::post('/label-manage-store', [StockManagementController::class, 'labelManageStore'])->name('labelManageStore');
        });
        Route::prefix('postage-management')->as('postageManagement.')->group(function () {
            Route::get('/', [PostageManagementController::class, 'index'])->name('index');
            Route::get('/manage/{shipper_user_id}', [PostageManagementController::class, 'manage'])->name('manage');
            Route::post('/manage-action/{shipper_user_id}', [PostageManagementController::class, 'manageAction'])->name('manageAction');
        });
        //ORDER-MANAGEMENT
        Route::prefix('order-management')->as('orderManagement.')->group(function () {
            Route::get('/', [OrderManagementController::class, 'index'])->name('index');
            Route::get('/view-order/{order_no}', [OrderManagementController::class, 'viewOrder'])->name('viewOrder');
            Route::get('/set-shipper/{order_no}', [OrderManagementController::class, 'setShipper'])->name('setShipper');
            Route::post('/set-shipper-action/{order_id}', [OrderManagementController::class, 'setShipperAction'])->name('setShipperAction');
            Route::get('/re-assign-shipper/{order_no}', [OrderManagementController::class, 'reAssignShipper'])->name('reAssignShipper');
            Route::post('/re-assign-shipper-action/{order_no}', [OrderManagementController::class, 'reAssignShipperAction'])->name('reAssignShipperAction');
            Route::get('/shipper-history/{order_no}', [OrderManagementController::class, 'shipperHistory'])->name('shipperHistory');
            Route::get('/add-free-bio/{order_id}', [OrderManagementController::class, 'addFreeBio'])->name('addFreeBio');
            Route::post('/free-bio/{order_id}', [OrderManagementController::class, 'freeBio'])->name('freeBio');
            Route::get('/delete-product/{sell_id}/{order_id}', [OrderManagementController::class, 'deleteProduct'])->name('deleteProduct');
            Route::delete('/delete-product/{sell_id}/{order_id}', [OrderManagementController::class, 'deleteProductAction'])->name('deleteProductAction');
        });
        //ACTIVITY LOG
        Route::prefix('activity-log')->as('activityLog.')->group(function () {
            Route::get('/product-activity', [ActivityLogController::class, 'productActivity'])->name('productActivity');
            Route::get('/label-activity', [ActivityLogController::class, 'labelActivity'])->name('labelActivity');
            Route::get('/postage-activity', [ActivityLogController::class, 'postageActivity'])->name('postageActivity');
        });
    });
});

Route::middleware('shipper')->group(function () {
    Route::prefix('shipper')->as('shipper.')->group(function () {
        Route::prefix('orders')->as('orders.')->group(function () {
            Route::get('/', [ShipperOrderController::class, 'index'])->name('index');
            Route::get('/view-order/{orderAssignId}', [ShipperOrderController::class, 'viewOrder'])->name('viewOrder');
            Route::post('/delivery-order/{order_assign_id}', [ShipperOrderController::class, 'deliveryOrder'])->name('deliveryOrder');
        });
        Route::get('/products', [ShipperProductController::class, 'index'])->name('products.index');
        Route::get('/product-labels', [ShipperProductLabelController::class, 'index'])->name('productLabel.index');
        Route::get('/postage', [ShipperPostageController::class, 'postage'])->name('postage');
        Route::get('/product-status', [ShipperProductStatusController::class, 'index'])->name('productStatus');
        Route::get('/activity-log', [ShipperActivityLogController::class, 'index'])->name('activityLog');
    });
});

