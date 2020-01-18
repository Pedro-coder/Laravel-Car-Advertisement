<?php
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
Route::get('clear_cache', function(){
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    
    echo '<h3>All cache has been cleared.</h3>';

});

Route::get('check',function(){dd(Auth::user()->isUserHasTaxiPermission());});
Route::middleware(['guest'])->group(function () {

    Route::get('/', 'PublicPageController@welcome')->name('welcome');
    // Visitors
    Route::get('sell/{id}', 'PublicPageController@SellView')->name('sell');
    Route::get('buy/{id}', 'PublicPageController@BuyView')->name('buy');
    Route::get('/home', 'HomeController@index')->name('home');
    //Waqas Changes
    Route::get('/email-verification', 'UserController@emailVerification')->name('emailVerification');
});
//Route::get('/deploy-923457286', 'Controller@deploy')->name('deploy');
// Default
Auth::routes(['verify' => false]);
Route::middleware(['auth'])->group(function () {
    //home
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/filter', 'HomeController@filter')->name('filter');
    // Admin
    Route::get('admin', 'PageController@viewAdmin')->name('admin');
    //Waqas Changes
    Route::get('findmenu_options', 'PageController@findmenu_options')->name('findmenu_options');
    Route::post('add_user_menu', 'PageController@add_user_menu')->name('add_user_menu');
    Route::get('brandupdate', 'PageController@brandupdate')->name('brandupdate');
    Route::post('brandupdate', 'PageController@brandupdate')->name('brandupdate');
    //Admin dropdown
    Route::get('wallet', 'PageController@wallet')->name('wallet');
    Route::get('wallet/{id?}', 'PageController@wallet')->name('wallet.user');
    Route::get('UserAccess', 'PageController@userAccess')->name('UserAccess');
    Route::get('accountant', 'PageController@accountant')->name('accountant');
    Route::get('accountant/user/{id}', 'PageController@accountantUser')->name('User');
    Route::get('membership', 'PageController@membership')->name('membership');
    Route::get('userMembershipdetails/{id}', 'PageController@userMembershipdetails')->name('userMembershipdetails');
    Route::post('updateShareRate', 'PageController@updateShareRate')->name('updateShareRate');
    Route::get('delete_car/{id}','TaxiController@delete_car');
    Route::get('approve_car/{id}','TaxiController@approve_car');
    Route::get('reject_car/{id}','TaxiController@reject_car');
    

    //Taxi Routes
    Route::get('taxi','TaxiController@index')->name('index.taxi');
    Route::post('addnewcar','TaxiController@addnewcar');
    Route::post('updatecar','TaxiController@updatecar');
    Route::get('getactivityjson/{id?}','TaxiController@getactivityjson');
    Route::get('usertaxi','TaxiController@usertaxi')->name('user.taxi');
    Route::get('accountstatus','TaxiController@accountstatus');
    Route::get('gettaxidetails/{id}','TaxiController@gettaxidetails');


    Route::get('CategorySetup', 'PageController@categorySetup')->name('categorySetup');
    Route::get('CategorySetup2', 'PageController@test')->name('test');
    Route::get('QueryScreen', 'PageController@queryscreen')->name('queryscreen');
    Route::post('TakeQuery', 'PageController@takeQuery')->name('takequery');
    Route::post('SaveQuery', 'PageController@saveQuery')->name('saveQuery');
    Route::post('DeleteQuery', 'PageController@deleteQuery')->name('deleteQuery');
    Route::post('SavePost', 'PageController@savePost')->name('savePost');
    Route::post('credit', 'PageController@credit')->name('credit');
    Route::post('transfer', 'PageController@transfer')->name('transfer');
    Route::post('cancelWithdrawRequest', 'PageController@cancelWithdrawRequest')->name('cancelWithdrawRequest');
    Route::post('approveWithdrawRequest', 'PageController@approveWithdrawRequest')->name('approveWithdrawRequest');
    Route::post('memberData', 'PageController@memberData')->name('memberData');
    Route::post('uploadMemberPdfFile', 'PageController@uploadMemberPdfFile')->name('uploadMemberPdfFile');
    Route::get('downloadMemberPdfFile', 'PageController@downloadMemberPdfFile')->name('downloadMemberPdfFile');
    Route::post('getIdNameList', 'PageController@getIdNameList')->name('getIdNameList');
    Route::post('OpacityUpdate', 'PageController@opacityUpdate')->name('opacityUpdate');
    Route::post('getEmailBasedData', 'PageController@getEmailBasedData')->name('getEmailBasedData');
    Route::post('getTransByDateRange', 'PageController@getTransByDateRange')->name('getTransByDateRange');
    Route::post('moveToExcel', 'PageController@moveToExcel')->name('moveToExcel');

    // Admin
    Route::get('admin', 'PageController@viewAdmin')->name('admin');
    Route::get('findmenu_options', 'PageController@findmenu_options')->name('findmenu_options');
    Route::post('add_user_menu', 'PageController@add_user_menu')->name('add_user_menu');
    Route::get('brandupdate', 'PageController@brandupdate')->name('brandupdate');
    Route::post('brandupdate', 'PageController@brandupdate')->name('brandupdate');
//Babar works 
    Route::get('/booking', 'BookingController@booking')->name('booking');
    // User Profile
    Route::get('/profile', 'UserController@showProfile')->name('profile');
    Route::get('/profile/{id}','UserController@showProfilewithid');
    Route::get('/userprofile', 'UserController@userProfile');
    Route::get('/userprofile/{id}', 'UserController@otherUserProfile')->name('otherUserProfile');
    Route::get('/userprofile/{id}/about', 'UserController@aboutotherUserProfile')->name('about.otherUserProfile');
    Route::get('/about', 'UserController@about')->name('about');
    Route::post('/about/userProfile', 'UserController@aboutUserProfile');
    Route::get('generate-pdf','UserController@generatePDF');

    Route::post('/updateUserImage', 'UserController@updateCoverPic')->name('updateImage');
//matul
    Route::get('/user_access_search','PageController@user_access_search')->name('user_access_search');
    Route::get('/get_user_image_and_link','PageController@get_user_image_and_link')->name('get_user_image_and_link');
    //login_system by matul.........
    Route::get('/create_user_with_verification','UserController@registeruser');
    Route::get('/create_user_without_verification','UserController@registeruserwithout');
    Route::get('/verified_email/{email}/{token}','UserController@verified_email')->name('verified_email');
//endof login system by matul......
    Route::post('/profile', 'UserController@updatePic')->name('updatePic');
    Route::post('/updateUser', 'UserController@updateUser')->name('updateUser');
    Route::get('/user-search', 'UserController@search')->name('user-search');
    Route::get('/user-search-filter', 'UserController@searchforfilter')->name('user-search-filter');

    Route::get('/upcoming_services', 'PageController@upcomingServices')->name('upcomingServices');


    //My Posts
    Route::get('/my_posts', 'PageController@myPosts')->name('myPosts');
    Route::get('saved_posts', 'PageController@getSavePost')->name('getSavePost');
    //Coupon
    Route::get('/coupon', 'CouponController@coupons')->name('coupons');
    Route::get('/coupon/action', 'CouponController@action')->name('coupon.action');
    Route::get('/coupon/create', 'CouponController@create')->name('coupon.create');
    Route::post('/coupon/create', 'CouponController@store')->name('coupon.store');
    Route::get('/coupon/{id}/edit', 'CouponController@editCoupon')->name('coupon.edit');
    Route::post('/coupon/{id}/update', 'CouponController@updateCoupon')->name('coupon.update');
    Route::get('/coupon/{id}/delete', 'CouponController@deleteCoupon')->name('coupon.delete');


    // All Order details
    //Show All Orders
    Route::get('/order', 'OrderController@index')->name('order');
    //Buyer order from single buyer post
    Route::PUT('/buyerOrder/{id}', 'OrderController@buyerOrder')->name('buyerOrder');
    Route::get('/buyerShow/{id}', 'OrderController@buyerShow')->name('buyerShow');
    Route::get('/buyerSingle/{id}', 'OrderController@buyerSingle')->name('buyerSingle');
    Route::PUT('/buyerStatus/{id}', 'OrderController@buyerStatus')->name('buyerStatus');
    //Seller order from single seller post
    Route::PUT('/sellerOrder/{id}', 'OrderController@sellerOrder')->name('sellerOrder');
    // Route::get('/sellerShow/{id}', 'OrderController@sellerShow')->name('sellerShow');
    Route::get('/sellerSingle/{id}', 'OrderController@sellerSingle')->name('sellerSingle');
    Route::PUT('/sellerStatus/{id}', 'OrderController@sellerStatus')->name('sellerStatus');
    //Posts (buyer, seller, article)
    Route::resource('/buyer', 'BuyerController');
    Route::resource('/seller', 'SellerController');
    Route::resource('/article', 'ArticleController');
    //email
    Route::resource('/email', 'EmailController');


});
//Waqas Changes
Route::middleware(['auth'])->group(function () {
    Route::post('user-access-ajax', 'PageController@userAccessAjax')->name('UserAccessAjax');
    Route::post('edit-or-create-new-user', 'PageController@saveExistingUser')->name('saveExistingUser');
    Route::post('create-user/{flag}', 'PageController@CreateUserWith')->name('CreateUserWith');
    Route::post('delete-user', 'PageController@deleteProfile')->name('deleteProfile');

});

