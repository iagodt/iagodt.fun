<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\attributes;
use App\Models\attributeValues;
use App\Models\products;
use Illuminate\Http\Request;


class AttributesController extends Controller
{
    public function getItem(Request $request)
    {
        $id = $request->id;
        $Products = attributeValues::where('products_id', $id)->get()->toArray();
        $output = [];
        foreach ($Products as $product) {

            $name = attributes::where('id', $product['attribute_id'])->value('name');
            //
            if (!array_key_exists($name, $output)) {
                $output[$name] = [$product['value']];
            } else {
                array_push($output[$name], $product['value']);
            }
        }

        return $output;
    }
    public function index(Request $request)
    {
        $atributos = attributeValues::distinct()->pluck('attribute_id', 'value')->toArray();
        $atributosName = attributes::distinct()->pluck('name', 'id')->toArray();
        $output = [];
        foreach ($atributosName as $value => $key) {
            $valuesArray = [];
            foreach ($atributos as $valor => $atributo) {
                if ($atributo == $value) {
                    array_push($valuesArray, $valor);
                }
                ;
            }
            $output[$key] = $valuesArray;
        }
        return $output;
    }

    public function filter(Request $request)
    {
        $filtersArray = explode(',', $request->filter);

        $products = [];

        foreach ($filtersArray as $filter) {
            $filters = attributeValues::all()->where('value', $filter)->pluck('products_id');
            foreach ($filters as $i) {
                array_push($products, products::where('id', $i)->first());
            }
        }

        $filteredProducts = array_unique($products);


        return $filteredProducts;
    }

}