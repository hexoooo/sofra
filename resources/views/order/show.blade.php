
@extends('layout')
@section('title')
    orders
@endsection
@section('PageName')
    orders
@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>search orders here</h1>
            <form action="{{route('orders.index',)}}">
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">search by name</label>
                  <input type="text" name='name' class="form-control" id="exampleInputEmail1" placeholder="name">
                </div>
 

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/main">Home</a></li>
              <li class="breadcrumb-item active"> orders</li>
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
          <h3 class="card-title">orders</h3>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row"><th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">client name</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">id</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">phone</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">status</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">delivery charge</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">total price</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">commission</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">product info</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">order price</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">address</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">delete</th>
                </thead>
                <tbody>
            @foreach ($orders as $order)
        
                <tr class="odd">
                  <td>  
                   
                     {{$order->client_name;}}
            
                  </td>
                  <td>  
                  
                    {{$order->id;}}
                   
                    </td>
                    <td>
                    
                    {{$order->phone;}}
              
                    </td>
                    <td>
    
                    {{$order->status;}}
  
                    </td>
                    <td>
    
                    {{$order->delivery_charge;}}
  
                    </td>
                    <td>
    
                    {{$order->total_price;}}
  
                    </td>
                    <td>
    
                    {{$order->commission;}}
  
                    </td>
                    <td>
                      @foreach ($order->products as $product)
                          {{' || product : ' . $product->name}}
                          {{' || price : ' . $product->price}}
                      @endforeach
                  
                    </td>
                    <td>
    
                    {{$order->order_price;}}
  
                    </td>
                    <td>
                 
                    {{$order->address}}
                  
                    </td>
                  <td>  
                    <form method='post' action='{{url(route('orders.destroy',$order->id))}}'>
                      @csrf
                      <input type="hidden" name='_method' value='delete' />
                    <button type='submit' class="btn btn-primary">delete num {{$order->id}}</button>
                    </form>  
                  </td>
                 
                </tr>
      
          @endforeach
        </tbody>
        <div class="card-footer">
            <a href={{url(route('orders.index'))}} class="btn btn-primary">go back to orders</a> 
        </div>
        <tfoot>
        </tfoot>
      </table>
      
        </div>

        <!-- /.card-body -->
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
