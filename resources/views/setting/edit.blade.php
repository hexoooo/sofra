@inject('setting', 'App\Models\setting')
@extends('layout')
@section('title')
   edit  setting
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
            <h1> edit  settings here</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/main">Home</a></li>
              <li class="breadcrumb-item active"> edit  settings</li>
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
          <h3 class="card-title">edit setting</h3>
        </div>
        <div class="card-body">
            <form action={{url(route('settings.update',$id))}} method="post">
              <input type="hidden" name="_method" value="put">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">about app</label>
                    <input type="text" class="form-control" name="about" placeholder="{{$setting->where('id',$id)->first()->about_app}}">
                    <label for="exampleInputEmail1">app commission</label>
                    <input type="text" class="form-control" name="commission" placeholder="{{$setting->where('id',$id)->first()->app_commission}}">
                    <button type='submit'>submit</button>
                    
                </div>
               
              </form>
      
        </div>

        <!-- /.card-body -->
        <div class="card-footer">
            <a href={{url(route('settings.index'))}} class="btn btn-primary">go back to settings</a> 
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
