<?php

use App\Http\Controllers\Admin\AdminAccommodationController;
use App\Http\Controllers\Admin\AdminAccommodationTypeController;
use App\Http\Controllers\Admin\AdminAmenityController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminDatewiseRoomController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminFeatureController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminPhotoController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminRoomController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminSlideController;
use App\Http\Controllers\Admin\AdminSubscriberController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use App\Http\Controllers\Admin\AdminVideoController;
use App\Http\Controllers\Customer\CustomerAuthController;
use App\Http\Controllers\Customer\CustomerHomeController;
use App\Http\Controllers\Customer\CustomerOrderController;
use App\Http\Controllers\Customer\CustomerProfileController;
use App\Http\Controllers\Customer\CustomerReviewController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\AccommodationController;
use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\BookingController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\FaqController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\PhotoController;
use App\Http\Controllers\Front\PrivacyController;
use App\Http\Controllers\Front\RoomController;
use App\Http\Controllers\Front\SubscriberController;
use App\Http\Controllers\Front\TermsController;
use App\Http\Controllers\Front\VideoController;
use App\Http\Middleware\CheckAuth;
use Illuminate\Support\Facades\Route;


/* Front */
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/blog', [BlogController::class, 'index'])->name('blog');

Route::get('/post/{id}', [BlogController::class, 'single_post'])->name('single_post');

Route::get('/photo-gallery', [PhotoController::class, 'index'])->name('photo_gallery');

Route::get('/video-gallery', [VideoController::class, 'index'])->name('video_gallery');

Route::get('/faq', [FaqController::class, 'index'])->name('faq');

Route::get('/terms-and-conditions', [TermsController::class, 'index'])->name('terms');

Route::get('/privacy-policy', [PrivacyController::class, 'index'])->name('privacy');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::post('/contact/send-email', [ContactController::class, 'send_email'])->name('contact_send_email');

Route::post('/subscriber/send-email', [SubscriberController::class, 'send_email'])->name('subscriber_send_email');

Route::get('/subscriber/verify/{email}/{token}', [SubscriberController::class, 'verify'])->name('subscriber_verify');

Route::get('/accommodation/room/{accomm_id}', [RoomController::class, 'index'])->name('room');

Route::get('/accommodation/room_detail/{id}', [RoomController::class, 'single_room'])->name('room_detail');

Route::get('/accommodation-types', [AccommodationController::class, 'index'])->name('accommodation_types');

Route::get('/accommodations/{accommtype_id}', [AccommodationController::class, 'accommodation_detail'])->name('accommodation_detail');

Route::post('/booking/submit', [BookingController::class, 'cart_submit'])->name('cart_submit');

Route::get('/cart', [BookingController::class, 'cart_view'])->name('cart');

Route::get('/cart/delete/{id}', [BookingController::class, 'cart_delete'])->name('cart_delete');

Route::get('/checkout', [BookingController::class, 'checkout'])->name('checkout');

Route::post('/payment', [BookingController::class, 'payment'])->name('payment');

Route::post('/payment/stripe/{price}', [BookingController::class, 'stripe'])->name('stripe');



/* Guest Middleware */
Route::middleware('guest')->group(function () {
    /* Customer Routes */
    Route::get('/login', [CustomerAuthController::class, 'login'])->name('customer_login');

    Route::post('/login-submit', [CustomerAuthController::class, 'login_submit'])->name('customer_login_submit');

    Route::get('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer_logout');

    Route::get('/signup', [CustomerAuthController::class, 'signup'])->name('customer_signup');

    Route::post('/signup-submit', [CustomerAuthController::class, 'signup_submit'])->name('customer_signup_submit');

    Route::get('/signup-verify/{email}/{token}', [CustomerAuthController::class, 'signup_verify'])->name('customer_signup_verify');

    Route::get('/forget-password', [CustomerAuthController::class, 'forget_password'])->name('customer_forget_password');

    Route::post('/forget-password-submit', [CustomerAuthController::class, 'forget_password_submit'])->name('customer_forget_password_submit');

    Route::get('/reset-password/{token}/{email}', [CustomerAuthController::class, 'reset_password'])->name('customer_reset_password');

    Route::post('/reset-password-submit', [CustomerAuthController::class, 'reset_password_submit'])->name('customer_reset_password_submit');

    /* Admin Routes */
    Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin_login');

    Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin_logout');

    Route::post('/admin/login-submit', [AdminLoginController::class, 'loginSubmit'])->name('admin_login_submit');

    Route::get('/admin/forget-password', [AdminLoginController::class, 'forgetPassword'])->name('admin_forget_password');

    Route::post('/admin/forget-password-submit', [AdminLoginController::class, 'forgetPasswordSubmit'])->name('admin_forget_password_submit');

    Route::get('/admin/reset-password/{token}/{email}', [AdminLoginController::class, 'resetPassword'])->name('admin_reset_password');

    Route::post('/admin/reset-password-submit', [AdminLoginController::class, 'resetPasswordSubmit'])->name('admin_reset_password_submit');

});


