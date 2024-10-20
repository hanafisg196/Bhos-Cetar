<div>
   {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
   {{ timeMachine() }}
   <style>
       .email-user-list {
           overflow-y: scroll !important;
       }
   </style>
     <div class="page-heading email-application overflow-hidden" style="margin-top:-20px; ">
        <section class="section content-area-wrapper">
            <div class="content-right" style="width: 120%">
                <div class="content-overlay">
                </div>
                <div class="content-wrapper">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                       <div class="email-app-area">
                          <div class="email-app-list-wrapper">
                              <div class="email-app-list" style="margin-top: 15px;">
                                  <div class="email-action">
                                      <div class="action-right d-flex flex-grow-1 align-items-center justify-content-around">
                                          <div class="email-fixed-search flex-grow-1">
                                             <div class="form-group position-relative  mb-0 has-icon-left">
                                                <input wire:model.live.debounce.500ms="searchEcor" type="text" class="form-control"
                                                    placeholder="Cari.....">
                                                <div class="form-control-icon">
                                                    <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                        <use xlink:href="/dist/assets/static/images/bootstrap-icons.svg#search" />
                                                    </svg>
                                                </div>
                                            </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="email-user-list list-group ps ps--active-y">
                                      <ul class="users-list-wrapper media-list">
                                       @if ($data->isNotEmpty())
                                       @foreach ($data as $item)
                                       @if ($item->read == 1)
                                       <li class="media mail-read">
                                         @else
                                       <li class="media">
                                        @endif
                                          <a href="{{route('detail.ecorrection', encrypt($item->id))}}" class="d-flex align-items-center
                                          text-decoration-none text-dark w-100" wire:click="readStat({{$item->id}})">
                                             <div class="pr-50">
                                                 <div class="avatar">
                                                     <img src="/dist/assets/compiled/png/document.png" alt="avatar img holder">
                                                 </div>
                                             </div>
                                             <div class="media-body">
                                                 <div class="user-details">
                                                     <div class="mail-items">
                                                      <span class="list-group-item-text text-truncate">{{ $item->nama }}</span>
                                                      @if ($item->status == 'Ditolak')
                                                      <span class="list-group-item-text text-truncate"
                                                          style="color: red">{{ $item->status }}</span>
                                                  @elseif ($item->status == 'Disetujui')
                                                      <span class="list-group-item-text text-truncate"
                                                          style="color: green">{{ $item->status }}</span>
                                                  @elseif ($item->status == 'Revisi')
                                                      <span class="list-group-item-text text-truncate"
                                                          style="color: #007aff">{{ $item->status }}</span>
                                                  @elseif ($item->status == 'Disposisi')
                                                      <span class="list-group-item-text text-truncate"
                                                            style="color: #ea27dd">{{ $item->status }}</span>
                                                  @else
                                                      <span class="list-group-item-text text-truncate"
                                                         style="color: burlywood">{{ $item->status }}</span>
                                                  @endif
                                                     </div>
                                                     <div class="mail-meta-item">
                                                      <span class="float-right">
                                                      <span
                                                              class="mail-date">{{ $item->created_at->diffForHumans() }}</span>
                                                      </span>
                                                  </div>
                                                 </div>
                                                 <div class="mail-message">
                                                     <p class="list-group-item-text truncate mb-0">
                                                         {{ trimString($item->title) }}
                                                     </p>
                                                     <div class="mail-meta-item">
                                                         <span class="float-right">
                                                             <span class="bullet bullet-success bullet-sm"></span>
                                                         </span>
                                                     </div>
                                                 </div>
                                             </div>
                                         </a>
                                       </li>
                                       @endforeach
                                       @else
                                       <div class="d-flex justify-content-center mt-5">Data tidak ditemukan.</div>
                                       @endif
                                       @if ($data->hasMorePages())
                                       <div class="d-flex justify-content-center mt-2">
                                           <button wire:click="loadMore" class="btn btn-primary rounded-pill">Load More</button>
                                       </div>
                                       @endif
                                      </ul>
                                  </div>

                              </div>
                          </div>
                      </div>

                    </div>
                </div>
            </div>
        </section>
     </div>
@if (session()->has('status'))
       <script>
           document.addEventListener('livewire:navigated', () => {
               Toastify({
                   text: "{{ session('status') }}",
                   duration: 3000,
                   close: true,
               }).showToast();
           }, {
               once: true
           })
       </script>
   @endif
</div>
