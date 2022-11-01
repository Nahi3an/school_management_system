<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $categories = Category::all();

        return response()->json([

            'status' => 200,
            'categories' => $categories
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

        return view('backEnd.category.add-category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [

            'category_name' => 'required|string|max:30|min:4',
            'category_image' => 'required|image|mimes:png,jpg,jpeg'
        ]);

        if ($validator->fails()) {

            return response()->json([

                'status' => 400,
                'errors' => $validator->messages()

            ]);
        } else {

            Category::create([

                'category_name' => $request->category_name,
                'category_image' => $this->saveImage($request)

            ]);

            return response()->json([

                'status' => 200,
                'message' => 'Category Added Successfuly!'

            ]);
        }
    }

    public function changeStatus(Request $request)
    {

        $category = Category::find($request->id);

        if ($category) {

            if ($category->status == 1) {

                $category->status = 0;
            } else {

                $category->status = 1;
            }

            $category->update();

            // $category = Category::find($request->id);

            return response()->json([

                'status' => 200,
                'message' => "Category Status Changed!"

            ]);
        } else {

            return response()->json([

                'status' => 404,
                'message' => 'Category Not Found!'

            ]);
        }
    }
    private function saveImage(Request $request)
    {

        $image = $request->file('category_image');
        $imageExt = $image->getClientOriginalExtension();
        $imageName = rand() . '.' . $imageExt;
        $imageDirectory = 'adminAsset/categoryImage/';
        $imageUrl = $imageDirectory . '' . $imageName;

        $image->move($imageDirectory, $imageName);

        return $imageUrl;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, $id)
    {
        //

        $category = Category::find($id);

        if ($category) {

            return response()->json([

                'status' => 200,
                'category' => $category

            ]);
        } else {

            return response()->json([

                'status' => 404,
                'message' => 'Category Not Found!'

            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {

        $validator = Validator::make($request->all(), [

            'category_name' => 'required|string|max:30|min:4',
        ]);

        $category = Category::find($request->id);

        if($validator->fails()){

            return response()->json([

                'status' => 400,
                'errors' => $validator->messages(),

            ]);

        }else{

            if ($category) {

                $updateImage = $category->category_image;

                if ($request->file('category_image')) {

                    unlink($category->category_image);
                    $updateImage = $this->saveImage($request);
                }

                $category->update([

                    'category_name' => $request->category_name,
                    'category_image' => $updateImage
                ]);

                return response()->json([

                    'status' => 200,
                    'message' => 'Category Info Updated Successfully!'

                ]);

            } else {

                return response()->json([

                    'status' => 404,
                    'message' => 'Category Not Found!'

                ]);
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category,$id)
    {
        //
        $category = Category::find($id);

        if ($category) {

            if ($category->category_image) {

                unlink($category->category_image);
            }

            $category->delete();

            return response()->json([
                'status' => 200,
                'message' => "Category Information Deleted"
            ]);
            
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Category Not Found!'
            ]);
        }
    }
}
