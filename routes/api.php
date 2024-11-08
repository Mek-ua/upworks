<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\EducationalStatusController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FreelancerController;
use App\Http\Controllers\FreelancerSkillController;
use App\Http\Controllers\JobPostController;
use App\Http\Controllers\JobApplyController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AdminController;

// Authentication Routes
Route::prefix('auth')->group(function () {  
    // Route::get('/register', [UserController::class, 'register']);
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [UserController::class, 'logout']);
        Route::put('/profile', [UserController::class, 'updateProfile']);
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });
});

// User Management
Route::get('/users/{id}', [UserController::class, 'viewProfile'])->middleware('auth:sanctum');

// Role Management
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/roles', [RoleController::class, 'index']);
    Route::post('/roles/{userId}', [RoleController::class, 'assignRole']);
});

// Address and Educational Status
Route::get('/addresses', [AddressController::class, 'index']);
Route::get('/addresses/{id}', [AddressController::class, 'show']);
Route::get('/educational-status', [EducationalStatusController::class, 'index']);
Route::get('/educational-status/{id}', [EducationalStatusController::class, 'show']);

//client and freelancer detail
Route::put('/update-client-details/{id}', [ClientController::class, 'updateClientDetails']);
Route::put('/update-freelancer-details/{id}', [FreelancerController::class, 'updateFreelancerDetails']);

// To retrive user name
Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'getUserDetails']);


// Category and Skill Management
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{id}', [CategoryController::class, 'show']);
Route::get('/skills', [SkillController::class, 'index']);
Route::get('/skills/{id}', [SkillController::class, 'show']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/freelancers/{freelancerId}/skills', [FreelancerSkillController::class, 'index']);
    Route::post('/freelancers/{freelancerId}/skills', [FreelancerSkillController::class, 'assignSkill']);
    Route::delete('/freelancers/{freelancerId}/skills/{skillId}', [FreelancerSkillController::class, 'removeSkill']);
});
Route::middleware('auth:sanctum')->post('/job-posts', [JobPostController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    // Routes for authenticated client profile management
    Route::get('/client/profile', [ClientController::class, 'showProfile']); // View authenticated client's profile
    Route::put('/client/profile', [ClientController::class, 'updateProfile']); // Update authenticated client's profile
    Route::get('/client/job-posts', [ClientController::class, 'listJobPosts']); // List job posts created by authenticated client

    // Routes for admin access to specific client profiles by ID
    Route::get('/clients/{id}', [ClientController::class, 'showProfile']); // View a specific client's profile by ID
    Route::put('/clients/{id}', [ClientController::class, 'updateProfile']); // Update a specific client's profile by ID
});

Route::middleware('auth:sanctum')->group(function () {
    // Routes for authenticated freelancer profile management
    Route::get('/freelancer/profile', [FreelancerController::class, 'showProfile']); // View authenticated freelancer's profile
    Route::put('/freelancer/profile', [FreelancerController::class, 'updateProfile']); // Update authenticated freelancer's profile
    Route::get('/freelancer/job-posts', [FreelancerController::class, 'listAvailableJobs']); // List job posts matching freelancer skills

    // Routes for admin or client access to specific freelancer profiles by ID
    Route::get('/freelancers/{id}', [FreelancerController::class, 'showProfile']); // View a specific freelancer's profile by ID
    Route::put('/freelancers/{id}', [FreelancerController::class, 'updateProfile']); // Update a specific freelancer's profile by ID
});

// Job posting Public route to view all job posts with optional filtering (accessible without authentication)
Route::get('/job-posts', [JobPostController::class, 'index']); 

// Routes that require authentication
Route::middleware('auth:sanctum')->group(function () {
    // Client-only routes for managing job posts
    Route::post('/job-posts', [JobPostController::class, 'store']); // Create a new job post
    Route::get('/job-posts/{id}', [JobPostController::class, 'show']); // View a specific job post by ID
    Route::put('/job-posts/{id}', [JobPostController::class, 'update']); // Update a job post
    Route::delete('/job-posts/{id}', [JobPostController::class, 'destroy']); // Delete a job post
});




// Job Applications
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/jobs/{jobPostId}/apply', [JobApplyController::class, 'apply']); // Apply to a job post
    Route::delete('/applications/{id}/withdraw', [JobApplyController::class, 'withdrawApplication']); // Withdraw an application
    Route::get('/jobs/{jobPostId}/applications', [JobApplyController::class, 'viewApplications']); // View applications for a job post
    Route::get('/applications/{id}', [JobApplyController::class, 'viewApplication']); // View details of a specific application
    Route::get('/freelancer/applications', [JobApplyController::class, 'viewMyApplications']);   //view all my applications
});



// Contract Management
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/contracts/{applicationId}', [ContractController::class, 'create']); // Create contract
    Route::get('/contracts/{id}', [ContractController::class, 'view']); // View specific contract
    Route::put('/contracts/{id}/complete', [ContractController::class, 'completeContract']); // Complete contract
    Route::delete('/contracts/{id}/cancel', [ContractController::class, 'cancelContract']); // Cancel contract
    Route::get('/contracts', [ContractController::class, 'list']); // List all contracts for user
});

Route::middleware('auth:sanctum')->group(function () {
    // Payment Method Routes
    Route::get('/payment-methods', [PaymentMethodController::class, 'index']); // List all payment methods
    Route::post('/payment-methods', [PaymentMethodController::class, 'store']); // Create a new payment method (admin only)
    Route::get('/payment-methods/{id}', [PaymentMethodController::class, 'show']); // View a specific payment method
    Route::put('/payment-methods/{id}', [PaymentMethodController::class, 'update']); // Update a payment method
    Route::patch('/payment-methods/{id}/toggle', [PaymentMethodController::class, 'toggleStatus']); // Toggle payment method status
    Route::delete('/payment-methods/{id}', [PaymentMethodController::class, 'destroy']); // Delete a payment method (admin only)

    // Payment Routes
    Route::post('/payments', [PaymentController::class, 'makePayment']); // Make a payment
    Route::get('/payments/user/{userId}', [PaymentController::class, 'viewPayments']); // View payments for a specific user
    Route::post('/payments/{paymentId}/refund', [PaymentController::class, 'refund']); // Request a refund for a payment
});

// Notifications
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/notifications/{userId?}', [NotificationController::class, 'viewNotifications']); // View notifications for self or another user (admin)
    Route::post('/notifications/send', [NotificationController::class, 'sendNotification']); // Send a notification
    Route::patch('/notifications/{id}/seen', [NotificationController::class, 'markAsSeen']); // Mark a notification as seen
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy']); // Delete a notification
});

// Chat
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/chats/send', [ChatController::class, 'sendMessage']);
    Route::get('/chats/{receiverId}/{receiverRole}', [ChatController::class, 'viewMessages']);
    Route::patch('/chats/{id}/read', [ChatController::class, 'markAsRead']);
});


// Ratings
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/contracts/{contractId}/rate', [RatingController::class, 'rateContract']); // Submit a rating
    Route::get('/contracts/{contractId}/rating', [RatingController::class, 'viewContractRating']); // View contract rating
    Route::get('/users/{userId}/ratings', [RatingController::class, 'viewUserRatings']); // View all ratings for a user

    //admin 
    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        Route::get('/admin/users', [AdminController::class, 'listUsers']);
        Route::get('/admin/jobs', [JobPostController::class, 'listJobs']);
        Route::get('/admin/contracts', [ContractController::class, 'listContracts']);
        Route::get('/admin/payments', [PaymentController::class, 'listPayments']);
        Route::get('/admin/categories', [CategoryController::class, 'listCategories']);
    });
    
});
