

@extends('admin.component.main')
@section('content')
    {{-- In work, do what you enjoy. --}}
    <style>
        .email-user-list {
        overflow-y: scroll !important;
    }
    </style>
    @php
         function stringReplace($string)
    {
        $words = explode(' ', $string);
        $limit = 9;
        $replace = '....';
        $setence = (count($words) > $limit) ? implode(' ', array_slice($words, 0, $limit)).$replace : $string;
        return $setence;
    }
    @endphp
      <div class="app-content-overlay"></div>
      <div class="email-app-area">

          <div class="email-app-list-wrapper">
              <div class="email-app-list">
                  <div class="email-action">

                      <div
                          class="action-right d-flex flex-grow-1 align-items-center justify-content-around">
                          <div class="sidebar-toggle d-block d-lg-none">
                              <button class="btn btn-sm btn-outline-primary">
                                  <i class="bi bi-list fs-5" ></i>
                              </button>
                          </div>

                          <div class="email-fixed-search flex-grow-1">
                              <div class="form-group position-relative  mb-0 has-icon-left">
                                  <input wire:model.live.debounce.500ms="search" type="text" class="form-control" placeholder="Search report..">
                                  <div class="form-control-icon">
                                      <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                          <use
                                              xlink:href="/assets/static/images/bootstrap-icons.svg#search" />
                                      </svg>
                                  </div>
                              </div>
                          </div>
                          <!-- pagination and page count -->
                          {{-- <span class="d-none d-sm-block">Pending - {{ $this->counterPending() }}</span> --}}
                      </div>
                  </div>
                  <div class="email-user-list list-group ps ps--active-y">
                    <ul class="users-list-wrapper media-list">
                        @foreach ($data as $item)
                        @if ($item->read == 1)
                        <li class="media mail-read">
                        @else
                        <li class="media">
                        @endif
                            <a href="/schedule/detail/{{ $item->id }}"
                                 class="d-flex align-items-center text-decoration-none text-dark w-100">

                                <div class="pr-50">
                                    <div class="avatar">
                                        <img src="assets/compiled/png/mail.png" alt="avatar img holder">
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div class="user-details">
                                        <div class="mail-items">
                                            <span class="list-group-item-text text-truncate">{{ $item->email }}</span>
                                            @if ($item->status == 'Ditolak')
                                            <span class="list-group-item-text text-truncate" style="color: red">{{ $item->status }}</span>
                                            @elseif ($item->status == 'Diproses')
                                            <span class="list-group-item-text text-truncate" style="color: green">{{ $item->status }}</span>
                                            @else
                                            <span class="list-group-item-text text-truncate" style="color: burlywood">{{ $item->status }}</span>
                                            @endif

                                        </div>
                                        <div class="mail-meta-item">
                                            <span class="float-right">
                                                <span class="mail-date">{{ $item->created_at->format('H:i') }}</span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mail-message">
                                        <p class="list-group-item-text truncate mb-0">
                                          {{stringReplace($item->kronologi)}}
                                        </p>
                                        <div class="mail-meta-item">
                                            <span class="float-right">
                                                <span class="bullet bullet-success bullet-sm"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="user-action" style="margin-left: 10px;">
                                <div class="checkbox-con me-3">
                                    <div class="checkbox checkbox-shadow checkbox-sm">
                                        <button type="button" wire:click ="delete('{{ $item->id }}')"  class="btn btn-icon action-icon" data-toggle="tooltip">
                                            <span class="fonticon-wrap">
                                                <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                    <use xlink:href="assets/static/images/bootstrap-icons.svg#trash" />
                                                </svg>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
                        {{-- @endforeach --}}
                        {{-- @if($report->hasMorePages())
                        <div class="d-flex justify-content-center mt-2">
                            <button  wire:click="loadMore" class="btn btn-primary rounded-pill">Load More</button>
                        </div>
                         @endif --}}
                         @endforeach
                    </ul>
                </div>


              </div>
          </div>

      </div>

      @endsection






