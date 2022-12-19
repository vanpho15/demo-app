<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Category\CategoryService;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $categoryservice;
    public function __construct(CategoryService $CategoryService){
        $this->categoryservice = $CategoryService;
    }
    public function create(){
        return view('admin.category.add',[
            'title' => 'Thêm danh mục',
            'categories'=>$this->categoryservice->getParent()
        ]);
    }
    public function store(Request $request){
        $result= $this->categoryservice->create($request);
        return redirect()->back();
    } 
    public function index()
    {
        return view('admin.category.list',[
            'title' => 'Danh sách danh mục',
            'categories'=>$this->categoryservice->getAll()
        ]);
    }
    public function show(Category $Category){//khai báo use
        return view('admin.category.edit',[
            'title' => 'Chỉnh sửa danh mục : '.$Category->name,
            'category'=>$Category,
            'categories'=>$this->categoryservice->getParent()
        ]);
    }
    public function update(Category $category,Request $request){
        $this->categoryservice->update($request, $category );
        return redirect()->route('categories.index');
    }
    public function destroy(Request $request){
        $result=$this->categoryservice->destroy($request);
        if($result){
            return response()->json([
                'error' =>false,
                'message' =>'Xóa Thành Công Danh Mục'
            ]);
        }
    }
}
