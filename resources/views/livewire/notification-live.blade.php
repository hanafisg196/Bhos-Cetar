<div>
    {{timeMachine()}}
    {{-- Stop trying to control. --}}
    {{-- <ul> --}}
      <li class="nav-item dropdown me-3">
         <a class="nav-link active dropdown-toggle text-gray-600" href="#" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
             <i class='bi bi-bell bi-sub fs-4'></i>
             <span class="badge badge-notification bg-danger">{{$this->countNotif}}</span>
         </a>
         <ul class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="dropdownMenuButton">
             <li class="dropdown-header">
                 <h6>Notifikasi</h6>
             </li>
             <li class="dropdown-item notification-item" style="margin-top: -10px;overflow-y: scroll; max-height: 400px; overflow-x: hidden;">
                 @foreach ($data as $item)
                 @if ($item['schedules'])
                 <a href="{{route('show.bantuan.hukum', encrypt($item['schedules']->id))}}" wire:click="readNotif({{$item->id}})">
                     @if ($item->notif_read == 1)
                     <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" style="background: rgb(226, 224, 224);">
                      @else
                      <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                     @endif
                     <div class="toast-header">
                         <i class="bi bi-envelope-fill me-3" style="font-size: 18px; color: #007aff;transform: translateY(-5px);"></i>
                         <strong class="me-auto">{{$item['schedules']->code}}</strong>
                         <small>{{$item->created_at->diffForHumans();}}</small>
                     </div>
                     <div class="toast-body">
                        <p>Laporan dengan kode {{$item['schedules']->code}} <strong style="color:{{ $item['schedules']->status == 'Disetujui' ? 'green' : 'red' }} ">{{$item['schedules']->status}}</strong>. <strong>Lihat</strong></p>
                     </div>
                  </div>
                 </a>
                 @elseif($item['ecorrections'])
                 <a href="{{route('ecorrection.show', encrypt($item['ecorrections']->id))}}" wire:click="readNotif({{$item->id}})" >
                     @if ($item->notif_read == 1)
                     <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" style="background: rgb(226, 224, 224);">
                      @else
                      <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                     @endif
                     <div class="toast-header">
                         <i class="bi bi-folder-fill me-3" style="font-size: 18px; color: #007aff;transform: translateY(-5px);"></i>
                         <strong class="me-auto">{{$item['ecorrections']->code}}</strong>
                         <small>{{$item->created_at->diffForHumans();}}</small>
                     </div>
                     <div class="toast-body">
                        <p>Laporan dengan kode {{$item['ecorrections']->code}} <strong style="color:{{ $item['ecorrections']->status == 'Disetujui' ? 'green' : 'red' }} ">{{$item['ecorrections']->status}}</strong>. <strong>Lihat</strong></p>
                     </div>
                 </div>
                 </a>
                 @else
                 <a href="{{route('show.aksi.ham', encrypt($item['ranhams']->id))}}" wire:click="readNotif({{$item->id}})">
                     @if ($item->notif_read == 1)
                     <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true" style="background: rgb(226, 224, 224);">
                      @else
                      <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                     @endif
                     <div class="toast-header">
                         <i class="bi bi-folder-fill me-3" style="font-size: 18px; color: #007aff;transform: translateY(-5px);"></i>
                         <strong class="me-auto">{{$item['ranhams']->code}}</strong>
                         <small>{{$item->created_at->diffForHumans();}}</small>
                     </div>
                     <div class="toast-body">
                        <p>Laporan dengan kode {{$item['ranhams']->code}} <strong style="color:{{ $item['ranhams']->status == 'Disetujui' ? 'green' : 'red' }} ">{{$item['ranhams']->status}}</strong>. <strong>Lihat</strong></p>
                     </div>
                 </div>
                 </a>
                 @endif
                 @endforeach
             </li>
             <li>
                 <p class="text-center py-2 mb-0"><a href="#">Semua</a></p>
             </li>
         </ul>
     </li>
    {{-- </ul> --}}

</div>
