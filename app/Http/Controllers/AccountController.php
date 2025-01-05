<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Accounts\Fund;
use App\Http\Requests\Transfer;
use App\Models\Accounts\Cashin;
use App\Models\Accounts\Classes;
use App\Models\Accounts\Expense;
use App\Models\Accounts\Deposite;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Accounts\Transaction;
use App\Http\Requests\ExpenseRequest;
use App\Models\Accounts\FundTransfer;
use App\Http\Requests\DepositeRequest;
use App\Http\Requests\FeeEnrtyRequest;
use App\Models\Accounts\PaymentPurpose;

class AccountController extends Controller
{
    public function index()
    {
        return Classes::get();
    }
    public function feeEntry(FeeEnrtyRequest $request)
    {

        // return $request->all();
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

    public function expenseList(Request $request)
    {

        try {
            $from = $request->start_date;
            $to = $request->end_date;
            $purpose = $request->purpose;

            $expense = Expense::with('purpose')
                ->when($purpose != null, function ($q) use ($purpose) {
                    $q->where('purpose_id', $purpose);
                })
                ->when($from != null, function ($q) use ($from, $to) {
                    $q->whereBetween('date', [$from, $to]);
                })
                ->orderBy('id', 'desc')
                ->get();
            $data['expense'] = $expense;
            $data['total_expense'] = $expense->sum('amount');

            return response()->json($data);
        } catch (\Exception $e) {

            return $e->getMessage();
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


    public function depositeList()
    {

        try {
            $deposite = Deposite::with('purpose')->orderBy('id', 'desc')->get();
            $data['deposite'] = $deposite;
            $data['total_deposite'] = $deposite->sum('amount');
            return response()->json($data);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }


    public function deposite(DepositeRequest $request)
    {
        try {

            DB::transaction(function () use ($request) {

                $validatedData = $request->validated();
                $validatedData['created_by'] = auth()->user()->id;
                $validatedData['created_at'] = now();
                $validatedData['ip_address'] = $request->ip();

                $depositeId = Deposite::insertGetId($validatedData);
                Transaction::create([
                    'user_id' => auth()->user()->id,
                    'amount' => $request->amount,
                    'type' => 'Credit',
                    'transactionable_type' => 'App\Models\Accounts\Deposite',
                    'transactionable_id' => $depositeId,
                ]);

                $purpose = PaymentPurpose::find($request->purpose_id);
                $fund =  Fund::find($purpose->fund_id);
                $amount = $fund->total_cash + $request->amount;
                $fund->update(['total_cash' => $amount]);
            });
            return response()->json(['message' => 'Deposite Successfully Done'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        }
    }
    public function fundTransferList()
    {
        try {
            $fund = FundTransfer::with('from_fund', 'to_fund')->get();
            $data['fund'] = $fund;
            $data['total_fund'] = $fund->sum('amount');
            return response()->json($data);
        } catch (\Exception $e) {
            return $e->getMessage();
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

    public function studentAccountStatement($id)
    {
        $cashIn = Cashin::with('purpose')->where('student_id', $id)->get();
        $data['statement'] = $cashIn;
        $data['total_paid'] = $cashIn->sum('amount');
        return $data;
    }

    public function feeCalculation(Request $request)
    {
        try {
            $from = $request->start_date;
            $to = $request->end_date;
            $purpose = $request->purpose;

            $account = Cashin::with(['student', 'purpose', 'section', 'batch'])
                ->when($purpose != null, function ($q) use ($purpose) {
                    $q->where('purpose_id', $purpose);
                })
                ->when($from != null && $to != null, function ($q) use ($from, $to) {
                    $q->whereBetween('date', [$from, $to]);
                })
                ->orderBy('id', 'desc')
                ->get();
            $data['account'] = $account->transform(function ($data) {
                return [
                    'id' => $data->id,
                    'student_name' => $data->student->student_name_english,
                    'reg_no' => $data->student->reg_no,
                    'department' => $data->section->department_name,
                    'batch' => $data->batch->batch_name,
                    'purpose' => $data->purpose->name,
                    'date' => $data->date,
                    'amount' => $data->amount,

                ];
            });
            $data['total_amount'] = $account->sum('amount');

            return response()->json($data);
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
}