/* Customer Routes with Customer Middleware */
Route::group(['middleware' => ['customer:customer']], function() {
    Route::get('/customer/home', [CustomerHomeController::class, 'index'])->name('customer_home');
    Route::get('/customer/edit-profile', [CustomerProfileController::class, 'index'])->name('customer_profile');
    Route::post('/customer/edit-profile-submit', [CustomerProfileController::class, 'profile_submit'])->name('customer_profile_submit');
    Route::get('/customer/order/view', [CustomerOrderController::class, 'index'])->name('customer_order_view');
    Route::get('/customer/invoice/{id}', [CustomerOrderController::class, 'invoice'])->name('customer_invoice');

    Route::get('/customer/review/view', [CustomerReviewController::class, 'index'])->name('customer_review_view');

    Route::get('/customer/review/add/{id}', [CustomerReviewController::class, 'add_review'])->name('customer_review_add');

    Route::post('/customer/review/submit/{id}', [CustomerReviewController::class, 'review_store'])->name('customer_review_submit');

    Route::get('/customer/review/edit/{id}', [CustomerReviewController::class, 'review_edit'])->name('customer_review_edit');

    Route::post('/customer/review/update/{id}', [CustomerReviewController::class, 'review_update'])->name('customer_review_update');

    Route::get('/customer/review/delete/{id}', [CustomerReviewController::class, 'review_delete'])->name('customer_review_delete');

});



