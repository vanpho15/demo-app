@extends('admin.main')
@section('head')
<script src="/ckeditor/ckeditor.js"></script>
@endsection
@section('content')
@include('admin.content-header', ['name'=>'Category', 'key'=>'Edit'])
<div class="row container-fluid">
    <div class="col-md-12 ">
    <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Sửa Danh Mục</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="danhmuc">Tên Danh mục</label>
                    <input type="text" class="form-control"  placeholder="Nhập Tên Danh Mục"name="name" value="{{$category->name}}">
                  </div>
                  <div class="form-group">
                <label class="form-label danhmuc">Chọn Danh Mục Cha</label>
                    <select class="form-control" name="parent_id">
                        <option value="0" {{ $category->parent_id==0? 'selected':''}} >Chọn danh mục cha</option>
                        @foreach($categories as $danhmuccha)
                        <option value="{{$danhmuccha->id}}" 
                        {{ $category->parent_id==$danhmuccha->id? 'selected':''}} >
                        {{$danhmuccha->name}}</option>
                        @endforeach
                    </select>
                </div>
                  <div class="form-group">
                    <label for="danhmuc">Mô Tả</label>
                    <textarea class="form-control" name="description" value="{{$category->description}}"></textarea>
                  </div>
                  <div class="form-group">
                    <label for="danhmuc">Mô Tả Chi Tiết</label>
                    <textarea class="form-control" id="content" name="content" value="{{$category->content}}"></textarea>
                  </div>
                  <div class="form-group">
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="active" name="active" {{$category->active==1?'checked=""': ''}} value="1">
                          <label for="active" class="custom-control-label">Có</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="no_active" name="active" {{$category->active==0?'checked=""': ''}} value="0" >
                          <label for="no_active" class="custom-control-label">Không</label>
                        </div>
                      </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Cập Nhật Danh Mục</button>
                </div>
              </form>
            </div>
    </div>
</div>


@endsection
@section('footer')
<script>
CKEDITOR.replace( 'content' );
</script>
@endsection