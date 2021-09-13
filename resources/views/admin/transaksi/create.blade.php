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
              <form method="post" action="{{url('transaksi/create')}}" class="form-create-transaksi">
                @csrf
               <div class="row">
                   <div class="col-md-6 col-xs-12">
                       <div class="form-group">
                          <label for="exampleInputEmail1">Tanggal</label>
                          <input type="text" autocomplete="off" name="tanggal" value="{{date('Y-m-d')}}" class="form-control datepicker" id="exampleInputEmail1" placeholder="Tanggal" required="">
                        </div>

                        <div class="form-group">
                          <div class="row">
                            <div class="col-md-10">
                              <label for="exampleInputEmail1">Select Customer</label>
                              <select class="form-control select2 cari-customer" name="user_id" required="">
                                  
                              </select>
                            </div>
                              <label for="exampleInputEmail1">Add Customer</label>
                              <span class="input-group-addon btn-add-customer" style="cursor: pointer;"><i class="fa fa-plus"></i></span>
                            <div class="col-md-2">
                              
                            </div>
                          </div>
                        </div>
                   </div>

                   <div class="col-md-6 col-xs-12">
                       <div class="form-group">
                          <label for="exampleInputEmail1">No WA Aktif <small style="color: red;"><b><i>**Untuk mengirim notifikasi</i></b></small> </label>
                          <input type="text" autocomplete="off" class="form-control" id="exampleInputEmail1" placeholder="No WA" name="no_wa" required="">
                        </div>

                        <div class="form-group">
                          <label for="exampleInputEmail1">Alamat</label>
                          <textarea class="form-control" name="alamat" rows="3" required=""></textarea>
                        </div>
                   </div>
               </div>
               <div class="row">
                 <div class="col-md-12 col-xs-12">
                   

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary btn-block btn-tambah-item">Tambah Item</button>
                        </div>
                 </div>
               </div>
               <hr style=" border-top: 4px dashed blue;">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                                <tr>
                                    <th>Paket</th>
                                    <th>Berat/Satuan </th>
                                    <th>Harga</th>
                                    <th>Diskon (%)</th>
                                    <th>SubTotal</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody class="list-item">
                                
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
                <hr style=" border-top: 4px dashed blue;">
                <div class="row">

                  <!-- <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Diskon</label>
                      <input type="number" name="diskon" class="form-control" value="0">
                    </div>
                  </div> -->

                  <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tax(%) <small style="color: red;"><b><i>**untuk koma ditulis dengan tanda titik(.)</i></b></small> </label>
                      <input type="number" name="tax" class="form-control" value="0">
                    </div>
                  </div>

                  <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Grand Total</label>
                      <input type="text" name="grand_total" class="form-control" value="0" readonly="">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status Bayar</label>
                      <select class="form-control select2" name="status_bayar">
                        <option value="4">Belum Dibayar</option>
                        <option value="3">Sudah Dibayar</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Status Pengerjaan</label>
                      <select class="form-control select2" name="status_pengerjaan">
                        <option value="7">Menunggu</option>
                        <option value="5">Sedang Dikerjakan</option>
                        <option value="6">Selesai</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 col-xs-12">
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary btn-block btn-lg">Submit</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>

<!-- modal customer -->
<div class = "modal fade" id = "modal-customer" role = "dialog">
    <div class = "modal-dialog modal-lg">
     <div class = "modal-content">
      <div class = "modal-header">      
       <button type = "button" class="close" data-dismiss = "modal">×</button>
       <h4 class = "modal-title">Warning</h4>
     </div>

     <div class = "modal-body">
        <form role="form" id="store_customer_ajax" method="post" action="{{url('transaksi/create-customer')}}">
                @csrf
               <div class="row">

                 <div class="col-md-6">
                  <small style="color: red;"><b><i>** Tanda Bintang 2 Merah Wajib Diisi</i></b></small>
                    <div class="box-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Nama <small style="color: red;"><b><i>**</i></b></small> </label>
                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Name" required="">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address </label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                      </div>
                    </div>
                    <!-- /.box-body -->
       
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary btn-submit-customer">Submit</button>
                    </div>
                 </div>

                 <div class="col-md-6">
                  <small style="color: red;"><b><i>-</i></b></small>
                    <div class="box-body">
                      <div class="form-group">
                        <label for="exampleInputEmail1">No Wa Aktif <small style="color: red;"><b><i>** Digunakan utk mengirim notifikasi</i></b></small> </label>
                        <input type="text" name="no_telp" class="form-control" id="exampleInputEmail1" placeholder="Name" required="">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Jenis Kelamin </label>
                        <select class="form-control" name="jenis_kelamin" required="">
                          <option value="p">Pria</option>
                          <option value="w">Wanita</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputFile">Alamat</label>
                        <textarea class="form-control" rows="5" name="alamat"></textarea>
                      </div>
                    </div>
                    <!-- /.box-body -->
                 </div>

               </div>
              </form>
     </div>

   </div>
 </div>
</div>
 
@endsection
 
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
 
  @include('admin.transaksi.create_scripts')
 
@endsection