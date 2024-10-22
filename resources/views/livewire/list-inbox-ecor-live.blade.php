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
         <div class="sidebar-left" style="height: 60vh;">
            <div class="sidebar">
                <div class="sidebar-content email-app-sidebar d-flex">
                    <!-- sidebar close icon -->
                    <span class="sidebar-close-icon">
                        <i class="bi bi-x"></i>
                    </span>
                    <!-- sidebar close icon -->
                    <div class="email-app-menu">
                        <div class="form-group form-group-compose">
                            <!-- compose button  -->
                            {{-- <button type="button" class="btn btn-primary btn-block my-4 compose-btn">
                                <i class="bi bi-plus"></i>
                                Compose
                            </button> --}}
                        </div>
                        <div class="sidebar-menu-list ps">
                           <!-- sidebar menu  -->
                           <div class="list-group list-group-messages mt-5">
                               <a href="#" wire:click.prevent="filterByStatus('all')"
                                  class="list-group-item position-relative pt-0 {{ $filter == 'all' ? 'active' : '' }}"
                                  id="inbox-menu">
                                   <div class="fonticon-wrap d-inline me-3"></div>
                                   Semua
                                   <span class="badge bg-light-primary badge-pill badge-round position-absolute" style="right: 10px;">5</span>
                               </a>
                               <a href="#" wire:click.prevent="filterByStatus('usulan')"
                                  class="list-group-item position-relative pt-0 {{ $filter == 'usulan' ? 'active' : '' }}">
                                   <div class="fonticon-wrap d-inline me-3"></div>
                                   Usulan
                                   <span class="badge bg-light-primary badge-pill badge-round position-absolute" style="right: 10px;">5</span>
                               </a>
                               <a href="#" wire:click.prevent="filterByStatus('disposisi')"
                                  class="list-group-item position-relative pt-0 {{ $filter == 'disposisi' ? 'active' : '' }}">
                                   <div class="fonticon-wrap d-inline me-3"></div>
                                   Disposisi
                                   <span class="badge bg-light-primary badge-pill badge-round position-absolute" style="right: 10px;">5</span>
                               </a>
                               <a href="#" wire:click.prevent="filterByStatus('disetujui')"
                                  class="list-group-item position-relative pt-0 {{ $filter == 'disetujui' ? 'active' : '' }}">
                                   <div class="fonticon-wrap d-inline me-3"></div>
                                   Disetujui
                                   <span class="badge bg-light-primary badge-pill badge-round position-absolute" style="right: 10px;">5</span>
                               </a>
                               <a href="#" wire:click.prevent="filterByStatus('ditolak')"
                                  class="list-group-item position-relative pt-0 {{ $filter == 'ditolak' ? 'active' : '' }}">
                                   <div class="fonticon-wrap d-inline me-3"></div>
                                   Ditolak
                                   <span class="badge bg-light-primary badge-pill badge-round position-absolute" style="right: 10px;">5</span>
                               </a>
                               <a href="#" wire:click.prevent="filterByStatus('revisi')"
                                  class="list-group-item position-relative pt-0 {{ $filter == 'revisi' ? 'active' : '' }}">
                                   <div class="fonticon-wrap d-inline me-3"></div>
                                   Revisi
                                   <span class="badge bg-light-primary badge-pill badge-round position-absolute" style="right: 10px;">5</span>
                               </a>
                           </div>
                           <!-- sidebar menu end -->
                       </div>

                    </div>
                </div>
            </div>
        </div>
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
                                       <div class="sidebar-toggle d-block d-lg-none">
                                          <button class="btn btn-sm btn-outline-primary">
                                              <i class="bi bi-list fs-5" ></i>
                                          </button>
                                       </div>
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
                                                      <div class="mail-meta-item">
                                                         <span class="float-right text-right">
                                                             <div class="mail-date" style="padding-left: 120px;">{{ $item->created_at->diffForHumans() }}</div>
                                                             <div>{{ verifikatorProfile(encrypt($item->verifikator_nip)) }}</div>
                                                         </span>
                                                     </div>


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
                                       <div class="d-flex justify-content-center mt-2 mb-2">
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
