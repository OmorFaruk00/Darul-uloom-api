<?php

use Illuminate\Support\Facades\DB;
// namespace App\Models;

use Illuminate\Support\Facades\Route;
use Doctrine\DBAL\Driver\AbstractMySQLDriver;
use App\Http\Controllers\Student\CourseController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\ADM\AdmissionFormController;
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

Route::get('/db', function () {

 
    try {
        $connection = DB::connection('patoari')->getPdo();
        $status = $connection->getAttribute(\PDO::ATTR_CONNECTION_STATUS);
        echo "Database connection successful. Status: $status";
    } catch (\Exception $e) {
        echo "Database connection failed: " . $e->getMessage();
    }
});
Route::get('/', function () {
    return view('welcome');
});
Route::get("show", [StudentController::class, 'studentShow']);

Route::prefix('course')->group(function () {
    Route::get("show", [CourseController::class, 'CourseShow'])->middleware('permission:Course-show');
    Route::post("add", [CourseController::class, 'CourseAdd'])->middleware('permission:Course-add');
    Route::get("edit/{id}", [CourseController::class, 'CourseEdit']);
    Route::post("update/{id}", [CourseController::class, 'CourseUpdate'])->middleware('permission:Course-update');
    Route::get("delete/{id}", [CourseController::class, 'CourseDelete'])->middleware('permission:Course-delete');
});

Route::get("test", [AdmissionFormController::class, 'testPDF']); 