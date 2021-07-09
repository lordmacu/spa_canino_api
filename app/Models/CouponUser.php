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
class CouponUser extends Model 
{


    public $table = 'coupon_user';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    public function coupon(){
        return $this->belongsTo(Coupons::class);
    }
    
 
    public function getUsersByCoupons($user){
        return $this->where("user_id",$user)->with("coupon")->get();
    }
    
}
