<?php

namespace App\Http\Controllers;

use App\Recommendation;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
     /**
     * Create recommendation
     *
     * @param  [integer] creator_id
     * @param  [integer] idea_id
     * @param  [string] text
     * @param  [integer] rating
     * @return [string] message
     */
    public function create(Request $request)
    {
        $request->validate([
            'idea_id' => 'required|integer',
            'rating' => 'required|integer',
            'text' => 'required|string'
        ]);
        $recommendation = new Recommendation([
            'creator_id' => $request->user()->id,
            'idea_id' => $request->idea_id,
            'rating' => $request->rating,
            'text' => $request->text
        ]);
        $recommendation->save();
        return response()->json([
            'message' => 'Successfully created recommendation!'
        ], 201);

    }

    /**
     * update recommendation
     *
     * @param  [integer] recommendation_id
     * @param  [integer] rating
     * @param  [string] text
     * @return [string] message
     */
    public function update(Request $request)
    {
        $recommendation = Recommendation::find($request->recommendation_id);
        $recommendation->rating = $request->rating;
        $recommendation->text = $request->text;
        $recommendation->save();
        return response()->json([
            'message' => 'Successfully updated recommendation!'
        ], 201);
    }
    public function delete(Request $request)
    {
        $recommendation_id = Recommendation::find($request->recommendation_id);
        $recommendation_id->delete();
        return response()->json([
            'message' => 'Successfully deleted recommendation_id!'
        ], 201);
    }
}
