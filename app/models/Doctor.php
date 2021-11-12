<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
 protected $table = "doctors";
 protected $fillable = ['name','title','hospital_id','created_at','updated_at','gender'];
 protected $hidden = ['created_at', 'updated_at'];

 public function hospital(){
     return $this-> belongsTo('App\models\Hospital','hospital_id','id');
 }
}
