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
                       <form role="form" method="post" action="{{url('wa-template')}}">
                            @csrf
                            {{method_field('PUT')}}
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Token</label>
                              <input type="text" name="token" value="{{$dt->token}}" class="form-control" required="" placeholder="Token">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Base Url Server</label>
                              <input type="text" name="base_url" value="{{$dt->base_url}}" class="form-control" required="" placeholder="Base Url Server">
                            </div>

                            <!-- <div class="form-group">
                              <label for="exampleInputEmail1">Template Create Transaksi</label>
                              <textarea class="form-control summernote" name="template_create_transaksi">{{$dt->template_create_transaksi}}</textarea>
                            </div> -->
                          </div>
                          <!-- /.box-body -->
             
                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </form>
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
