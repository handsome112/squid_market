<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Http\Controllers\{
    AuthController,
    UserController,
    SellerController,
    ProductController,
    IndexController,
    StaffController,
    AdminController,
    OrderController
};

####### AUTH
Route::middleware('guest')->group(function () {
    Route::get('/ddos', [IndexController::class, 'viewDDos'])->name('ddos');
    Route::get('/login', [AuthController::class, 'viewLogin'])->name('login');
    Route::post('/tologin', [AuthController::class, 'viewToLogin'])->name(
        'to_login'
    );
    Route::post('/login', [AuthController::class, 'postLogin'])->name(
        'post.login'
    );

    Route::get('/register', [AuthController::class, 'viewRegister'])->name(
        'register'
    );
    Route::post('/register', [AuthController::class, 'postRegister'])->name(
        'post.register'
    );

    Route::get('/reset/password', [
        AuthController::class,
        'viewResetPassword',
    ])->name('resetpassword');

    Route::get('/reset/password/pgp', [
        AuthController::class,
        'viewResetWithPGP',
    ])->name('resetwithpgp');

    Route::get('/reset/password/mnemonic', [
        AuthController::class,
        'viewResetWithMnemonic',
    ])->name('resetwithmnemonic');

    Route::post('/reset/password/mnemonic', [
        AuthController::class,
        'postResetWithMnemonic',
    ])->name('post.resetwithmnemonic');

    Route::post('/reset/password', [
        AuthController::class,
        'postResetPassword',
    ])->name('post.resetpassword');

    Route::put('/reset/password', [
        AuthController::class,
        'putResetPassword',
    ])->name('put.resetpassword');
});
Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

Route::get('/master-key', [AuthController::class, 'viewMasterKey'])->name(
    'masterkey'
);

Route::get('/login/verify', [AuthController::class, 'viewVerifyLogin'])->name(
    'verifylogin'
);
Route::post('/login/verify', [AuthController::class, 'postVerifyLogin'])->name(
    'post.verifylogin'
);

####### END AUTH

