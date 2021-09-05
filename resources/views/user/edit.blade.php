@inject('user', 'App\Models\user')
@extends('layout')
@section('title')
   edit user
@endsection
@section('PageName')
    edit users
@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> edit users here</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/main">Home</a></li>
              <li class="breadcrumb-item active"> edit users</li>
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
          <h3 class="card-title">edit user</h3>
        </div>
        <div class="card-body">
            <form action={{url(route('users.update',$id))}} method="post">
              <input type="hidden" name='_method' value='put'/>
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">user name</label>
                    <input type="text" class="form-control" name="name" placeholder="{{$user->where('id',$id)->first()->name}}">
                
                    <label for="exampleInputEmail1">user email</label>
                    <input type="text" class="form-control" name="email" placeholder="{{$user->where('id',$id)->first()->email}}">
                    <label for="exampleInputEmail1">old password</label>
                    <input type="password" class="form-control" name="oldPassword" placeholder="password">
                    <label for="exampleInputEmail1">new password</label>
                    <input type="password" class="form-control" name="password" placeholder="password">
                    <div class="form-group">
                      <label>Select role</label>
                      <select class="form-control" name='role'>
                        {{-- @foreach($role as $r)
                        @php 
                        echo "<option value='$r->name'> $r->name </option>"
                        @endphp
                        @endforeach --}}

                      </select>
                    </div>
                  </div>
                    <button type='submit'>submit</button>
                    
                </div>
               
              </form>
      
        </div>

        <!-- /.card-body -->
        <div class="card-footer">
            <a href={{url(route('users.index'))}} class="btn btn-primary">go back to users</a> 
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
