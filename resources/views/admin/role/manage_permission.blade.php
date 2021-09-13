@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>

                    <a href="{{url('admin/role')}}" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-backward"></i> Kembali</a>
                </p>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <center>
                            <p>
                                <b><i>
                                    Note : Kolom sebelah kiri adalah list semua permission, kolom sebelah kanan adalah list permission yang sudah di tambahkan untuk role {{$dt->nama}}
                                </i></b>
                            </p>
                        </center>
                    </div>
                </div>

               <div class="row">
                   <div class="col-md-6">
                       <div class="table-responsive">
                           <table class="table">
                               <thead>
                                   <tr>
                                       <th>Keterangan</th>
                                       <th>Tambahkan</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   @foreach($permissions as $pr)
                                    <tr>
                                        <td>{{$pr->keterangan}}</td>
                                        <td>
                                            <a href="{{url('admin/role/permission/'.$dt->id.'/'.$pr->id)}}" class="btn btn-warning btn-xs"><i class="fa fa-forward"></i></a>
                                        </td>
                                    </tr>
                                   @endforeach
                               </tbody>
                           </table>
                       </div>
                   </div>
                   <div class="col-md-6">
                       <div class="table-responsive">
                           <table class="table">
                               <thead>
                                   <tr>
                                       <th>Keterangan</th>
                                       <th>Tambahkan</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   @foreach($role_permission as $rp)
                                    <tr>
                                        <td>{{$rp->permission->keterangan}}</td>
                                        <td>
                                            <a href="{{url('admin/role/permission/delete/'.$rp->id)}}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                   @endforeach
                               </tbody>
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