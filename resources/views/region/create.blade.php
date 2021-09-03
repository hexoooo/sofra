@extends('layout')
@section('title')
   ceate new region
@endsection
@section('PageName')
    create regions
@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> create new regions here</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/main">Home</a></li>
              <li class="breadcrumb-item active"> create new regions</li>
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
          <h3 class="card-title">new region</h3>
        </div>
        <div class="card-body">
          <form action={{url(route('regions.store'))}} method="post">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">region name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter name">
                    <div class="form-group">
                      <label>Select related city</label>
                      <select name='id' class="form-control">
                        @foreach ($cities as $city)
                          <option> {{$city->name}} </option>
                        @endforeach
                      </select>
                    </div>
                    <button type='submit'>submit</button>
                    
                </div>
               
              </form>
      
        </div>

        <!-- /.card-body -->
        <div class="card-footer">
            <a href={{url(route('regions.index'))}} class="btn btn-primary">go back to regions</a> 
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
