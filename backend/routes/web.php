<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\InquiryController;

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

// Route::get('/', [HomeController::class, 'index']);


Auth::routes();

Route::get('/', [PostController::class, 'index']);


Route::group(['middleware' => 'auth'], function(){

    //POSTS
    Route::name('posts.')->group(function () {
        //Show Create Form
        Route::get('/create', [PostController::class, 'create'])->name('create');
        //Manage Posts
        Route::get('/myposts', [PostController::class, 'myPosts'])->name('myPosts');
        //STORE Post
        Route::post('/posts', [PostController::class, 'store'])->name('store');
        //SHOW EDIT FORM
        Route::get('/edit/{post}', [PostController::class, 'edit'])->name('edit');
        //UPDATE Post
        Route::patch('/update/{post_id}', [PostController::class, 'update'])->name('update');
        //DELETE Post
        Route::delete('/delete/{post_id}', [PostController::class, 'destroy'])->name('destroy');
        
        //Single Listing
        Route::get('/show/{post_id}', [PostController::class, 'show'])->name('show');
    });
    
    //User
    Route::name('user.')->group(function(){
        //Show Profile
        Route::get('/show', [UserController::class, 'show'])->name('show');
        //Edit Profile
        Route::get('/edit', [UserController::class, 'edit'])->name('edit');
        //Show Inquiry Form
        Route::get('/inquiry', [InquiryController::class, 'inquiry'])->name('inquiry');
        //STORE Inquiry
        Route::post('/storeInquiry', [InquiryController::class, 'store'])->name('store');
        //Update Profile
        Route::patch('/update', [UserController::class, 'update'])->name('update');

    });

    //Comment
    Route::name('comment.')->group(function(){
       //Add Comment
       Route::get('/store', [CommentController::class, 'store'])->name('store'); 
       
    });

    //Admin
    Route::name('admin.')->group(function(){
        Route::get('/adminPage', [AdminController::class, 'adminPage'])->name('adminPage');
        Route::get('/addAdmin', [AdminController::class, 'addAdmin'])->name('addAdmin');
        Route::patch('/usertype1/{user_id}', [AdminController::class, 'changeUsertype1'])->name('changeUsertype1');
        Route::patch('/usertype0/{user_id}', [AdminController::class, 'changeUsertype0'])->name('changeUsertype0');

        Route::get('/checkInquiries', [InquiryController::class, 'index'])->name('index');
        Route::get('/respondInquiry/{inquiry}', [InquiryController::class, 'respondInquiry'])->name('respondInquiry');
        Route::patch('/updateInquiry/{inquiry}', [InquiryController::class, 'updateInquiry'])->name('updateInquiry');

        Route::get('/accountAdministration', [AdminController::class, 'accountAdministration'])->name('account');
        Route::patch('/suspended/{user_id}', [AdminController::class, 'suspended'])->name('suspended');
        Route::patch('/reversed/{user_id}', [AdminController::class, 'reversed'])->name('reversed');

        //Single Inquiry
        Route::get('/showInquiry/{inquiry}', [InquiryController::class, 'show'])->name('show');

    });

});
