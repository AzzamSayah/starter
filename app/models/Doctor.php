<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
 protected $table = "doctors";
 protected $fillable = ['name','title','hospital_id','created_at','updated_at','gender'];
 protected $hidden = ['created_at', 'updated_at','pivot'];

 public function hospital(){
     return $this-> belongsTo('App\models\Hospital','hospital_id','id');
 }
 public function services(){
     return $this -> belongsToMany('App\models\Service','doctor_service'
     ,'doctor_id','service_id','id','id');
 }
}
