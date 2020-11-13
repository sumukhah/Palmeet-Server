<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class PalRequestController extends Controller
{
    public function index(){
        $user=Auth::user();
        $pendingPalRequests=$user->pendingPalRequests()->with(['pal'])->get();
        $rejectedPalRequests=$user->rejectedPalRequests()->with(['pal'])->get();
        $acceptedPalRequests=$user->pendingPalRequests()->with(['pal'])->get();
        $myPendingRequests=$user->myPendingPalRequests()->with(['user'])->get();

        $data=[
            'user'=>$user,
            'pending'=>$pendingPalRequests,
            'rejected'=>$rejectedPalRequests,
            'my_pals'=>$acceptedPalRequests,//people I have accepted
            'my_pending'=>$myPendingRequests,//People who sent me request I have not responded
        ];

        return response()->json(['data'=>$data],200);
    }

    public function pal($id){

    }
}
