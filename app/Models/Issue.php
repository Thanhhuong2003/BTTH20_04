<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $table = 'issues'; // Tên bảng trong database

    // Các cột có thể gán giá trị thông qua Eloquent
    protected $fillable = [
        'computer_id',
        'reported_by',
        'description',
        'urgency',
        'status',
        'reported_date',
    ];
}
