@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                    <a href="{{url('admin/income/create')}}" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                    <button class="btn btn-sm btn-flat btn-success btn-verif"><i class="fa fa-check"></i> Verifikasi</button>
                    <button class="btn btn-sm btn-flat btn-primary btn-filter"><i class="fa fa-filter"></i> Filter</button>
                </p>
            </div>
            <div class="box-body">
              <div class="row form-filter" style="display: none;">
                <div class="col-md-4 col-xs-12">
                    <form role="form" method="get" action="{{url('admin/income/filter')}}">
                      <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Dari</label>
                          <input type="text" name="dari" class="form-control datepicker" id="exampleInputEmail1" placeholder="Dari" autocomplete="off" value="{{$dari}}">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputPassword1">Sampai</label>
                          <input type="text" name="sampai" class="form-control datepicker" id="exampleInputPassword1" placeholder="Sampai" autocomplete="off" value="{{$sampai}}">
                        </div>
                      </div>
                      <!-- /.box-body -->
         
                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Filter</button>
                      </div>
                    </form>    
                </div>
              </div>

               <div class="row">
                   <div class="col-md-12">
                       <div class="table-responsive">
                           <table class="table tbl-income">
                               <thead>
                                   <tr>
                                       <th>
                                           <input type="checkbox" class="check-income-all"> Verifikasi
                                       </th>
                                       <th>Action</th>
                                       <th>Tanggal</th>
                                       <th>Ref No</th>
                                       <th>Biaya Masuk Ke</th>
                                       <th>Note</th>
                                       <th>Created At</th>
                                       <th>Updated At</th>
                                       <th>Created By</th>
                                       <th>Updated By</th>
                                   </tr>
                               </thead>
                           </table>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}">
 
@endsection
 
@section('scripts')
 
    @include('income.index_scripts')
 
@endsection