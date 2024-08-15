<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
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

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <section class="section" style="max-height: 650px;
    overflow-y: scroll; scrollbar-width: none;
     -ms-overflow-style: none;">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="card-body py-1">
                        <div class="collapse-title media">
                            <div class="pr-1">
                                <div class="avatar me-3">
                                    <img src="/assets/compiled/jpg/8.jpg" alt="avtar img holder"
                                    width="30" height="30">
                                </div>
                            </div>
                            <div class="media-body mt-25">
                                <span class="text-primary">{{ $data->nama }}</span>
                                <span class="d-sm-inline d-none">&lt;Status - {{ $data->status }}&gt;</span>
                                <small class="text-muted d-block">to Bhos Ce-Tar System</small>
                            </div>
                        </div>
                        <p class="text-bold-500">Nip : {{ $data->nama }}</p>
                        <p class="text-bold-500">Nama : {{ $data->nip }}</p>
                        <p class="text-bold-500">Email : {{ $data->email }}</p>
                        <p class="text-bold-500">Whatsapp : {{ $data->wa }}</p>
                        <p class="text-bold-500">Alamat : {{ $data->alamat }}</p>
                        <p class="text-bold-500">Kronologi</p>
                        <p>
                            {{ $data->kronologi }}
                        </p>

                    </div>
                    <label class="sidebar-label">Lampiran</label>
                    @foreach ($data['dokumens'] as $item)
                    <ul class="list-unstyled mb-2">
                        <li class="cursor-pointer pb-25">
                            @if (str_contains($item->file ,'pdf'))
                            <img src="/assets/compiled/png/pdf.png" height="32">
                            @else
                            <img src="/assets/compiled/png/img.png" height="30">
                            @endif
                            <small class="text-muted ms-1 attchement-text">{{ $this->sliceStr($item->file ) }}</small>
                            <button wire:click="download('{{ $item->file }}')" class="btn icon btn-primary">
                                <i class="bi bi-download"></i>
                            </button>
                        </li>
                    </ul>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

</div>
