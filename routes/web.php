<?php

use Illuminate\Support\Facades\Route;
// namespace App\Models;

use App\Http\Controllers\ADM\AdmissionFormController;
use Illuminate\Support\Facades\DB;
use Doctrine\DBAL\Driver\AbstractMySQLDriver;
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

Route::get("test", [AdmissionFormController::class, 'testPDF']); 