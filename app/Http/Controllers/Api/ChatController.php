<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChatConversations;
use App\Models\ChatMessages;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function getConversations($id)
    {
//        $cons = ChatConversations::where('user_1', $id)->orWhere('user_2', $id)->orderBy('id','DESC')->get();
//        $messages = ChatMessages::where('sender_id' , $id)->orWhere('receiver_id' , $id)->orderBy('id' ,'Desc')->distinct('sender_id')->get();
        $cons = ChatConversations::select('*')
            ->where(function($query) use ($id) {
                return $query->where('user_1', $id)
                    ->orWhere('user_2', $id);
            })
            ->addSelect(
                \DB::raw("(select MAX(chat_messages.id) from chat_messages where chat_messages.chat_conversation_id = chat_conversations.id) as message_id")
            )
            ->orderBy('message_id', 'desc')->get();

        $data=array();
        foreach ($cons as $con) {
           if($con->message_id!=null){
               $lastMessage=ChatMessages::where('id' , $con->message_id)->orderBy('id' , 'DESC')->first();
               if($lastMessage!=null){
                   if($con->user_1 != $id){
                       $user = User::with('userProfile')->where('id', $con->user_1)->first();
                       $con['user'] = $user;
                       $con['last_message'] = $lastMessage;
                       array_push($data,$con);
                   }else if($con->user_2 !=$id){
                       $user = User::with('userProfile')->where('id', $con->user_2)->first();
                       $con['user'] = $user;
                       $con['last_message'] = $lastMessage;
                       array_push($data, $con);
                   }
               }
           }
        }
        return successResponse($data, "success");
    }

    public  function  getChat($id){
        $data = ChatMessages::where('chat_conversation_id' , $id)->get();
        return successResponse($data, "success");

    }


}
