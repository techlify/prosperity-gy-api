<?php

namespace App\Http\Controllers;

use App\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function storeVote(Request $request)
    {
        $request->validate([
            'idea_id' => 'required|integer',
            'vote' => 'required|integer',
        ]);
        $vote = Vote::where(['creator_id' => $request->user()->id, 'idea_id' => $request->idea_id])->first();
        if ($vote) {
            $vote->vote = $request->vote;
        } else {
            $vote = new Vote([
                'creator_id' => $request->user()->id,
                'idea_id' => $request->idea_id,
                'vote' => $request->vote
            ]);
        }
        $vote->save();
        return response()->json([
            'message' => 'Successfully created Vote!'
        ], 201);
    }
    public function userVote(Request $request)
    {
        return $vote = Vote::where(['creator_id' => $request->user()->id, 'idea_id' => $request->idea_id])->first();
    }
}
