<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable=['appointment_type',
    'user_id',
    'department_id',
    'doctor_id',
    'appointment_time'];

   public function user():BelongsTo
   {
    return $this->belongsTo(User::class);
   }

}
