<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes([
    
]);

Route::get('/home', 'HomeController@index')->name('home');

// Frontend
Route::get('/', 'FrontendController@Frontend')->name('Frontend');
Route::get('/shop', 'FrontendController@Shop')->name('Shop');
Route::get('/shop-list', 'FrontendController@ShopListView')->name('ShopListView');
Route::get('/shop-item/{cat_id}', 'FrontendController@SingleShop')->name('SingleShop');
Route::get('/shop-item-single/{subcat_id}', 'FrontendController@SingleSubShop')->name('SingleSubShop');
Route::post('/shop', 'FrontendController@ProductSearch')->name('ProductSearch');

Route::post('/search', 'FrontendController@Search')->name('Search');
Route::post('/newsletter', 'FrontendController@Newsletter')->name('Newsletter');
Route::get('/view-newsletter', 'FrontendController@ViewNews')->name('ViewNews'); //backend
Route::get('/delete-news/{id}', 'FrontendController@DeleteNews')->name('DeleteNews'); //backend

// Wishlist 
Route::get('/wishlist', 'WishlistController@Wishlist')->name('Wishlist');
Route::get('/add-to-wishlist/{id}', 'WishlistController@AddWishlist')->name('AddWishlist');
Route::get('/delete-wishlist/{id}', 'WishlistController@DeleteWishlist')->name('DeleteWishlist');

// Compare 
Route::get('/compare', 'WishlistController@Compare')->name('Compare');
Route::get('/add-to-compare/{id}', 'WishlistController@AddToCompare')->name('AddToCompare');
Route::get('/delete-compare/{id}', 'WishlistController@DeleteCompare')->name('DeleteCompare');

// Reviews 
Route::post('/post-review', 'FrontendController@PostReview')->name('PostReview');

// Blog
Route::get('/add-blog-category', 'BlogController@AddBlogCategory')->name('AddBlogCategory');
Route::post('/post-blogcategory', 'BlogController@PostBlogCategory')->name('PostBlogCategory');
Route::get('/view-blogcategory', 'BlogController@ViewBlogCategory')->name('ViewBlogCategory');
Route::get('/delete-blogcategory/{id}', 'BlogController@DeleteBlogCategory')->name('DeleteBlogCategory');
Route::get('/add-blog', 'BlogController@AddBlog')->name('AddBlog');
Route::post('/post-blog', 'BlogController@PostBlog')->name('PostBlog');
Route::get('/view-blog', 'BlogController@ViewBlog')->name('ViewBlog');
Route::get('/edit-blog/{id}', 'BlogController@EditBlog')->name('EditBlog');
Route::post('/update-blog', 'BlogController@UpdateBlog')->name('UpdateBlog');
Route::get('/delete-blog/{id}', 'BlogController@DeleteBlog')->name('DeleteBlog');
Route::get('/trashed-blog', 'BlogController@TrashedBlog')->name('TrashedBlog');
Route::get('/restore-blog/{id}', 'BlogController@RestoreBlog')->name('RestoreBlog');
Route::get('/permanent-delete/{id}', 'BlogController@ForseDelete')->name('ForseDelete');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/blog', 'BlogController@Blog')->name('Blog');
Route::get('/single-blog/{id}', 'BlogController@SingleBlog')->name('SingleBlog');
Route::post('/search-blog', 'BlogController@SearchBlog')->name('SearchBlog');
Route::post('/blog-comment', 'BlogController@BlogComment')->name('BlogComment');
Route::get('/single-category/{id}', 'BlogController@SingleCat')->name('SingleCat');


// Backend
Route::group(['middleware'=>['auth', 'Admin']], function(){
    Route::get('/backend/dashboard', function () {
        return view('backend/dashboard');
    });
});


// Category
Route::get('/add-category', 'CategoryController@AddCategory')->name('AddCategory');
Route::post('/post-category', 'CategoryController@PostCategory')->name('PostCategory');
Route::get('/view-category', 'CategoryController@ViewCategory')->name('ViewCategory');
Route::get('/edit-category/{id}', 'CategoryController@EditCategory')->name('EditCategory');
Route::post('/update-category', 'CategoryController@UpdateCategory')->name('UpdateCategory');
Route::get('/delete-category/{id}', 'CategoryController@DeleteCategory')->name('DeleteCategory');
Route::get('/trashed-category', 'CategoryController@TrashedCategory')->name('TrashedCategory');
Route::get('/restore-category/{id}', 'CategoryController@RestoreCategory')->name('RestoreCategory');
Route::get('/permanent-category/{id}', 'CategoryController@PermanentCategory')->name('PermanentCategory');

