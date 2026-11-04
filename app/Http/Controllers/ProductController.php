<?php

namespace App\Http\Controllers;

class ProductController extends Controller
{
    public static array $products = [];

    public function index()
    {
        return view('pages.products', ['products' => self::$products]);
    }

    public function show(string $slug)
    {
        $product = self::$products[$slug] ?? null;
        if (!$product) {
            abort(404);
        }
        return view('pages.product-detail', compact('product'));
    }
}
