
@extends('layout')
@section('title')
    clients
@endsection
@section('PageName')
    clients
@endsection
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>search clients here</h1>
            <form action="{{route('clients.index',)}}">
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
              <li class="breadcrumb-item active"> clients</li>
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
          <h3 class="card-title">clients</h3>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                <thead>
                <tr role="row"><th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">clients</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">id</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">phone</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">email</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">region</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">delete</th><th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">activation</th>
                </thead>
                <tbody>
            @foreach ($clients as $c)
        
                <tr class="odd">
                  <td>  
                   
                     {{$c->name;}}
            
                  </td>
                  <td>  
                  
                    {{$c->id;}}
                   
                    </td>
                    <td>
                    
                    {{$c->phone;}}
              
                    </td>
                    <td>
    
                    {{$c->email;}}
  
                    </td>
                    <td>
                 
                    {{$c->region()->first()->name}}
                  
                    </td>
                  <td>  
                    <form method='post' action='{{url(route('clients.destroy',$c->id))}}'>
                      @csrf
                      <input type="hidden" name='_method' value='delete' />
                    <button type='submit' class="btn btn-primary">delete num {{$c->id}}</button>
                    </form>  
                  </td>
                 
                  @if ($c->active)
              

                  <td>
                    <a method="post" href="/clients/{{$c->id}}/edit" class="btn btn-danger">deactivate</a>
                </td>
               
                @else
                 
                

                  <td>
                    <a method="post" href="/clients/{{$c->id}}/edit" class="btn btn-info">activate</a>
               </td>
                
                  @endif
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
