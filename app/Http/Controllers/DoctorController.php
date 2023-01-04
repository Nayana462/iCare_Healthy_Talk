<?php

namespace App\Http\Controllers;

use App\Models\ChatConversations;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\DoctorCategories;
use App\Models\UserQualification;
use Illuminate\Validation\Rules;

use DB;
class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $doctors = User::where('role_id' , '2')->with('doctorCategories')->paginate(10);
         return view('backend.doctor.index', compact('doctors'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.doctor.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


            try {

            DB::beginTransaction();
            $params = $request->all();
            $params['password'] = Hash::make($request->password);
            $params['role_id'] = 2;
            $status = User::create($params);
            $id=  DB::getPdo()->lastInsertId();
            $params['fullname'] = $request->name;
            $params['user_id'] = $id;
            $profile = UserProfile::create($params);
            $params['cat_id'] = $request->category;
            $params['doctor_id'] =$id;
            $doctcat = DoctorCategories::create($params);

             for ($i=0; $i<count($request->qualification) ; $i++) {
                    $params['title'] = $request->qualification[$i];
                    $params['document'] = $request->document[$i];
                    $params['from_date'] = $request->from_date[$i];
                    $params['to_date'] = $request->to_date[$i];
                    $params['user_id'] = $id;
                    UserQualification::create($params);
                }
               DB::commit();
                request()->session()->flash('success','Doctor successfully deleted');
                return redirect()->route('doctor.index');
        } catch (\PDOException $e) {
            // Woopsy
            DB::rollBack();
            request()->session()->flash('error','Error occurred while adding Doctor');
                return redirect()->route('doctor.index');
        }




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = User::find($id);
        $categories  = Category::all();
        $cat_id = DoctorCategories::where('doctor_id' , $id)->first()->cat_id;
        return  view('backend.doctor.edit', compact('doctor' , 'categories' , 'cat_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'unique:users,email,'.$id
        ]);
        $doctor = User::find($id);
        $params = $request->all();
        $doctor->update($params);
        $params['password'] = Hash::make($request->password);
        $params['fullname'] = $request->name;
        $doctor->userprofile()->updateOrCreate(['user_id' => $id],  $params);

         DoctorCategories::where('doctor_id' , $id)->update([
             'cat_id' =>$request->category,
         ]);
        request()->session()->flash('success','Doctor Updated successfully');
        return redirect()->route('doctor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

            $deletedoctor = User::find($id);
            $deletedoctor->userprofile()->delete();
            $deletedoctor->userQualifications()->delete();
            $deletedoctor->doctorCategories()->delete();
            ChatConversations::where('user_1' , $id)->orWhere('user_2' , $id)->delete();
            $deletedoctor->delete();
            request()->session()->flash('success','Doctor successfully deleted');
            return redirect()->route('doctor.index');
    }

    public  function  viewqualification($id){
     $qualification = UserQualification::where('user_id' , $id)->paginate(10);
     return view('backend.doctor.index_qualification', compact('qualification'));
    }

    public  function  qualificationedit($id){
        $qualification = UserQualification::find($id);
        return view('backend.doctor.edit_qualification', compact('qualification'));
    }

    public function updatequalification(Request $request){
        $id = $request->id;

        $qualification = UserQualification::find($id);
          $params= $request->all();
        $qualification->update($params);
        request()->session()->flash('success','Qualification successfully deleted');
        return redirect('view/'.$qualification->user_id);
    }
    
    public function savequalification(Request $request){
     $params = $request->all();
     $params['user_id'] = $request->user_id;
     $userqualification = UserQualification::create($params);
     if($userqualification){
            request()->session()->flash('success','Qualification Added successfully ');
        }
        else{
            request()->session()->flash('error','Error occurred while adding Qualification');
        }
        return redirect('view/'.$request->user_id);
    }

    public function deletequalification($id){
        $deletequalification  = UserQualification::find($id);
        $userqualification = $deletequalification->delete();
        if($userqualification){
            request()->session()->flash('success','Qualification Deleted successfully ');
        }
        else{
            request()->session()->flash('error','Error occurred while adding Qualification');
        }
        return redirect()->back();
    }
}
