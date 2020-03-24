<?php

namespace App\Http\Controllers;

use App\Idea;
use App\User;
use App\Writeup;
use Illuminate\Http\Request;

class WriteupController extends Controller
{
     /**
     * Create writeup
     *
     * @param  [integer] user_id
     * @param  [integer] idea_id
     * @param  [string] writeup
     * @return [string] message
     */
    public function create(Request $request)
    {
        $request->validate([
            'idea_id' => 'required|integer',
            'writeup' => 'required|string'
        ]);
        $writeup = new Writeup([
            'creator_id' => $request->user()->id,
            'idea_id' => $request->idea_id,
            'writeup' => $request->writeup
        ]);
        $writeup->save();
        return response()->json([
            'message' => 'Successfully created Writeup!'
        ], 201);

    }

    /**
     * update writeup
     *
     * @param  [integer] writeup_id
     * @param  [string] writeup
     * @return [string] message
     */
    public function update(Request $request)
    {
        $writeup = Writeup::find($request->writeup_id);
        $writeup->writeup = $request->writeup;
        $writeup->save();
        return response()->json([
            'message' => 'Successfully updated Writeup!'
        ], 201);
    }
    public function delete(Request $request)
    {
        $writeup = Writeup::find($request->writeup_id);
        $writeup->delete();
        return response()->json([
            'message' => 'Successfully deleted Writeup!'
        ], 201);
    }
    public function read(Request $request){
        return response()->json(Idea::with('users')->get());
    }
}
