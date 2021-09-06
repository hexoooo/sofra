@inject('permission', 'Spatie\Permission\Models\permission')
@extends('layout')
@section('title')
   edit permission
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
            <h1> edit new permissions here</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/main">Home</a></li>
              <li class="breadcrumb-item active"> edit new permissions</li>
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
          <h3 class="card-title">edit permission</h3>
        </div>
        <div class="card-body">
            <form action={{url(route('permissions.update',$id))}} method="post">
              <input value='put' type='hidden' name="_method" />
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">permission name</label>
                    <input type="text" class="form-control" name="newName" placeholder="{{$permission->where('id',$id)->first()->name}}">
                    <button type='submit'>submit</button>
                    
                </div>
               
              </form>
      
        </div>

        <!-- /.card-body -->
        <div class="card-footer">
            <a href={{url(route('permissions.index'))}} class="btn btn-primary">go back to permissions</a> 
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
