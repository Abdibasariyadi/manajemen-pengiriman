@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                </p>
            </div>
            <div class="box-body">
               <div class="row">
                   <div class="col-md-8 col-md-offset-2">
                       <form role="form" method="post" action="{{url('admin/permissions')}}">
                            @csrf
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Title</label>
                              <input type="text" name="title" class="form-control" id="exampleInputEmail1" placeholder="Title">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Keterangan</label>
                              <input type="text" name="keterangan" class="form-control" id="exampleInputPassword1" placeholder="Keterangan">
                            </div>
                          </div>
                          <!-- /.box-body -->
             
                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </form>

                   </div>
               </div>

               <div class="row">
                   <div class="col-md-8 col-md-offset-2">
                       <div class="table-responsive">
                           <table class="table">
                               <thead>
                                   <tr>
                                       <th>Keterangan</th>
                                       <th>Title</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   @foreach($data as $dt)
                                   <tr>
                                       <td>{{$dt->keterangan}}</td>
                                       <td>{{$dt->title}}</td>
                                   </tr>
                                   @endforeach
                               </tbody>
                           </table>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
</div>
 
@endsection
 
@section('scripts')
 
<script type="text/javascript">
    $(document).ready(function(){
 
        // btn refresh
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })
 
    })
</script>
 
@endsection