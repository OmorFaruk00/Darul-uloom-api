<?php

namespace App\Http\Controllers;

use App\Models\Accounts\Cashin;
use App\Models\Accounts\Expense;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
       $data['todayFee'] = Cashin::whereDate('date', Carbon::today())
                           ->sum('amount');

       $data['thisMonthFee'] = Cashin::whereMonth('date', Carbon::now()->month)
                               ->whereYear('date', Carbon::now()->year)
                               ->sum('amount');
       $data['totalFee']  =  Cashin::sum('amount');


        $data['todayExpense'] = Expense::whereDate('date', Carbon::today())
                           ->sum('amount');

       $data['thisMonthExpense'] = Expense::whereMonth('date', Carbon::now()->month)
                               ->whereYear('date', Carbon::now()->year)
                               ->sum('amount');
       $data['totalExpense']  =  Expense::sum('amount');



       return $data;
    }
}
