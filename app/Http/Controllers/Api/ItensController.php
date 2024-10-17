<?php

namespace App\Http\Controllers\Api;
use App\Models\products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItensController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return products::get();
    }

    public function get(Request $request){
        $item = $request->name;
        $id = $request->id;
        
        if($id == null){
            return products::where("name",$item)->get()->first();
        }
        return products::where("id",$id)->get()->first();
    }

    public function getSuggests(Request $request){
        
        return Products::where('category', 'like', '%"category": "' . $request->category . '"%')->get();;
    }
    public function getHome(Request $request){
        
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
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
