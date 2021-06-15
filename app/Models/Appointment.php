<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class Appointment
 * @package App\Models
 * @version June 15, 2021, 12:18 pm UTC
 *
 * @property string $user_id
 * @property string $pet_id
 * @property string $doctor_id
 * @property string $date
 */
class Appointment extends Model
{


    public $table = 'appointment';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'user_id',
        'pet_id',
        'doctor_id',
        'date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'string',
        'pet_id' => 'string',
        'doctor_id' => 'string',
        'date' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|string',
        'pet_id' => 'required|string',
        'doctor_id' => 'required|string',
        'date' => 'required'
    ];

    
}
