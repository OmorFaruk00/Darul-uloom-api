<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposite extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function purpose()
    {
        return $this->hasOne('App\Models\Accounts\PaymentPurpose', 'id', 'purpose_id');
    }
}
