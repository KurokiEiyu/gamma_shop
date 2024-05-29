<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Login;
use App\Http\Controllers\Admin\Logout;
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\Customer;
use App\Http\Controllers\Admin\Seller;
use App\Http\Controllers\Admin\Product;
use App\Http\Controllers\Admin\Category;
use App\Http\Controllers\Admin\AdminAccount;
use App\Http\Controllers\Admin\DepositList;
use App\Http\Controllers\Admin\Rekening;
use App\Http\Controllers\Admin\WithdrawList;
use App\Http\Controllers\Admin\Report;
use App\Http\Controllers\Admin\History;
use App\Http\Controllers\Shop\OrderItem;
use App\Http\Controllers\Shop\Checkout;
use App\Http\Controllers\Shop\Home;
use App\Http\Controllers\Shop\ProductList;
use App\Http\Controllers\Shop\ProductDetail;
use App\Http\Controllers\Shop\LoginCustomer;
use App\Http\Controllers\Shop\LogoutCustomer;
use App\Http\Controllers\Shop\LoginSeller;
use App\Http\Controllers\Shop\LogoutSeller;
use App\Http\Controllers\Shop\Cart;
use App\Http\Controllers\Shop\CustomerAccount;
use App\Http\Controllers\Shop\Deposit;
use App\Http\Controllers\Shop\OrderDetail;
use App\Http\Controllers\Shop\Product as ShopProduct;
use App\Http\Controllers\Shop\RegisterCustomer;
use App\Http\Controllers\Shop\RegisterSeller;
use App\Http\Controllers\Shop\Wishlist;
use App\Http\Controllers\Shop\Store;
use App\Http\Controllers\Shop\TransaksiList;
use App\Http\Controllers\Shop\Withdraw;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('admin/login', [Login::class, 'index'])->name('admin.login');
Route::post('admin/login/auth', [Login::class, 'auth'])->name('admin.login.auth');
Route::get('admin/logout', [Logout::class, 'index'])->name('admin.logout')->middleware('admin.auth');

Route::get('admin/dashboard', [Dashboard::class, 'index'])->name('admin.dashboard')->middleware('admin.auth');
Route::get('admin/data/customer', [Customer::class, 'index'])->middleware('admin.auth');
Route::get('admin/data/seller', [Seller::class, 'index'])->middleware('admin.auth');
Route::get('admin/data/product', [Product::class, 'index'])->middleware('admin.auth');
Route::get('admin/data/category', [Category::class, 'index'])->name('admin.data.category')->middleware('admin.auth');
Route::get('admin/data/category/add', [Category::class, 'add'])->name('admin.data.category.add')->middleware('admin.auth');
Route::post('admin/data/category/add_process', [Category::class, 'add_process'])->name('admin.data.category.add_process')->middleware('admin.auth');
Route::get('admin/data/category/{id_category}/edit', [Category::class, 'edit'])->middleware('admin.auth');
Route::post('admin/data/category/edit_process', [Category::class, 'edit_process'])->name('admin.data.category.edit_process')->middleware('admin.auth');
Route::delete('admin/data/category/delete_process', [Category::class, 'delete_process'])->name('admin.data.category.delete_process')->middleware('admin.auth');

Route::get('admin/data/rekening', [Rekening::class, 'index'])->name('admin.data.rekening')->middleware('admin.auth');
Route::get('admin/data/rekening/add', [Rekening::class, 'add'])->name('admin.data.rekening.add')->middleware('admin.auth');
Route::post('admin/data/rekening/add_process', [Rekening::class, 'add_process'])->name('admin.data.rekening.add_process')->middleware('admin.auth');
Route::get('admin/data/rekening/{id_rekening}/edit', [Rekening::class, 'edit'])->name('admin.data.rekening.edit')->middleware('admin.auth');
Route::post('admin/data/rekening/edit_process', [Rekening::class, 'edit_process'])->name('admin.data.rekening.edit_process')->middleware('admin.auth');
Route::delete('admin/data/rekening/delete_process', [Rekening::class, 'delete_process'])->name('admin.data.rekening.delete_process')->middleware('admin.auth');

