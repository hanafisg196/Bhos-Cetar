<div>
   {{-- Nothing in the world is as soft and yielding as water. --}}
   @if ($checkUploaderOne === true)
       <li class="sidebar-item {{ request()->is('laporan-aksi-ham') ? 'active' : '' }}" title="Laporan Aksi Ham">
           <a href="{{ route('ranham.home') }}" class='sidebar-link'>
               <i class="bi bi-card-checklist"></i>
               <span>Kami Peduli</span>
           </a>
       </li>
   @endif
   @if ($checkUploaderTwo === true)
       <li class="sidebar-item {{ request()->is('ecorrection') ? 'active' : '' }}">
           <a href="{{ route('ecorrection') }}" class='sidebar-link'>
               <i class="bi bi-clipboard-check-fill"></i>
               <span>E-Corection</span>
           </a>
       </li>
   @endif


</div>
