@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>

                    <a href="{{url('transaksi/create')}}" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah Transaksi</a>

                    <a href="{{url('transaksi/create')}}" class="btn btn-sm btn-flat btn-success btn-filter"><i class="fa fa-filter"></i> Filter</a>

                    <a href="{{url('transaksi/struck/last')}}" class="btn btn-sm btn-flat btn-danger" target="_blank"><i class="fa fa-print"></i> Cetak Struck Transaksi Terakhir</a>
                </p>
            </div>
            <div class="box-body">
               <div class="row">
                   <div class="col-md-12">
                       <div class="table-responsive">
                           <table class="table table-hover tbl-transaksi">
                               <thead>
                                   <tr>
                                        <th>Action</th>
                                       <th>Tanggal</th>
                                       <th>Ref No</th>
                                       <th>Customer</th>
                                       <th>Status Bayar</th>
                                       <th>Status Pengerjaan</th>
                                       <th>Karyawan</th>
                                       <th>Total</th>
                                       <th>Diskon</th>
                                       <th>Tax</th>
                                       <th>Grand Total</th>
                                   </tr>
                               </thead>
                               <tfoot>
                                 <tr>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th></th>
                                   <th><b><i>Total</i></b></th>
                                   <th><b><i>{{number_format($grand_total,2)}}</i></b></th>
                                 </tr>
                               </tfoot>
                           </table>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
</div>

<!-- modal filter -->
<div class="modal fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
  <div class="modal-dialog modal-default modal-dialog-centered modal-" role="document">
    <div class="modal-content bg-gradient-danger">

      <div class="modal-header">
        <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <div class="modal-body">

        <form role="form" method="get" action="">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Dari</label>
              <input type="text" class="form-control datepicker" id="exampleInputEmail1" placeholder="Dari" autocomplete="off" name="dari" value="{{$dari}}">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Sampai</label>
              <input type="text" name="sampai" class="form-control datepicker" id="exampleInputPassword1" placeholder="Sampai" autocomplete="off" value="{{$sampai}}">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Status Bayar</label>
              <select class="form-control" name="status_bayar">
                <option value="all" {{ ($status_bayar == 'all') ? 'selected' : '' }}>All Status</option>
                <option value="4" {{ ($status_bayar == 4) ? 'selected' : '' }}>Belum Dibayar</option>
                <option value="3" {{ ($status_bayar == 3) ? 'selected' : '' }}>Sudah Dibayar</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Status Pengerjaan</label>
              <select class="form-control" name="status_pengerjaan">
                <option value="all" {{ ($status_pengerjaan == 'all') ? 'selected' : '' }}>All Status</option>
                <option value="7" {{ ($status_pengerjaan == 7) ? 'selected' : '' }}>Menunggu</option>
                <option value="5" {{ ($status_pengerjaan == 5) ? 'selected' : '' }}>Sedang Dikerjakan</option>
                <option value="6" {{ ($status_pengerjaan == 6) ? 'selected' : '' }}>Selesai</option>
              </select>
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <p>
              <button type="submit" class="btn btn-primary btn-submit"><i class="fa fa-filter"></i>Filter</button>

              <button class="btn btn-warning btn-print" target="_blank"><i class="fa fa-print"></i>Print</button>

              <button class="btn btn-success btn-excel" target="_blank"><i class="fa fa-download"></i>Excel</button>
            </p>
          </div>
        </form>

      </div>

    </div>
  </div>
</div>
<!-- end modal filter -->

<!-- modal status bayar -->
<div class="modal fade" id="modal-status-bayar" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
  <div class="modal-dialog modal-default modal-dialog-centered modal-" role="document">
    <div class="modal-content bg-gradient-danger">

      <div class="modal-header">
        <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <div class="modal-body">

        <form role="form" action="#" method="post">
          @csrf
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Status Bayar</label>
              <select class="form-control" name="status_bayar">
                <option selected="" disabled="">Pilih Status Bayar</option>
                <option value="4">Belum Dibayar</option>
                <option value="3">Sudah Dibayar</option>
              </select>
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update Status Bayar</button>
          </div>
        </form>

      </div>

    </div>
  </div>
</div>

<!-- modal status pengerjaan -->
<div class="modal fade" id="modal-status-pengerjaan" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
  <div class="modal-dialog modal-default modal-dialog-centered modal-" role="document">
    <div class="modal-content bg-gradient-danger">

      <div class="modal-header">
        <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <div class="modal-body">

        <form role="form" action="#" method="post">
          @csrf
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Status Pengerjaan</label>
              <select class="form-control" name="status_pengerjaan">
                <option selected="" disabled="">Pilih Status Pengerjaan</option>
                <option value="7">Menunggu</option>
                <option value="5">Sedang Dikerjakan</option>
                <option value="6">Selesai</option>
              </select>
            </div>
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Update Status Pengerjaan</button>
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

        $('body').on('click','.btn-status-bayar',function(e){
          e.preventDefault();
          var url = $(this).attr('href');
          $('#modal-status-bayar').find('form').attr('action',url);
          $('#modal-status-bayar').modal();
        })

        $('body').on('click','.btn-status-pengerjaan',function(e){
          e.preventDefault();
          var url = $(this).attr('href');
          $('#modal-status-pengerjaan').find('form').attr('action',url);
          $('#modal-status-pengerjaan').modal();
        })

        $('.btn-submit').click(function(e){
            // alert('asd');
            var url = "{{ url('transaksi/filter') }}";
            $(this).closest('#modal-filter').find('form').attr('action',url);
        })

        $('.btn-print').click(function(e){
            // alert('asd');
            var url = "{{ url('transaksi/filter/print') }}";
            $(this).closest('#modal-filter').find('form').attr('action',url);
        })

        $('.btn-excel').click(function(e){
            // alert('asd');
            var url = "{{ url('transaksi/filter/excel') }}";
            $(this).closest('#modal-filter').find('form').attr('action',url);
        })

        $('.btn-filter').click(function(e){
          e.preventDefault();
          $('#modal-filter').modal();
        })

        // btn refresh
        $('.btn-refresh').click(function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        });

        $('.tbl-transaksi').DataTable({
          dom: 'lBfrtip',
            button: [
            'excel'
            ],
            "lengthMenu": [
                [ 10, 25, 50, 100, 1000, -1 ],
                [ '10 rows', '25 rows', '50 rows', '100 rows', '1000 rows', 'All' ]
            ],
            scrollY:300,
            processing: true,
            serverSide: true,
            ajax: "{{$yajra}}",
            columns: [
                // or just disable search since it's not really searchable. just add searchable:false
                {data: 'action', name: 'action'},
                {data: 'tanggal', name: 'tanggal'},
                {data: 'reference_no', name: 'reference_no'},
                {data: 'customer.name', name: 'customer.name'},
                {data: 'status_bayar_r', name: 'status_bayar_r'},
                {data: 'status_pengerjaan_r', name: 'status_pengerjaan_r'},
                {data: 'karyawan.name', name: 'karyawan.name'},
                {data: 'total', name: 'total'},
                {data: 'diskon', name: 'diskon'},
                {data: 'order_tax', name: 'order_tax'},
                {data: 'grand_total_amount', name: 'grand_total_amount'}
            ]
        });

    })
</script>

@endsection