####### SET PGP KEY
Route::middleware(['auth', 'ban', 'two_factor_authentication'])->group(
    function () {
        Route::get('/set/pgp-key', [
            UserController::class,
            'viewSetPGPKey',
        ])->name('setpgpkey');
        Route::get('/mnemonic', [AuthController::class, 'viewMnemonic'])->name(
            'register-success'
        );
        Route::get('/homes', [AuthController::class, 'returnHome'])->name(
            'mnemoniccopied'
        );
        Route::post('/set/pgp-key', [
            UserController::class,
            'postSetPGPKey',
        ])->name('post.setpgpkey');
        Route::put('/set/pgp-key', [
            UserController::class,
            'putSetPGPKey',
        ])->name('put.setpgpkey');
        Route::get('/set/pgp-key/cancel', [
            UserController::class,
            'cancelSetPGPKey',
        ])->name('cancelsetpgpkey');
    }
);
####### END SET PGP KEY
Route::middleware([
    'auth',
    'ban',
    'mnemoniccopy',
    'pgp_key',
    'two_factor_authentication',
])->group(function () {
    Route::get('/welcome', [UserController::class, 'viewWelcome'])->name(
        'welcome'
    );
    ####### INDEX
    Route::get('/', [IndexController::class, 'viewHome'])->name('home');
    Route::get('/productdetail/{product}', [
        IndexController::class,
        'viewProductDetail',
    ])->name('detailview');
    Route::get('/category/{slug}', [
        IndexController::class,
        'viewCategory',
    ])->name('category');
    Route::get('/products/seller/{vendor}', [
        IndexController::class,
        'viewVendorProducts',
    ])->name('vendorproducts');

    Route::get('/product/{product}', [
        IndexController::class,
        'viewProduct',
    ])->name('product');

    Route::get('/cart', [IndexController::class, 'viewCart'])->name('cart');
    Route::post('/cart/add/product/{product}', [
        IndexController::class,
        'postAddToCart',
    ])->name('post.addtocart');
    Route::post('/cart/savechange/productcart', [
        IndexController::class,
        'postSaveCart',
    ])->name('post.savecart');
    Route::post('/cart/clear', [IndexController::class, 'postClearCart'])->name(
        'post.clearcart'
    );
    Route::get('/cart/remove/product/{product}', [
        IndexController::class,
        'postRemoveToCart',
    ])->name('post.removetocart');
    // Route::get('/cart/remove/products/{product}', [
    //     IndexController::class,
    //     'viewConfirm',
    // ])->name('confirmcart');

    Route::post('/checkout/order', [
        IndexController::class,
        'postCheckout',
    ])->name('post.checkout');

    Route::get('/profile/{seller}', [
        IndexController::class,
        'viewSeller',
    ])->name('seller');

    Route::post('/fan/{seller}', [IndexController::class, 'postFan'])->name(
        'post.fan'
    );

    Route::get('/faq', [IndexController::class, 'viewAbout'])->name('about');
    Route::get('/rules', [IndexController::class, 'viewRules'])->name('rules');
    Route::get('/adminpgp', [IndexController::class, 'adminPGP'])->name(
        'adminpgp'
    );
    Route::get('/mirrors', [IndexController::class, 'viewMirrors'])->name(
        'mirrors'
    );
    Route::get('/canary', [IndexController::class, 'viewCanary'])->name(
        'canary'
    );
    Route::get('/ticket', [IndexController::class, 'viewSupport'])->name(
        'ticket'
    );

    Route::get('/product/report/{product}', [
        IndexController::class,
        'viewReport',
    ])->name('report');
    Route::post('/product/report/{product}', [
        IndexController::class,
        'postReport',
    ])->name('post.reportproduct');

    Route::get('/notices/diary', [
        IndexController::class,
        'viewNoticeDiary',
    ])->name('noticediary');
    Route::get('/notice/{notice}', [
        IndexController::class,
        'viewNotice',
    ])->name('notice');

    Route::get('/helpdesk', [IndexController::class, 'viewSupport'])->name(
        'support'
    );
    Route::post('/helpdesk', [
        IndexController::class,
        'postCreateHelpRequest',
    ])->name('post.createhelprequest');
    Route::get('/helpdesk/ticket/{helpRequest}', [
        IndexController::class,
        'viewHelpRequest',
    ])->name('helprequest');
    Route::post('/helpdesk/ticket/{helpRequest}', [
        IndexController::class,
        'postHelpRequest',
    ])->name('post.helprequest'); #Create new reply
    Route::post('/search/result', [IndexController::class, 'postResult'])->name(
        'post.result'
    );
    Route::get('/search/result', [IndexController::class, 'viewResult'])->name(
        'result'
    );
    ####### END INDEX

    ####### USER
    Route::prefix('account')->group(function () {
        #currency
        Route::get('/currency', [UserController::class, 'viewSettings'])->name(
            'settings'
        );
        Route::post('/currency', [
            UserController::class,
            'postChangeCurrency',
        ])->name('post.changecurrency');
        Route::get('/2FA-Settings', [
            UserController::class,
            'view2FAsetting',
        ])->name('2fasetting');
        Route::post('/2FA-Settings/enable', [
            UserController::class,
            'enable2FA',
        ])->name('post.enable2FA');
        Route::post('/2FA-Settings/disable', [
            UserController::class,
            'disable2FA',
        ])->name('post.disable2FA');

        #PGP KEYS
        Route::get('/pgp', [UserController::class, 'viewPGP'])->name('pgp');
        Route::post('/pgp/change-pgp-key', [
            UserController::class,
            'postChangePGPKey',
        ])->name('post.changepgpkey'); #Create verification code
        Route::put('/pgp/change-pgp-key', [
            UserController::class,
            'putChangePGPKey',
        ])->name('put.changepgpkey'); #Confirm verification code and change PGP key
        Route::get('/pgp/cancel-pgp-key-change', [
            UserController::class,
            'cancelPGPKeyChange',
        ])->name('cancelpgpkeychange'); #Cancel pgp key change request
        Route::get('/pgp/twostep', [
            UserController::class,
            'putTwoFactorAuthentication',
        ])->name('changetwofactorauthentication');
        Route::put('/settings/change-two-factor-authentication', [
            UserController::class,
            'putTwoFactorAuthentication',
        ])->name('put.changetwofactorauthentication');

        #index
        Route::get('/stats', [UserController::class, 'viewAccountIndex'])->name(
            'accountindex'
        );

        // Route::get('/2FA-Settings', [
        //     UserController::class,
        //     'view2FAsetting',
        // ])->name('2fasetting');

        #WALLET
        Route::get('/wallet', [UserController::class, 'viewWallet'])->name(
            'payment'
        );
        Route::get('/exchange', [UserController::class, 'viewExchange'])->name(
            'exchange'
        );
        Route::post('/wallet/withdraw', [
            UserController::class,
            'postWithdraw',
        ])->name('post.withdraw');

        #MESSAGES
        Route::get('/messages', [
            UserController::class,
            'viewConversations',
        ])->name('conversations');
        Route::get('/viewconversationmessages/{conversation}', [
            UserController::class,
            'viewConversationMessages',
        ])->name('selectconv');
        Route::get('/conversationmessages/open', [
            UserController::class,
            'openConversationMessages',
        ])->name('openconversationmessages');
        Route::post('/messages/new', [
            UserController::class,
            'postNewConversation',
        ])->name('post.conversations'); #Create new covnersation
        Route::get('/messages/{conversation}', [
            UserController::class,
            'viewConversationMessages',
        ])->name('conversationmessages');
        Route::post('/messages/post/{conversation}', [
            UserController::class,
            'postNewConversationMessage',
        ])->name('post.conversationmessages');
        Route::get('/messages/new/{vendor}', [
            UserController::class,
            'createNewConversation',
        ])->name('newconversation');
        Route::post('/report/{vendor}', [
            UserController::class,
            'postReportVendor',
        ])->name('post.reportvendor');
        // Route::post('/report/{product}', [
        //     UserController::class,
        //     'postReportProduct',
        // ])->name('post.reportproduct');
        Route::get('/feedback/detailvendor/{vendor}', [
            UserController::class,
            'viewFeedbackDetail',
        ])->name('detailfeedback');
        Route::get('/feedback/detailproduct/{product}', [
            UserController::class,
            'viewFeedbackDetail_p',
        ])->name('detailfeedback_p');

        #Change Avatar
        Route::put('/stats', [UserController::class, 'putChangeAvatar'])->name(
            'put.changeavatar'
        );

        Route::post('/stats', [UserController::class, 'saveDescription'])->name(
            'post.savedescription'
        );

        #Create new message

        Route::get('/all/wishlist', [
            UserController::class,
            'viewFavorites',
        ])->name('favorites');
        Route::post('/all/wishlist/{product}', [
            UserController::class,
            'postFavorites',
        ])->name('post.favorites'); #Add or remove product to favorites
        Route::get('/orders/{status}', [
            UserController::class,
            'viewOrders',
        ])->name('orders');

        Route::get('/pin-settings', [
            UserController::class,
            'viewHistory',
        ])->name('history'); #pin settings changed from history
        Route::put('/pin-settings', [
            UserController::class,
            'putChangePIN',
        ])->name('put.changepin');

        Route::get('/password', [
            UserController::class,
            'viewStatistics',
        ])->name('statistics');
        Route::put('/password', [
            UserController::class,
            'putChangePassword',
        ])->name('put.changepassword');

        Route::get('/affiliate', [
            UserController::class,
            'viewAffiliate',
        ])->name('affiliate');

        Route::get('/notifications', [
            UserController::class,
            'viewNotifications',
        ])->name('notifications');

        Route::get('/notifications/detail/{notification}', [
            UserController::class,
            'viewNotificationDetails',
        ])->name('notificationdetail');
        Route::delete('/notifications', [
            UserController::class,
            'deleteNotifications',
        ])->name('delete.notifications');

        Route::get('/pgp/key', [UserController::class, 'viewPgpKey'])->name(
            'pgpkey'
        );
    });
    ####### END USER

    ####### SELLER
    Route::prefix('vending')->group(function () {
        Route::get('/become', [SellerController::class, 'viewBecome'])->name(
            'becomeseller'
        );
        Route::post('/become', [SellerController::class, 'postBecome'])->name(
            'post.becomeseller'
        );

        Route::middleware('seller')->group(function () {
            Route::get('/dashboard', [
                SellerController::class,
                'viewDashboard',
            ])->name('seller.dashboard');
            Route::put('/dashboard', [
                SellerController::class,
                'putDashboard',
            ])->name('put.seller.dashboard'); #Edit public profile
            Route::get('/sales/{status}', [
                SellerController::class,
                'viewSales',
            ])->name('sales');
            Route::get('/sales/{order}/view', [
                SellerController::class,
                'viewSale',
            ])->name('sale');
            Route::post('/bidding/slot', [
                SellerController::class,
                'postBid',
            ])->name('post.bidding');
        });
    });
    ####### END SELLER

    ####### STAFF
    Route::group(['middleware' => 'staff', 'prefix' => 'staff'], function () {
        Route::get('/notices', [StaffController::class, 'viewNotices'])->name(
            'staff.notices'
        );
        Route::get('/notices/{notice}', [
            StaffController::class,
            'viewNotice',
        ])->name('staff.notice');
        Route::put('/notices/{notice}/edit', [
            StaffController::class,
            'putEditNotice',
        ])->name('put.staff.editnotice');

        // Route::get('/products', [StaffController::class, 'viewProducts'])->name(
        //     'staff.products'
        // );
        Route::put('/products/{product}/featured', [
            StaffController::class,
            'putFeatured',
        ])->name('put.staff.featuredproduct'); #Mark product to featured
        Route::get('/disputes', [StaffController::class, 'viewDisputes'])->name(
            'staff.disputes'
        );

        Route::get('/reports', [StaffController::class, 'viewReports'])->name(
            'staff.reports'
        );
        Route::delete('/reports/{report}/delete', [
            StaffController::class,
            'deleteReport',
        ])->name('delete.staff.report');

        Route::post('/support/{helpRequest}/close', [
            StaffController::class,
            'postCloseHelpRequest',
        ])->name('post.staff.closehelprequest');
        Route::post('/support/{helpRequest}/open', [
            StaffController::class,
            'postOpenHelpRequest',
        ])->name('post.staff.openhelprequest');
        Route::delete('/support/{helpRequest}/delete', [
            StaffController::class,
            'deleteHelpRequest',
        ])->name('delete.staff.helprequest');

        Route::post('/orders/{dispute}/resolve/dispute', [
            StaffController::class,
            'postResolveDispute',
        ])->name('post.resolvedispute');

        Route::get('/mass-message', [
            StaffController::class,
            'viewMassMessage',
        ])->name('staff.massmessage');
    });
    Route::group(
        [
            'middleware' => 'staff',
            'prefix' => 'admin',
        ],
        function () {
            Route::post('/promote/{product}', [
                AdminController::class,
                'promoteProduct',
            ])->name('promote');
            Route::post('/unpromote/{product}', [
                AdminController::class,
                'unpromoteProduct',
            ])->name('unpromote');
            Route::post('/delpromote/{product}', [
                AdminController::class,
                'delpromoteProduct',
            ])->name('delpromote');
            Route::get('/{section}/dashboard', [
                AdminController::class,
                'viewDashboard',
            ])->name('admin.dashboard');
            Route::get('/{section}/news', [
                AdminController::class,
                'viewNews',
            ])->name('admin.news');
            Route::get('/{section}/faqs', [
                AdminController::class,
                'viewFaqs',
            ])->name('admin.faqs');
            Route::get('/{section}/withdrawmarketfees', [
                AdminController::class,
                'viewWithdrawMarketFees',
            ])->name('admin.withdrawmarketfees');
            Route::get('/{section}/lostmoneyhistory', [
                AdminController::class,
                'viewLostMoneyHistory',
            ])->name('admin.lostmoneyhistory');
            Route::get('/{section}/withdrawalhistory', [
                AdminController::class,
                'viewWithdrawalHistory',
            ])->name('admin.withdrawalhistory');
            Route::get('/dashboard', [
                AdminController::class,
                'viewDashboard2',
            ])->name('admin.dashboard2');
            Route::post('/notices', [
                AdminController::class,
                'postAddNotice',
            ])->name('post.admin.addnotice');
            Route::delete('/notices/{notice}/delete', [
                AdminController::class,
                'deleteNotice',
            ])->name('delete.admin.notice');
            Route::get('/{section}/supporttickets/filter', [
                AdminController::class,
                'viewSupport',
            ])->name('admin.supporttickets');
            Route::put('/adminsettings/settings', [
                AdminController::class,
                'putDashboard',
            ])->name('put.admin.dashboard');
            Route::post('/addtodo', [AdminController::class, 'addTodo'])->name(
                'post.addtodo'
            );
            Route::get('/deltodo/{todo?}', [
                AdminController::class,
                'delTodo',
            ])->name('deltodo');
            Route::post('/exit-button', [
                AdminController::class,
                'postExitButton',
            ])->name('post.admin.exitbutton');

            Route::put('/edit/mainsettings/{user}', [
                AdminController::class,
                'editMainSettings',
            ])->name('edit.mainsettings');
            Route::post('/edit/banuser/{user}', [
                AdminController::class,
                'editBanUser',
            ])->name('edit.banuser');
            Route::post('/edit/pgp/{user}', [
                AdminController::class,
                'editPGP',
            ])->name('edit.pgp');
            Route::post('/edit/fakefeedback/{user}', [
                AdminController::class,
                'editFakeFeedback',
            ])->name('edit.fakefeedback');

            Route::get('/{section}/categories', [
                AdminController::class,
                'viewCategories',
            ])->name('admin.categories');
            Route::get('/{section}/settings', [
                AdminController::class,
                'viewAdminSettings',
            ])->name('admin.settings');
            Route::get('/{section}/notices', [
                AdminController::class,
                'viewAdminNotices',
            ])->name('admin.notices');
            Route::post('/categories', [
                AdminController::class,
                'postAddCategory',
            ])->name('post.admin.addcategories');
            Route::get('/{section}/editcategories/{category}', [
                AdminController::class,
                'viewCategory',
            ])->name('admin.editcategory');
            Route::put('/categories/{category}/edit', [
                AdminController::class,
                'putEditCategory',
            ])->name('put.admin.editcategory');
            Route::get('/categories/{category}/delete', [
                AdminController::class,
                'deleteCategory',
            ])->name('delete.admin.category');

            Route::get('/{section}/users', [
                AdminController::class,
                'viewUsers',
            ])->name('admin.users');
            Route::get('/{section}/edituser/{user}', [
                AdminController::class,
                'editUser',
            ])->name('edituser');
            Route::get('/users/{user}', [
                AdminController::class,
                'viewUser',
            ])->name('admin.user');
            Route::post('/users/ban/{user}', [
                AdminController::class,
                'banUser',
            ])->name('ban.user');
            Route::get('/users/unban/{user}', [
                AdminController::class,
                'unbanUser',
            ])->name('unban.user');
            Route::get('/users/confirm/{user}/{ban}', [
                AdminController::class,
                'viewBanReason',
            ])->name('banreason');
            Route::put('/users/{user}/edit', [
                AdminController::class,
                'putEditUser',
            ])->name('put.admin.edituser');

            Route::get('/{section}/livefeed', [
                AdminController::class,
                'viewLivefeed',
            ])->name('admin.livefeed');
            Route::get('/{section}/vendors', [
                AdminController::class,
                'viewVendors',
            ])->name('admin.vendors');
            Route::get('/{section}/messages', [
                AdminController::class,
                'viewMessages',
            ])->name('admin.messages');
            Route::get('/{section}/massmessages', [
                AdminController::class,
                'viewMassMessages',
            ])->name('admin.massmessages');
            Route::post('/mass-message', [
                AdminController::class,
                'postMassMessage',
            ])->name('post.admin.massmessage');
            Route::get('/{section}/products', [
                AdminController::class,
                'viewProducts',
            ])->name('admin.products');
            Route::get('/{section}/orders', [
                AdminController::class,
                'viewOrders',
            ])->name('admin.orders');
            Route::get('/{section}/withdrawals', [
                AdminController::class,
                'viewWithdrawals',
            ])->name('admin.withdrawals');
            // Route::get('/{section}/categories', [
            //     AdminController::class,
            //     'viewCategories',
            // ])->name('admin.categories');
            Route::get('/{section}/othermarkets', [
                AdminController::class,
                'viewOthermarkets',
            ])->name('admin.othermarkets');
            Route::post('/{section}/othermarkets/add', [
                AdminController::class,
                'postAddOtherMarkets',
            ])->name('addothermarket');
            Route::post('/{section}/othermarkets/edit/{market}', [
                AdminController::class,
                'postEditOtherMarkets',
            ])->name('editothermarket');
            Route::post('/editusers/{user}/market', [
                AdminController::class,
                'postASDF',
            ])->name('asdf');

            Route::get('/{section}/reports/vendor', [
                AdminController::class,
                'viewReportvendors',
            ])->name('admin.reportvendors');
            Route::get('/{section}/reports/product', [
                AdminController::class,
                'viewReportproducts',
            ])->name('admin.reportproducts');
            Route::get('/{section}/bannedusers', [
                AdminController::class,
                'viewBannedusers',
            ])->name('admin.bannedusers');
            Route::get('/{section}/disputes', [
                AdminController::class,
                'viewDisputes',
            ])->name('admin.disputes');
            Route::get('/accept/disputes/{dispute}', [
                AdminController::class,
                'acceptDispute',
            ])->name('acceptdispute');
            // Route::get('/{section}/supporttickets', [
            //     AdminController::class,
            //     'viewSupporttickets',
            // ])->name('admin.supporttickets');
            Route::post('/dashboard/adminchats', [
                AdminController::class,
                'postAdminChats',
            ])->name('post.adminchats');
        }
    );
    ####### END STAFF

    ####### PRODUCT
    Route::get('/{section}/createphysical/{product?}', [
        ProductController::class,
        'createPhysical',
    ])->name('createphysical');

    Route::post('/{section}/createphysical/{product?}', [
        ProductController::class,
        'postPhysicalProduct',
    ])->name('post.physicalproduct');

    Route::get('/{section}/createdigital/{product?}', [
        ProductController::class,
        'createDigital',
    ])->name('createdigital');

    Route::post('/{section}/createdigital/{product?}', [
        ProductController::class,
        'postDigitalProduct',
    ])->name('post.digitalproduct');

    Route::get('/{section}/product/images/{product?}', [
        ProductController::class,
        'viewImages',
    ])->name('images');
    Route::post('/{section}/product/images/{product?}', [
        ProductController::class,
        'postImage',
    ])->name('post.image');
    Route::post('/{section}/product/images/delete/{image}/{product?}', [
        ProductController::class,
        'postDeleteImage',
    ])->name('post.deleteimage');

    Route::get('/{section}/product/offers/{product?}', [
        ProductController::class,
        'viewOffers',
    ])->name('offers');
    Route::post('/{section}/product/offers/{product?}', [
        ProductController::class,
        'postOffer',
    ])->name('post.offer');
    Route::post('/{section}/product/offers/delete/{offer}/{product?}', [
        ProductController::class,
        'postDeleteOffer',
    ])->name('post.deleteoffer');

    Route::get('/{section}/product/deliveries/{product?}', [
        ProductController::class,
        'viewDeliveries',
    ])->name('deliveries');
    Route::post('/{section}/product/deliveries/{product?}', [
        ProductController::class,
        'postDelivery',
    ])->name('post.delivery');
    Route::post('/{section}/product/deliveries/delete/{delivery}/{product?}', [
        ProductController::class,
        'postDeleteDelivery',
    ])->name('post.deletedelivery');

    Route::get('/{section}/product/informations/{product?}', [
        ProductController::class,
        'viewInformations',
    ])->name('informations');
    Route::post('/{section}/product/informations/{product?}', [
        ProductController::class,
        'postInformations',
    ])->name('post.informations');

    Route::post('/product/delete/{product}', [
        ProductController::class,
        'postDeleteProduct',
    ])->name('post.deleteproduct'); #Delete product
    Route::get('/product/delete/{product?}', [
        ProductController::class,
        'viewConfirms',
    ])->name('confirm');

    ####### END PRODUCT

    ####### ORDER
    Route::get('/orders/{order}/view', [
        OrderController::class,
        'viewOrder',
    ])->name('order');
    Route::post('/orders/feedback/{order}', [
        OrderController::class,
        'postFeedback',
    ])->name('post.feedback');
    Route::get('/dispute-message/view/{order}', [
        OrderController::class,
        'viewDispute',
    ])->name('dispute-message');
    Route::post('/orders/{dispute}/dispute/message', [
        OrderController::class,
        'postCreateDisputeMessage',
    ])->name('post.createdisputemessage');
    Route::get('/orders/dispute/sharefunds50/{dispute}', [
        Ordercontroller::class,
        'shareFunds50',
    ])->name('sharefunds50');
    Route::get('/orders/dispute/sharefunds75/{dispute}', [
        Ordercontroller::class,
        'shareFunds75',
    ])->name('sharefunds75');
    Route::get('/orders/dispute/sharefunds25/{dispute}', [
        Ordercontroller::class,
        'shareFunds25',
    ])->name('sharefunds25');
    Route::get('/orders/dispute/sharefunds100/{dispute}', [
        Ordercontroller::class,
        'shareFunds100',
    ])->name('sharefunds100');
    Route::get('/orders/dispute/sharefunds0/{dispute}', [
        Ordercontroller::class,
        'shareFunds0',
    ])->name('sharefunds0');
    Route::get('/orders/dispute/refund/{dispute}', [
        Ordercontroller::class,
        'refund',
    ])->name('refund');
    Route::post('/orders/{order}/finalizearly', [
        OrderController::class,
        'postFinalizearly',
    ])->name('post.finalizearly');
    Route::get('/orders/{order}/status/{status}', [
        OrderController::class,
        'postChangeOrderStatus',
    ])->name('post.changeorderstatus');
    ####### END ORDER
});