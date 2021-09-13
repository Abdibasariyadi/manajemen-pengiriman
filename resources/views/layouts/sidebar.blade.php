<section class="sidebar">
      <!-- Sidebar user panel -->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">



        <li class="menu-sidebar"><a href="{{ url('/beranda') }}"><span class="fa fa-calendar-minus-o"></span> Beranda Dashboard</span></a></li>

        @if (Auth::user()->id == 1)

        <li class="header">MASTER DATA</li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-group"></i>
            <span>Data Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/users')}}"><i class="fa fa-circle-o"></i> List User</a></li>
            <li><a href="{{url('admin/users/create')}}"><i class="fa fa-circle-o"></i> Add User</a></li>
          </ul>
        </li>
        @endif

        {{-- <li class="treeview">
          <a href="#">
            <i class="fa fa-cubes"></i>
            <span>Produk</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('paket-laundry')}}"><i class="fa fa-circle-o"></i> Paket Laundry</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-opencart"></i>
            <span>Supplier</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/supplier')}}"><i class="fa fa-circle-o"></i> List Supplier</a></li>
            <li><a href="{{url('admin/supplier/create')}}"><i class="fa fa-circle-o"></i> Add Supplier</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-share"></i> <span>Accounting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/coa-category')}}"><i class="fa fa-circle-o"></i> COA Category</a></li>
            <li><a href="{{url('admin/coa')}}"><i class="fa fa-circle-o"></i> COA</a></li>
          </ul>
        </li> --}}
        @if (Auth::user()->id == 1)
            <li class="header">PENJEMPUTAN</li>

            <li class="treeview">
            <a href="#">
                <i class="fa fa-calculator"></i>
                <span>Penjemputan</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{url('admin/penjemputan')}}"><i class="fa fa-circle-o"></i> List Penjemputan</a></li>
                <li><a href="{{url('admin/penjemputan/create')}}"><i class="fa fa-circle-o"></i> Tambah Penjemputan</a></li>
                <!-- <li><a href="{{url('transaksiku')}}"><i class="fa fa-circle-o"></i> List Transaksi Ku (per cust)</a></li> -->
            </ul>
            </li>
        @endif


        @if (Auth::user()->id > 1)
        <li class="header">PENGIRIMAN</li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-calculator"></i>
            <span>Pengiriman</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('pengiriman')}}"><i class="fa fa-circle-o"></i> List Pengiriman</a></li>
            <li><a href="{{url('pengiriman/create')}}"><i class="fa fa-circle-o"></i> Tambah Pengiriman</a></li>
            <!-- <li><a href="{{url('transaksiku')}}"><i class="fa fa-circle-o"></i> List Transaksi Ku (per cust)</a></li> -->
          </ul>
        </li>
        @endif


        {{-- <li class="header">TRANSAKSI</li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-calculator"></i>
            <span>Transaksi</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('transaksi')}}"><i class="fa fa-circle-o"></i> List Transaksi</a></li>
            <li><a href="{{url('transaksi/create')}}"><i class="fa fa-circle-o"></i> Create Transaksi</a></li>
            <!-- <li><a href="{{url('transaksiku')}}"><i class="fa fa-circle-o"></i> List Transaksi Ku (per cust)</a></li> -->
          </ul>
        </li> --}}

        {{-- <li class="header">BIAYA</li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-eyedropper"></i>
            <span>Income</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/income')}}"><i class="fa fa-circle-o"></i> List Income</a></li>
            <li><a href="{{url('admin/income/create')}}"><i class="fa fa-circle-o"></i> Create Income</a></li>
            <!-- <li><a href="{{url('transaksiku')}}"><i class="fa fa-circle-o"></i> List Transaksi Ku (per cust)</a></li> -->
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-exclamation"></i>
            <span>Expense</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/expense')}}"><i class="fa fa-circle-o"></i> List Expense</a></li>
            <li><a href="{{url('admin/expense/create')}}"><i class="fa fa-circle-o"></i> Create Expense</a></li>
            <!-- <li><a href="{{url('transaksiku')}}"><i class="fa fa-circle-o"></i> List Transaksi Ku (per cust)</a></li> -->
          </ul>
        </li> --}}

        {{-- <li class="header">LAPORAN</li>

        <li class="menu-sidebar"><a href="{{ url('/admin/jurnal') }}"><span class="fa fa-calendar-minus-o"></span> Jurnal</span></a></li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-excel-o"></i>
            <span>Laporan Lainnya</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('laporan/per-cust')}}"><i class="fa fa-circle-o"></i> Laporan Per Cust</a></li>
            <li><a href="{{url('laporan/per-paket')}}"><i class="fa fa-circle-o"></i> Laporan Per Paket</a></li>
            <li><a href="{{url('laporan/per-karyawan')}}"><i class="fa fa-circle-o"></i> Laporan Per Karyawan</a></li>
          </ul>
        </li> --}}
        @if (Auth::user()->id == 1)
            <li class="header">LAPORAN</li>

            {{-- <li class="menu-sidebar"><a href="{{ url('/admin/jurnal') }}"><span class="fa fa-calendar-minus-o"></span> Jurnal</span></a></li> --}}

            <li class="treeview">
            <a href="#">
                <i class="fa fa-file-excel-o"></i>
                <span>Laporan</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                {{-- <li><a href="{{url('laporan/per-cust')}}"><i class="fa fa-circle-o"></i> Laporan Per Cust</a></li>
                <li><a href="{{url('laporan/per-paket')}}"><i class="fa fa-circle-o"></i> Laporan Per Paket</a></li>
                <li><a href="{{url('laporan/per-karyawan')}}"><i class="fa fa-circle-o"></i> Laporan Per Karyawan</a></li> --}}
                <li><a href="{{url('laporan/pengiriman')}}"><i class="fa fa-circle-o"></i> Laporan Pengiriman</a></li>
            </ul>
            </li>



        <li class="header">OTHER</li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-plug"></i>
            <span>Roles & Permissions</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('admin/role')}}"><i class="fa fa-circle-o"></i> Master Role</a></li>
            <li><a href="{{url('admin/permissions')}}"><i class="fa fa-circle-o"></i> Master Permissions</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-gears"></i>
            <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('change-password')}}"><i class="fa fa-circle-o"></i> Change Password</a></li>
            <!-- <li><a href="{{url('wa-template')}}"><i class="fa fa-circle-o"></i> Wa Token</a></li> -->
            <li><a href="{{url('profile-comp')}}"><i class="fa fa-circle-o"></i> Company Profile</a></li>
          </ul>
        </li>
        @endif

        <!-- <li class="menu-sidebar"><a href="{{ url('/update-profile') }}"><span class="glyphicon glyphicon-log-out"></span> Update Profile</span></a></li> -->

        <li class="menu-sidebar"><a href="{{ url('/keluar') }}"><span class="glyphicon glyphicon-log-out"></span> Logout</span></a></li>


      </ul>
    </section>
