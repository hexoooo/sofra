@extends('layout')
@section('title')
   ceate new payment
@endsection
@section('PageName')
    create payments
@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> create new payments here</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/main">Home</a></li>
              <li class="breadcrumb-item active"> create new payments</li>
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
          <h3 class="card-title">new payment</h3>
        </div>
        <div class="card-body">
          <form action={{url(route('payments.store'))}} method="post">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">payed</label>
                    <input type="text" class="form-control" name="payed" placeholder="Enter value">
                    <label for="exampleInputEmail1">notes</label>
                    <input type="text" class="form-control" name="notes" placeholder="Enter notes">
                    <label for="exampleInputEmail1">date</label>
                    <input type="text" class="form-control" name="date" placeholder="Enter date">
                    <div class="form-group">
                      <label>Select related restaurant</label>
                      <select name='restaurant' class="form-control">
                        @foreach ($restaurants as $restaurant)
                          <option> {{$restaurant->name}} </option>
                        @endforeach
                      </select>
                    </div>
                    <button type='submit'>submit</button>
                    
                </div>
               
              </form>
      
        </div>

        <!-- /.card-body -->
        <div class="card-footer">
            <a href={{url(route('payments.index'))}} class="btn btn-primary">go back to payments</a> 
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
