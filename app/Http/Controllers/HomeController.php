<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::withAvg('reviews', 'rating')->withCount('reviews');
        

        if ($request->sort == 'price_asc') {
            $products->orderBy('price', 'asc');
        } 
        elseif ($request->sort == 'price_desc') {
            $products->orderBy('price', 'desc');
        } 
        else {
            $products->latest();
        }

        $products = $products->get();

        return view('auth.home', compact('products'));
    }
}