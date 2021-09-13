@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>

                    <button class="btn btn-sm btn-flat btn-success btn-filter"><i class="fa fa-filter"></i> Filter</button>
                </p>
            </div>
            <div class="box-body">

                <div class="row div-filter" style="display: none;">
                    <div class="col-md-4">
                        <form role="form" method="get" action="{{ url('laporan/per-paket/filter') }}">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Dari</label>
                              <input type="text" class="form-control datepicker" id="exampleInputEmail1" placeholder="Dari" autocomplete="off" name="dari" value="{{$dari}}">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Sampai</label>
                              <input type="text" class="form-control datepicker" id="exampleInputPassword1" placeholder="Sampai" autocomplete="off" name="sampai" value="{{$sampai}}">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputFile">Pilih Paket</label>
                              <select class="form-control select2" name="paket_id" style="width: 100%;">
                                  <option value="all" {{ ($paket_id == 'all') ? 'selected' : '' }}>All</option>
                                  @foreach($mpakets as $pk)
                                  <option value="{{$pk->id}}" {{ ($paket_id == $pk->id) ? 'selected' : '' }}>{{$pk->nama}}</option>
                                  @endforeach
                              </select>
                            </div>
                          </div>
                          <!-- /.box-body -->

                          <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-stripped myTable2">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Paket</th>
                                @foreach($status as $st)
                                <th>{{$st->nama}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <?php $jumlah_total=0; ?>
                            @foreach($pakets as $e=>$pk)
                            <tr>
                                <td>{{$e+1}}</td>
                                <td>{{$pk->nama}}</td>
                                @foreach($status as $st)
                                <?php

                                ?>
                                <td>{{ number_format($pk->total($dari,$sampai,$pk->id,$st->id),0) }}</td>
                                @endforeach

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">
    $(document).ready(function(){

        $('.btn-filter').click(function(e){
            e.preventDefault();
            $('.div-filter').toggle();
        })

        $('.myTable2').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
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
