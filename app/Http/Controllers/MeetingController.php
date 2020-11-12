<?php

namespace App\Http\Controllers;

use App\Meeting;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function index()
    {
        return Meeting::all();
    }

    public function show(Meeting $Meeting)
    {
        return $Meeting;
    }

    public function store(Request $request)
    {
        $Meeting = Meeting::create($request->all());

        return response()->json($Meeting, 201);
    }

    public function update(Request $request, Meeting $Meeting)
    {
        $Meeting->update($request->all());

        return response()->json($Meeting, 200);
    }

    public function delete(Meeting $Meeting)
    {
        $Meeting->delete();

        return response()->json(null, 204);
    }
}
