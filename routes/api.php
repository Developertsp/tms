<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\ProjectAttachmentController;
use App\Http\Controllers\Api\ProjectCommentController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');
// Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
//     return $request->user();
// });
Route::middleware(['auth:sanctum'])->group(function () {
    // Project Routes
    Route::get('projects', [ProjectController::class, 'index'])->name('projects.list');
    // Company Routes
    Route::get('companies', [CompanyController::class, 'index'])->name('companies.list');
    // Department Routes
    Route::get('departments', [DepartmentController::class, 'index'])->name('departments.list');
    // Task Routes
    Route::get('tasks', [TaskController::class, 'index'])->name('tasks.list');
});
// Company Routes
Route::get('companies/create', [CompanyController::class, 'create'])->name('companies.create');
Route::post('companies/store', [CompanyController::class, 'store'])->name('companies.store');
Route::get('companies/edit/{id}', [CompanyController::class, 'edit'])->name('companies.edit');
Route::post('companies/update', [CompanyController::class, 'update'])->name('companies.update');
Route::delete('companies/destroy/{id}', [CompanyController::class, 'destroy'])->name('companies.destroy');


// Task Routes
Route::get('tasks', [TaskController::class, 'index'])->name('tasks.list');
Route::get('tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('tasks/store', [TaskController::class, 'store'])->name('tasks.store');
Route::get('tasks/show/{id}', [TaskController::class, 'show'])->name('tasks.show');
Route::post('tasks/update', [TaskController::class, 'update'])->name('tasks.update');
Route::get('tasks/report', [TaskController::class, 'report'])->name('tasks.report');
Route::post('tasks/export', [TaskController::class, 'export'])->name('tasks.export');
Route::post('tasks/update_deadline', [TaskController::class, 'update_task_deadline'])->name('tasks.update.deadline');
Route::delete('tasks/destroy/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');

// Task Comments
// Route::post('comments/store', [CommentController::class, 'store'])->name('comments.store');

// // Task Attachments
// Route::post('attachments/store', [AttachmentController::class, 'store'])->name('attachments.store');

// // Task Time Tracking
// Route::post('tracking/store', [TaskTimeTrackingController::class, 'store'])->name('tracking.store');


// Project Routes
Route::get('projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('projects/store', [ProjectController::class, 'store'])->name('projects.store');
Route::get('projects/edit/{id}', [ProjectController::class, 'edit'])->name('projects.edit');
Route::post('projects/update', [ProjectController::class, 'update'])->name('projects.update');
Route::delete('projects/destroy/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
Route::get('projects/show/{id}', [ProjectController::class, 'show'])->name('projects.show');
Route::post('projects/comments/store', [ProjectCommentController::class, 'store'])->name('projects.comments.store');
Route::post('projects/attachments/store', [ProjectAttachmentController::class, 'store'])->name('projects.attachments.store');

// Department Routes
Route::get('departments', [DepartmentController::class, 'index'])->name('departments.list');
Route::get('departments/create', [DepartmentController::class, 'create'])->name('departments.create');
Route::post('departments/store', [DepartmentController::class, 'store'])->name('departments.store');
Route::get('departments/edit/{id}', [DepartmentController::class, 'edit'])->name('departments.edit');
Route::post('departments/update', [DepartmentController::class, 'update'])->name('departments.update');
Route::delete('departments/destroy/{id}', [DepartmentController::class, 'destroy'])->name('departments.destroy');

// Notification Routes
// Route::get('notifications/read/{id}', [NotificationController::class, 'read'])->name('notifications.read');
// Route::post('notifications/read_all/', [NotificationController::class, 'read_all'])->name('notifications.read_all');
// Route::get('notifications/list', [NotificationController::class, 'list'])->name('notifications.list');

// // dashboard filter
// Route::get('dashboard/filter', [DashboardController::class, 'filter'])->name('dashboard.filter');

// // JD Task Routes
// Route::get('jd', [JdTaskController::class, 'index'])->name('jd.list');
// Route::get('jd/create', [JdTaskController::class, 'create'])->name('jd.create');
// Route::get('jd/edit/{id}', [JdTaskController::class, 'edit'])->name('jd.edit');
// Route::post('jd/update', [JdTaskController::class, 'update'])->name('jd.update');
// Route::post('jd/store', [JdTaskController::class, 'store'])->name('jd.store');
// Route::delete('jd/destroy/{id}', [JdTaskController::class, 'destroy'])->name('jd.destroy');

