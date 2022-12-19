<?php
namespace App\Http\Services\Category;
use Illuminate\Support\Str;
use App\Models\Category;
class CategoryService {
    public function getParent(){
        return Category::where('parent_id',0)->get();
    }
    public function create($request){
        try{
            Category::create([
                'name' =>(string) request()->input('name'),
                'parent_id' =>(int) request()->input('parent_id'),
                'description' =>(string) request()->input('description'),
                'content' =>(string) request()->input('content'),
                'slug' =>(string) Str::slug(request()->input('name')),
                'active'=>(int) request()->input('active')
            ]);
            session()->flash('success','Tạo Thành Công');
        }catch(\Exception $err){//bắt lỗi trùng slug vì undique
            session()->flash('error','Không Tạo Thành Công');
            return false;
        }
        return true;
    }
    public function getAll(){
        return Category::orderbyDesc('id')->simplePaginate(10);
    }
    public function update($request, $category):bool
    {
        if($request->input('parent_id') != $category->id){
            $category->parent_id =(int) $request->input('parent_id');
        }
        $category->name =(string) $request->input('name');
        $category->description =(string) $request->input('description');
        $category->content =(string) $request->input('content');
        $category->active=(int) $request->input('active');
        $category->save();
        session()->flash('success','Cập nhập thành công danh mục');
        return true;
    }
    public function destroy($request){
        $id=(int) $request->input('id');
        $category=Category::where('id',$id)->first();
        if($category){
            return Category::where('id',$id)->orWhere('parent_id',$id)->delete();
            
        }
        return false;
    }
   
}