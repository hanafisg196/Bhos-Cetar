<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    {{ timeMachine() }}
    <style>
        .email-user-list {
            overflow-y: scroll !important;
        }
    </style>
    <div class="app-content-overlay">
    </div>
    <div class="email-app-area">
        <div class="email-app-list-wrapper">
            <div class="email-app-list" style="margin-top: 15px;">
                <div class="email-action">
                    <div class="action-right d-flex flex-grow-1 align-items-center justify-content-around">
                        <div class="sidebar-toggle d-block d-lg-none">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-list fs-5"></i>
                            </button>
                        </div>
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
                        </div>
                        <!-- pagination and page countß -->

                        <div class="col-md-4">
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
                                <a href="{{ route('detail.aksi.ham', encrypt($item->id)) }}"
                                    {{-- wire:click.prevent="readInboxLah('{{ $item->id }}')" --}}

                                    class="d-flex align-items-center text-decoration-none text-dark w-100">
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
