<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;



/**
 * Class Contact
 * @package App\Models
 * @version June 15, 2021, 12:07 pm UTC
 *
 * @property string $subject
 * @property string $description
 * @property string $email
 */
class Contact extends Model
{


    public $table = 'contacts';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'subject',
        'description',
        'email'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'subject' => 'string',
        'description' => 'string',
        'email' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'subject' => 'required|string',
        'description' => 'required|string',
        'email' => 'required|string'
    ];

    
}
