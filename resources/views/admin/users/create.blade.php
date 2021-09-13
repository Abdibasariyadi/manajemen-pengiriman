@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>

                    <a href="{{url('admin/users')}}" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-backward"></i> Kembali</a>
                </p>
            </div>
            <div class="box-body">
               <form role="form" method="post" action="{{url('admin/users/create')}}">
                @csrf
               <div class="row">

                 <div class="col-md-6 col-xs-12">
                  <small style="color: red;"><b><i>** password default : 123</i></b></small>
                    <div class="box-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Name" required="">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address <small style="color: red;"><b><i>Digunakan untuk email login</i></b></small> </label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" required="">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputFile">Role</label>
                        <select class="form-control select2" name="role_id" required="">
                          @foreach($roles as $rl)
                          <option value="{{$rl->id}}">{{$rl->nama}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <!-- /.box-body -->
                 </div>

                 <div class="col-md-6 col-xs-12">
                  <small style="color: red;"><b><i>-</i></b></small>
                    <div class="box-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">No Wa Aktif <small style="color: red;"><b><i>Digunakan utk mengirim notifikasi</i></b></small> </label>
                        <input type="text" name="no_telp" class="form-control" id="exampleInputEmail1" placeholder="Name" required="">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Jenis Kelamin <small style="color: red;"><b><i>Digunakan untuk email login</i></b></small> </label>
                        <select class="form-control select2" name="jenis_kelamin" required="">
                          <option value="p">Pria</option>
                          <option value="w">Wanita</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputFile">Alamat</label>
                        <textarea class="form-control" rows="5" name="alamat"></textarea>
                      </div>
                    </div>
                    <!-- /.box-body -->
                 </div>


       
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

               </div>
              </form>
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
        });
 
    })
</script>
 
@endsection