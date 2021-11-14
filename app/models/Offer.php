<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\scopes\OfferScope;

class Offer extends Model
{
 protected $table = "offers";
 protected $fillable = ['name_ar','name_en','price','details_ar','details_en','photo','created_at','updated_at','status'];
 protected $hidden = ['created_at','updated_at'];
 public $timestamps = false;


 // register global scope
 protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new OfferScope);
    }




##################### Local scopes #########################
 public function scopeInactive($query){
     return $query -> where('status',0);
 }

 public function scopeInvalid($query){
     return $query -> where('status',0)-> whereNull('details_ar');
 }
###################### end Local scopes ###########################
}
