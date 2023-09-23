<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundTransfer extends Model
{
    use HasFactory;
    protected  $guarded = [];

    public function from_fund()
    {
        return $this->hasOne('App\Models\Accounts\Fund', 'id', 'from_fund_id')->select('id','name');
    }

    public function to_fund()
    {
        return $this->hasOne('App\Models\Accounts\Fund', 'id', 'to_fund_id')->select('id','name');
    }
}
