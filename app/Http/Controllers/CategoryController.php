<?php

namespace App\Http\Controllers;


use App\Models\Itens;
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

    public function getItensByCategory(Request $request){
        $category = $request->category;
        $categoryID = Categories::where('title',$category)->get()[0]['id'];
        return Itens::where('category',$categoryID)->get();
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
