
@extends('layout')
@section('title')
    restaurants
@endsection
@section('PageName')
    restaurants
@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>search restaurants here</h1>
            <form action="{{route('restaurants.index',)}}">
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
              <li class="breadcrumb-item active"> restaurants</li>
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
          <h3 class="card-title">restaurants</h3>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row"><th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">restaurants</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">id</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">phone</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">delete</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">activation</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">show</th>
                </thead>
                <tbody>
            @foreach ($restaurants as $restaurant)
        
                <tr class="odd">
                  <td>  
                   
                     {{$restaurant->name;}}
            
                  </td>
                  <td>  
                  
                    {{$restaurant->id;}}
                   
                    </td>
                    <td>
                    
                    {{$restaurant->phone;}}
              
                    </td>
                  <td>  
                    <form method='post' action='{{url(route('restaurants.destroy',$restaurant->id))}}'>
                      @csrf
                      <input type="hidden" name='_method' value='delete' />
                    <button type='submit' class="btn btn-primary">delete num {{$restaurant->id}}</button>
                    </form>  
                  </td>
                 
                  @if ($restaurant->active)
              

                  <td>
                    <a method="post" href="/restaurants/{{$restaurant->id}}/edit" class="btn btn-danger">deactivate</a>
                </td>
               
                @else
                 
                

                  <td>
                    <a method="post" href="/restaurants/{{$restaurant->id}}/edit" class="btn btn-info">activate</a>
               </td>
                
                  @endif
                  <td>
                    <a method="post" href="/restaurants/{{$restaurant->id}}" class="btn btn-info">show</a>
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
