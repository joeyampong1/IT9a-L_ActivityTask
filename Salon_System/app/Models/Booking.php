<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
use App\Models\Service;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id', 'customer_name', 'customer_contact',
        'appointment_datetime', 'total_price'
    ];

    protected $casts = [
        'appointment_datetime' => 'datetime',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    // Helper: check if paid
    public function isPaid()
    {
        return $this->payment && $this->payment->status === 'paid';
    }
}