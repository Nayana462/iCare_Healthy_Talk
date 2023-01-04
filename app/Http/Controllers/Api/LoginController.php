<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChatConversations;
use App\Models\DoctorCategories;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use DB;
class LoginController extends Controller
{


    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'role_id' => 'required',

        ]);

        $credentials = $request->only('email', 'password', 'role_id');
        if (Auth::attempt($credentials)) {
            $data1 = auth()->user();

            $data = $data1->load('userProfile');
            if ($request->role_id == "2") {
                $data = $data1->load('userQualifications');
            }
            return successResponse($data, "success");
            //  return response()->json([
            //     'data' => $data
            // ]);
        } else {
            $error["message"] = "this is error message";
            $error["error"] = "this is error";

            return errorResponse($error);


        }
    }

    public function getProfile(Request $request, $id)
    {
        $user_id = $request->user_id;
        $data = User::findorFail($id);
        if ($data->role_id == 2) {
            $c = DoctorCategories::where('doctor_id', $id)->first();
            $data['category'] = Category::findorFail($c->cat_id);
        }
        $data->userProfile;
        $data->userQualifications;
        $s = \DB::select("select * from chat_conversations where (user_1='" . $id . "' AND user_2='" . $user_id . "') OR (user_1='" . $user_id . "' AND user_2='" . $id . "')");
        if(count($s)>0){
            $s[0]->user=$data;
//        $data['conversation']=$s;
            return successResponse($s[0], "success");
        }else{
            $error["user"] = $data;
            return successResponse($error, "success");
        }
    }

    public  function  registerUser(Request $request){

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role_id' => 3,
                'password' => Hash::make($request->password),
            ]);
            $id = DB::getPdo()->lastInsertId();
            $params= $request->all();
            $params['fullname'] = $request->name;
            $params['user_id'] = $id;
            $userProfile = UserProfile::create($params);

            DB::commit();
        } catch (\PDOException $e) {
            // Woopsy
            DB::rollBack();
            request()->session()->flash('error','Error occurred while adding Doctor');
        }
        return  successResponse("user registered successfully");
    }

    public function updateProfile(Request $request){

    }


}
