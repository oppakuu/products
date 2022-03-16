<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with(Product::RELATION_AUTHOR);
        $name = $createdAt = $authorName = '';
        
        if($request->filled(Product::NAME)) {
            $name = $request->input(Product::NAME);
            $products = $products->where(Product::NAME, 'like', '%' . $name . '%');
        }
        if($request->filled(Product::CREATED_AT)) {
            $createdAt = $request->input(Product::CREATED_AT);
            $products = $products->where(Product::CREATED_AT, 'like', $createdAt . '%');
        }
        if($request->filled(Product::AUTHOR_NAME)) {
            $authorName = $request->input(Product::AUTHOR_NAME);
            $products = $products->whereHas(Product::RELATION_AUTHOR,
                function ($products) use ($authorName) {
                    $products->where('name', 'like', '%' . $authorName . '%');
                });
        }
        
        $products = $products->get();
        
        return view('products', [
            'products' => $products, 
            'name' => $name, 
            'createdAt' => $createdAt, 
            'authorName' => $authorName
        ]);
    }
}
