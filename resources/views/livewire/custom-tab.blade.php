<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
@if ($checkUploaderOne === true)
<li class="nav-item" role="presentation">
   <a class="nav-link" id="table-lah" data-bs-toggle="tab" href="#tableLah" role="tab" aria-controls="tableLah" aria-selected="false">Laporan Aksi Ham</a>
</li>
@endif
@if ($checkUploaderTwo === true)
<li class="nav-item" role="presentation">
   <a class="nav-link" id="table-ecor" data-bs-toggle="tab" href="#tableEcor" role="tab" aria-controls="tableEcor" aria-selected="false">Ecorrections</a>
</li>

@endif
</div>
