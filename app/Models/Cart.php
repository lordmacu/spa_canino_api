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
class Cart extends Model
{


    public $table = 'cart';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    public function product(){
        return $this->belongsTo(Products::class);
    }
    
    
    public function getCartByUser($user){
        return $this->where("user_id",$user)->with("product")->get();
    }

       public function getCartByUserAndProduct($user,$product){
        return $this->where("user_id",$user)->where("product_id",$product)->first();
    }

 
    
}
