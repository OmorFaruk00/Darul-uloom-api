<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashin extends Model
{
    use HasFactory;
    protected $guarded=[];

    
    public function purpose()
    {
        return $this->hasOne(PaymentPurpose::class, 'id', 'purpose_id');
    }
}
