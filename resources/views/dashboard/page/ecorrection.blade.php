@extends('dashboard.template.main')
@section('content')
{{ timeMachine() }}
    @if ($errors->any())
        <div class="d-flex justify-content-center">
            <div class="alert alert-danger alert-dismissible show fade col-12 col-md-10">
                <p> Gagal Menambahkan Rule</p>
                @foreach ($errors->all() as $error)
                    <div class="invalid-feedback d-block" style="color: white;">
                        {{ $error }}
                    </div>
                @endforeach
                <button type="button" class="btn-close" style="color: white" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        </div>
    @endif
    <div class="page-content">
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-10"  id="page" style="display: none;">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">E-corrections</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="list-ecor" data-bs-toggle="tab" href="#listEcor"
                                            role="tab" aria-controls="list" aria-selected="true">List data</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link " id="form-ecor" data-bs-toggle="tab" href="#formEcor"
                                            role="tab" aria-controls="form" aria-selected="true">Buat baru</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="listEcor" role="tabpanel"
                                        aria-labelledby="table-tab">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-lg">
                                                <thead>
                                                    <tr>
                                                        <th>Waktu</th>
                                                        <th>Kode</th>
                                                        <th>Status</th>
                                                        <th>Judul</th>
                                                        <th>File</th>
                                                        <th>Lihat</th>
                                                    </tr>
                                                    @foreach ($ecor as $item)
                                                <tbody>
                                                    <tr style="padding: 0;">
                                                        <td class="col-auto" style="padding: 5px;">
                                                            <p class="mb-0" style="margin: 0;">
                                                                {{ $item->created_at->diffForHumans() }}</p>
                                                        </td>
                                                        <td class="col-auto" style="padding: 5px;">
                                                            <p class="mb-0" style="margin: 0;">{{ $item->code }}</p>
                                                        </td>
                                                        <td class="col-auto" style="padding: 5px;">
                                                            <p class="mb-0"
                                                                style="margin: 0;color:
                                                            {{ $item->status === 'Disetujui' ? 'green' : ($item->status === 'Ditolak' || $item->status === 'Revisi' ? 'red' : 'orange') }}">
                                                                {{ $item->status }}
                                                            </p>
                                                        </td>
                                                        <td class="col-auto" style="padding: 5px;">
                                                            <p class="mb-0" style="margin: 0;">{{cutLink($item->title)}}</p>
                                                        </td>
                                                        <td class="col-auto" style="padding: 5px;">
                                                            @foreach ($item['dokumens'] as $files)
                                                                <p class="mb-0" style="margin: 0;">
                                                                    {{ strCut($files->file) }}
                                                                </p>
                                                            @endforeach
                                                        </td>
                                                        <td class="col-auto" style="padding: 5px;">
                                                            <a class="btn icon btn-primary ms-3" data-bs-toggle="modal"
                                                                data-bs-target="#modal-{{ $files->id }}">
                                                                <i class="bi bi-eye-fill"></i>
                                                            </a>
                                                            <a class="btn icon btn-primary ms-3" data-bs-toggle="modal"
                                                                data-bs-target="#modals-{{ $item->id }}">
                                                                <i class="bi bi-info-circle"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <div class="modal fade" id="modal-{{ $files->id }}" tabindex="-1"
                                                    role="dialog"
                                                    aria-labelledby="exampleModalScrollableTitle-{{ $files->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-scrollable " role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                                    Detail Data</h5>
                                                                <button type="button" class="close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="d-flex justify-content-center mt-3">
                                                                    <iframe src="{{ asset('storage/' . $files->file) }}"
                                                                        style="width:718px; height:700px;" title="doc"
                                                                        name="contents"></iframe>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Close</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @include('dashboard.component.modal-tracking-point')
                                                @endforeach
                                                </thead>
                                            </table>
                                            {{ $ecor->links() }}
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="formEcor" role="tabpanel"
                                        aria-labelledby="table-tab">
                                        <form class="form" action="{{ route('ecorrection.create') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mt-4 ms-2">
                                                <div class="col-md-8 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Judul</label>
                                                        <input type="text" id="last-name-column"
                                                            class="form-control @error('judul') is-invalid @enderror"
                                                            value="{{ old('judul') }}"
                                                            placeholder="Judul Surat atau Dokumen.." name="judul">
                                                        @error('judul')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email-id-column">Dokumen</label>
                                                        <input type="file" class="filepond" name="file"
                                                            id="file" multiple data-allow-reorder="true"
                                                            data-max-file-size="5MB" data-max-files="1"
                                                            accept="application/pdf, application/msword,
                                                   application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button style="display: none" id="loading" class="btn btn-primary"
                                                        type="button" disabled>
                                                        <span class="spinner-border spinner-border-sm" role="status"
                                                            aria-hidden="true"></span>
                                                        Loading...
                                                    </button>
                                                    <button style="display: block" id="send" type="submit"
                                                        class="btn btn-primary me-1 mb-1">Kirim</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('dashboard.component.tab-active-session')
        </section>
        @include('placeholder.page-loader')
    </div>
    @include('dashboard.component.button-loading')
    @include('dashboard.component.page-loader')
@endsection
@section('script')
    @include('dashboard.component.filepond')
@endsection
