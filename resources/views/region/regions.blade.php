@extends('layout')
@section('title')
    regions
@endsection
@section('PageName')
    regions
@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>regions are here</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/main">Home</a></li>
              <li class="breadcrumb-item active"> regions</li>
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
          <h3 class="card-title">regions</h3>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row"><th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">region</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">id</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">city</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">edit</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">delete</th>
                </thead>
                <tbody>
            @foreach ($regions as $region)
        
                <tr class="odd">
                  <td>  
                
                  {{ $region->name;}}
         
                  </td>
                  <td>  
                    
                    {{$region->id;}}
                 
                  </td>
                  <td>  
                    @foreach ($cities as $city)
                        
                          @if ($city->id==$region->city_id) 
                           {{$city->name}}
                           @endif
                        
                    @endforeach  
                  </td>
                  <td>  
                    <a href={{url(route('regions.edit',$region->id))}} class="btn btn-primary">edit num {{$region->id}}</a>
                  </td>
                  <td>  

                    <form method='post' action='{{url(route('regions.destroy',$region->id))}}'>
                      @csrf
                      <input type="hidden" name='_method' value='delete' />
                    <button type='submit' class="btn btn-primary">delete num {{$region->id}}</button>
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
            <a href={{url(route('regions.create'))}} class="btn btn-primary">add region</a> 
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
