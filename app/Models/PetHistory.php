<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class PetHistory
 * @package App\Models
 * @version June 15, 2021, 12:20 pm UTC
 *
 * @property string $pet_id
 * @property string $description
 */
class PetHistory extends Model
{


    public $table = 'pet_history';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'pet_id',
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'pet_id' => 'string',
        'description' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'pet_id' => 'required|string',
        'description' => 'required|string'
    ];

    
}
