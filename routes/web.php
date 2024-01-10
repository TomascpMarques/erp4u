<?php

use App\Http\Controllers\Actl\ProductController;
use App\Http\Controllers\Actl\SupplierController;
use App\Http\Controllers\Actl\FamiliesController;
use \App\Http\Controllers\Actl\TaxRatesController;
use App\Http\Controllers\Actl\PostalCodeController;
use App\Http\Controllers\Actl\UnitMeasureController;
use App\Http\Controllers\Actl\BarcodeReaderController;
use App\Http\Controllers\Actl\MonitorizacaoController;
use App\Http\Controllers\Actl\ParteleiraController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\EmailMiddleware;

/* Route::get('/', function () {
    return view('welcome');
});
 */

Route::controller(BarcodeReaderController::class)->group(function () {
    Route::get("/barcode/reader", "BarcodeReader")->name("barcode.reader");
})->middleware(['auth', 'verified']);

Route::controller(PostalCodeController::class)->group(function () {
    Route::get("/postalCode/all", "PostalCodeAll")->name("postalCodes.all");
    Route::get("/postalCode/add", "PostalCodeAdd")->name("postalCodes.add");
    Route::post("/postalCode/add", "PostalCodeStore")->name("postalCodes.store");
    Route::get("/postalCode/edit/{id}", "PostalCodeEdit")->name("postalCodes.edit");
    Route::post("/postalCode/update", "PostalCodeUpdate")->name("postalCodes.update");
    Route::get("/postalCode/delete/{id}", "PostalCodeDelete")->name("postalCodes.delete");
})->middleware(['auth', 'verified']);

Route::controller(SupplierController::class)->group(function () {
    Route::get("/supplier/all", "SupplierAll")->name("supplier.all");
    Route::get("/supplier/add", "SupplierAdd")->name("supplier.add");
    Route::post("/supplier/add", "SupplierStore")->name("supplier.store");
    Route::get("/supplier/edit/{id}", "SupplierEdit")->name("supplier.edit");
    Route::post("/supplier/update", "SupplierUpdate")->name("supplier.update");
    Route::get("/supplier/delete/{id}", "SupplierDelete")->name("supplier.delete");
})->middleware(['auth', 'verified']);

Route::controller(FamiliesController::class)->group(function () {
    Route::get("/products/families/all", "FamiliesAll")->name("families.all");
    Route::get("/products/families/add", "FamilyAdd")->name("families.add");
    Route::post("/products/families/add", "FamilyStore")->name("families.store");
    Route::get("/products/families/edit/{id}", "FamilyEdit")->name("families.edit");
    Route::post("/products/families/update", "FamilyUpdate")->name("families.update");
    Route::get("/products/families/delete/{id}", "FamiliesDelete")->name("families.delete");
})->middleware(['auth', 'verified']);

Route::controller(ProductController::class)->group(function () {
    Route::get("/products/all", "ProductsAll")->name("product.all");
    Route::get("/products/add", "ProductsAdd")->name("product.add");
    Route::post("/products/add", "ProductsStore")->name("product.store");
    Route::get("/products/edit/{id}", "ProductsEdit")->name("product.edit");
    Route::post("/products/update", "ProductsUpdate")->name("product.update");
    Route::get("/products/delete/{id}", "ProductsDelete")->name("product.delete");
    Route::get("/products/getOne/{id}", "ProductsGetOne")->name("product.getOne")->middleware(EmailMiddleware::class);
    Route::get("/products/sellOne/{id}", "ProductsSellOne")->name("product.sellOne")->middleware(EmailMiddleware::class);
    Route::get("/products/buy/{quantity}/{id}", "ProductsBuy")->name("product.buy")->middleware(EmailMiddleware::class);
})->middleware(['auth', 'verified']);

Route::controller(TaxRatesController::class)->group(function () {
    Route::get("/taxRates/all", "TaxRatesAll")->name("taxRates.all");
    Route::get("/taxRates/add", "TaxRatesAdd")->name("taxRates.add");
    Route::post("/taxRates/add", "TaxRatesStore")->name("taxRates.store");
    Route::get("/taxRates/edit/{id}", "TaxRatesEdit")->name("taxRates.edit");
    Route::post("/taxRates/update", "TaxRatesUpdate")->name("taxRates.update");
    Route::get("/taxRates/delete/{id}", "TaxRatesDelete")->name("taxRates.delete");
})->middleware(['auth', 'verified']);

Route::controller(UnitMeasureController::class)->group(function () {
    Route::get("/unitMeasures/all", "unitMeasuresAll")->name("unitMeasures.all");
    Route::get("/unitMeasures/add", "unitMeasuresAdd")->name("unitMeasures.add");
    Route::post("/unitMeasures/add", "unitMeasuresStore")->name("unitMeasures.store");
    Route::get("/unitMeasures/edit/{id}", "unitMeasuresEdit")->name("unitMeasures.edit");
    Route::post("/unitMeasures/update", "unitMeasuresUpdate")->name("unitMeasures.update");
    Route::get("/unitMeasures/delete/{id}", "unitMeasuresDelete")->name("unitMeasures.delete");
})->middleware(['auth', 'verified']);

Route::controller(ParteleiraController::class)->group(function () {
    Route::get("/parteleira/all", "parteleiraAll")->name("parteleira.all");
    Route::get("/parteleira/add", "parteleiraAdd")->name("parteleira.add");
    Route::post("/parteleira/add", "parteleiraStore")->name("parteleira.store");
    Route::get("/parteleira/edit/{id}", "parteleiraEdit")->name("parteleira.edit");
    Route::post("/parteleira/update", "parteleiraUpdate")->name("parteleira.update");
    Route::get("/parteleira/delete/{id}", "parteleiraDelete")->name("parteleira.delete");
})->middleware(['auth', 'verified']);

Route::controller(MonitorizacaoController::class)->group(function () {
    Route::get("/monitor/all", "MonitorAll")->name("monitor.all");
    Route::get("/monitor/add", "MonitorAdd")->name("monitor.add");
    Route::post("/monitor/add", "MonitorStore")->name("monitor.store");
    Route::get("/monitor/edit/{id}", "MonitorEdit")->name("monitor.edit");
    Route::post("/monitor/update", "MonitorUpdate")->name("monitor.update");
    Route::get("/monitor/delete/{id}", "MonitorDelete")->name("monitor.delete");
})->middleware(['auth', 'verified']);

// Admin All Route
Route::controller(AdminController::class)->group(function () {
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'Profile')->name('admin.profile');
    Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
    Route::post('/store/profile', 'StoreProfile')->name('store.profile');
    Route::get('/change/password', 'ChangePassword')->name('change.password');
    Route::post('/update/password', 'UpdatePassword')->name('update.password');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');
require __DIR__ . '/auth.php';
