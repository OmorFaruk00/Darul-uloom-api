<?php

namespace App\Models\Accounts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposite extends Model
{
    use HasFactory;
    protected $guarded=[];
<<<<<<< HEAD

=======
>>>>>>> 9253a3a1187c146c6a13e3a3eebffe87854f8ebc
    public function purpose()
    {
        return $this->hasOne('App\Models\Accounts\PaymentPurpose', 'id', 'purpose_id');
    }
}
