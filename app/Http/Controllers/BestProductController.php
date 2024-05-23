<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BestProductController extends Controller
{
    public function getBestProducts() {
        $bestProducts = Product::orderBy('number_of_purchases', 'desc')
                                ->take(4) // Adjust the number of products you want to fetch
                                ->get();
        return response()->json($bestProducts);
}

}
    // public function index(){

    // }
    // public function store(){

    // }
    // public function update(){

    // }
    // public function destroy(){

    // }

