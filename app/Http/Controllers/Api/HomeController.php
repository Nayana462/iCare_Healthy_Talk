<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Banner;
use App\Models\User;
use App\Models\DoctorCategories;
use App\Models\UserProfile;
class HomeController extends Controller
{
    public function getCategories(){
        $data['categories'] =Category::all();
        $data['banners'] =Banner::all();
        $test = array();
        $users = UserProfile::where('is_popular' ,1)->with('doctorCategories1')->with('userQualifications')->get();
        foreach ($users as $user) {
            $category  = Category::findOrFail($user->doctorCategories1[0]->cat_id);
            $user["category"]=$category;
           array_push($test,$user);
        }
        $data['popular_docs']=$test;
        if($data){
             return     successResponse($data,"success");
    }else{
        $error["message"]="this is error message";
                $error["error"]="this is error";

               return   errorResponse($error);
    }
   }

   public function getDoctorsByCategoy($id)
   {
    $data=array();
       $doctorsCats = DoctorCategories::where('cat_id' , $id)->get();
       if(count($doctorsCats)>0){
        $category  = Category::findOrFail($id);
        foreach($doctorsCats as $doctorsCat){
            $doctor = User::with('userProfile')->with('userQualifications')->where('id' , $doctorsCat->doctor_id)->first();
            $doctor["category"]=$category;
            array_push($data,$doctor);
        }
       }
        return successResponse($data,"success");
       //dd($doctors->count());
   }

}
