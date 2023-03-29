 <!--Start sidebar-wrapper-->
 <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
         <a href="index.html">
             <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
             <h5 class="logo-text">Dashtreme Admin</h5>
         </a>
     </div>
     <ul class="sidebar-menu do-nicescrol">
         <li class="sidebar-header">MAIN NAVIGATION</li>
         <li>
             <a href="{{ route('index') }}">
                 <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
             </a>
         </li>

         <li>
             <a href="{{ route('distributor') }}">
                 <i class="zmdi zmdi-invert-colors"></i> <span>Distributor</span>
             </a>
         </li>

         <li>
             <a href="{{ route('posisi') }}">
                 <i class="zmdi zmdi-format-list-bulleted"></i> <span>Posisi</span>
             </a>
         </li>

         <li>
             <a href="{{ route('pengeluaran') }}">
                 <i class="zmdi zmdi-grid"></i> <span>Pengeluaran</span>
             </a>
         </li>

         <li>
             <a href="{{ route('pemasukan') }}">
                 <i class="zmdi zmdi-calendar-check"></i> <span>Pemasukkan</span>
             </a>
         </li>

         <li>
             <a href="{{ route('penggajian') }}">
                 <i class="zmdi zmdi-face"></i> <span>Penggajian</span>
             </a>
         </li>
         <li>
             <a href="{{ route('penjab') }}">
                 <i class="zmdi zmdi-face"></i> <span>Penanggung Jawab</span>
             </a>
         </li>
         <li>
             <a href="{{ route('role') }}">
                 <i class="zmdi zmdi-face"></i> <span>Role</span>
             </a>
         </li>
     </ul>
 </div>
 <!--End sidebar-wrapper-->