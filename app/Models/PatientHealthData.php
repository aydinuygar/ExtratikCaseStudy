<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientHealthData extends Model
{
    use HasFactory;
    protected $table = 'patient_health_data'; 

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function medical()
    {
        return $this->belongsTo(Medical::class);
    }
  
}