//Routes for advertisement

Route::get('/advertisement', 'AdvertisementController@index')->name('AdvertisementPage');

Route::post('/AdvertisementAction', 'AdvertisementController@action')->name('AdvertisementAction');
Route::get('/advertisement/show', 'AdvertisementController@viewAds')->name('AdvertisementShow');
Route::post('deleteAdd', 'AdvertisementController@deleteAdd')->name('deleteAdd');
Route::post('getAdsData', 'AdvertisementController@getAdsData')->name('getAdsData');
Route::post('addProfession', 'PageController@addProfession')->name('addProfession');
Route::post('getProfession', 'PageController@getProfession')->name('getProfession');
Route::post('updateProfession', 'PageController@updateProfession')->name('updateProfession');
Route::post('deleteProfession', 'PageController@deleteProfession')->name('deleteProfession');
Route::post('getProfessionOfType', 'PageController@getProfessionOfType')->name('getProfessionOfType');
Route::post('submitMembershipForm', 'PageController@submitMembershipForm')->name('submitMembershipForm');


Route::get('foo', function () {
    return 'Hello World';
});

/////////////////// ///////////////////////////////////
///////////////////////// Abdul Rehman Code ///////////////////////

Route::get('/faqsetup', 'FaqController@faqs')->name('faqs');
Route::get('/faq', 'FaqController@faquser')->name('faquser');
Route::post('/faqsetup/create', 'FaqController@store')->name('faq.store');
Route::get('/faqsetup/{id}/delete', 'FaqController@deleteFaq')->name('faq.delete');
Route::get('/faqsetup/{id}/edit', 'FaqController@editFaq')->name('faq.edit');
Route::post('/faqsetup/{id}/update', 'FaqController@updateFaq')->name('faq.update');

