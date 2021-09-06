@inject('role', 'Spatie\Permission\Models\Role')
@extends('layout')
@section('title')
   edit role
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
            <h1> edit new roles here</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/main">Home</a></li>
              <li class="breadcrumb-item active"> edit new roles</li>
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
          <h3 class="card-title">edit role</h3>
        </div>
        <div class="card-body">
            <form action={{url(route('roles.update',$id))}} method="post">
              <input value='put' type='hidden' name="_method" />
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">role name</label>
                    <input type="text" class="form-control" name="newName" placeholder="{{$role->where('id',$id)->first()->name}}">
                    <div class="form-group">
                      <label>Select role</label>
                      <select multiple class="form-control" name='permission[]'>
                        @foreach($permission as $p)
                        @php 
                        echo "<option value='$p->name'> $p->name </option>"
                        @endphp
                        @endforeach

                      </select>
                    </div>
                  </div>
                    <button type='submit'>submit</button>
                    
                </div>
               
              </form>
      
        </div>

        <!-- /.card-body -->
        <div class="card-footer">
            <a href={{url(route('roles.index'))}} class="btn btn-primary">go back to roles</a> 
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
