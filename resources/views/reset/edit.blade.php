{{-- @inject('info', 'App\Models\ContactInfo') --}}
@extends('layout')
@section('title')
   create new password
@endsection
@section('PageName')
    create
@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> create new passwords here</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/main">Home</a></li>
              <li class="breadcrumb-item active"> create new passwords</li>
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
          <h3 class="card-title">edit password</h3>
        </div>
        <div class="card-body">
            <form action={{route('reset.update',16)}} method="post">
              <input type="hidden" name="_method" value="put" />
                @csrf
                <div class="card-body">
                  <div class="form-group">

                    <label for="exampleInputEmail1">new pass word</label>
                    <input type="text" class="form-control" name="new_password" placeholder="new password">
                    <label for="exampleInputEmail1">old password</label>
                    <input type="text" class="form-control" name="old_password" placeholder="old password">
                    <button type='submit'>submit</button>
                    
                </div>
               
              </form>
      
        </div>

        <!-- /.card-body -->
        <div class="card-footer">
            <a href={{url(route('reset.index'))}} class="btn btn-primary">go back to passwords</a> 
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
