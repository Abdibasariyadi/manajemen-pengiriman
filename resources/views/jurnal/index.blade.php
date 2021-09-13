@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <!-- <a href="{{ url('admin/jurnal/create') }}" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-plus"></i> Tambah Jurnal</a> -->

                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                </p>
            </div>
            <div class="box-body">
               <div class="row">
                   <div class="col-md-12 col-xs-12">
                       <div class="table-responsive">
                           <table class="table tbl-jurnal">
                               <thead>
                                   <tr>
                                        <th>View Detail</th>
                                       <th>Ledger Number</th>
                                       <th>Ledger Date</th>
                                       <th>Total Debit</th>
                                       <th>Total Credit</th>
                                       <th>Ref No</th>
                                       <th>Created By</th>
                                       <th>Created At</th>
                                       <th>Cabang</th>
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
 
@endsection
 
@section('scripts')
 
    @include('jurnal.scripts')
 
@endsection