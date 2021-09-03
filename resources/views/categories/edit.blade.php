@inject('category', 'App\Models\category')
@extends('layout')
@section('title')
   edit new category
@endsection
@section('PageName')
    edit
@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> edit new categories here</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/main">Home</a></li>
              <li class="breadcrumb-item active"> edit new categories</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">edit category</h3>
        </div>
        <div class="card-body">
            <form action={{url(route('categories.update',$id))}} method="post">
              <input type="hidden" name="_method" value="put">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">category name</label>
                    <input type="text" class="form-control" name="newName" placeholder="{{$category->where('id',$id)->first()->name}}">
                    <button type='submit'>submit</button>
                    
                </div>
               
              </form>
      
        </div>

        <!-- /.card-body -->
        <div class="card-footer">
            <a href={{url(route('categories.index'))}} class="btn btn-primary">go back to categories</a> 
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@endsection
