<?php

namespace App\Http\Controllers;

use App\Idea;
use App\User;
use App\IdeaCategory;
use App\Vote;
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
        if($request->categories) {
            foreach ($request->categories as $category) {
                $idea_category = new IdeaCategory([
                    'idea_id' => $request->idea_id,
                    'category_id' => $category,
                    'creator_id' => $request->user()->id
                ]);
                $idea_category->save();
            }
        }
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
    public function readall(Request $request){
        return response()->json(Idea::latest()->with('users','votes')->get());
    }
    public function read(Request $request,$id)
    {
        $finalData = Idea::with('users','writeups')->with('writeups.users')->find($id);
        $finalData["Upvotes"] = Vote::where(['idea_id' => $id,'vote' => 1])->count();
        $finalData["Downvotes"] = Vote::where(['idea_id' => $id,'vote' => -1])->count();
        return $finalData;
    }
}
