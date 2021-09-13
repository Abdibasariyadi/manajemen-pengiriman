@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>

                    <a href="{{url('paket-laundry')}}" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-backward"></i> Kembali</a>
                </p>
            </div>
            <div class="box-body">
               <div class="row">
                   <form method="post" action="{{url('paket-laundry/'.$dt->id)}}">
                      @csrf
                      {{method_field('PUT')}}
                     <div class="col-md-6">

                       <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nama Paket</label>
                          <input type="text" name="nama" class="form-control" id="exampleInputEmail1" placeholder="Nama Paket" required="" value="{{$dt->nama}}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Harga Per Satuan</label>
                          <input type="number" name="harga" class="form-control" id="exampleInputPassword1" placeholder="Harga" required="" value="{{$dt->harga}}">
                        </div>

                        <div class="form-group">
                          <label for="exampleInputPassword1">Pilih Satuan</label>
                          <select class="form-control" name="satuan_id" required="">
                            <option selected="" disabled="">Pilih Satuan</option>
                            @foreach($satuans as $st)
                            <option value="{{$st->id}}" {{ ($dt->satuan_id == $st->id) ? 'selected' : '' }}>{{$st->nama}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>

                     </div>
                     <div class="col-md-6">
                         <div class="box-body">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Estimasi Pengerjaan (*hari)</label>
                            <input type="number" name="estimasi_pengerjaan" class="form-control" id="exampleInputEmail1" placeholder="Estimasi Pengerjaan" required="" value="{{$dt->estimasi_pengerjaan}}">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan</label>
                            <textarea class="form-control" rows="5" name="keterangan">{{$dt->keterangan}}</textarea>
                          </div>
                        </div>
                        <!-- /.box-body -->
           
                        <div class="box-footer">
                          <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                     </div>
                   </form>
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