<?php

namespace App\Models\Returns;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnRequest extends Model
{
    use HasFactory; 

    protected $fillable = [
        'order_code',
        'product_name',
        'customer_name',
        'responsable_employee',
        'request_date',
        'quantity',
        'reason',
        'status',
    ];
}
