<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Colour;
use Illuminate\Support\Facades\Auth;

class ColourController extends Controller
{
    //
    public function index()
    {
        $colours = Colour::orderBy('created_at','desc')->paginate(5);
        return view('admin.colours',compact('colours'));
    }

    public function add(Request $request)
    {
        if (empty($request->colour)) {
            return response(['error' => __('colours.empty-field')]);
        }

        // Check if colour already exist

        $colour = Colour::where('colour',$request->colour)->get()->first();
        if ($colour) {
            return response(['error' => __('colours.colour-exist')]);
        }

        try{
            Colour::create(request(['colour']));
            $colour_id = Colour::where('colour',$request->colour)->get()->first()->id;
            return response(['message' => __('colours.create-success'),'colour_id' => $colour_id]);
        }
        catch(Exception $e){
            return response(['error' => __('colours.create-error')]);
        }
    }

    public function update(Request $request)
    {
        if (!$request->colour) {
            return response(['error' => __('colours.empty-field')],403);
        }

        $colour_to_update = Colour::find($request->id);

        if (!$colour_to_update) {
            return response(['error' => __('colours.not-found')]);
        }
        // Check if colour exist
        $colour_exists = Colour::where('colour',$request->colour)->get()->first();
        if($colour_exists){
            if ($colour_exists->id != $request->id) {
                 return response(['error' => __('colours.colour-exist')]);
                }
            }

        try{
            $colour_to_update->update(request(['colour']));
            return response(['message' => __('colours.update-success')]);
        }
        catch(Exception $e){
            return response(['error' => __('colours.create-error')]);
        }
    }

    public function delete(Request $request)
    {
        if (!$request->id) {
            return response(['error' => __('colours.empty-id')],404);
        }

        try{
            $colour_to_delete = Colour::find($request->id);
            $colour_to_delete->delete();
            return response(['message' => __('colours.delete-success')],201);
            
        }
        catch(Exception $e){
            return response(['error' => __('colours.delete-error')],500);
        }
    }
}