Route::get('admin/data/account', [AdminAccount::class, 'index'])->name('admin.data.account')->middleware('admin.auth');
Route::get('admin/data/account/add', [AdminAccount::class, 'add'])->middleware('admin.auth');
Route::post('admin/data/account/add_process', [AdminAccount::class, 'add_process'])->name('admin.data.account.add_process')->middleware('admin.auth');
Route::get('admin/data/account/{id_account}/edit', [AdminAccount::class, 'edit'])->middleware('admin.auth');
Route::put('admin/data/account/edit_process', [AdminAccount::class, 'edit_process'])->name('admin.data.account.edit_process')->middleware('admin.auth');
Route::delete('admin/data/account/delete_process', [AdminAccount::class, 'delete_process'])->name('admin.data.account.delete_process')->middleware('admin.auth');

Route::get('admin/data/deposit', [DepositList::class, 'index'])->name('admin.data.deposit')->middleware('admin.auth');
Route::post('admin/data/deposit/update', [DepositList::class, 'update'])->name('admin.data.deposit.update')->middleware('admin.auth');

Route::get('admin/data/withdraw', [WithdrawList::class, 'index'])->name('admin.data.withdraw')->middleware('admin.auth');
Route::post('admin/data/withdraw/update', [WithdrawList::class, 'update'])->name('admin.data.withdraw.update')->middleware('admin.auth');

Route::get('admin/report', [Report::class, 'index'])->name('admin.report')->middleware('admin.auth');

Route::get('admin/history_deposit', [History::class, 'deposit'])->name('admin.history.deposit')->middleware('admin.auth');
Route::get('admin/history_withdraw', [History::class, 'withdraw'])->name('admin.history.withdraw')->middleware('admin.auth');


Route::get('', [Home::class, 'index'])->name('shop.home');
Route::get('shop', [ProductList::class, 'index']);
Route::get('shop/search', [ProductList::class, 'search'])->name('shop.search');
Route::get('product/{id_product}', [ProductDetail::class, 'index'])->name('shop.product.detail');

Route::get('customer/login', [LoginCustomer::class, 'index'])->name('shop.customer.login');
Route::post('customer/login/auth', [LoginCustomer::class, 'auth'])->name('shop.customer.login.auth');
Route::get('customer/logout', [LogoutCustomer::class, 'index'])->name('shop.customer.logout')->middleware('customer.auth');
Route::get('customer/register', [RegisterCustomer::class, 'index'])->name('shop.customer.register');
Route::post('customer/register_process', [RegisterCustomer::class, 'register'])->name('shop.customer.register_process');
Route::get('customer/cart', [Cart::class, 'index'])->middleware('customer.auth');
Route::get('customer/account', [CustomerAccount::class, 'index'])->name('shop.customer.account')->middleware('customer.auth');
Route::get('customer/account/edit', [CustomerAccount::class, 'edit'])->name('shop.customer.account.edit')->middleware('customer.auth');
Route::post('customer/account/edit_process', [CustomerAccount::class, 'edit_process'])->name('shop.customer.account.edit_process')->middleware('customer.auth');
Route::get('customer/order/{id_order}', [OrderDetail::class, 'index'])->middleware('customer.auth');
Route::post('customer/order/status/update', [OrderItem::class, 'update_status'])->name('shop.customer.order.status.update')->middleware('customer.auth');
Route::get('customer/order/{id}/review', [OrderItem::class, 'review'])->name('shop.customer.order.review')->middleware('customer.auth');
Route::post('customer/order/{id}/review_process', [OrderItem::class, 'review_process'])->name('shop.customer.order.review_process')->middleware('customer.auth');
Route::post('customer/favorite/add', [Wishlist::class, 'add'])->name('shop.customer.favorite.add')->middleware('customer.auth');
Route::post('customer/favorite/delete', [Wishlist::class, 'delete'])->name('shop.customer.favorite.delete')->middleware('customer.auth');
Route::post('customer/cart/add', [Cart::class, 'add'])->name('shop.customer.cart.add')->middleware('customer.auth');
Route::post('customer/cart/delete', [Cart::class, 'delete'])->name('shop.customer.cart.delete')->middleware('customer.auth');
Route::post('customer/checkout', [Checkout::class, 'add'])->name('shop.customer.checkout')->middleware('customer.auth');

