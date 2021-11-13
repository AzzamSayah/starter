<?php

namespace App\Http\Controllers\relations;

use App\Http\Controllers\Controller;
use App\models\Doctor;
use App\models\Hospital;
use App\models\Patient;
use App\models\Phone;
use App\models\Service;
use App\User;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
    ###### begin one to one relationships methods #########
    public function hasOneRelation(){

        // $phones = $user -> phone; //get phone relationships
        // $user = User:: with('phone') -> find(4);// get user with all data pf phone reltionship
        // get some data from reletionship
        $user = User::with(['phone' => function($q){
            $q -> select('code','phone','user_id');
        }])->find(4);

        // return one filed from object
       //return $code = $user -> phone -> code;
       //or
       //return $user -> name;

     
        return response()->json($user);
    }

    public function hasOneRelationReverse(){
        //$phone = Phone::find(1);// return only phone data
        $phone = Phone::with('user')->find(1); // return phone data +  all user data

        $phone = Phone::with(['user' => function($q){
            $q -> select('id','name');
        }])->find(1); // // return phone data +  some user data

        // make some attribute visible
        //$phone -> makeVisible(['user_id']);
        // make some attribute hidden
        //$phone -> makeHidden(['code']);
       // return $phone -> user; // return user of this phone number
        return $phone;
    }

    public function getUsersHasPhones(){
       
        return User:: whereHas('phone') -> get();
   }

    public function getUsersHasPhonesWithCondition(){
        return
            User::whereHas('phone', function ($q) {
                $q->where('code', '961');
            })->get();

    }

    public function getUsersNotHasPhones()
    {
        return User::whereDoesntHave('phone')->get();
    }


    ####### end one to one  relationships methods ###########

    ######## begin one to many relationships methods ###########
    public function getHospitalDoctors(){
         $hospital = Hospital :: find(1); // first method
        // Hospital::where('id',1) -> first(); // second method
        // Hospital::  first(); // third method
         
        //return $hospital -> doctors -> find(2) -> name;
     // return  $hospital = Hospital:: with('doctorsd')->find(1);

    //  $doctors = $hospital->doctors;
    //  foreach($doctors as $doctor){
    //      echo $doctor -> name .'<br>';
    //  }
       
        $doctor  = Doctor:: find(3);
        return $doctor -> hospital  -> name;

    }

    public function hospitals(){
        $hospitals = Hospital:: select('id','name','address') ->get();
        return view('doctors.hospital',compact('hospitals'));
    }

    public function doctors($hospital_id){
        $hospital = Hospital::find($hospital_id);
        $doctors = $hospital -> doctors;
        return view('doctors.doctor',compact('doctors'));

    }

    public function hospitalsHasDoctors(){
        return Hospital:: whereHas('doctors') -> get();
    }

    public function hospitalsHasDoctorsMale()
    {
        return Hospital::with('doctors') -> whereHas('doctors',function($q){
            $q -> where('gender',1);
        })->get();
    }

    public function hospitalsNotHaveDotors(){
        return Hospital:: whereDoesnthave('doctors')-> get();
    }

    public function deleteDoctors($hospital_id){
        $hospital = Hospital::find($hospital_id);
        if(!$hospital){
            return abort('404');
        }

        // delete doctors in this hospital
        $hospital -> doctors() -> delete();
        // delete hospital
        $hospital -> delete();
       return redirect() -> route('hospital.all');
    }

    ######## end one to many relationships methods ###########

    ######## begin many to many relationships methods ###########
    public function getDoctorServices(){
       //  return $doctor -> services;
       return  $doctor = Doctor::with('services') -> find(1);
        
    }

    public function getServiceDoctors(){
  return $doctors = Service:: with(['doctors' => function($q){
      $q -> select('doctors.id','name','title');
  }]) -> find(1);
    }
public function getDoctorServicesByDoctorID($doctor_id){
    $doctor = Doctor::find($doctor_id);
    $docServices = $doctor -> services;

    $doctors = Doctor:: select('id','name') -> get();
    $services = Service:: select('id','name') -> get();
    return view('doctors.services',compact('docServices', 'doctors', 'services'));
}


    public function saveServicesToDoctor(Request $request){
    $doctor = Doctor::find($request -> doctor_id);
    if (!$doctor) {
        return abort('404');
    } 
          //many to many insertion with repitation
        // $doctor -> services() -> attach($request->service_ids);
        //many to many insertion with delte old data and insertion new data -> update
        // $doctor -> services() -> sync($request->service_ids);
        //many to many insertion without  repitation
        $doctor -> services() -> syncWithoutDetaching($request->service_ids);
       
        return redirect() ->back();
    
    
    }

######## end many to many relationships methods ###########



    ######## begin has one through relationships methods ###########
public function getPatientDoctor(){
 $patient = Patient::find(2);
 return $patient -> doctor;
}

    ######## end has one through relationships methods ###########





}
