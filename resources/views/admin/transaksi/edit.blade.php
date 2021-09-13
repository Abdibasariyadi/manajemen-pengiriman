@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>

                    <a href="{{url('transaksi')}}" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-backward"></i> Kembali ke list Transaksi</a>
                </p>
            </div>
            <div class="box-body">
              <form method="post" action="{{url('transaksi/'.$dt->id)}}">
                @csrf
                {{ method_field('PUT') }}
               <div class="row">
                   <div class="col-md-6">
                       <div class="form-group">
                          <label for="exampleInputEmail1">Tanggal</label>
                          <input type="text" autocomplete="off" name="tanggal" value="{{date('Y-m-d',strtotime($dt->tanggal))}}" class="form-control datepicker" id="exampleInputEmail1" placeholder="Tanggal" required="">
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Select Customer</label>
                          <select class="form-control select2 cari-customer" name="user_id" required="">
                              <option value="{{$dt->user_id}}">{{$dt->customer->name}}</option>
                          </select>
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-block btn-tambah-item">Tambah Item</button>
                        </div>
                   </div>

                   <div class="col-md-6">
                       <div class="form-group">
                          <label for="exampleInputEmail1">No WA Aktif <small style="color: red;"><b><i>**Untuk mengirim notifikasi</i></b></small> </label>
                          <input type="text" autocomplete="off" class="form-control" id="exampleInputEmail1" placeholder="No WA" name="no_wa" required="" value="{{$dt->customer->no_telp}}">
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Alamat</label>
                          <textarea class="form-control" name="alamat" rows="3" required="">{{$dt->customer->alamat}}</textarea>
                        </div>
                   </div>
               </div>
               <hr style=" border-top: 4px dashed blue;">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Paket</th>
                                    <th>Berat (kg) <small style="color: red;"><b><i>**untuk koma ditulis dengan tanda titik(.)</i></b></small> </th>
                                    <th>Harga</th>
                                    <th>SubTotal</th>
                                    <th>Estimasi Selesai</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody class="list-item">
                                @foreach($dt->lines as $ln)
                                <tr>
                                  <td>
                                    <select class="form-control item-paket" name="paket_laundry_id[]" required="">
                                      <option value="{{$ln->paket_laundry->id}}">{{$ln->paket_laundry->nama}}</option>

                                      @foreach($pakets as $pk)
                                      <option value="{{$pk->id}}">{{$pk->nama}}</option>
                                      @endforeach
                                    </select>
                                  </td>
                                  <td>
                                    <input type="number" min="0" name="berat[]" class="form-control berat-row" required="" value="{{$ln->berat}}">
                                  </td>
                                  <td>
                                    <input type="text" name="harga[]" class="form-control harga-paket" readonly="" value="{{$ln->harga}}">
                                  </td>
                                  <td>
                                    <input type="text" name="sub_total[]" class="form-control sub-total" readonly="" value="{{$ln->total_harga}}">
                                  </td>
                                  <td>
                                    <input type="text" name="estimasi_selesai[]" class="form-control datepicker estimasi-selesai" value="{{date('Y-m-d',strtotime($ln->estimasi_selesai))}}">
                                  </td>
                                  <td>
                                    <button class="btn btn-danger btn-xs btn-hapus-row"><i class="fa fa-trash"></i></button>
                                  </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <hr style=" border-top: 4px dashed blue;">
                <div class="row">

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Diskon</label>
                      <input type="number" name="diskon" class="form-control" value="{{$dt->diskon}}">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tax(%) <small style="color: red;"><b><i>**untuk koma ditulis dengan tanda titik(.)</i></b></small> </label>
                      <input type="number" name="tax" class="form-control" value="{{$dt->tax}}">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Grand Total</label>
                      <input type="text" name="grand_total" class="form-control" value="{{$dt->grand_total_amount}}" readonly="">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status Bayar</label>
                      <select class="form-control select2" name="status_bayar">
                        <option value="{{$dt->status_bayar_r->id}}">{{$dt->status_bayar_r->nama}}</option>
                        <option value="4">Belum Dibayar</option>
                        <option value="3">Sudah Dibayar</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status Pengerjaan</label>
                      <select class="form-control select2" name="status_pengerjaan">
                        <option value="{{$dt->status_pengerjaan_r->id}}">{{$dt->status_pengerjaan_r->nama}}</option>
                        <option value="7">Menunggu</option>
                        <option value="5">Sedang Dikerjakan</option>
                        <option value="6">Selesai</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary btn-block btn-lg">Update</button>
                    </div>
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

        function calculate_grand_total(){

          var grand_total = 0;

          var sub_total = 0;
          $('.sub-total').each(function(i,v){
            var total = $(this).val();
            if(total == ''){
              total = 0;
            }
            total = parseFloat(total);
            sub_total += total;
          });

          var diskon = $("input[name='diskon']").val();
          if(diskon == ''){
            diskon = 0;
          }
          diskon = parseFloat(diskon);

          grand_total = parseFloat(sub_total) - diskon;

          var tax = $("input[name='tax']").val();
          if(tax == ''){
            tax=0;
          }
          tax = parseFloat(tax);

          var order_tax = grand_total * tax / 100;

          grand_total += order_tax;

          $("input[name='grand_total']").val(grand_total);
        }

        // inputan tax ===================
        $("input[name='tax']").keyup(function(){
          calculate_grand_total();
        })
        $("input[name='tax']").change(function(){
          calculate_grand_total();
        })
        // end inputan tax ===================

        // inputan diskon ===================
        $("input[name='diskon']").keyup(function(){
          calculate_grand_total();
        })
        $("input[name='diskon']").change(function(){
          calculate_grand_total();
        })
        // end inputan diskon ===================

        // inputan berat ===================
        $('body').on('keyup','.berat-row',function(e){
          var berat = $(this).val();
          if(berat == ''){
            berat=0;
          }
          berat = parseFloat(berat);

          var harga = $('.harga-paket').val();
          if(harga == ''){
            harga=0;
          }
          harga = parseFloat(harga);

          var sub_total = harga*berat;
          $(this).closest('tr').find('.sub-total').val(sub_total);

          calculate_grand_total();
        });

        $('body').on('change','.berat-row',function(e){
          var berat = $(this).val();
          if(berat == ''){
            berat=0;
          }
          berat = parseFloat(berat);

          var harga = $('.harga-paket').val();
          if(harga == ''){
            harga=0;
          }
          harga = parseFloat(harga);

          var sub_total = harga*berat;
          $(this).closest('tr').find('.sub-total').val(sub_total);

          calculate_grand_total();
        })
        // end inputan berat ===================

        $('body').on('change','.item-paket',function(e){
          var id = $(this).val();
          var tgl = $("input[name='tanggal']").val();
          var url = "{{url('transaksi/create/get-detail-paket-ajax')}}"+'/'+id+'/'+tgl;
          var _this = $(this);
          $.get(url,function(data,stat){
            // console.log(data);
            _this.closest('tr').find('.harga-paket').val(data.data.harga);
            _this.closest('tr').find('.estimasi-selesai').val(data.durasi);

            var harga = data.data.harga;
            var berat = _this.closest('tr').find('.berat-row').val();
            var sub_total = parseFloat(harga)*parseFloat(berat);
            // alert(sub_total);
            _this.closest('tr').find('.sub-total').val(sub_total);

            calculate_grand_total();
          });

          
        });

        function calculate_total_row(paket){

          var tgl = $("input[name='tanggal']").val();
          var url = "{{url('transaksi/create/get-detail-paket-ajax')}}"+'/'+paket+'/'+tgl;
          $.get(url,function(data,stat){
            // console.log(data);
            $('.harga-paket').val(data.data.harga);
            $('.estimasi-selesai').val(data.durasi);
          });

        }

        $('.btn-tambah-item').click(function(e){
            e.preventDefault();
            
            var nilai = '';
            nilai += '<tr>';
                nilai += '<td>';
                    nilai += '<select class="form-control item-paket" name="paket_laundry_id[]" required="">';
                        nilai += '<option selected="" disabled="">Pilih Paket</option>';
                        @foreach($pakets as $pk)
                         var pk = {!! json_encode($pk) !!};
                         
                        nilai += '<option value="'+pk.id+'">'+pk.nama+'</option>';

                        @endforeach
                    nilai += '</select>';
                nilai += '</td>';

                nilai += '<td>';
                    nilai += '<input type="number" value="0" min="0" name="berat[]" class="form-control berat-row" required="">'
                nilai += '</td>';

                nilai += '<td>';
                    nilai += '<input type="text" name="harga[]" class="form-control harga-paket" readonly="">'
                nilai += '</td>';

                nilai += '<td>';
                    nilai += '<input type="text" name="sub_total[]" class="form-control sub-total" readonly="">'
                nilai += '</td>';

                nilai += '<td>';
                    nilai += '<input type="text" name="estimasi_selesai[]" class="form-control datepicker estimasi-selesai">'
                nilai += '</td>';

                nilai += '<td>';
                    nilai += '<button class="btn btn-danger btn-xs btn-hapus-row"><i class="fa fa-trash"></i></button>';
                nilai += '</td>';

            nilai += '</tr>';

            $('.list-item').append(nilai);

            calculate_grand_total();
        });

        $('body').on('click','.btn-hapus-row',function(e){
            e.preventDefault();
            $(this).closest('tr').remove();
            calculate_grand_total();
        })

        $("select[name='user_id']").change(function(e){
            var id = $(this).val();
            var url = "{{ url('transaksi/create/get-detail-customer-ajax') }}"+'/'+id;

            $.ajax({
                type:'get',
                dataType:'json',
                url:url,
                success:function(data){
                    // console.log(data.data);
                    $("input[name='no_wa']").val(data.data.no_telp);
                    $("textarea[name='alamat']").val(data.data.alamat);
                },error:function(a,b,c){
                    alert(c);
                }
            })
        })

        $('.cari-customer').select2({
            placeholder: 'Ketik Untuk Mencari...',
            ajax: {
              url: "{{ url('transaksi/create/get-customer-ajax') }}",
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
 
        // btn refresh
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })
 
    })
</script>
 
@endsection