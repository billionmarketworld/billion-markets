<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'amount', 'status'];
    // 👥 এই উইথড্রটি কোন ইউজারের, তা জানার জন্য রিলেশনশিপ
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
