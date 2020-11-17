<?php

namespace App\Http\Controllers;

use App\Meeting;
use App\MeetingRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MeetingController extends Controller
{
    public $user;

    public function index()
    {
        $this->user = Auth::user();
        $meetings = ['active' => [], 'old' => []];

        Meeting::with(['host'])->where(['user_id' => $this->user->id])
            ->orderBy('meeting_starts', 'desc')
            ->get()
            ->mapToGroups(function ($meeting) use (&$meetings) {
                $meeting->invited=$meeting->invites->count();
                $meeting->attending=$meeting->attendance->count();
                unset($meeting->invites);
                unset($meeting->attendance);
                if ($meeting->status == Meeting::$Ended)
                    $meetings['old'][] = $meeting;
                else {
                    if (Carbon::parse($meeting->meeting_ends)->isPast()) {
                        $meeting->status = Meeting::$Ended;
                        unset($meeting->invited);
                        unset($meeting->attending);
                        $meeting->save();
                        $meeting = Meeting::find($meeting->id);
                        $meeting->meetingRequest()->get()->mapToGroups(function ($requestList) {
                            $requestList->update(['meeting_status' => Meeting::$Ended]);
                            return [];
                        });
                        $meeting->invited=$meeting->invites->count();
                        $meeting->attending=$meeting->attendance->count();
                        unset($meeting->invites);
                        unset($meeting->attendance);
                        $meetings['old'][] = $meeting;
                    } else {
                        $meetings['active'][] = $meeting;
                    }
                }
                return [];
            });

        $this->user->acceptedMeetingRequests()->with(['meeting.host'])->get()->mapToGroups(function ($acceptedMeeting) use (&$meetings) {
            if ($acceptedMeeting->meeting->status <= Meeting::$Started)
                $meetings['active'][] = $acceptedMeeting->meeting;
            else
                $meetings['old'][] = $acceptedMeeting->meeting;
            return [];
        });

        return response()->json(['data' => $meetings]);
    }
    public function myMeetingInvites()
    {
        $this->user = Auth::user();
        $invites = MeetingRequest::with(['meeting.host'])->where(['user_id' => $this->user->id,'acceptance_status'=>MeetingRequest::$Pending])
            ->get();
        return response()->json(['data' => $invites]);
    }

    public function acceptMeetingInvite($mid){
        $meetingRequest=(new MeetingRequest)->find($mid);
        if(is_null($meetingRequest))
            return response()->json(['error'=>"Meeting instance not found."]);
        $user=Auth::user();
        if($meetingRequest->user_id!=$user->id)
            return response()->json(['error'=>"You are not invited to this meeting"]);

        if($meetingRequest->update(['acceptance_status'=>MeetingRequest::$Accepted])){
            $this->sendMeetingAcceptanceMail($meetingRequest->meeting->host,$meetingRequest->invitee,$meetingRequest->meeting);
        }
        return response()->json(['success'=>"Acceptance Acknowledged"]);
    }
    public function declineMeetingInvite($mid){
        $meetingRequest=(new MeetingRequest)->find($mid);
        if(is_null($meetingRequest))
            return response()->json(['error'=>"Meeting instance not found."]);
        $user=Auth::user();
        if($meetingRequest->user_id!=$user->id)
            return response()->json(['error'=>"You are not invited to this meeting"]);

        if($meetingRequest->update(['acceptance_status'=>MeetingRequest::$Declined])){
            $this->sendMeetingDeclinationMail($meetingRequest->meeting->host,$meetingRequest->invitee,$meetingRequest->meeting);
        }
        return response()->json(['success'=>"Declination Acknowledged"]);
    }


    public function store(Request $request)
    {
        $this->user=Auth::user();
        $request['user_id'] = $this->user->id;
        $request['meeting_starts'] = Carbon::parse(json_decode($request['meeting_starts']));
        $request['meeting_ends'] = Carbon::parse(json_decode($request['meeting_ends']));
        $Meeting = Meeting::create($request->all());
        return response()->json(['data'=>$Meeting], 201);
    }
    public function invitePals(Request $request)
    {
        $req=['invitees','meeting_id'];
        foreach ($req as $item) {
            if(!isset($request[$item]))
                return response()->json(['error'=>$item.' is required']);
        }
        $Meeting = Meeting::find($request['meeting_id']);
        if(is_null($Meeting))
            return response()->json(['error'=>"Meeting has been deleted!"]);
        $invitees=[];
        $rIv=json_decode($request['invitees']);
        if(is_array($rIv))
            $invitees=$rIv;
        else
            $invitees[]=$rIv;
//        dd($invitees);
        $this->user=Auth::user();
        $totalInvited=0;
        foreach ($invitees as $invitee) {
            if($meetingRequest=(new MeetingRequest)->updateOrCreate(['user_id'=>$invitee,'meeting_id'=>$Meeting->id])){
                $totalInvited ++;
                if(!is_null($meetingRequest->invitee))
                $this->sendMeetingInviteMail($Meeting->host,$meetingRequest->invitee,$Meeting);
            }
        }

        return response()->json(['success'=>'successfully invited '.$totalInvited.' Pals!'], 201);
    }

    public function sendMeetingInviteMail($host,$user,$meeting){

        $message=$host->name. ' has invited you for a meeting!';
        $message .='<h4>Meeting Title:</h4>';
        $message .='<h5>'.$meeting->title.'</h5>';
        $message .='<h4>Meeting Schedule</h4>';
        $message .='<h5>'.$meeting->meeting_starts.' - '.$meeting->meeting_ends.'</h5>';

        $html = '<h2>Meeting Invite from your Pal '.$host->name.'</h2>';
        $html .= '<p>'.$message.'</p>';
        $msgArray=[
            'pal' => $user->name,
            'subject' => 'Meeting Request from your Pal '.$host->name,
            'email_content' => html_entity_decode($html),
            'app_link' =>env('APP_URL'),
        ];
        Mail::send(['html'=>'meeting'], $msgArray, function (Message $message) use ($user,$host,$html) {
            $message->to($user->email)
                ->subject('New Meeting invite from your Pal '.$host->name)
                ->setFrom('no-reply@palmeet.com','Pal Meet')
                ->setBody($html, 'text/html');
        });
    }
    public function sendMeetingAcceptanceMail($host,$user,$meeting){

        $message=$user->name. ' has <strong style="color:green">ACCEPTED</strong> your meeting invite!';
        $message .='<h4>Meeting Title:</h4>';
        $message .='<h5>'.$meeting->title.'</h5>';
        $message .='<h5>Meeting Schedule</h5>';
        $message .='<h4>'.$meeting->meeting_starts.' - '.$meeting->meeting_ends.'</h4>';

        $html = '<h2>Meeting Invite from you has been accepted by '.$user->name.'</h2>';
        $html .= '<p>'.$message.'</p>';
        $msgArray=[
            'pal' => $host->name,
            'subject' => 'Meeting Request from you was accepted by your Pal '.$user->name,
            'email_content' => html_entity_decode($html),
            'app_link' =>env('APP_URL'),
        ];
        Mail::send(['html'=>'meeting'], $msgArray, function (Message $message) use ($user,$host,$html) {
            $message->to($host->email)
                ->subject('Meeting invite accepted by your Pal '.$user->name)
                ->setFrom('no-reply@palmeet.com','Pal Meet')
                ->setBody($html, 'text/html');
        });
    }
    public function sendMeetingDeclinationMail($host,$user,$meeting){

        $message=$user->name. ' has <strong style="color:indianred">DECLINED</strong> your meeting invite!';
        $message .='<h4>Meeting Title:</h4>';
        $message .='<h5>'.$meeting->title.'</h5>';
        $message .='<h5>Meeting Schedule</h5>';
        $message .='<h4>'.$meeting->meeting_starts.' - '.$meeting->meeting_ends.'</h4>';

        $html = '<h2>Meeting Invite from you has been declined by '.$user->name.'</h2>';
        $html .= '<p>'.$message.'</p>';
        $msgArray=[
            'pal' => $host->name,
            'subject' => 'Meeting Request from you was declined by your Pal '.$user->name,
            'email_content' => html_entity_decode($html),
            'app_link' =>env('APP_URL'),
        ];
        Mail::send(['html'=>'meeting'], $msgArray, function (Message $message) use ($user,$host,$html) {
            $message->to($host->email)
                ->subject('Meeting invite declined by your Pal '.$user->name)
                ->setFrom('no-reply@palmeet.com','Pal Meet')
                ->setBody($html, 'text/html');
        });
    }

    public function show(Meeting $Meeting)
    {
        $user=Auth::user();
        return response()->json($user->meetings()->with(['host','invites.invitee','attendance.invitee'])->get());
    }

    public function update(Request $request, Meeting $Meeting)
    {
        $Meeting->update($request->all());

        return response()->json($Meeting, 200);
    }

    public function delete($meeting_id)
    {

        $Meeting=(new Meeting)->find($meeting_id);
        if(is_null($Meeting))
            return response()->json(['error'=>"Meeting not found. Must have been deleted"]);
        $Meeting->meetingRequest()->get()->mapToGroups(function ($meetReq) {
            $meetReq->delete();
            return [];
        });
        $Meeting->delete();

        return response()->json(['success'=>"deleted!"]);
    }
}