//Faq Category Route
Route::group([ 'prefix' => 'faq','middleware' => 'auth'], function() {

    Route::get('/category', 'FaqCategoryController@index')->name('faq.category.index');
    Route::post('/category', 'FaqCategoryController@store')->name('faq.category.store');
    Route::post('/category/parent', 'FaqCategoryController@storeParent')->name('faq.category.store.parent');
    Route::get('/category/edit/{faq}', 'FaqCategoryController@edit')->name('faq.category.edit');
    Route::put('/category/edit/{faq}', 'FaqCategoryController@update')->name('faq.category.update');
    Route::put('/category/move', 'FaqCategoryController@moveCategory')->name('faq.category.move');
    Route::delete('/category/destroy/{faq}', 'FaqCategoryController@destroy')->name('faq.category.destroy');
    Route::delete('/category/destroy/parent/{name}', 'FaqCategoryController@destroyParent')->name('faq.category.destroy.parent');
    Route::delete('/category/destroy/name/{name}', 'FaqCategoryController@destroyByName')->name('faq.category.destroy.name');

});


//Exam

Route::get('/examsetup', 'ExamController@exams')->name('exams');
Route::get('/exam', 'ExamController@examuser')->name('examuser');
Route::post('/examsetup/create', 'ExamController@store')->name('exam.store');
Route::get('/examsetup/{id}/delete', 'ExamController@deleteExam')->name('exam.delete');
Route::get('/examsetup/{id}/edit', 'ExamController@editExam')->name('exam.edit');
Route::post('/examsetup/{id}/update', 'ExamController@updateExam')->name('exam.update');
Route::post('/examsetup/check', 'ExamController@checkExam')->name('exam.check');


