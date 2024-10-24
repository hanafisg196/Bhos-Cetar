<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    {{ timeMachine() }}
    <style>
        .email-user-list {
            overflow-y: scroll !important;
        }
        .nav-link {
         margin-right: 20px;
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
                                  @if ($checkVerifikator === true)
                                  <a href="#" wire:click.prevent="filterByStatus('disposisiByVerifikator')"
                                  class="list-group-item position-relative pt-0 {{ $filter == 'disposisiByVerifikator' ? 'active' : '' }}">
                                   <div class="fonticon-wrap d-inline me-3"></div>
                                   Disposisi Anda
                                   <span class="badge bg-light-danger badge-pill badge-round position-absolute" style="right: 10px;">{{$allReadCount}}</span>
                                  </a>
                                  @endif
                                  <a href="#" wire:click.prevent="filterByStatus('usulan')"
                                     class="list-group-item position-relative pt-0 {{ $filter == 'usulan' ? 'active' : '' }}">
                                      <div class="fonticon-wrap d-inline me-3"></div>
                                      Usulan
                                      <span class="badge bg-light-{{$checkVerifikator === true ? 'primary' : 'danger' }} badge-pill badge-round position-absolute"
                                      style="right: 10px;">{{$usulanReadCount}}</span>
                                  </a>
                                  <a href="#" wire:click.prevent="filterByStatus('disposisi')"
                                     class="list-group-item position-relative pt-0 {{ $filter == 'disposisi' ? 'active' : '' }}">
                                      <div class="fonticon-wrap d-inline me-3"></div>
                                      Disposisi
                                      <span class="badge bg-light-primary badge-pill badge-round position-absolute" style="right: 10px;">{{$diposisiCount}}</span>
                                  </a>
                                  <a href="#" wire:click.prevent="filterByStatus('disetujui')"
                                     class="list-group-item position-relative pt-0 {{ $filter == 'disetujui' ? 'active' : '' }} ">
                                      <div class="fonticon-wrap d-inline me-3"></div>
                                      Disetujui
                                      <span class="badge bg-light-primary badge-pill badge-round position-absolute" style="right: 10px;">{{$disetujuiCount}}</span>
                                  </a>
                                  <a href="#" wire:click.prevent="filterByStatus('ditolak')"
                                     class="list-group-item position-relative pt-0 {{ $filter == 'ditolak' ? 'active' : '' }}">
                                      <div class="fonticon-wrap d-inline me-3"></div>
                                      Ditolak
                                      <span class="badge bg-light-primary badge-pill badge-round position-absolute" style="right: 10px;">{{$ditolakCount}}</span>
                                  </a>
                                  <a href="#" wire:click.prevent="filterByStatus('revisi')"
                                     class="list-group-item position-relative pt-0 {{ $filter == 'revisi' ? 'active' : '' }}">
                                      <div class="fonticon-wrap d-inline me-3"></div>
                                      Revisi
                                      <span class="badge bg-light-primary badge-pill badge-round position-absolute" style="right: 10px;">{{$revisiCount}}</span>
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
                                           <div class="email-fixed-search flex-grow-1">
                                               <div class="form-group position-relative  mb-0 has-icon-left">
                                                   <input wire:model.live.debounce.500ms="searchLah" type="text" class="form-control"
                                                       placeholder="Cari Bantuan..">
                                                   <div class="form-control-icon">
                                                       <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                           <use xlink:href="/dist/assets/static/images/bootstrap-icons.svg#search" />
                                                       </svg>
                                                   </div>
                                               </div>
                                               @if ($checkVerifikator === true && $activatedTab === true)
                                               <div class="nav nav-tabs mt-3" id="myTab" role="tablist">
                                                <a href="#" wire:click.prevent="filterByStatus('disposisiByVerifikator')"
                                                   class="nav-link {{ $filter == 'disposisiByVerifikator' ? 'active' : '' }}">
                                                    Diposisi
                                                    <span class="badge bg-light-danger badge-pill badge-round position-absolute" style="margin-left:5px;">{{$diposisiReadCountByVerifikator}}</span>
                                                </a>
                                                <a href="#" wire:click.prevent="filterByStatus('revisiByVerifikator')"
                                                 class="nav-link {{ $filter == 'revisiByVerifikator' ? 'active' : '' }}">
                                                 Revisi
                                                 <span class="badge bg-light-danger badge-pill badge-round position-absolute" style="margin-left:5px;">{{$revisiReadCountByVerifikator}}</span>
                                                </a>
                                                <a href="#" wire:click.prevent="filterByStatus('disetujuiByVerifikator')"
                                                   class="nav-link {{ $filter == 'disetujuiByVerifikator' ? 'active' : '' }}">
                                                    Disetujui
                                                    <span class="badge bg-light-primary badge-pill badge-round position-absolute" style="margin-left:5px;">{{$disetujuiCountByVerifikator}}</span>
                                                </a>
                                                <a href="#" wire:click.prevent="filterByStatus('ditolakByVerifikator')"
                                                   class="nav-link {{ $filter == 'ditolakByVerifikator' ? 'active' : '' }}">
                                                    Ditolak
                                                    <span class="badge bg-light-primary badge-pill badge-round position-absolute" style="margin-left:5px;">{{$ditolakCountByVerfikator}}</span>
                                                </a>
                                              </div>
                                              @endif
                                           </div>
                                           <!-- pagination and page countß -->
                                           @if ($checkVerifikator === true)
                                           <div class="col-md-4" style="margin-top: -54px;">
                                           @else
                                           <div class="col-md-4">
                                           @endif
                                               <div class="input-group">
                                                   <label class="input-group-text" for="inputGroupSelect01">Kategori</label>
                                                   <select wire:model.live.debounce.500ms="selectedCat" class="form-select"
                                                       id="inputGroupSelect01">
                                                       <option selected>Pilih...</option>
                                                       @foreach ($option as $val)
                                                           <option value="{{ $val->id }}">{{ $val->nama }}</option>
                                                       @endforeach
                                                   </select>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="email-user-list list-group ps ps--active-y">
                                       <ul class="users-list-wrapper media-list">
                                           @if ($lah->isNotEmpty())
                                               @foreach ($lah as $item)
                                                   @if ($item->read == 1)
                                                       <li class="media mail-read">
                                                       @else
                                                       <li class="media">
                                                   @endif
                                                   @if ($checkKabag === true)
                                                   <a href="{{ route('detail.aksi.ham', encrypt($item->id)) }}"
                                                      wire:click="readInboxLah('{{ $item->id }}')"
                                                      class="d-flex align-items-center text-decoration-none text-dark w-100">
                                                   @elseif (areYouVerifikator(encrypt($item->verifikator_nip)))
                                                   <a href="{{ route('detail.aksi.ham', encrypt($item->id)) }}"
                                                      wire:click="readInboxLah('{{ $item->id }}')"
                                                      class="d-flex align-items-center text-decoration-none text-dark w-100">
                                                   @else
                                                   <a class="d-flex align-items-center text-decoration-none text-dark w-100"
                                                   onclick="Swal.fire('Akses ditolak!',
                                                   'Anda tidak memiliki izin untuk mengakses halaman ini.', 'warning')">
                                                   @endif
                                                   <div class="pr-50">
                                                           <div class="avatar">
                                                               <img src="/dist/assets/compiled/png/folder.png" alt="avatar img holder">
                                                           </div>
                                                       </div>
                                                       <div class="media-body">
                                                           <div class="user-details">
                                                               <div class="mail-items">
                                                                   <span
                                                                       class="list-group-item-text text-truncate">{{ $item->name }}</span>
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
                                                                  <span class="float-right text-right">
                                                                      <div class="mail-date" style="padding-left: 120px;">{{ $item->created_at->diffForHumans() }}</div>
                                                                      <div class="text-right">{{ verifikatorProfile(encrypt($item->verifikator_nip))}}</div>
                                                                  </span>
                                                              </div>
                                                           </div>
                                                           <div class="mail-message">
                                                               <p class="list-group-item-text truncate mb-0">
                                                                   {{ trimString($item->link) }}
                                                               </p>
                                                               <div class="mail-meta-item">
                                                                   <span class="float-right">
                                                                       <span class="bullet bullet-success bullet-sm"></span>
                                                                   </span>
                                                               </div>
                                                           </div>
                                                       </div>
                                                   </a>
                                                   {{-- <div class="user-action" style="margin-left: 10px;">
                                               <div class="checkbox-con me-3">
                                                   <div class="checkbox checkbox-shadow checkbox-sm">
                                                       <button type="button" wire:click ="delete('{{ $item->id }}')"
                                                           class="btn btn-icon action-icon" data-toggle="tooltip">
                                                           <span class="fonticon-wrap">
                                                               <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                                   <use
                                                                       xlink:href="/dist/assets/static/images/bootstrap-icons.svg#trash" />
                                                               </svg>
                                                           </span>
                                                       </button>
                                                   </div>
                                               </div>
                                           </div> --}}
                                                   </li>
                                               @endforeach
                                           @else
                                               <div class="d-flex justify-content-center mt-5">Data tidak ditemukan.</div>
                                           @endif
                                           @if ($lah->hasMorePages())
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
