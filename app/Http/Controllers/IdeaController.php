<?php

namespace App\Http\Controllers;

use App\Idea;
use App\User;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    //
       /**
     * Create idea
     *
     * @param  [integer] user_id
     * @param  [string] idea
     * @return [string] message
     */
    public function create(Request $request)
    {
        $request->validate([
            'idea' => 'required|string',
        ]);
        $idea = new Idea([
            'creator_id' => $request->user()->id,
            'idea' => $request->idea
        ]);
        $idea->save();
        return response()->json([
            'message' => 'Successfully created Idea!'
        ], 201);
    }
     /**
     * update idea
     *
     * @param  [integer] idea_id
     * @param  [string] idea
     * @return [string] message
     */
    public function update(Request $request)
    {
        $idea = Idea::find($request->idea_id);
        $idea->idea = $request->idea;
        $idea->save();
        return response()->json([
            'message' => 'Successfully updated Idea!'
        ], 201);
    }
    public function delete(Request $request)
    {
        $idea = Idea::find($request->idea_id);
        $idea->delete();
        return response()->json([
            'message' => 'Successfully deleted Idea!'
        ], 201);
    }
    public function read(Request $request){
        return response()->json(Idea::with('users')->get());
    }
}