// SubCategory
Route::get('/add-subcategory', 'SubCategoryController@AddSubCategory')->name('AddSubCategory');
Route::post('/post-subcategory', 'SubCategoryController@PostSubCategory')->name('PostSubCategory');
Route::get('/view-subcategory', 'SubCategoryController@ViewSubCategory')->name('ViewSubCategory');
Route::get('/edit-subcategory/{id}', 'SubCategoryController@EditSubCategory')->name('EditSubCategory');
Route::post('/update-subcategory', 'SubCategoryController@UpdateSubCategory')->name('UpdateSubCategory');
Route::get('/delete-subcategory/{id}', 'SubCategoryController@DeleteSubCategory')->name('DeleteSubCategory');
Route::get('/trashed-subcategory', 'SubCategoryController@TrashedSubCategory')->name('TrashedSubCategory');
Route::get('/restore-subcategory/{id}', 'SubCategoryController@RestoreSubCategory')->name('RestoreSubCategory');
Route::get('/permanent-subcategory/{id}', 'SubCategoryController@PermanentSubCategory')->name('PermanentSubCategory');

// Product
Route::get('/add-product', 'ProductController@AddProduct')->name('AddProduct');
Route::post('/post-product', 'ProductController@PostProduct')->name('PostProduct');
Route::get('/view-product', 'ProductController@ViewProduct')->name('ViewProduct');
Route::get('/edit-product/{slug}', 'ProductController@EditProduct')->name('EditProduct');
Route::post('/update-product', 'ProductController@UpdateProduct')->name('UpdateProduct');
Route::get('/delete-product/{id}', 'ProductController@DeleteProduct')->name('DeleteProduct');
Route::get('/trashed-product', 'ProductController@TrashedProduct')->name('TrashedProduct');
Route::get('/restore-product/{id}', 'ProductController@RestoreProduct')->name('RestoreProduct');
Route::get('/permanent-delete-product/{id}', 'ProductController@PermanentDeleteProduct')->name('PermanentDeleteProduct');

Route::get('/single-product/{id}', 'ProductController@SingleProduct')->name('SingleProduct');

// Cart
Route::get('/cart', 'CartController@Cart')->name('Cart');
Route::get('/add-to-cart/{id}', 'CartController@SingleCart')->name('SingleCart');
Route::post('/multiple-cart', 'CartController@MultipleCart')->name('MultipleCart');
Route::get('/single-cart-delete/{id}', 'CartController@SingleCartDelete')->name('SingleCartDelete');

// Coupon
Route::get('/add-coupon', 'CouponController@AddCoupon')->name('AddCoupon');
Route::post('/post-coupon', 'CouponController@PostCoupon')->name('PostCoupon');
Route::get('/view-coupon', 'CouponController@ViewCoupon')->name('ViewCoupon');
Route::get('/delete-coupon/{id}', 'CouponController@DeleteCoupon')->name('DeleteCoupon');
Route::post('/cart-coupon', 'CouponController@CartCoupon')->name('CartCoupon');

// Top Bannar
Route::get('/add-bannar', 'BannarController@AddBannar')->name('AddBannar');
Route::post('/post-bannar', 'BannarController@PostBannar')->name('PostBannar');
Route::get('/view-bannar', 'BannarController@ViewBannar')->name('ViewBannar');
Route::get('/delete-bannar/{id}', 'BannarController@DeleteBannar')->name('DeleteBannar');

// Contact
Route::get('/contact-us', 'ContactController@ContactUs')->name('ContactUs');
Route::post('/post-contact', 'ContactController@PostContact')->name('PostContact');

// Site Info
Route::get('/add-info', 'ContactController@AddInfo')->name('AddInfo');
Route::post('/post-info', 'ContactController@PostInfo')->name('PostInfo');
Route::get('/view-info', 'ContactController@ViewInfo')->name('ViewInfo');
Route::get('/edit-info/{id}', 'ContactController@EditInfo')->name('EditInfo');
Route::post('/update-info', 'ContactController@UpdateInfo')->name('UpdateInfo');
Route::get('/delete-info/{id}', 'ContactController@DeleteInfo')->name('DeleteInfo');
Route::get('/info', 'ContactController@Info')->name('Info');

// Checkout 
Route::get('/checkout', 'CheckoutController@Checkout')->name('Checkout');
Route::post('/final-checkout', 'CheckoutController@FinalCheckout')->name('FinalCheckout');

// Backend/Admin
Route::get('/all-orders', 'BackendController@AllOrders')->name('AllOrders');
Route::get('/view-full-information/{id}', 'BackendController@FullOrder')->name('FullOrder');
Route::post('/order-status', 'BackendController@OrderStatus')->name('OrderStatus');
Route::get('/orders-in-processing', 'BackendController@Processing')->name('Processing');
Route::get('/orders-delivared', 'BackendController@Delivared')->name('Delivared');
Route::get('/orders-returned', 'BackendController@Returned')->name('Returned');
Route::get('/orders-canceled', 'BackendController@Canceled')->name('Canceled');


// Ajax
Route::get('/api/get-category-list/{cat_id}', 'ProductController@GetSubCategory')->name('GetSubCategory');
Route::get('/api/get-district-list/{id}', 'CheckoutController@GetDistrict')->name('GetDistrict');
Route::get('/api/get-upazila-list/{id}', 'CheckoutController@GetUpazila')->name('GetUpazila');
Route::get('/api/get-union-list/{id}', 'CheckoutController@GetUnion')->name('GetUnion');
