<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function create()
    {
        return view('admin.products.add', [
            'title' => 'Thêm Sản Phẩm Mới',
            'categories' => $this->productService->getcategory()
        ]);
    }
    public function store(Request $request)
    {
        $this->productService->insert($request);
        return redirect()->back();
    }

}
