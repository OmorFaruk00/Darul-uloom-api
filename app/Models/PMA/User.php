<?php

namespace App\Models\PMA;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    use HasFactory;
    protected $connection = 'patoari';
    protected $table = 'wp_users';





   

}
