<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use HasFactory;

    // 🎯 ডাটা প্রটেকশন ফিল্ড সেট করা হলো
    protected $fillable = ['content', 'is_active'];
}
