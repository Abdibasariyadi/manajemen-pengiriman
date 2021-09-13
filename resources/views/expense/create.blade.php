@extends('layouts.master')
 
@section('content')
 
<div class="row">
    <div class="col-md-12">
        <h4>{{ $title }}</h4>
        <div class="box box-warning">
            <div class="box-header">
                <p>
                    <a href="{{url('admin/expense')}}" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-backward"></i> Kembali Ke List</a>
                    <button class="btn btn-sm btn-flat btn-warning btn-refresh"><i class="fa fa-refresh"></i> Refresh</button>
                </p>
            </div>
            <div class="box-body">
                <center>
                    <p style="color: red;"><b><i>Tanda (<span style="color: red;">*</span>) Wajib Diisi..</i></b></p>
                </center>

              <form role="form" method="POST" action="{{url('admin/expense/create')}}">
                @csrf

               <div class="row">
                   <div class="col-md-8 col-md-offset-2 col-xs-12">
                      @if ($errors->any())
                          <div class="alert alert-danger">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      @endif
                          <div class="box-body">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Tanggal <span style="color: red;">*</span></label>
                              <input type="text" name="tanggal" class="form-control datepicker" id="exampleInputEmail1" placeholder="Tanggal" autocomplete="off" required="" value="{{date('Y-m-d')}}">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Ref No <span style="color: red;">*</span></label>
                              <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Expense No" required="" name="ref_no" value="{{$ref_no}}">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Biaya Keluar Dari : <span style="color: red;">*</span> </label>
                              <select class="form-control select2" name="coa_id" required="">
                                  @foreach($coas as $co)
                                  <option value="{{$co->id}}">{{$co->nama}}</option>
                                  @endforeach
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputPassword1">Note</label>
                              <textarea class="form-control" name="note" rows="5"></textarea>
                            </div>
                          </div>
                          <!-- /.box-body -->
                   </div>
               </div>

              <div class="row">
                <div class="col-md-12 col-xs-12">
                  <h4><b><i>Rincian Expense..</i></b></h4>
                  <button class="btn btn-xs btn-success btn-add-line"><i class="fa fa-plus"></i> Tambah Item</button>
                  <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>COA/Akun</th>
                          <th>Nominal</th>
                          <th>Note</th>
                          <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody id="lines">
                        <tr>
                          <td>
                            <select class="form-control select2" name="coa_id_line[]" required="" style="width: 100%;">
                              <option selected="" disabled="">Pilih COA</option>
                              @foreach($coas as $co)
                              <option value="{{$co->id}}">{{$co->nama}}</option>
                              @endforeach
                            </select>
                          </td>
                          <td>
                            <input type="number" name="nominal[]" class="form-control" required="">
                          </td>
                          <td>
                            <input type="text" name="note_line[]" class="form-control">
                          </td>
                          <td>
                            <button class="btn btn-xs btn-danger btn-hapus-line"><i class="fa fa-trash"></i></button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <button class="btn btn-xs btn-success btn-add-line"><i class="fa fa-plus"></i> Tambah Item</button>
                </div>
              </div>

              <div class="row" style="margin-top: 15px;">
                <div class="col-md-12 col-xs-12">
                  <button class="btn btn-block btn-primary" type="submit">SUBMIT</button>
                </div>
              </div>

              </form>

            </div>
        </div>
    </div>
</div>
 
@endsection
 
@section('scripts')
 
  @include('expense.scripts')
 
@endsection