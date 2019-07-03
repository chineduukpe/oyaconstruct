<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Size;

class SizeController extends Controller
{
    //
    public function index()
    {
        $sizes = Size::orderBy('created_at','desc')->paginate(5);
        return view('admin.sizes',compact('sizes'));
    }

    public function add(Request $request)
    {
        if (empty($request->size)) {
            return response(['error' => __('sizes.empty-field')]);
        }

        // Check if Size already exist

        $size = Size::where('size',$request->size)->get()->first();
        if ($size) {
            return response(['error' => __('sizes.size-exist')]);
        }

        try{
            Size::create(request(['size']));
            $size_id = Size::where('size',$request->size)->get()->first()->id;
            return response(['message' => __('sizes.create-success'),'size_id' => $size_id]);
        }
        catch(Exception $e){
            return response(['error' => __('sizes.create-error')]);
        }
    }

    public function update(Request $request)
    {
        if (!$request->size) {
            return response(['error' => __('sizes.empty-field')],403);
        }

        $colour_to_update = Size::find($request->id);

        if (!$colour_to_update) {
            return response(['error' => __('sizes.not-found')]);
        }
        // Check if size exist
        $colour_exists = Size::where('size',$request->size)->get()->first();
        if($colour_exists){
            if ($colour_exists->id != $request->id) {
                 return response(['error' => __('sizes.size-exist')]);
                }
            }

        try{
            $colour_to_update->update(request(['size']));
            return response(['message' => __('sizes.update-success')]);
        }
        catch(Exception $e){
            return response(['error' => __('sizes.create-error')]);
        }
    }

    public function delete(Request $request)
    {
        if (!$request->id) {
            return response(['error' => __('sizes.empty-id')],404);
        }

        try{
            $colour_to_delete = Size::find($request->id);
            $colour_to_delete->delete();
            return response(['message' => __('sizes.delete-success')],201);
            
        }
        catch(Exception $e){
            return response(['error' => __('sizes.delete-error')],500);
        }
    }
}
