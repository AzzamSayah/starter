<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = "patients";
    protected $fillable = ['name', 'age'];
    public $timestamps = false;
    // has one through 
public function doctor(){
    return $this->hasOneThrough('App\models\Doctor','App\models\Medical', 'patient_id','medical_id','id','id');
}
}
