<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
 protected $table = "hospitals";
 protected $fillable = ['name','address','created_at','updated_at'];
 protected $hidden = ['created_at', 'updated_at'];

 public function doctors(){
     return $this-> hasMany('App\models\Doctor','hospital_id','id');
 }
 

}
