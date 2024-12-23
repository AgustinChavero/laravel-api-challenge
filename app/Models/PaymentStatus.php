<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentStatus extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'payment_statuses';

    protected $fillable = [
        'name',
        'color',
    ];

    protected $casts = [
        'color' => 'string',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class, 'status_id');
    }
}
