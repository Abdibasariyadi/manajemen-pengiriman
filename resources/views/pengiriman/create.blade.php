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
                            <label for="exampleInputFile">Masukan ID Orderan</label>
                            <select class="form-control select2" name="penjemputan_id" id="penjemputan_id" style="width: 100%;">
                                @foreach ($penjemputan_id as $p)
                                    <option value="{{$p->id}}">{{'KUY000'.$p->id}}</option>
                                @endforeach
                                {{-- <option value="{{$penjemputan_id->id}}">{{$penjemputan_id->nama_penerima}}</option> --}}
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail1">Nama Penerima</label>
                          <input type="text" name="nama_penerima" id="nama_penerima" class="form-control" id="exampleInputEmail1" placeholder="Nama Penerima" onkeyup="this.value = this.value.toUpperCase()">
                            @error('nama_penerima')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Driver</label>
                            <input type="text" name="driver" id="driver" class="form-control" id="exampleInputEmail1" placeholder="Nama Penerima" value="{{ Auth::user()->name }}">
                              @error('driver')
                                  <span class="text-danger"> {{ $message }} </span>
                              @enderror
                          </div>

                        <div class="form-group">
                          <label for="exampleInputPassword1">Alamat</label>
                          <textarea class="form-control" rows="3" name="alamat" id="alamat" onkeyup="this.value = this.value.toUpperCase()"></textarea>
                          @error('alamat')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">No HP</label>
                            <input type="number" name="no_hp" id="no_hp" class="form-control" id="exampleInputEmail1" placeholder="No HP">
                            @error('no_hp')
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
                            <label for="exampleInputPassword1">Dana Talangan</label>
                            <input type="number" name="dana_talangan" id="dana_talangan" class="form-control" id="exampleInputEmail1" placeholder="Dana Talangan">
                            @error('dana_talangan')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Ongkir</label>
                            <input type="number" name="ongkir" id="ongkir" class="form-control" id="exampleInputEmail1" placeholder="Ongkir">
                            @error('ongkir')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Total Tagihan</label>
                            <input type="number" name="total_tagihan" id="total_tagihan" class="form-control" id="exampleInputEmail1" placeholder="Total Tagihan">
                            @error('total_tagihan')
                                <span class="text-danger"> {{ $message }} </span>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan</label>
                            <textarea type="number" name="keterangan" class="form-control" id="exampleInputEmail1" placeholder="Keterangan" onkeyup="this.value = this.value.toUpperCase()"></textarea>
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

        $('.cari-id').select2({
	        placeholder: 'Masukan ID...',
	        ajax: {
	          url: "{{ url('pengiriman/get-id') }}",
	          dataType: 'json',
	          delay: 250,
	          processResults: function (data) {
	            return {
	              results:  $.map(data, function (item) {
	                return {
	                  text: item.name,
	                  id: item.id
	                }
	              })
	            };
	          },
	          cache: true
	        }
	      });


        $('#penjemputan_id').change(function() {
        var id = $(this).val();
        var url = '{{ route("getDetails", ":id") }}';
        url = url.replace(':id', id);

        $.ajax({
            url: url,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                if (response != null) {
                    $('#nama_penerima').val(response.nama_penerima);
                    $('#alamat').val(response.alamat);
                    $('#no_hp').val(response.no_hp);
                    $('#ongkir').val(response.ongkir);
                    $('#dana_talangan').val(response.dana_talangan);
                    $('#total_tagihan').val(response.total_tagihan);
                }
            }
        });
    });

    })

</script>

@endsection