//Train
Route::get('/trainsetup', 'TrainController@trains')->name('trains');
Route::get('/train', 'TrainController@trainuser')->name('trainuser');
Route::post('/trainsetup/create', 'TrainController@store')->name('train.store');
Route::get('/trainsetup/{id}/delete', 'TrainController@deleteTrain')->name('train.delete');
Route::get('/trainsetup/{id}/edit', 'TrainController@editTrain')->name('train.edit');
Route::post('/trainsetup/{id}/update', 'TrainController@updateTrain')->name('train.update');

////////////////// Home Page Setup /////////////////////

Route::get('/homepage-setup', 'UserController@homepageSetup');
Route::post('/sethomepage', 'UserController@setHomepageSetup');


//chat ........

Route::get('/helpchatdashboard', 'ChatDashboardController@helpChat')->name('helpchatdashboard');

Route::get('/chatdashboard', 'ChatDashboardController@index')->name('chatdashboard');
Route::get('/privateChat/{chatRoomId}/{user_id}/{helpDeskUser}', 'PrivateChatController@rtnChatBox')->name('privateChat');
Route::post('/send/{id}/{helpDeskUser}', 'PrivateChatController@store');
Route::post('/geturl', 'PrivateChatController@geturl');
Route::post('/timeformate', 'PrivateChatController@timeformate');
Route::post('/setuserlocalutc', 'PrivateChatController@setuserlocalutc');
Route::get('/getlogedinusertime', 'PrivateChatController@getlogedinusertime')->name('getlogedinusertime');

Route::post('/getOldMessage', 'ChatController@getOldMessage');
Route::post('/chatSpam/{id}', 'ChatController@spam');
Route::post('/chatReport/{id}', 'ChatController@report');
Route::get('/chatsearch', 'searchController@search')->name('chatsearch');

Route::get('/agentchatsearch', 'searchController@agentSearch')->name('agentchatsearch');

Route::get('/defaullevelsearch', 'searchController@defaullevelsearch')->name('defaullevelsearch');
Route::get('/levelsearch', 'searchController@levelsearch')->name('levelsearch');
Route::get('/unreadsearch', 'searchController@unreadsearch')->name('unreadsearch');
Route::get('/indeviduallevelsearch', 'searchController@indeviduallevelsearch')->name('indeviduallevelsearch');

Route::post('/setonline', 'ChatController@setonline');
Route::post('/setoffline', 'ChatController@setoffline');
Route::post('/getallOnlineUser', 'ChatController@getallOnlineUser');
Route::post('/readwrite', 'ChatController@readwrite');

Route::get('/levelset', 'LevelController@index')->name('levelset');
Route::get('/getOldLevel', 'LevelController@getOldLevel');
Route::post('/addcustomlevel', 'LevelController@custom');
Route::get('/leveldel/{id}', 'LevelController@delete')->name('leveldel');
Route::get('/starchat/{id}', 'LevelController@starchat')->name('starchat');
Route::get('/delallchat/{id}', 'LevelController@delallchat');
Route::get('/getmessagepopup', 'messagepopController@index')->name('messagepop');
Route::get('/getmessagepopupcross', 'messagepopController@getmessagepopupcross');

Route::get('/gmtime', 'PrivateChatController@test');
Route::get('/testtt', 'searchController@test');
Route::get('/sendemailforunread', 'PrivateChatController@sendemailforunread');
Route::post('/sendmail', 'PrivateChatController@sendmail');

//end of chat..........
Route::post('getAndMoveVerifyDetails', 'PageController@getAndMoveVerifyDetails')->name('getAndMoveVerifyDetails');
Route::get('getMemberDetailsUsingEmail', 'PageController@getMemberDetailsUsingEmail')->name('getMemberDetailsUsingEmail');
//////////////////////// Blog /////////////////////////////

