<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="page-content" style="margin-top: -20px;">
      <section class="row d-flex justify-content-center">
          <div class="col-7 col-xl-7">
              <div class="card">
                  <div class="card-body">
                     <ul>
                        <h4>Pemberitahuan</h4>
                        <li class="dropdown-item notification-item">
                           @foreach ($data as $item)
                               @if (isset($item['schedules']))
                                   <a href="{{ route('show.bantuan.hukum', encrypt($item['schedules']->id)) }}">
                                       <div class="toast show mb-1" role="alert" aria-live="assertive" aria-atomic="true"
                                          style="width: 100%;{{ $item->notif_read == 1 ? 'background: rgb(226, 224, 224);' : '' }}"
                                          wire:click="readNotif({{ $item->id }})">
                                           <div class="toast-header">
                                               <i class="bi bi-envelope-fill me-3" style="font-size: 18px; color: #007aff; transform: translateY(-5px);"></i>
                                               <strong class="me-auto">{{ $item['schedules']->code }}</strong>
                                               <small>{{ $item->created_at->diffForHumans() }}</small>
                                           </div>
                                           <div class="toast-body">
                                               <p>Laporan dengan kode {{ $item['schedules']->code }} <strong style="color: {{ $item['schedules']->status == 'Disetujui' ? 'green' : 'red' }}">{{ $item['schedules']->status }}</strong>. <strong>Lihat</strong></p>
                                           </div>
                                       </div>
                                   </a>
                               @elseif (isset($item['ecorrections']))
                                   <a href="{{ route('ecorrection.show', encrypt($item['ecorrections']->id)) }}">
                                       <div class="toast show mb-1" role="alert" aria-live="assertive" aria-atomic="true"
                                        style="width: 100%;{{ $item->notif_read == 1 ? 'background: rgb(226, 224, 224);' : '' }}"
                                          wire:click="readNotif({{ $item->id }})">
                                           <div class="toast-header">
                                               <i class="bi bi-calendar2-check-fill me-3" style="font-size: 18px; color: #007aff; transform: translateY(-5px);"></i>
                                               <strong class="me-auto">{{ $item['ecorrections']->code }}</strong>
                                               <small>{{ $item->created_at->diffForHumans() }}</small>
                                           </div>
                                           <div class="toast-body">
                                               <p>Laporan dengan kode {{ $item['ecorrections']->code }} <strong style="color: {{ $item['ecorrections']->status == 'Disetujui' ? 'green' : 'red' }}">{{ $item['ecorrections']->status }}</strong>. <strong>Lihat</strong></p>
                                           </div>
                                       </div>
                                   </a>
                               @elseif (isset($item['ranhams']))
                                   <a href="{{ route('show.aksi.ham', encrypt($item['ranhams']->id)) }}">
                                       <div class="toast show mb-1" role="alert" aria-live="assertive" aria-atomic="true"
                                       style="width: 100%;{{ $item->notif_read == 1 ? 'background: rgb(226, 224, 224);' : '' }}"
                                          wire:click="readNotif({{ $item->id }})">
                                           <div class="toast-header">
                                               <i class="bi bi-folder-fill me-3" style="font-size: 18px; color: #007aff; transform: translateY(-5px);"></i>
                                               <strong class="me-auto">{{ $item['ranhams']->code }}</strong>
                                               <small>{{ $item->created_at->diffForHumans() }}</small>
                                           </div>
                                           <div class="toast-body">
                                               <p>Laporan dengan kode {{ $item['ranhams']->code }} <strong style="color: {{ $item['ranhams']->status == 'Disetujui' ? 'green' : 'red' }}">{{ $item['ranhams']->status }}</strong>. <strong>Lihat</strong></p>
                                           </div>
                                       </div>
                                   </a>
                               @endif
                           @endforeach
                        </li>
                        @if ($data->hasMorePages())
                        <div class="d-flex justify-content-center mt-2 mb-2">
                            <button wire:click="loadMore" class="btn btn-primary rounded-pill">Load More</button>
                        </div>
                        @endif
                     </ul>
                  </div>
              </div>
          </div>
      </section>
  </div>
</div>

<script>
   document.addEventListener('livewire:init', () => {
      Livewire.on('update-count', (event) => {
          console.log('yes i did it')
      });
   });
</script>