/* Admin Routes with Admin Middleware*/
Route::group(['middleware' => ['admin:admin']], function() {
    Route::get('/admin/edit-profile', [AdminProfileController::class, 'index'])->name('admin_profile');

    Route::post('/admin/edit-profile-submit', [AdminProfileController::class, 'profileSubmit'])->name('admin_profile_submit');

    Route::get('/admin/home', [AdminHomeController::class, 'index'])->name('admin_home');

    Route::get('/admin/setting', [AdminSettingController::class, 'index'])->name('admin_setting');

    Route::get('/admin/datewise-rooms', [AdminDatewiseRoomController::class, 'index'])->name('admin_datewise_rooms');

    Route::post('/admin/datewise-rooms/submit', [AdminDatewiseRoomController::class, 'show'])->name('admin_datewise_rooms_submit');

    Route::post('/admin/setting/update', [AdminSettingController::class, 'update'])->name('admin_setting_update');

    Route::get('/admin/customer', [AdminCustomerController::class, 'index'])->name('admin_customer');

    Route::get('/admin/customer/change-status/{id}', [AdminCustomerController::class, 'change_status'])->name('admin_customer_change_status');

    Route::get('/admin/order/view', [AdminOrderController::class, 'index'])->name('admin_order_view');

    Route::get('/admin/order/invoice/{id}', [AdminOrderController::class, 'invoice'])->name('admin_invoice');

    Route::get('/admin/order/delete/{id}', [AdminOrderController::class, 'delete'])->name('admin_order_delete');

    Route::get('/admin/slide/view', [AdminSlideController::class, 'index'])->name('admin_slide_view');
    
    Route::get('/admin/slide/add', [AdminSlideController::class, 'add'])->name('admin_slide_add');
    
    Route::post('/admin/slide/store', [AdminSlideController::class, 'store'])->name('admin_slide_store');
    
    Route::get('/admin/slide/edit/{id}', [AdminSlideController::class, 'edit'])->name('admin_slide_edit');
    
    Route::post('/admin/slide/update/{id}', [AdminSlideController::class, 'update'])->name('admin_slide_update');
    
    Route::get('/admin/slide/delete/{id}', [AdminSlideController::class, 'delete'])->name('admin_slide_delete');


    Route::get('/admin/rates/view', [AdminReviewController::class, 'index'])->name('admin_review_view');

    Route::get('/admin/rates/delete/{id}', [AdminReviewController::class, 'delete'])->name('admin_review_delete');


    Route::get('/admin/accommodation-type/view', [AdminAccommodationTypeController::class, 'index'])->name('admin_accommodation_type_view');
    
    Route::get('/admin/accommodation-type/add', [AdminAccommodationTypeController::class, 'add'])->name('admin_accommodation_type_add');
    
    Route::post('/admin/accommodation-type/store', [AdminAccommodationTypeController::class, 'store'])->name('admin_accommodation_type_store');
    
    Route::get('/admin/accommodation-type/edit/{id}', [AdminAccommodationTypeController::class, 'edit'])->name('admin_accommodation_type_edit');
    
    Route::post('/admin/accommodation-type/update/{id}', [AdminAccommodationTypeController::class, 'update'])->name('admin_accommodation_type_update');
    
    Route::get('/admin/accommodation-type/delete/{id}', [AdminAccommodationTypeController::class, 'delete'])->name('admin_accommodation_type_delete');



    Route::get('/admin/accommodation/view/{accomtype_id}', [AdminAccommodationController::class, 'index'])->name('admin_accommodation_view');

    Route::get('/admin/accommodations', [AdminAccommodationController::class, 'accommodation_all'])->name('admin_accommodation_all');
    
    Route::get('/admin/accommodation/add/{accomtype_id}', [AdminAccommodationController::class, 'add'])->name('admin_accommodation_add');
    
    Route::post('/admin/accommodation/store/{accomtype_id}', [AdminAccommodationController::class, 'store'])->name('admin_accommodation_store');
    
    Route::get('/admin/accommodation/edit/{id}', [AdminAccommodationController::class, 'edit'])->name('admin_accommodation_edit');
    
    Route::post('/admin/accommodation/update/{id}', [AdminAccommodationController::class, 'update'])->name('admin_accommodation_update');
    
    Route::get('/admin/accommodation/delete/{id}', [AdminAccommodationController::class, 'delete'])->name('admin_accommodation_delete');
    
    
    
    Route::get('/admin/feature/view', [AdminFeatureController::class, 'index'])->name('admin_feature_view');
    
    Route::get('/admin/feature/add', [AdminFeatureController::class, 'add'])->name('admin_feature_add');
    
    Route::post('/admin/feature/store', [AdminFeatureController::class, 'store'])->name('admin_feature_store');
    
    Route::get('/admin/feature/edit/{id}', [AdminFeatureController::class, 'edit'])->name('admin_feature_edit');
    
    Route::post('/admin/feature/update/{id}', [AdminFeatureController::class, 'update'])->name('admin_feature_update');
    
    Route::get('/admin/feature/delete/{id}', [AdminFeatureController::class, 'delete'])->name('admin_feature_delete');
    
    
    
    Route::get('/admin/testimonial/view', [AdminTestimonialController::class, 'index'])->name('admin_testimonial_view');
    
    Route::get('/admin/testimonial/add', [AdminTestimonialController::class, 'add'])->name('admin_testimonial_add');
    
    Route::post('/admin/testimonial/store', [AdminTestimonialController::class, 'store'])->name('admin_testimonial_store');
    
    Route::get('/admin/testimonial/edit/{id}', [AdminTestimonialController::class, 'edit'])->name('admin_testimonial_edit');
    
    Route::post('/admin/testimonial/update/{id}', [AdminTestimonialController::class, 'update'])->name('admin_testimonial_update');
    
    Route::get('/admin/testimonial/delete/{id}', [AdminTestimonialController::class, 'delete'])->name('admin_testimonial_delete');
    
    
    
    Route::get('/admin/post/view', [AdminPostController::class, 'index'])->name('admin_post_view');
    
    Route::get('/admin/post/add', [AdminPostController::class, 'add'])->name('admin_post_add');
    
    Route::post('/admin/post/store', [AdminPostController::class, 'store'])->name('admin_post_store');
    
    Route::get('/admin/post/edit/{id}', [AdminPostController::class, 'edit'])->name('admin_post_edit');
    
    Route::post('/admin/post/update/{id}', [AdminPostController::class, 'update'])->name('admin_post_update');
    
    Route::get('/admin/post/delete/{id}', [AdminPostController::class, 'delete'])->name('admin_post_delete');
    
    
    
    Route::get('/admin/photo/view', [AdminPhotoController::class, 'index'])->name('admin_photo_view');
    
    Route::get('/admin/photo/add', [AdminPhotoController::class, 'add'])->name('admin_photo_add');
    
    Route::post('/admin/photo/store', [AdminPhotoController::class, 'store'])->name('admin_photo_store');
    
    Route::get('/admin/photo/edit/{id}', [AdminPhotoController::class, 'edit'])->name('admin_photo_edit');
    
    Route::post('/admin/photo/update/{id}', [AdminPhotoController::class, 'update'])->name('admin_photo_update');
    
    Route::get('/admin/photo/delete/{id}', [AdminPhotoController::class, 'delete'])->name('admin_photo_delete');
    
    
    
    Route::get('/admin/video/view', [AdminVideoController::class, 'index'])->name('admin_video_view');
    
    Route::get('/admin/video/add', [AdminVideoController::class, 'add'])->name('admin_video_add');
    
    Route::post('/admin/video/store', [AdminVideoController::class, 'store'])->name('admin_video_store');
    
    Route::get('/admin/video/edit/{id}', [AdminVideoController::class, 'edit'])->name('admin_video_edit');
    
    Route::post('/admin/video/update/{id}', [AdminVideoController::class, 'update'])->name('admin_video_update');
    
    Route::get('/admin/video/delete/{id}', [AdminVideoController::class, 'delete'])->name('admin_video_delete');
    
    
    Route::get('/admin/faq/view', [AdminFaqController::class, 'index'])->name('admin_faq_view');
    
    Route::get('/admin/faq/add', [AdminFaqController::class, 'add'])->name('admin_faq_add');
    
    Route::post('/admin/faq/store', [AdminFaqController::class, 'store'])->name('admin_faq_store');
    
    Route::get('/admin/faq/edit/{id}', [AdminFaqController::class, 'edit'])->name('admin_faq_edit');
    
    Route::post('/admin/faq/update/{id}', [AdminFaqController::class, 'update'])->name('admin_faq_update');
    
    Route::get('/admin/faq/delete/{id}', [AdminFaqController::class, 'delete'])->name('admin_faq_delete');
    
    
    Route::get('/admin/page/about', [AdminPageController::class, 'about'])->name('admin_about_page');
    
    Route::post('/admin/page/about/update', [AdminPageController::class, 'about_update'])->name('admin_about_page_update');
    
    Route::get('/admin/page/terms', [AdminPageController::class, 'terms'])->name('admin_terms_page');
    
    Route::post('/admin/page/terms/update', [AdminPageController::class, 'terms_update'])->name('admin_terms_page_update');
    
    Route::get('/admin/page/privacy', [AdminPageController::class, 'privacy'])->name('admin_privacy_page');
    
    Route::post('/admin/page/privacy/update', [AdminPageController::class, 'privacy_update'])->name('admin_privacy_page_update');
    
    
    Route::get('/admin/page/contact', [AdminPageController::class, 'contact'])->name('admin_contact_page');
    
    Route::post('/admin/page/contact/update', [AdminPageController::class, 'contact_update'])->name('admin_contact_page_update');
    
    
    Route::get('/admin/page/photo-gallery', [AdminPageController::class, 'photo_gallery'])->name('admin_photo_gallery_page');
    
    Route::post('/admin/page/photo-gallery/update', [AdminPageController::class, 'photo_gallery_update'])->name('admin_photo_gallery_page_update');
    
    Route::get('/admin/page/video-gallery', [AdminPageController::class, 'video_gallery'])->name('admin_video_gallery_page');
    
    Route::post('/admin/page/video-gallery/update', [AdminPageController::class, 'video_gallery_update'])->name('admin_video_gallery_page_update');
    
    
    Route::get('/admin/page/faq', [AdminPageController::class, 'faq'])->name('admin_faq_page');
    
    Route::post('/admin/page/faq/update', [AdminPageController::class, 'faq_update'])->name('admin_faq_page_update');
    
    
    Route::get('/admin/page/blog', [AdminPageController::class, 'blog'])->name('admin_blog_page');
    
    Route::post('/admin/page/blog/update', [AdminPageController::class, 'blog_update'])->name('admin_blog_page_update');
    
    
    Route::get('/admin/page/room', [AdminPageController::class, 'room'])->name('admin_room_page');
    
    Route::post('/admin/page/room/update', [AdminPageController::class, 'room_update'])->name('admin_room_page_update');
    
    
    
    Route::get('/admin/page/cart', [AdminPageController::class, 'cart'])->name('admin_cart_page');
    
    Route::post('/admin/page/cart/update', [AdminPageController::class, 'cart_update'])->name('admin_cart_page_update');
    
    
    Route::get('/admin/page/checkout', [AdminPageController::class, 'checkout'])->name('admin_checkout_page');
    
    Route::post('/admin/page/checkout/update', [AdminPageController::class, 'checkout_update'])->name('admin_checkout_page_update');
    
    Route::get('/admin/page/payment', [AdminPageController::class, 'payment'])->name('admin_payment_page');
    
    Route::post('/admin/page/payment/update', [AdminPageController::class, 'payment_update'])->name('admin_payment_page_update');
    
    
    Route::get('/admin/page/signup', [AdminPageController::class, 'signup'])->name('admin_signup_page');
    
    Route::post('/admin/page/signup/update', [AdminPageController::class, 'signup_update'])->name('admin_signup_page_update');
    
    
    Route::get('/admin/page/signin', [AdminPageController::class, 'signin'])->name('admin_signin_page');
    
    Route::post('/admin/page/signin/update', [AdminPageController::class, 'signin_update'])->name('admin_signin_page_update');
    
    
    Route::get('/admin/subscriber/show', [AdminSubscriberController::class, 'index'])->name('admin_subscriber_show');
    
    Route::get('/admin/subscriber/send-email', [AdminSubscriberController::class, 'send_email'])->name('admin_subscriber_send_email');
    
    Route::post('/admin/subscriber/send-email-submit', [AdminSubscriberController::class, 'submit_email'])->name('admin_subscriber_submit_email');
    
    
    
    
    Route::get('/admin/amenity/view', [AdminAmenityController::class, 'index'])->name('admin_amenity_view');
    
    Route::get('/admin/amenity/add', [AdminAmenityController::class, 'add'])->name('admin_amenity_add');
    
    Route::post('/admin/amenity/store', [AdminAmenityController::class, 'store'])->name('admin_amenity_store');
    
    Route::get('/admin/amenity/edit/{id}', [AdminAmenityController::class, 'edit'])->name('admin_amenity_edit');
    
    Route::post('/admin/amenity/update/{id}', [AdminAmenityController::class, 'update'])->name('admin_amenity_update');
    
    Route::get('/admin/amenity/delete/{id}', [AdminAmenityController::class, 'delete'])->name('admin_amenity_delete');
    
    
    
    
    Route::get('/admin/room/view/{accom_id}', [AdminRoomController::class, 'index'])->name('admin_room_view');
    
    Route::get('/admin/room/add/{accom_id}', [AdminRoomController::class, 'add'])->name('admin_room_add');
    
    Route::post('/admin/room/store/{accom_id}', [AdminRoomController::class, 'store'])->name('admin_room_store');
    
    Route::get('/admin/room/edit/{id}', [AdminRoomController::class, 'edit'])->name('admin_room_edit');
    
    Route::post('/admin/room/update/{id}', [AdminRoomController::class, 'update'])->name('admin_room_update');
    
    Route::get('/admin/room/delete/{id}', [AdminRoomController::class, 'delete'])->name('admin_room_delete');
    
    Route::get('/admin/room/gallery/edit/{id}', [AdminRoomController::class, 'gallery'])->name('admin_room_gallery');
    
    Route::post('/admin/room/gallery/store/{id}', [AdminRoomController::class, 'gallery_store'])->name('admin_room_gallery_store');
    
    Route::get('/admin/room/gallery/delete/{id}', [AdminRoomController::class, 'gallery_delete'])->name('admin_room_gallery_delete'); 


});
