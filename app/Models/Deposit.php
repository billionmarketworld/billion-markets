<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;
    // কোন কোন কলামে ডাটা সেভ করার অনুমতি থাকবে তা ডিফাইন করা হলো
    protected $fillable = ['user_id', 'amount', 'status'];
    // 👥 এই ডিপোজিটটি কোন ইউজারের, তা জানার জন্য রিলেশনশিপ
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