Route::get('/blog', 'PublicBlogContoller@index')->name('blog');

Route::get('/timeline', 'HomeController@timeline')->name('timeline');
Route::get('/my-blog', 'BlogController@myBlog')->name('my.blog');
Route::get('/add-blog', 'BlogController@addBlog')->name('add.blog');
Route::post('/blog/store', 'BlogController@storeBlog');
Route::get('/public-blog', 'BlogController@publicBlog');
Route::get('/userprofile/{id}/timeline', 'HomeController@timeline')->name('user.profile.timeline');
Route::get('/userprofile/{id}/blog', 'BlogController@userProfileBlog')->name('user.profile.blog');
Route::get('/blod-details/{ids}', 'BlogController@blogDetails')->name('blog.article.detail');
Route::post('/add_comment/{post_id}/{user_id}','BlogController@addComment');
Route::get('/delete_post/{post_id}', 'BlogController@deletePost');
Route::get('/delete_comment/{comment_id}', 'BlogController@deleteComment');
Route::get('/visitors-details/{ids}', 'BlogController@visitorDetails');
Route::post('/blog/update/reaction', 'BlogController@updateBlogReaction');
Route::get('/blog/pay-to-read/{amount}/{owner_id}/{id}','BlogController@payToRead');

Route::post('/storeModelBlog', 'BlogController@storeModelBlog')->name('blog.storeModelBlog');
Route::post('/blog/blogDelete', 'BlogController@deleteModelBlog');
Route::post('/blog/blogModelEdit', 'BlogController@editModelBlog');
Route::get('/blog/insertBlogReferral/{owner_id}/{id}/{enterReferral}','BlogController@insertReferralBlog');

/////////////////////// Sakib changes ///////////////////

Route::resource('/events', 'EventsController');
Route::resource('/eventM', 'EventModalController');
Route::get('/search', 'EventsController@search')->name('search');
Route::get('/going-to-event/{user_id}/{owner_id}/{event_id}/{event_modal_id}','EventsController@goingToEvent');
Route::get('/not-going-to-event/{user_id}/{owner_id}/{event_id}/{event_modal_id}','EventsController@notGoingToEvent');
Route::get('/going-status/{status}/{user_id}/{event_id}/{amount}','EventsController@eventStatus');
//get records
Route::post('/get_records', 'DisputeController@getRecords')->name('getRecords');
Route::post('/event/invite/{event_id}','EventsController@eventInvite');
Route::get('/event/draft/{user_id}','EventsController@draftEvents');
Route::get('/draft/add-plan/{event_id}','EventsController@draftAddPlan');
Route::get('/event/plan&price/{event_id}','EventsController@eventPlanPrice');
Route::get('/event/passed','EventsController@passedEvents');
Route::get('/event/club-events','EventsController@clubEvents');
Route::get('/event/club-member-events','EventsController@clubMemberEvents');
//dispute work
Route::get('/dispute', 'DisputeController@create')->name('dispute');
Route::post('/add_dispute', 'DisputeController@addDispute')->name('adddispute');
Route::post('/get_all_dis_rec', 'DisputeController@getallDispute')->name('getallDispute');

Route::get('events/profile/{user_id}', 'EventsController@profileEvents')->name('events.profile.index');
Route::get('save-event/{event_id}', 'EventsController@saveEvent')->name('events.save');

Route::post('/get_note_of_record', 'DisputeController@getNoteOfRecord')->name('getNoteOfRecord');

