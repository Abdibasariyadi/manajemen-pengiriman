@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>

                    <a href="{{ url('admin/supplier') }}" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-backward"></i> Kembali</a>
                </p>
            </div>
            <div class="box-body">
               <center>
                   <p style="color: red;">
                       <b><i>Yang Memiliki Tanda (**) Wajib Diisi</i></b>
                   </p>
               </center>
               <form method="post" action="{{ url('admin/supplier/'.$dt->id) }}">
                @csrf
                {{method_field('PUT')}}
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                        
                          <div class="box-body">

                            <div class="form-group">
                              <label for="exampleInputEmail1">Nama <small style="color: red;">**</small></label>
                              <input type="text" name="nama" class="form-control" id="exampleInputEmail1" placeholder="Nama" required="" value="{{$dt->nama}}">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Company Name <small style="color: red;">**</small></label>
                              <input type="text" name="company_name" class="form-control" id="exampleInputEmail1" placeholder="Company Name" required="" value="{{$dt->company_name}}">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">No NPWP</label>
                              <input type="text" name="no_npwp" class="form-control" id="exampleInputEmail1" placeholder="No NPWP" value="{{$dt->no_npwp}}">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">No Telp</label>
                              <input type="text" name="no_telp" class="form-control" id="exampleInputEmail1" placeholder="No Telp" value="{{$dt->no_telp}}">
                            </div>

                            <div class="form-group">
                              <label for="exampleInputEmail1">Status <small style="color: red;">**</small></label>
                              <select class="form-control" name="is_active">
                                  <option value="1" {{ ($dt->is_active == 1) ? 'selected' : '' }}>Aktif</option>
                                  <option value="2" {{ ($dt->is_active != 1) ? 'selected' : '' }}>Tidak Aktif</option>
                              </select>
                            </div>

                          </div>
                          <!-- /.box-body -->

                        </div>

                        <div class="col-md-6 col-xs-12">
                            <div class="box-body">

                                <div class="form-group">
                                  <label for="exampleInputEmail1">Email</label>
                                  <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" value="{{$dt->email}}">
                                </div>

                                <div class="form-group">
                                  <label for="exampleInputEmail1">Kota</label>
                                  <input type="text" name="kota" class="form-control" id="exampleInputEmail1" placeholder="Kota" value="{{$dt->kota}}">
                                </div>

                                <div class="form-group">
                                  <label for="exampleInputEmail1">Provinsi</label>
                                  <input type="text" name="provinsi" class="form-control" id="exampleInputEmail1" placeholder="Provinsi" value="{{$dt->provinsi}}">
                                </div>

                                <div class="form-group">
                                  <label for="exampleInputEmail1">Kode Pos</label>
                                  <input type="text" name="kode_pos" class="form-control" id="exampleInputEmail1" placeholder="Kode Pos" value="{{$dt->kode_pos}}">
                                </div>

                                <div class="form-group">
                                  <label for="exampleInputEmail1">Alamat Lengkap</label>
                                  <textarea class="form-control" name="alamat_lengkap" rows="5">{{ $dt->alamat_lengkap }}</textarea>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-xs-12">
                            <button class="btn btn-primary btn-block" type="submit">Update</button>
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
        })
 
    })
</script>
 
@endsection