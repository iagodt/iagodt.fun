<?php

namespace App\Http\Controllers\Api;


use App\Models\products;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $output = [];
        $categories = Categories::get()->toArray();
        foreach ($categories as $key => $value) {
           if($categories[$key]['active'] == 1){
            array_push($output,$categories[$key]);
           }
        }

        return $output;
        
    }

    public function getItensByCategory(Request $request)
{
    $category = $request->category;
    $categoryRecord = Categories::where('title', $category)->first();

    $categoryID = (string) $categoryRecord->id;

    return Products::where('category', 'like', '%"category": "' . $categoryID . '"%')->get();
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categories $categories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $categories)
    {
        //
    }
}
