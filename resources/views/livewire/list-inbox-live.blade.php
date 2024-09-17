<div>
{{timeMachine()}}
    {{-- In work, do what you enjoy. --}}
    <style>
        .email-user-list {
            overflow-y: scroll !important;
        }
    </style>

    <div class="app-content-overlay"></div>
    <div class="email-app-area">
        <div class="email-app-list-wrapper">
            <div class="email-app-list">
                <div class="email-action">

                    <div class="action-right d-flex flex-grow-1 align-items-center justify-content-around">
                        <div class="sidebar-toggle d-block d-lg-none">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-list fs-5"></i>
                            </button>
                        </div>

                        <div class="email-fixed-search flex-grow-1">
                            <div class="form-group position-relative  mb-0 has-icon-left">
                                <input wire:model.live.debounce.500ms="search" type="text" class="form-control"
                                    placeholder="Cari Laporan..">
                                <div class="form-control-icon">
                                    <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                        <use xlink:href="/dist/assets/static/images/bootstrap-icons.svg#search" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <!-- pagination and page countß -->
                        <span class="d-none d-sm-block">Usulan - {{ $this->counterSchedule() }}</span>
                    </div>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="table-tab" data-bs-toggle="tab" href="#tableContent" role="tab" aria-controls="tableContent" aria-selected="true">Laporan Bantuan Hukum</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="other-tab" data-bs-toggle="tab" href="#otherContent" role="tab" aria-controls="otherContent" aria-selected="false">Laporan Aksi Ham</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="tableContent" role="tabpanel" aria-labelledby="table-tab">
                     <div class="email-user-list list-group ps ps--active-y">
                        <ul class="users-list-wrapper media-list">
                            @foreach ($lbh as $item)
                                @if ($item->read == 1)
                                    <li class="media mail-read">
                                    @else
                                    <li class="media">
                                @endif
                                <a href="{{route('detail.bantuan.hukum',encrypt($item->id))}}" wire:click="readInboxLbh('{{ $item->id }}')"
                                    class="d-flex align-items-center text-decoration-none text-dark w-100">

                                    <div class="pr-50">
                                        <div class="avatar">
                                            <img src="/dist/assets/compiled/png/email.png" alt="avatar img holder">
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        <div class="user-details">
                                            <div class="mail-items">
                                                <span class="list-group-item-text text-truncate">{{ $item->email }}</span>
                                                @if ($item->status == 'Ditolak')
                                                <span class="list-group-item-text text-truncate"
                                                        style="color: red">{{ $item->status }}</span>
                                                @elseif ($item->status == 'Disetujui')
                                                <span class="list-group-item-text text-truncate"
                                                        style="color: green">{{ $item->status }}</span>
                                                @elseif ($item->status == 'Revisi')
                                                <span class="list-group-item-text text-truncate"
                                                        style="color: #007aff">{{ $item->status }}</span>
                                                @else
                                                <span class="list-group-item-text text-truncate"
                                                        style="color: burlywood">{{ $item->status }}</span>
                                                @endif

                                            </div>
                                            <div class="mail-meta-item">
                                                <span class="float-right">
                                                    <span class="mail-date">{{ $item->created_at->diffForHumans() }}</span>
                                                </span>
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
                                <div class="user-action" style="margin-left: 10px;">
                                    <div class="checkbox-con me-3">
                                        <div class="checkbox checkbox-shadow checkbox-sm">
                                            <button type="button" wire:click ="delete('{{ $item->id }}')"
                                                class="btn btn-icon action-icon" data-toggle="tooltip">
                                                <span class="fonticon-wrap">
                                                    <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                        <use xlink:href="/dist/assets/static/images/bootstrap-icons.svg#trash" />
                                                    </svg>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                </li>
                            @endforeach
                            @if ($lbh->hasMorePages())
                                <div class="d-flex justify-content-center mt-2">
                                    <button wire:click="loadMore" class="btn btn-primary rounded-pill">Load More</button>
                                </div>
                            @endif
                        </ul>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="otherContent" role="tabpanel" aria-labelledby="other-tab">
                        <div class="email-user-list list-group ps ps--active-y">
                            <ul class="users-list-wrapper media-list">
                                @foreach ($lah as $item)
                                    @if ($item->read == 1)
                                        <li class="media mail-read">
                                        @else
                                        <li class="media">
                                    @endif
                                    <a href="{{route('detail.aksi.ham',encrypt($item->id))}}" wire:click="readInboxLah('{{ $item->id }}')"
                                        class="d-flex align-items-center text-decoration-none text-dark w-100">

                                        <div class="pr-50">
                                            <div class="avatar">
                                                <img src="/dist/assets/compiled/png/folder.png" alt="avatar img holder">
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="user-details">
                                                <div class="mail-items">
                                                    <span class="list-group-item-text text-truncate">{{ $item->name }}</span>
                                                    @if ($item->status === 'Ditolak')
                                                        <span class="list-group-item-text text-truncate"
                                                            style="color: red">{{ $item->status }}</span>
                                                    @elseif ($item->status === 'Disetujui')
                                                        <span class="list-group-item-text text-truncate"
                                                            style="color: green">{{ $item->status }}</span>
                                                    @else
                                                        <span class="list-group-item-text text-truncate"
                                                            style="color: burlywood">{{ $item->status }}</span>
                                                    @endif

                                                </div>
                                                <div class="mail-meta-item">
                                                    <span class="float-right">
                                                        <span class="mail-date">{{ $item->created_at->diffForHumans()}}</span>
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
                                    <div class="user-action" style="margin-left: 10px;">
                                        <div class="checkbox-con me-3">
                                            <div class="checkbox checkbox-shadow checkbox-sm">
                                                <button type="button" wire:click ="delete('{{ $item->id }}')"
                                                    class="btn btn-icon action-icon" data-toggle="tooltip">
                                                    <span class="fonticon-wrap">
                                                        <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                            <use xlink:href="/dist/assets/static/images/bootstrap-icons.svg#trash" />
                                                        </svg>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    </li>
                                @endforeach
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
  @if (session()->has('status'))
        <script>
              document.addEventListener('livewire:navigated', () => {
            Toastify({
                text: "{{ session('status') }}",
                duration: 3000,
                close: true,
            }).showToast();
        })
        </script>
    @endif

