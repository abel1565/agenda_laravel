<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'lastname',
        'phone',
        'creation_date',
        'status_id',
        'rol_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function rol(){
        return $this->belongsTo(Rol::class);
    }
    public function status(){
        return $this->belongsTo(Status::class);
    }
    //relacion con las citas que crea el usuario 
    public function citasCreated(){
        return $this->hasMany(Citas::class, 'createdby');
    }
    //relacion con las citas que tiene asignadas el usuario 
    public function citasAssigned(){
        return $this->hasMany(Citas::class, 'assignedto');
    }
}
