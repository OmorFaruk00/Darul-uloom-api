<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Accounts\Fund;
use App\Models\Accounts\Cashin;
use App\Models\Accounts\Classes;
use App\Models\Accounts\Expense;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Accounts\Transaction;
use App\Http\Requests\ExpenseRequest;
use App\Http\Requests\FeeEnrtyRequest;
use App\Http\Requests\Transfer;
use App\Models\Accounts\FundTransfer;
use App\Models\Accounts\PaymentPurpose;

class AccountController extends Controller
{
    public function index()
    {
        return Classes::get();
    }
    public function feeEntry(FeeEnrtyRequest $request)
    {
        try {

            DB::transaction(function () use ($request) {

                $validatedData = $request->validated();
                $validatedData['created_by'] = auth()->user()->id;
                $validatedData['created_at'] = now();
                $validatedData['ip_address'] = $request->ip();

                $cashinId = Cashin::insertGetId($validatedData);
                Transaction::create([
                    'user_id' => $request->student_id,
                    'amount' => $request->amount,
                    'type' => 'Credit',
                    'transactionable_type' => 'App\Models\Accounts\Cashin',
                    'transactionable_id' => $cashinId,
                ]);

                $purpose = PaymentPurpose::find($request->purpose_id);
                $fund =  Fund::find($purpose->fund_id);
                $amount = $fund->total_cash + $request->amount;
                $fund->update(['total_cash' => $amount]);
            });
            return response()->json(['message' => 'Payment Successfully Done'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function expense(ExpenseRequest $request)
    {
        try {

            DB::transaction(function () use ($request) {

                $validatedData = $request->validated();
                $validatedData['expense_by'] = auth()->user()->id;
                $validatedData['created_at'] = now();
                $validatedData['ip_address'] = $request->ip();

                $expenseId = Expense::insertGetId($validatedData);
                Transaction::create([
                    'user_id' => auth()->user()->id,
                    'amount' => $request->amount,
                    'type' => 'Debit',
                    'transactionable_type' => 'App\Models\Accounts\Expense',
                    'transactionable_id' => $expenseId,
                ]);

                $purpose = PaymentPurpose::find($request->purpose_id);
                $fund =  Fund::find($purpose->fund_id);
                $amount = $fund->total_cash - $request->amount;
                $fund->update(['total_cash' => $amount]);
            });
            return response()->json(['message' => 'Expense Successfully Done'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function fundTransfer(Transfer $request)
    {

        try {

            $from_fund =  Fund::find($request->from_fund_id);
            if ($from_fund->total_cash < $request->amount) {
                return response()->json(['message' => 'Balance Not Available'], 404);
            } else {
                    DB::transaction(function () use ($request, $from_fund) {
                    $from_fund->update(['total_cash' => ($from_fund->total_cash - $request->amount)]);
                    $to_fund = Fund::find($request->to_fund_id);
                    $to_fund->update(['total_cash' => ($to_fund->total_cash + $request->amount)]);

                    $validatedData = $request->validated();
                    $validatedData['transfer_by'] = auth()->user()->id;
                    $validatedData['date'] = now();
                    $validatedData['ip_address'] = $request->ip();
    
                    $transferId = FundTransfer::insertGetId($validatedData);
                    Transaction::create([
                        'user_id' => auth()->user()->id,
                        'amount' => $request->amount,
                        'type' => 'Debit',
                        'transactionable_type' => 'App\Models\Accounts\FundTransfer',
                        'transactionable_id' => $transferId,
                    ]);
                });
            }    
            return response()->json(['message' => 'Fund Transfer Successfully Done'], 200);

               
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }

    public function studentAccountStatement($id){
        $data['statement'] = Cashin::with('purpose')->where('student_id',$id)->get();
        $data['total_paid'] = Cashin::where('student_id',$id)->sum('amount');
        return $data;

    }
}
