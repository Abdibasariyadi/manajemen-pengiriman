@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>

                    <a href="{{url('pengiriman')}}" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-backward"></i> Kembali</a>
                </p>
            </div>
            <div class="box-body">
               <div class="row">
                <form action="{{ route('store.pengiriman') }}" method="POST">
                      @csrf
                     <div class="col-md-6">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="cabang_id" value="1">
                       <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nama Penerima</label>
                          <input type="text" name="nama_penerima" class="form-control" id="exampleInputEmail1" placeholder="Nama Penerima" onkeyup="this.value = this.value.toUpperCase()" value="{{ $dt->nama_penerima }}">
                            @error('nama_penerima')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>

                        <div class="form-group">
                          <label for="exampleInputPassword1">Alamat</label>
                          <textarea class="form-control" rows="3" name="alamat" onkeyup="this.value = this.value.toUpperCase()">{{ $dt->alamat }}</textarea>
                          @error('alamat')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No HP</label>
                            <input type="text" name="no_hp" class="form-control" id="exampleInputEmail1" placeholder="No HP" value="{{ $dt->no_hp }}">
                            @error('no_hp')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Pengirim</label>
                            <input type="text" name="pengirim" class="form-control" id="exampleInputEmail1" placeholder="Pengirim" onkeyup="this.value = this.value.toUpperCase()" value="{{ $dt->pengirim }}">
                            @error('pengirim')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Penjemputan</label>
                            <input type="text" name="penjemputan" class="form-control" id="exampleInputEmail1" placeholder="Penjemputan" onkeyup="this.value = this.value.toUpperCase()" value="{{ $dt->penjemputan }}">
                            @error('penjemputan')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                          <label for="exampleInputPassword1">Pilih Satuan</label>
                          <select class="form-control" name="satuan_id">
                            <option selected="" disabled="">Pilih Satuan</option>
                            @foreach($data as $st)
                            <option value="{{$st->id}}">{{$st->nama}}</option>
                            @endforeach
                          </select>
                        </div> --}}
                      </div>

                     </div>
                     <div class="col-md-6">
                         <div class="box-body">
                          <div class="form-group">
                            <label for="exampleInputEmail1">Driver</label>
                            <input type="text" name="driver" class="form-control" id="exampleInputEmail1" placeholder="Driver" onkeyup="this.value = this.value.toUpperCase()" value="{{ $dt->driver }}">
                            @error('driver')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Dana Talangan</label>
                            <input type="number" name="dana_talangan" class="form-control" id="exampleInputEmail1" placeholder="Dana Talangan" value="{{ $dt->dana_talangan }}">
                            @error('dana_talangan')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Ongkir</label>
                            <input type="number" name="ongkir" class="form-control" id="exampleInputEmail1" placeholder="Ongkir" value="{{ $dt->ongkir }}">
                            @error('ongkir')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Total Tagihan</label>
                            <input type="number" name="total_tagihan" class="form-control" id="exampleInputEmail1" placeholder="Total Tagihan" value="{{ $dt->total_tagihan }}">
                            @error('total_tagihan')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan</label>
                            <textarea type="number" name="keterangan" class="form-control" id="exampleInputEmail1" placeholder="Keterangan" onkeyup="this.value = this.value.toUpperCase()">{{ $dt->keterangan }}</textarea>
                            @error('keterangan')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                          </div>
                          {{-- <div class="form-group">
                            <label for="exampleInputPassword1">Upload</label>
                            <input type="file" accept="image/*" capture="camera">
                          </div> --}}
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                          <button type="submit" class="btn btn-primary">Submit</button>
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
