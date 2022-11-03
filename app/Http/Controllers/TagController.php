<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $allTags = Tag::all();

        return response()->json([
            'status' => 200,
            'tags' => $allTags
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backEnd.tag.add-tag');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'tag_name' => 'required|max:20|min:5|string'
        ]);

        if ($validator->fails()) {


            return response()->json([

                'status' => 400,
                'errors' =>  $validator->messages()

            ]);
        } else {

            Tag::create([

                'tag_name' => $request->tag_name
            ]);


            return response()->json([

                'status' => 200,
                'message' => "Tag Added Successfully!"

            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //

        return response()->json([
            'status' => 200,
            'tag' => $tag,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Tag $tag, Request $request)
    {
        //

        $validator = Validator::make($request->all(), [

            'tag_name' => 'required|max:20|min:5|string'
        ]);

        if ($validator->fails()) {


            return response()->json([

                'status' => 400,
                'errors' =>  $validator->messages()

            ]);
        } else {

            $tag->update([

                'tag_name' => $request->tag_name
            ]);


            return response()->json([

                'status' => 200,
                'message' => "Tag Added Successfully!"

            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //

        $tag->delete();

        return response()->json([

            'status' => 200,
            'message' => "Tag Deleted Successfully!"
        ]);
    }
}
