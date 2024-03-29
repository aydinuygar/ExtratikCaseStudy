<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table = 'patients'; 

    public function nextofkins()
    {
        return $this->hasMany(NextOfKin::class);
    }
}
