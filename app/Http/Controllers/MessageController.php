<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class MessageController extends Controller
{
    public function store(Request $request) {
        $sender = JWTAuth::parseToken()->authenticate();

        $validator = Validator::make($request->all(), [
            'receiver_id' => 'required',
            'message_content' => 'required|string|max:255',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $message = Message::create([
            'sender_id'=>$sender->id,
            'receiver_id'=>$request->receiver_id,
            'message_content'=>$request->message_content
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully',
            'data' => $message
        ], 201);
    }
    public function show($id) {
        $message = Message::find($id);

        return response()->json([
            'success' => true,
            'message' => 'Take message successfully',
            'data' => $message
        ]);
    }

    public function getMessages($receiver_id) {
        $messages = Message::where('receiver_id',$receiver_id)->get();
        return response()->json([
            'success' => true,
            'message' => 'Get messages successfully',
            'data' => $messages
        ]);
    }

    public function destroy($id) {
        Message::destroy($id);
        return response()->json([
            'success' => true,
            'message' => 'Message deleted successfully',
        ]);
    }
}