Route::get('seller/login', [LoginSeller::class, 'index'])->name('shop.seller.login');
Route::post('seller/login/auth', [LoginSeller::class, 'auth'])->name('shop.seller.login.auth');
Route::get('seller/logout', [LogoutSeller::class, 'index'])->name('shop.seller.logout')->middleware('seller.auth');
Route::get('seller/register', [RegisterSeller::class, 'index'])->name('shop.seller.register');
Route::post('seller/register_process', [RegisterSeller::class, 'register'])->name('shop.seller.register_process');

Route::get('seller/store', [Store::class, 'index'])->name('shop.seller.mystore')->middleware('seller.auth');;
Route::get('seller/order/list', [Store::class, 'order_list'])->name('shop.seller.order_list')->middleware('seller.auth');;
Route::post('seller/order/list/update', [Store::class, 'update_order_status'])->name('shop.seller.order.list.update')->middleware('seller.auth');;
Route::get('seller/store/edit', [Store::class, 'edit_store'])->name('shop.seller.store.edit')->middleware('seller.auth');
Route::post('seller/store/edit_process', [Store::class, 'edit_store_process'])->name('shop.seller.store.edit_process')->middleware('seller.auth');

Route::get('seller/product/add', [ShopProduct::class, 'add'])->name('shop.seller.product.add')->middleware('seller.auth');
Route::post('seller/product/add_process', [ShopProduct::class, 'add_process'])->name('shop.seller.product.add_process')->middleware('seller.auth');
Route::get('seller/product/{id}/edit', [ShopProduct::class, 'edit'])->name('shop.seller.product.edit')->middleware('seller.auth');
Route::post('seller/product/edit_process', [ShopProduct::class, 'edit_process'])->name('shop.seller.product.edit_process')->middleware('seller.auth');
Route::delete('seller/product/delete_process', [ShopProduct::class, 'delete_process'])->name('shop.seller.product.delete_process')->middleware('seller.auth');

Route::get('seller/deposit', [Deposit::class, 'index'])->name('shop.seller.deposit')->middleware('seller.auth');
Route::post('seller/deposit/send', [Deposit::class, 'send'])->name('shop.seller.deposit.send')->middleware('seller.auth');
Route::get('seller/deposit/history', [Deposit::class, 'history'])->name('shop.seller.deposit.history')->middleware('seller.auth');

Route::get('seller/withdraw', [Withdraw::class, 'index'])->name('shop.seller.withdraw')->middleware('seller.auth');
Route::post('seller/withdraw/send', [Withdraw::class, 'send'])->name('shop.seller.withdraw.send')->middleware('seller.auth');
Route::get('seller/withdraw/history', [Withdraw::class, 'history'])->name('shop.seller.withdraw.history')->middleware('seller.auth');

Route::get('seller/report', [Store::class, 'report'])->name('shop.seller.report')->middleware('seller.auth');

Route::get('seller/transaksi', [TransaksiList::class, 'index'])->name('shop.seller.transaksi')->middleware('seller.auth');
Route::get('seller/transaksi/{id}/print', [TransaksiList::class, 'print'])->name('shop.seller.transaksi.print')->middleware('seller.auth');
Route::get('seller/transaksi/print/all', [TransaksiList::class, 'print_all'])->name('shop.seller.transaksi.print.all')->middleware('seller.auth');