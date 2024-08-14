<?php

namespace App\Http\Controllers\Api;
use App\Models\Itens;
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
        return Itens::get();
    }

    public function get(Request $request){
        $item = $request->name;
        $id = $request->id;
        
        if($id == null){
            return Itens::where("name",$item)->get()->first();
        }
        return Itens::where("id",$id)->get()->first();
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
