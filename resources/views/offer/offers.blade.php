@extends('layout')
@section('title')
    offers
@endsection
@section('PageName')
    offers
@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>search offers here</h1>
            <form action="{{route('offers.index',)}}">
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
              <li class="breadcrumb-item active"> offers</li>
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
          <h3 class="card-title">offers</h3>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row"><th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">offers</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">id</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">info</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">start</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">end</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">restaurant</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">delete</th>
                </thead>
                <tbody>
            @foreach ($offers as $offer)
        
                <tr class="odd">
                  <td>  
                   
                     {{$offer->name;}}
            
                  </td>
                  <td>  
                  
                    {{$offer->id;}}
                   
                    </td>
                    <td>
                    
                    {{$offer->info;}}
              
                    </td>
                    <td>
    
                    {{$offer->start_date;}}
  
                    </td>
                    <td>
                 
                    {{$offer->end_date;}}
                  
                    </td>
                    <td>
                 
                    {{$offer->restaurant()->first()->name;}}
                  
                    </td>
                  <td>  
                    <form method='post' action='{{url(route('offers.destroy',$offer->id))}}'>
                      @csrf
                      <input type="hidden" name='_method' value='delete' />
                    <button type='submit' class="btn btn-primary">delete num {{$offer->id}}</button>
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