//Event start date ane last date insert
Route::post('/events/datetimeInsert', 'EventModalController@insertStartDateTime')->name('events.datetimeInsert');
//insert event model data 
Route::post('/events/eventInsert', 'EventModalController@eventInsert')->name('event.insert');
//update going status
Route::post('/events/goingStatusUpdate', 'EventModalController@goingEventStatus');
//event model edit
Route::post('/events/eventModelEdit', 'EventModalController@eventModelEdit');
//event model saved post
Route::post('/events/eventModelsaved', 'HomeController@eventModelSaved');
//event model Edit date time list
Route::post('/events/eventEditDateTime', 'EventModalController@eventEditDateTime');
//event model Edit add date time
Route::post('/events/editEventDateTime', 'EventModalController@editEventDateTime');
//event delete
Route::post('/events/eventDelete', 'EventModalController@eventDelete');
//event fee pay function
Route::get('/events/joinToPay/{amount}/{owner_id}/{id}/{modelId}/{needApproval}/{ticketBook}','HomeController@payToJoin');
//free join event 
Route::get('/events/freeJoinToPay/{owner_id}/{id}/{modelId}/{needApproval}','HomeController@freeJoinToPay');
//going event participent list
Route::post('/events/goingParticipentList','EventModalController@goingParticipentList');
//waiting event participent list
Route::post('/events/waitingParticipentList','EventModalController@waitingParticipentList');
//update event request need to approval
Route::post('/events/updateEventRequest','EventModalController@updateEventRequest');
//reject event request need to approval
Route::post('/events/rejectEventRequest','EventModalController@rejectEventRequest');
//edit selected event date time
Route::post('/events/selectChangeDateTime','EventModalController@selectChangeDateTime');
//update event date time
Route::post('/events/updateSelectedDateTime','EventModalController@updateSelectedDateTime');
//delete event date time
Route::post('/events/deleteEventDateTime','EventModalController@deleteEventDateTime');
//event model unsaved post
Route::post('/events/eventModelUnsaved', 'HomeController@eventModelUnsaved');
//edit event edit selected event date time
Route::post('/events/selectEditChangeDateTime','EventModalController@selectChangeDateTime');
//delete event date time
Route::post('/events/deleteListEventDateTime','EventModalController@deleteListEventDateTime');
//cancel join request
Route::get('/events/cancelToJoin/{userId}/{eventId}/{eventModelId}/{amount}','HomeController@cancelToJoin');

 Route::get('/share/{event_id}/{user_id}', 'ShareController@eventShareDesign');

 Route::get('/activeEvent', 'EventsController@activeEvent')->name('activeEvent');
 Route::get('/goingEvent', 'EventsController@goingEvent')->name('goingEvent');
 Route::get('/pastEvent', 'EventsController@pastEvent')->name('pastEvent');
 Route::get('/closeEvent', 'EventsController@closeEvent')->name('closeEvent');

 Route::get('/events/insertReferral/{ownerId}/{event_id}/{eventRef}','HomeController@insertReferral');

//////////////Rafi's Changes/////////////////
Route::group(
    [
        'prefix' => 'bids',
    ],
    function(){
        Route::resource('buyers', 'Bids\BuyerController');
    }
);

// //////////////Rafi's Changes/////////////////
// Route::group(
//     [
//         'prefix' => 'bids',
//     ],
//     function(){
//         Route::resource('buyers', 'Bids\BuyerController');
//     }
// );
// //matul bidf
Route::get('/bids/user-bids','bidController@userBids')->name('bids.user.index');
Route::get('/bids/buyers','bidController@index')->name('bids.buyers.index');
Route::get('/buyer_bid_form','bidController@showform');
Route::post('/save-bid-form','bidController@store');
Route::get('/edit-bid-form/{id}','bidController@edit');
Route::post('/edit-bid-form/{id}','bidController@editstore');



Route::group(['prefix' => 'settings'], function() {
    Route::get('/', 'SettingsController@index')->name('settings');
    Route::post('env', 'SettingsController@updateEnv');
      Route::post('display', 'SettingsController@display');
    Route::post('update-email', 'SettingsController@updatePaypalEmailId');
});


Route::get('/bids/buyers/delete/{id}','bidController@delete');


/*Follow user routes*/
Route::post('follow_user', 'FollowController@followUser')->name('follow.user');
Route::post('review_user', 'ReviewController@reviewUser')->name('review.user');
Route::post('total_review','ReviewController@getAverageTotalReview')->name('get.average.total.review');

//Faq Category Route
Route::group([ 'prefix' => 'faq','middleware' => 'auth'], function() {

    Route::get('/category', 'FaqCategoryController@index')->name('faq.category.index');
    Route::post('/category', 'FaqCategoryController@store')->name('faq.category.store');
    Route::get('/category/edit/{faq}', 'FaqCategoryController@edit')->name('faq.category.edit');
    Route::put('/category/edit/{faq}', 'FaqCategoryController@update')->name('faq.category.update');
    Route::delete('/category/destroy/{faq}', 'FaqCategoryController@destroy')->name('faq.category.destroy');

});

