<?php

namespace App\Http\Controllers;

use App\PalRequest;
use App\User;
use Illuminate\Http\JsonResponse;
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
        $myPals=[];
        $user->acceptedPalRequests()->with(['pal'])->get()
            ->mapToGroups(function ($acceptedMe)use(&$myPals){
                $acceptedMe->name=$acceptedMe->pal->name;
                $myPals[]=$acceptedMe;
                return [];
            });
        $myAcceptedPalRequests=$user->myAcceptedPalRequests()->with(['user'])->get()
            ->mapToGroups(function ($acceptedMe)use(&$myPals){
                $acceptedMe->name=$acceptedMe->user->name;
                $myPals[]=$acceptedMe;
                return [];
            });
        $myPendingRequests=$user->myPendingPalRequests()->with(['user'])->get();

        $data=[
//            'user'=>$user,
            'pending'=>$pendingPalRequests,
            'rejected'=>$rejectedPalRequests,
            'my_pals'=>$myPals,//people I have accepted
            'my_pending'=>$myPendingRequests,//People who sent me request I have not responded
        ];

        return response()->json(['data'=>$data],200);
    }

    public function newPalRequest(Request $request){
        $user=Auth::user();
        $newRequest=[
            'user_id'=>$user->id,
            'email'=>$request->email,
        ];
        $requiresReg=0;
        $pal=(new User)->where(['email'=>$request->email])->first();
        if(is_null($pal))
            $requiresReg=1;
        else
            $newRequest['pal_id']=$pal->id;
        $checkPalRequest=(new PalRequest)->where($newRequest)->first();
        if(!is_null($checkPalRequest)&&$checkPalRequest->status>=0)
            return response()->json(['error'=>'Already requested.']);
        $palRequest=null;
        try{
            $palRequest=(new PalRequest)->updateOrCreate($newRequest);
            $newRequest->update(['message'=>$request->message?:null]);
        }
        catch (\Exception $exception)
        {
            return response()->json(['error'=>"Please Enter your email address"],400);
        }

        $message=$user->name. ' sent you a Pal Request.';
        $html = '<h2>New Pal Request</h2>';
        $html .= '<p>'.$message.'</p>';
        if(isset($request->message)&&!empty($request->message))
            $html .='<h3>Message</h3><p>'.$request->message.'</p>';
        $msgArray=[
            'name' => $user->name,
            'pal' => $pal?$pal->name:null,
            'user_message' => $request->message??'',
            'subject' => 'New Pal Request!',
            'email_content' => html_entity_decode($html),
            'requires_reg' =>$requiresReg,
            'accept_link' =>env('APP_URL').'accept-pal',
        ];
        Mail::send(['html'=>'mailer'], $msgArray, function (Message $message) use ($request,$html) {
            $message->to($request->email)
                ->subject('New Meet Pal Request!')
                ->setFrom('no-reply@palmeet.com','Pal Meet')
                ->setBody($html, 'text/html');
        });
        return response()->json(['data'=>$palRequest]);

    }
    public function acceptPalRequest($id){
        $pal=Auth::user();
        $palRequest=(new PalRequest)->find($id);
        if(is_null($palRequest))
            return response()->json(['error'=>"Request instance not found"]);

        if($palRequest->email!=$pal->email)
            return response()->json(['error'=>"This Pal Request is not for you!"]);

        $palRequest->update(['pal_id'=>$pal->id,'status'=>1]);
        $user=$palRequest->user;

        $message=$pal->name. ' has accepted Your Pal Request! <br> You can now have scheduled meetings with '.$pal->name.'!';
        $html = '<h2>'.$pal->name.' is now your Meet Pal!</h2>';
        $html .= '<p>'.$message.'</p>';
        $msgArray=[
            'name' => $user->name,
            'user' => $user?$user->name:null,
            'subject' => 'Meet Pal Request Accepted!',
            'email_content' => html_entity_decode($html),
            'requires_reg' =>0,
            'app_link' =>env('APP_URL'),
        ];
        Mail::send(['html'=>'mailer'], $msgArray, function (Message $message) use ($user,$html) {
            $message->to($user->email)
                ->subject('Pal Meet Request Accepted!')
                ->setFrom('no-reply@palmeet.com','Pal Meet')
                ->setBody($html, 'text/html');
        });
        return $this->index();

    }



}
