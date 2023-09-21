<?php

namespace App\Models\PMA;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    protected $connection = 'patoari';
    protected $table = 'wp_posts';

    public function User()
    {
        return $this->belongsTo(User::class,'post_author','ID',)->select('ID','display_name');
    }

}
