<div>
    {{ timeMachine() }}
    <style>
        .email-user-list {
            overflow-y: scroll !important;
        }
        .nav-link {
         margin-right: 20px;
        }
    </style>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
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
                               @if ($checkVerifikatorOne === true)
                               <a href="#" wire:click.prevent="filterByStatus('disposisiVerifikator')"
                               class="list-group-item position-relative pt-0 {{ $filter == 'disposisiVerifikator' ? 'active' : '' }}">
                                <div class="fonticon-wrap d-inline me-3"></div>
                                Disposisi Anda
                                <span class="badge bg-light-danger badge-pill badge-round position-absolute" style="right: 10px;">{{$allReadCount}}</span>
                               </a>
                               @endif
                               <a href="#" wire:click.prevent="filterByStatus('usulan')"
                                  class="list-group-item position-relative pt-0 {{ $filter == 'usulan' ? 'active' : '' }}">
                                   <div class="fonticon-wrap d-inline me-3"></div>
                                   Usulan
                                   <span class="badge bg-light-{{$checkKabag === true ? 'danger' : 'primary'}} badge-pill badge-round position-absolute"
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
                                                <input wire:model.live="searchLbh" type="text" class="form-control"
                                                placeholder="Cari berdasarakan nama, nip atau kode">
                                                <div class="form-control-icon">
                                                    <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                        <use xlink:href="/dist/assets/static/images/bootstrap-icons.svg#search" />
                                                    </svg>
                                                </div>
                                            </div>
                                            @if ($checkVerifikatorOne === true && $activatedTab === true)
                                            <div class="nav nav-tabs mt-3" id="myTab" role="tablist">
                                             <a href="#" wire:click.prevent="filterByStatus('disposisiVerifikator')"
                                                class="nav-link {{ $filter == 'disposisiVerifikator' ? 'active' : '' }}">
                                                 Diposisi
                                                 <span class="badge bg-light-danger badge-pill badge-round position-absolute" style="margin-left:5px;">{{$diposisiReadCountByVerifikator}}</span>
                                             </a>
                                             <a href="#" wire:click.prevent="filterByStatus('diperbaikiToVerifikator')"
                                              class="nav-link {{ $filter == 'diperbaikiToVerifikator' ? 'active' : '' }}">
                                              Diperbaiki
                                              <span class="badge bg-light-danger badge-pill badge-round position-absolute" style="margin-left:5px;">{{$diperbaikiReadCountTpVerifikator}}</span>
                                             </a>
                                             <a href="#" wire:click.prevent="filterByStatus('disetujuiVerifikator')"
                                                class="nav-link {{ $filter == 'disetujuiVerifikator' ? 'active' : '' }}">
                                                 Disetujui
                                                 <span class="badge bg-light-primary badge-pill badge-round position-absolute" style="margin-left:5px;">{{$disetujuiCountByVerifikator}}</span>
                                             </a>
                                             <a href="#" wire:click.prevent="filterByStatus('ditolakVerifikator')"
                                                class="nav-link {{ $filter == 'ditolakVerifikator' ? 'active' : '' }}">
                                                 Ditolak
                                                 <span class="badge bg-light-primary badge-pill badge-round position-absolute" style="margin-left:5px;">{{$ditolakCountByVerfikator}}</span>
                                             </a>
                                           </div>
                                           @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="email-user-list list-group ps ps--active-y">
                                    <ul class="users-list-wrapper media-list">
                                       @if (!empty($lbh))
                                            @foreach ($lbh as $item)
                                                @if ($item->read == 1)
                                                    <li class="media mail-read">
                                                    @else
                                                    <li class="media">
                                                @endif
                                                @if ($checkKabag === true)
                                                <a href="{{ route('detail.bantuan.hukum', encrypt($item->id)) }}" wire:navigate
                                                   wire:click.prevent="readInboxLbh('{{ $item->id }}')"
                                                   class="d-flex align-items-center text-decoration-none text-dark w-100">
                                                @elseif (areYouVerifikator(encrypt($item->verifikator_nip)))
                                                <a href="{{ route('detail.bantuan.hukum', encrypt($item->id)) }}" wire:navigate
                                                   wire:click.prevent="readInboxLbh('{{ $item->id }}')"
                                                   class="d-flex align-items-center text-decoration-none text-dark w-100">
                                                @else
                                                <a class="d-flex align-items-center text-decoration-none text-dark w-100"
                                                onclick="Swal.fire('Akses ditolak!',
                                                 'Anda tidak memiliki izin untuk mengakses halaman ini.', 'warning')">
                                                @endif
                                                    <div class="pr-50">
                                                        <div class="avatar">
                                                            <img src="/dist/assets/compiled/png/email.png" alt="avatar img holder">
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="user-details">
                                                            <div class="mail-items">
                                                                <span
                                                                    class="list-group-item-text text-truncate">{{ $item->email }}</span>
                                                                @if ($item->status == 'Ditolak')
                                                                    <span class="list-group-item-text text-truncate"
                                                                        style="color: red">{{ $item->status }}</span>
                                                                @elseif ($item->status == 'Disetujui')
                                                                    <span class="list-group-item-text text-truncate"
                                                                        style="color: green">{{ $item->status }}</span>
                                                                @elseif ($item->status == 'Revisi')
                                                                    <span class="list-group-item-text text-truncate"
                                                                        style="color: red">{{ $item->status }}</span>
                                                                @elseif ($item->status == 'Disposisi')
                                                                    <span class="list-group-item-text text-truncate"
                                                                        style="color: #ea27dd">{{ $item->status }}</span>
                                                                @else
                                                                    <span class="list-group-item-text text-truncate"
                                                                        style="color: burlywood">{{ $item->status }}</span>
                                                                @endif

                                                            </div>
                                                        </div>
                                                        <div class="mail-message">
                                                            <p class="list-group-item-text truncate mb-0">
                                                                {{ trimString($item->kronologi) }}
                                                            </p>
                                                            <div class="mail-meta-item">
                                                                <span class="float-right">
                                                                    <span class="bullet bullet-success bullet-sm"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <div class="mail-meta-item d-flex flex-column align-items-end text-right" style="font-size: 0.3rem;white-space: nowrap;">
                                                   <div class="mail-date" style="">{{ $item->created_at->diffForHumans() }}</div>
                                                   <div class="mail-date" style="color: #007aff">{{ verifikatorProfile(encrypt($item->verifikator_nip)) }}</div>
                                                   <div class="mail-date" style="color: #000000">
                                                      @if ($item->special_message)
                                                      Pesan Khusus - {{$item->special_message}}
                                                      @endif
                                                   </div>
                                                   <div class="mail-date">
                                                       <button class="btn btn-sm btn-primary" style="font-size: 0.7rem" data-bs-toggle="modal" data-bs-target="#modal-{{ $item->id }}">
                                                           Lacak
                                                       </button>
                                                   </div>
                                               </div>
                                                </li>
                                               <div wire:ignore.self class="modal fade text-left"  id="modal-{{ $item->id }}" tabindex="-1" role="dialog"
                                                   aria-labelledby="myModalLabel1" aria-hidden="true">
                                                   <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                       <div class="modal-content">
                                                           <div class="modal-header">
                                                               <h5 class="modal-title" id="myModalLabel1">Pelacakan Status</h5>
                                                               <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                                                   <i data-feather="x"></i>
                                                               </button>
                                                           </div>
                                                           <div class="modal-body">
                                                            @foreach ($item['trackingPoints'] as $track)
                                                            <div class="card mb-1">
                                                                <div class="card-body">
                                                                  @if ($track->nama_pemohon)
                                                                  <p class="mb-1"><strong>Pemohon - {{$track->nama_pemohon}}</strong> </p>
                                                                  @elseif ($track->status === 'Disposisi')
                                                                  <p style="margin-bottom: -3px;">Di dispoisikan oleh Kabag Hukum - <strong>{{$track->nama_kabag}}</strong></p>
                                                                  <p class="mb-1">Kepada <strong>Pemeriksa - {{$track->nama_pemeriksa}}</strong> </p>
                                                                  @else
                                                                  <p class="mb-1"><strong>Pemeriksa - {{$track->nama_pemeriksa}}</strong> </p>
                                                                  @endif
                                                                    <h6 class="card-title">Status: {{ $track->status }}</h6>
                                                                    <p class="text-muted mb-0"><small>{{ $track->created_at->diffForHumans() }}</small></p>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                           </div>
                                                           <div class="modal-footer">
                                                               <button type="button" class="btn" data-bs-dismiss="modal">
                                                                   <i class="bx bx-x d-block d-sm-none"></i>
                                                                   <span class="d-none d-sm-block">Tutup</span>
                                                               </button>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>
                                            @endforeach
                                        @else
                                        <div class="d-flex justify-content-center mt-5">Data tidak ditemukan.</div>
                                        @endif
                                        @if ($lbh->hasMorePages())
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

