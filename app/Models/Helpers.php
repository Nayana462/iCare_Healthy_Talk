<?php

use App\Models\Category;

function successResponse($data='' , $message='' , $status=200){
	 return response()->json([
                    'data' => $data ,  'statusCode'=>true
                ], $status);
}

function errorResponse($error='' , $status=500){
	 return response()->json([
                    'error' => $error , 'status'=>$status
                ], $status);
}

function getDoctorCategory($id){
    $category = Category::findOrFail($id);
    return $category->title;
}

?>
