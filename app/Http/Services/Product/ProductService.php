<?php
namespace App\Http\Services\Product;
use App\Models\Procduct;
use App\Models\Category;
class ProductService {
    public function getcategory()
    {
        return Category::where('active', 1)->get();
    }
    protected function isValidPrice($request)
    {
        if ($request->input('price') != 0 && $request->input('price_sale') != 0
            && $request->input('price_sale') >= $request->input('price')
        ) {
            session()->flash('error', 'Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }

        if ($request->input('price_sale') != 0 && (int)$request->input('price') == 0) {
            session()->flash('error', 'Vui lòng nhập giá gốc');
            return false;
        }

        return  true;
    }
    public function insert($request)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;

        try {
            $request->except('_token');
            Procduct::create($request->all());
            session()->flash('success', 'Thêm Sản phẩm thành công');
        } catch (\Exception $err) {
            session()->flash('error', 'Thêm Sản phẩm lỗi');
            \Log::info($err->getMessage());
            return  false;
        }
        return  true;
    }
    public function get(){
        return Product::with('category')
        ->orderByDesc('id')->simplePaginate(8);
    }/*with là liên kết vs function bên model product */
    public function update($request, $product)
    {
        $isValidPrice = $this->isValidPrice($request);
        if ($isValidPrice === false) return false;
        try {
            $product->fill($request->input());
            $product->save();
            session()->flash('success', 'Cập Nhật Sản phẩm thành công');
        } catch (\Exception $err) {
            session()->flash('error', 'Cập Nhật Sản phẩm lỗi');
            \Log::info($err->getMessage());
            return  false;
        }
        return  true;
    }
    public function destroy($request)
    
    {
        $product= Product::where('id',$request->input('id'))->first();
        if($product){
            $product->delete();
            return true;
        }else{
            return false;
        }
    }

    
}