<?php

namespace App\Http\Controllers\ADM;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function division(){
        return \App\Models\Division::all();
    }
    public function district($id){
        return \App\Models\District::where('division_id',$id)->get();
    }
    public function thana($id){
        return \App\Models\Thana::where('district_id',$id)->get();
    }
    public function union($id){
        return \App\Models\Union::where('thana_id',$id)->get();
    }


    public function registration_generate(){

         $currentYear = date('Y');
         $firstTwo = substr($currentYear, 0, 2);
         $lastTwo = substr($currentYear, 2, 2);        
        for ($i = 1; $i <= 200; $i++) {
            $incrementedValueWithZeros = str_pad($i, 5, '0', STR_PAD_LEFT);
            $reg = $firstTwo.$incrementedValueWithZeros.$incrementedValueWithZeros.$lastTwo;
            Registration::insert([
                'reg_code'=>$reg, 
                'status'=>1, 

            ]);
        }

        return "registration number successfully created ";
    }
}
