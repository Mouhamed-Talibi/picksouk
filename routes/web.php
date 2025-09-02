<?php

    use App\Http\Controllers\AdminController;
    use App\Http\Controllers\AppController;
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\BagController;
    use App\Http\Controllers\CategoryController;
    use App\Http\Controllers\ClothesController;
    use App\Http\Controllers\ElectronicsController;
    use App\Http\Controllers\HealthAndBeautyController;
    use App\Http\Controllers\MessageController;
    use App\Http\Controllers\OrderController;
    use App\Http\Controllers\ParfumDetailController;
    use App\Http\Controllers\PaymentController;
    use App\Http\Controllers\ProductController;
    use App\Http\Controllers\TestimonialController;
    use App\Http\Controllers\UserController;
    use App\Models\User;
    use Illuminate\Support\Facades\Route;

    // home route
    Route::get('/', [AppController::class, 'home'])
        ->name('app.app');

    // login redirect route
    Route::get('/login', [AuthController::class, 'LoginForm'])->name('login');

    // auth routes
    Route::prefix('auth')->name('auth.')->group(function() {
        // login form route
        Route::get('/login', [AuthController::class, 'loginForm'])
            ->name('login_form');
        // login route
        Route::post('/login', [AuthController::class, 'login'])
            ->name('login');
        // signup form route
        Route::get('/signup', [AuthController::class, 'signupForm'])
            ->name('signup_form');
        // signup route
        Route::post('/signup', [AuthController::class, 'signup'])
            ->name('signup');
        // verify email route
        Route::get('/email/verify', [AuthController::class, 'verifyEmail'])
            ->name('verify_email');
        // confirm account route
        Route::get('/confirm_email/{hash}', [AuthController::class, 'confirmEmail'])
            ->name('confirm_email');
        // logout route
        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('logout');
    });

    // app routes
    Route::middleware(['verified', 'auth'])->prefix('picksouk')->name('app.')->group(function(){
        // home route
        Route::get('/home', [AppController::class, 'index'])
            ->name('home');
        // show product page
        Route::get('products/{product}', [ProductController::class, 'show'])
            ->name('show_product');
        // show products by category
        Route::get('categories/{category}', [CategoryController::class, 'show'])
            ->name('show_category_products');
        // create order
        Route::post('orders/create', [OrderController::class, 'store'])
            ->name('orders.create');
        // user orders
        Route::get('orders/', [OrderController::class, 'index'])
            ->name('my_orders');
        // cancel order
        Route::delete('orders/{order}/cancel', [OrderController::class, 'destroy'])
            ->name('orders.cancel');
        // find product
        Route::post('find-product', [AppController::class, 'findProduct'])
            ->name('find_product');
        // search result
        Route::get('find-product', [AppController::class, 'findProduct'])
            ->name('find_product');
        // about us route
        Route::get('about-us', [AppController::class, 'aboutUs'])
            ->name('about_us');
        // contact us route
        Route::get('contact-us', [AppController::class, 'contactUs'])
            ->name('contact_us');
    });

    // admin routes
    Route::middleware(['verified', 'auth', 'admin'])->prefix('admin')->name('admin.')->group(function(){
        // dashboard routes
        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');
        // add category route
        Route::get('/categories/add', [AdminController::class, 'addCategory'])
            ->name('add_category');
        // insert category
        Route::post('/categories/store', [AdminController::class, 'storeCategory'])
            ->name('insert_category');
        // categories list
        Route::get('/categories', [CategoryController::class, 'index'])
            ->name('categories');
        // edit category form
        Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])
            ->name('edit_category');
        // update category
        Route::put('/categories/{category}', [CategoryController::class, 'update'])
            ->name('update_category');
        // delete category
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])
            ->name('destroy_category');
        // restore category
        Route::get('/categories/{category}/restore', [CategoryController::class, 'restore'])
            ->name('restore_category');
        // create product route
        Route::get('/products/create', [ProductController::class, 'create'])
            ->name('add_products');
        // store product
        Route::post('/products/store', [ProductController::class, 'store'])
            ->name('store_product');
        // products route
        Route::get('/products', [ProductController::class, 'index'])
            ->name('products');
        // edit product form
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
            ->name('edit_product');
        // update product 
        Route::put('/products/{product}', [ProductController::class, 'update'])
            ->name('update_product');
        // delete product
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])
            ->name('destroy_product');
        // restore product
        Route::get('/products/{product}/restore', [ProductController::class, 'restore'])
            ->name('restore_product');
        // Parfums routes
            // create parfum
            Route::get('/parfums/create', [ParfumDetailController::class, 'create'])
                ->name('parfums.create');
            // store parfum 
            Route::post('parfums/store', [ParfumDetailController::class, 'store'])
                ->name('parfums.store');
            // manage parfums
            Route::get('parfums/manage', [ParfumDetailController::class, 'index'])
                ->name('parfums.manage');
            // edit parfum
            Route::get('parfums/{parfum}/edit', [ParfumDetailController::class, 'edit'])
                ->name('edit_parfum');
            // update parfum
            Route::put('parfums/{parfum}/update', [ParfumDetailController::class, 'update'])
                ->name('update_parfum');
        // Electronics routes
            // create electronics
            Route::get('eletronics/create', [ElectronicsController::class, 'create'])
                ->name('electronics.create');
            // store electronics 
            Route::post('electronics/store', [ElectronicsController::class, 'store'])
                ->name('electronics.store');
            // manage electronics
            Route::get('electronics/manage', [ElectronicsController::class, 'index'])
                ->name('electronics.manage');
            // edit product
            Route::get('electronics/edit/{id}', [ElectronicsController::class, 'edit'])
                ->name('electronics.edit');
            // update product
            Route::put('electronics/update/{id}', [ElectronicsController::class, 'update'])
                ->name('electronics.update');
        // clothes routes
            // create clothes
            Route::get('clothes/create', [ClothesController::class, 'create'])
                ->name('clothes.create');
            // store clothes
            Route::post('clothes/store', [ClothesController::class, 'store'])
                ->name('clothes.store');
            // manage clothes
            Route::get('clothes/manage', [ClothesController::class, 'index'])
                ->name('clothes.manage');
            // edir clothes
            Route::get('clothes/edit/{id}', [ClothesController::class, 'edit'])
                ->name('clothes.edit');
            // update clothes
            Route::put('clothes/update/{id}', [ClothesController::class, 'update'])
                ->name('clothes.update');
        // health and beauty
            // create health and beauty
            Route::get('health-beauty/create', [HealthAndBeautyController::class, 'create'])
            ->name('health_beauty.create');
            // store health and beauty
            Route::post('health-beauty/store', [HealthAndBeautyController::class, 'store'])
                ->name('health_beauty.store');
            // manage health and beauty
            Route::get('health-beauty/manage', [HealthAndBeautyController::class, 'index'])
                ->name('health_beauty.manage');
            // edit health and beauty
            Route::get('health-beauty/edit/{id}', [HealthAndBeautyController::class, 'edit'])
                ->name('health_beauty.edit');
            // update health and beauty
            Route::put('health-beauty/update/{id}', [HealthAndBeautyController::class, 'update'])
                ->name('health_beauty.update');
        // bags routes
            // create bags
            Route::get('bags/create', [BagController::class, 'create'])
                ->name('bags.create');
            // store bags
            Route::post('bags/store', [BagController::class, 'store'])
                ->name('bags.store');
            // manage bags
            Route::get('bags/manage', [BagController::class, 'index'])
                ->name('bags.manage');
            // edit bag
            Route::get('bags/edit/{bag}', [BagController::class, 'edit'])
                ->name('bags.edit');
            // update bag
            Route::put('bags/update/{id}', [BagController::class, 'update'])
                ->name('bags.update');
        // Users management
            // users index
            Route::get('users', [UserController::class, 'index'])
                ->name('users.index');
            // user details
            Route::get('users/{user}', [UserController::class, 'show'])
                ->name('users.user');
            // delete user
            Route::delete('users/{user}/delete', [UserController::class, 'destroy'])
                ->name('users.delete');
        // testimonials management
            // index route
            Route::get('testimonials', [TestimonialController::class, 'index'])
                ->name('testimonials.index');
            // accept testimonial
            Route::patch('testimonials/{testimonial}/accept', [TestimonialController::class, 'accept'])
                ->name('testimonials.accept');
            // delete testimonial
            Route::delete('testimonials/{testimonial}/delete', [TestimonialController::class, 'destroy'
                ])->name('testimonials.delete');
        // orders management
            // index orders
            Route::get('orders', [AdminController::class, 'orders'])
                ->name('orders.index');
            // update order status
            Route::put('orders/{order}/update-status', [AdminController::class, 'updateOrderStatus'])
                ->name('orders.update_status');
            // delete cancelled orders
            Route::delete('orders/delete-cancelled', [AdminController::class, 'deleteCancelledOrders'])
                ->name('orders.delete_cancelled');
            // destroy order
            Route::delete('orders/{order}/delete', [OrderController::class, 'destroy'])
                ->name('orders.destroy');
        // payments routes
            // index route
            Route::get('payments', [PaymentController::class, 'index'])
                ->name('payments.index');
        // messages route
            // index route
            Route::get('messages', [MessageController::class, 'index'])
                ->name('messages.index');
    });

    // testimonials store
    Route::post('testimonials/store', [TestimonialController::class, 'store'])
        ->name('testimonials.store');

    // testing email
        Route::get('/test-mail', function () {
        Mail::to('picksouk.contact@gmail.com')->send(new App\Mail\TestMail());
        return 'Test email sent!';
    });

    // send message route
    Route::post('picksouck/send-message', [MessageController::class, 'store'])
        ->name('send_message');

    // products category
    Route::get('categories/{category}', [CategoryController::class, 'productsCategory'])
        ->name('products_category');

    // show product
    Route::get('products/{product}', [AppController::class, 'showProduct'])
        ->name('showProduct');

    // products route
    Route::get('products', [AppController::class, 'products'])
        ->name('products');