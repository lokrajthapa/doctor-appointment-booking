<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $filable=['appointment_type','patient_id'];

   public function user():BelongsTo
   {
    return $this->belongsTo(User::class);
   }

}
