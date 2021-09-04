@extends('layout')
@section('content')
@inject('clients', 'App\Models\client')
@inject('restaurants', 'App\Models\Restaurant')
@inject('regions', 'App\Models\Region')
@inject('cities', 'App\Models\City')
@inject('categories', 'App\Models\category')
@inject('payments', 'App\Models\Payment')
@inject('offers', 'App\Models\offer')
@inject('Contacts', 'App\Models\ContactUs')
@inject('settings', 'App\Models\Setting')
@inject('orders', 'App\Models\Order')
{{-- 
@inject('users', 'App\Models\user')closed
@inject('permissions', 'Spatie\Permission\Models\permission') closed--}}

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="container-fluid">
        <h5 class="mb-2">Info Box</h5>
        <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fas fa-users"></i></span>
    
            <div class="info-box-content">
              <span class="info-box-text"><a href="/clients">clients</a></span>
              <span class="info-box-number">{{$clients->count()}}</span>
            </div>

            <!-- /.info-box-content -->
          </div>
          
          <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fas fa-bullhorn"></i></span>
    
            <div class="info-box-content">
              <span class="info-box-text"><a href="/payments">payments</a></span>
              <span class="info-box-number">{{$payments->count()}}</span>
            </div>
            

            <!-- /.info-box-content -->
          </div>
         
          <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fas fa-door-open"></i></span>
    
            <div class="info-box-content">
              <span class="info-box-text"><a href='/offers'>offers</a></span>
              <span class="info-box-number">{{$offers->count()}}</span>
            </div>
            

            <!-- /.info-box-content -->
          </div>
          <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fas fa-door-open"></i></span>
    
            <div class="info-box-content">
              <span class="info-box-text"><a href='/orders'>orders</a></span>
              <span class="info-box-number">{{$orders->count()}}</span>
            </div>
            

            <!-- /.info-box-content -->
          </div>
          
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="far fa-flag"></i></span>
    
            <div class="info-box-content">
              <span class="info-box-text"><a href="/cities">cities</a></span>
              <span class="info-box-number">{{$cities->count()}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="fas fa-tint"></i></span>
    
            <div class="info-box-content">
              <span class="info-box-text"><a href="/restaurants">restaurants</a></span>
              <span class="info-box-number">{{$restaurants->count()}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>

          <div class="info-box">
            <span class="info-box-icon bg-danger"><i class="fas fa-lock"></i></i></span>
    
            <div class="info-box-content">
              {{-- <span class="info-box-text"><a href='/permissions'>permissions</a></span>
              <span class="info-box-number">{{$permissions->count()}}</span> --}}
            </div>
            <!-- /.info-box-content -->
          </div>
   
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-info"><i class="far fa-copy"></i></span>
    
            <div class="info-box-content">
              <span class="info-box-text"><a href="regions">regions</a></span>
              <span class="info-box-number">{{$regions->count()}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fas fa-envelope"></i></span>
    
            <div class="info-box-content">
              <span class="info-box-text"><a href="/contacts">contacts</a></span>
              <span class="info-box-number">{{$Contacts->count()}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          {{-- to do num 3 --}}
          <div class="info-box">
            <span class="info-box-icon bg-info"><i class="far fa-user-circle"></i></span>
    
            <div class="info-box-content">
              {{-- <span class="info-box-text"><a href='/users'>users</a></span>
              <span class="info-box-number">{{$users->count()}}</span> --}}
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
          <div class="info-box">
            <span class="info-box-icon bg-success"><i class="far fa-star"></i></span>
    
            <div class="info-box-content">
              <span class="info-box-text"><a href="categories">categories</a></span>
              <span class="info-box-number">{{$categories->count()}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <div class="info-box">
            <span class="info-box-icon bg-success"><i class="fas fa-asterisk"></i></span>
    
            <div class="info-box-content">
              <span class="info-box-text"><a href="reset">reset password</a></span>
  
            </div>
            <!-- /.info-box-content -->
          </div>
          <div class="info-box">
            <span class="info-box-icon bg-success"><i class="fas fa-user-cog"></i></span>
    
            <div class="info-box-content">
              <span class="info-box-text"><a href="/settings">settings</a></span>
              <span class="info-box-number">{{$settings->count()}}</span>
  
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-12">


    
       
            <!-- /.info-box-content -->
         
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
    </div>
    <!-- Content Header (Page header) -->
    {{-- <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>info is here</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active"> Dashboard</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    <fcatection>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">all you need is here</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
         here is the place that you can find every thing
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content --> --}}
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    {{-- <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.1.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer> --}}

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@endsection