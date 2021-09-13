<script type="text/javascript">
    $(document).ready(function(){

        $('.btn-add-customer').click(function(e){
          e.preventDefault();
          // var url = $(this).closest('form').attr('action');
          $('#modal-customer').modal();
        })

        $('.form-create-transaksi').on('submit',function(e){
            // e.preventDefault();
            // alert('sd');
            $(this).find("button[type='submit']").attr('disabled',true);
        })

        $('.btn-submit-customer').click(function(e){
          e.preventDefault();

          var url = $(this).closest('form').attr('action');
          // $('#modal-customer').modal();
          $.ajax({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              url: url,
              type: 'post',
              dataType: 'json',
              data: $(this).closest('form').serialize(),
              success: function(data) {
                 console.log(data.dt);
                 var hasil = '';

                 hasil += '<option value="'+data.dt.id+'">';
                  hasil += data.dt.name;
                 hasil += '</option>';

                 $("select[name='user_id']").append(hasil);
                 $("input[name='no_wa']").val(data.dt.no_telp);
                 $("textarea[name='alamat']").val(data.dt.alamat);
                 $('#modal-customer').modal('hide');
               },error:function(a,b,c){
                alert(c);
               }
          });
        })

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
          // console.log(sub_total);
          // var diskon = $("input[name='diskon']").val();
          // if(diskon == ''){
          //   diskon = 0;
          // }
          // diskon = parseFloat(diskon);

          grand_total = parseFloat(sub_total);

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
        // $("input[name='diskon']").keyup(function(){
        //   calculate_grand_total();
        // })
        // $("input[name='diskon']").change(function(){
        //   calculate_grand_total();
        // })
        // end inputan diskon ===================

        // inputan berat ===================
        $('body').on('keyup','.berat-row',function(e){
          var berat = $(this).val();
          if(berat == ''){
            berat=0;
          }
          berat = parseFloat(berat);

          // var harga = $('.harga-paket').val();
          var harga = $(this).closest('tr').find('.harga-paket').val();
          if(harga == ''){
            harga=0;
          }
          harga = parseFloat(harga);

          var sub_total = harga*berat;
          $(this).closest('tr').find('.sub-total').val(sub_total);
          $(this).closest('tr').find('.sub-total-asli').val(sub_total);

          calculate_grand_total();
        });

        $('body').on('change','.berat-row',function(e){
          var berat = $(this).val();
          if(berat == ''){
            berat=0;
          }
          berat = parseFloat(berat);

          // var harga = $('.harga-paket').val();
          var harga = $(this).closest('tr').find('.harga-paket').val();
          if(harga == ''){
            harga=0;
          }
          harga = parseFloat(harga);

          var sub_total = harga*berat;
          $(this).closest('tr').find('.sub-total').val(sub_total);
          $(this).closest('tr').find('.sub-total-asli').val(sub_total);

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
            _this.closest('tr').find('.sub-total-asli').val(sub_total);

            calculate_grand_total();
          });

          
        });

        $('body').on('change','.diskon',function(e){
            var sub_total = $(this).closest('tr').find('.sub-total-asli').val();
            sub_total = parseFloat(sub_total);

            var diskon = $(this).val();
            diskon = parseFloat(diskon);

            var nilai_diskon = sub_total * diskon / 100;

            var nilai_setelah_diskon = sub_total - nilai_diskon;

            $(this).closest('tr').find('.sub-total').val(nilai_setelah_diskon);

            calculate_grand_total();
        });

        $('body').on('keyup','.diskon',function(e){
            var sub_total = $(this).closest('tr').find('.sub-total-asli').val();
            sub_total = parseFloat(sub_total);

            var diskon = $(this).val();
            if(diskon == ''){
              diskon=0;
            }
            diskon = parseFloat(diskon);

            var nilai_diskon = sub_total * diskon / 100;

            var nilai_setelah_diskon = sub_total - nilai_diskon;

            $(this).closest('tr').find('.sub-total').val(nilai_setelah_diskon);

            calculate_grand_total();
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
                    nilai += '<input type="number" name="diskon[]" class="form-control diskon" value="0" required="" min="0">';

                nilai += '<td>';
                    nilai += '<input type="text" name="sub_total[]" class="form-control sub-total" readonly="">';
                    nilai += '<input type="hidden" name="sub_total_asli[]" class="form-control sub-total-asli" readonly="">';
                nilai += '</td>';

                    nilai += '<input type="hidden" name="estimasi_selesai[]" class="form-control datepicker estimasi-selesai">';
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