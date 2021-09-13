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
              <form role="form" method="post" action="{{url('admin/users/'.$dt->id)}}">
                @csrf
                {{method_field('PUT')}}

               <div class="row">
                 <div class="col-md-6">
                  <small style="color: red;"><b><i>** password default : 123</i></b></small>
                    <div class="box-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Nama</label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Name" required="" value="{{$dt->name}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" required="" value="{{$dt->email}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputFile">Role</label>
                        <select class="form-control select2" name="role_id">
                          @foreach($roles as $rl)
                          <option value="{{$rl->id}}" {{($dt->role_id == $rl->id) ? 'selected' : ''}}>{{$rl->nama}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <!-- /.box-body -->
       
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                 </div>

                 <div class="col-md-6">
                  <small style="color: red;"><b><i>-</i></b></small>
                    <div class="box-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">No Wa Aktif <small style="color: red;"><b><i>Digunakan utk mengirim notifikasi</i></b></small> </label>
                        <input type="text" name="no_telp" class="form-control" id="exampleInputEmail1" placeholder="Name" required="" value="{{$dt->no_telp}}">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Jenis Kelamin <small style="color: red;"><b><i>Digunakan untuk email login</i></b></small> </label>
                        <select class="form-control select2" name="jenis_kelamin" required="">
                          <option value="p" {{($dt->jenis_kelamin == 'p') ? 'selected' : ''}}>Pria</option>
                          <option value="w" {{($dt->jenis_kelamin == 'w') ? 'selected' : ''}}>Wanita</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputFile">Alamat</label>
                        <textarea class="form-control" rows="5" name="alamat">{{$dt->alamat}}</textarea>
                      </div>
                    </div>
                    <!-- /.box-body -->
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