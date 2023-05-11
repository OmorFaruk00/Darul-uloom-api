<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accounts\PaymentPurpose;
use App\Http\Requests\Purpose;

class PaymentPurposeController extends Controller
{
   
    public function index()
    {
        return PaymentPurpose::with('fund')->get();
    }

   
    public function create()
    {
        //
    }

    public function store(Purpose $request)
    {
        PaymentPurpose::create($request->validated());
        return response(['message'=>'Payment Purpose Make Successfully']);
    }

    
    public function show($type)
    {
        return PaymentPurpose::where('type',$type)->get();
        
    }

   
    public function edit($id)
    {
        return PaymentPurpose::findorFail($id);
    }

   
    public function update(Purpose $request, $id)
    {
        PaymentPurpose::findorFail($id)->update($request->validated());
        return response(['message'=>'Payment Purpose Update Successful']);
    }

  
    public function destroy($id)
    {
        PaymentPurpose::findorFail($id)->delete();
        return response()->json(['message' => 'Purpose Deleted Successfully'],200);
        
    }
 

   
  
}