//By tuhin
Route::group(['middleware' => 'auth'], function() {

    Route::post('buy/store', 'PostBuyController@storeBuy')->name('post.buy.store');
    Route::post('buy/delete', 'PostBuyController@deleteBuy')->name('post.buy.delete');
    Route::get('buy/get/info', 'PostBuyController@getBuyInfo')->name('post.buy.info');
    Route::post('buy/bid/store', 'PostBuyController@buyBidStore')->name('post.buy.bid.store');
    Route::post('post/bid/delete', 'PostBuyController@postBidDelete')->name('post.bid.delete');
    Route::get('buy/bid/get', 'PostBuyController@buyBidget')->name('post.buy.bid.get');
    Route::post('buy/bid/order/create', 'PostBuyController@orderCreate')->name('post.buy.bid.order.create');
    Route::post('buy/bid/order/in-process', 'PostBuyController@orderInprocessCreate')->name('post.buy.bid.order.inprocess');
    Route::post('buy/bid/order/delivered', 'PostBuyController@orderDeliverCreate')->name('post.buy.bid.order.deliver');
    Route::post('buy/bid/order/dispute', 'PostBuyController@orderDisputeCreate')->name('post.buy.bid.order.dispute');
    Route::post('buy/bid/order/dispute-change', 'PostBuyController@orderDisputeChange')->name('post.buy.bid.order.disputeChange');
    Route::post('buy/bid/order/received', 'PostBuyController@orderReceiveCreate')->name('post.buy.bid.order.receive');

});
Route::post('/post/save', 'HomeController@savePost')->name('post.save');
Route::post('/post/un-save', 'HomeController@savePostUnSave')->name('post.unsave');
Route::get('/post/old', 'PostBuyController@oldPost')->name('post.old');
Route::get('/post/bids', 'PostBuyController@postBids')->name('post.bids');
Route::get('/bids/{id}/other','bidController@otherUsersBid')->name('bids.user.other');

//task5
Route::get('/aboutus','SettingsController@aboutUsPage')->name('aboutus');
Route::resource('/postcategory', 'PostCategoryController');
// Route::post('/postcategory/delete', 'PostCategoryController@destroy');

// --------------- By Rahul start(11-11-19)--------------- //

Route::group(['middleware' => 'auth'], function() {
    // Seller store
    Route::post('sell/store', 'SellerController@storeSell')->name('post.sell.store');
    Route::post('sell/delete', 'SellerController@deleteSell')->name('post.sell.delete');
    Route::post('sell/bid/store', 'SellerController@sellBidStore')->name('post.sell.bid.store');
    Route::get('sell/bid/get', 'SellerController@sellBidget')->name('post.sell.bid.get');
    Route::post('sell/bid/order/create', 'SellerController@orderCreate')->name('post.sell.bid.order.create');
    Route::post('sell/bid/order/received', 'SellerController@orderReceiveCreate')->name('post.sell.bid.order.receive');
});

// ---------------  start(22-11-19)--------------- //
Route::post('sell/getpostcategory', 'SellerController@getPostCategory');

// ---------------- End -------------------- //
//------------counter notification ------------//
Route::post('/counter', 'PageController@counter');
Route::post('/notification-list-page', 'PageController@notificationList');

//Paypal

Route::get('payment-status',array('as'=>'payment.status','uses'=>'PageController@paymentInfo'));
// Route::get('payment',array('as'=>'payment','uses'=>'PageController@payment'));
// Route::get('payment-cancel', function () {
//     return 'Payment has been canceled';
// });
Route::post('payments/with-credit-card','PaypalPaymentController@paywithCreditCard');
Route::post('payments/with-paypal','PaypalPaymentController@paywithPaypal');

Route::get('payments/success','PaypalPaymentController@paymentSuccess');

Route::get('payments/fails','PaypalPaymentController@paymentFailure');

Route::get('payments/list','PaypalPaymentController@listOfTransaction');

Route::get('payments/show','PaypalPaymentController@show');

// Display Category name in buy
Route::post('/maincategory', 'HomeController@displayCategory');