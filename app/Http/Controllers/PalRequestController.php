<?php

namespace App\Http\Controllers;

use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PalRequestController extends Controller
{
    public function index(){
        $user=Auth::user();
        $pendingPalRequests=$user->pendingPalRequests()->with(['pal'])->get();
        $rejectedPalRequests=$user->rejectedPalRequests()->with(['pal'])->get();
        $acceptedPalRequests=$user->pendingPalRequests()->with(['pal'])->get();
        $myPendingRequests=$user->myPendingPalRequests()->with(['user'])->get();

        $data=[
//            'user'=>$user,
            'pending'=>$pendingPalRequests,
            'rejected'=>$rejectedPalRequests,
            'my_pals'=>$acceptedPalRequests,//people I have accepted
            'my_pending'=>$myPendingRequests,//People who sent me request I have not responded
        ];

        return response()->json(['data'=>$data],200);
    }

    public function newPalRequest(Request $request){
        $user=Auth::user();
        $message=$user->name. ' sent you a Pal Request.';
//        Mail::raw($message, function($message)use($request)
//        {
//            $message->subject('New Pal Request!');
//            $message->from('no-reply@palmeet.com', 'Pal Meet');
//            $message->to($request->email);
//        });

        $html = '<h2>New Pal Request</h2>';
        $html .= '<p>'.$message.'</p>';
        $msgArray=[
            'name' => $user->name,
            'user_message' => $request->message??'',
            'subject' => 'New Pal Request!',
            'email_content' => html_entity_decode($html),
            'accept_link' =>env('APP_URL').'accept-pal',
        ];
        Mail::send(['html'=>'mailer'], $msgArray, function (Message $message) use ($request,$html) {
            $message->to($request->email)
                ->subject('New Pal Request!')
                ->setFrom('no-reply@palmeet.com','Pal Meet')
                ->setBody($html, 'text/html');
        });
        return $request;
    }
}
