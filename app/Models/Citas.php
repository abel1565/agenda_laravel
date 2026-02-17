<?php

namespace App\Models;
use App\Models\Status_Citas;

use Illuminate\Database\Eloquent\Model;

class Citas extends Model
{
    protected $fillable = [
        'title',
        'description',
        'createdby',
        'assignedto',
        'status_id',
        'start_date',
        'end_date',
    ];

    //relacion con el creador de la cita 
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'createdby');
    }
    //relacion con el usuario que es agendado a la cita 
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assignedto');
    }
    
    //relacion con el estado de la cita 
    public function status()
    {
        return $this->belongsTo(Status_Citas::class, 'status_id');
    }
}
