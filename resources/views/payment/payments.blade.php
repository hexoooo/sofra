@extends('layout')
@section('title')
    payments
@endsection
@section('PageName')
    payments
@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>search payments here</h1>
            <form action="{{route('payments.index',)}}">
              <div class="card-body">
                <div class="form-group">
                  <label>restaurants</label>
                  <select class="form-control select2 select2-hidden-accessible" name='name' style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    <option selected="selected" data-select2-id="3">select restaurant</option>
                    @foreach ($restaurants as $restaurant)     
                    <option data-select2-id="30" >{{$restaurant->name}}</option>
                    @endforeach
                  </select>
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
              <li class="breadcrumb-item active"> payments</li>
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
          <h3 class="card-title">payments</h3>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row"><th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">payed</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">notes</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">date</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">restaurant</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">edit</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">delete</th>
                </thead>
                <tbody>
            @foreach ($payments as $payment)
        
                <tr class="odd">
                  <td>  
                
                  {{ $payment->payed;}}
         
                  </td>
                  <td>  
                    
                    {{$payment->notes;}}
                 
                  </td>
                  <td>  
                    
                    {{$payment->date;}}
                 
                  </td>
                  <td>  
                    {{$payment->restaurant->name}}
                  </td>
                  <td>  
                    <a href={{url(route('payments.edit',$payment->id))}} class="btn btn-primary">edit num {{$payment->id}}</a>
                  </td>
                  <td>  

                    <form method='post' action='{{url(route('payments.destroy',$payment->id))}}'>
                      @csrf
                      <input type="hidden" name='_method' value='delete' />
                    <button type='submit' class="btn btn-primary">delete num {{$payment->id}}</button>
                    </form> 
                  </td>
                </tr>
      
          @endforeach
        </tbody>
        <tfoot>
        </tfoot>
      </table>
      
        </div>

        <!-- /.card-body -->
        <div class="card-footer">
            <a href={{url(route('payments.create'))}} class="btn btn-primary">add payment</a> 
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
