@extends('dashboard.template.main')
@section('content')
    <style>
        .card-header p {
            margin-bottom: 5px;
        }
    </style>
     <div class="page-content">
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12" id="page" style="display: none;">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Perbarui Bantuan Hukum</h4>
                        <p><strong>Kode - </strong>{{ $data->code }}</p>
                        <p><strong>Status - </strong>{{ $data->status }}</p>
                        <p><strong>Pesan - </strong>{{ $data->message }}</p>
                    </div>
                    <div class="card-content" style="margin-top: -20px;">
                        <div class="card-body">
                            <form class="form" action="{{ route('update.bantuan.hukum', encrypt($data->id)) }}"
                                method="post" id="inputForm" enctype="multipart/form-data">
                                @csrf
                                @if ($data->status === "Disetujui" || $data->status === "Ditolak" )
                                <fieldset disabled>
                                @else
                                <fieldset>
                                @endif
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Nama</label>
                                            <input type="text" id="last-name-column"
                                                class="form-control @error('nama') is-invalid @enderror"
                                                value="{{ $data->nama }}" placeholder="Nama.." name="nama">
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="city-column">Email</label>
                                            <input type="email" id="city-column"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ $data->email }}" placeholder="Alamat Email" name="email">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="country-floating">Whatsapp</label>
                                            <input type="phone" id="country-floating"
                                                class="form-control @error('wa') is-invalid @enderror" name="wa"
                                                value="{{ $data->wa }}" placeholder="Nomor Whatsapp">
                                            @error('wa')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="exampleFormControlTextarea1" name="alamat"
                                                rows="3">{{ $data->alamat }}</textarea>
                                            @error('alamat')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12" style="margin-top: -43px;">
                                        <div class="form-group">
                                            <label for="company-column">Kronologi</label>
                                            <textarea class="form-control @error('kronologi') is-invalid @enderror" id="exampleFormControlTextarea1"
                                                name="kronologi" rows="7">{{ $data->kronologi }}</textarea>
                                            @error('kronologi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <label for="email-id-column">Dokumen</label>
                                        @foreach ($data['documents'] as $item)
                                        <ul class="list-unstyled mb-2">
                                            <li class="cursor-pointer pb-25" style="margin-left: 10px;">
                                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                                    <!-- Bagian Gambar -->
                                                    <div style="display: flex; align-items: center;">
                                                        @if (str_contains($item->file, 'pdf'))
                                                            <img src="/dist/assets/compiled/png/pdf.png" height="25" alt="">
                                                        @else
                                                            <img src="/dist/assets/compiled/png/image.png" height="25" alt="">
                                                        @endif
                                                        <!-- Bagian Teks -->
                                                        <small class="text-muted attachment-text" style="margin-left: 10px;">
                                                            {{ strCut($item->file) }}
                                                        </small>
                                                    </div>
                                                    <div style="display: flex; justify-content: flex-end; align-items: center;">
                                                        <a style="font-size:20px; margin-left: 10px;" href="{{ route('schedule.download', ['file' => strCut($item->file)]) }}">
                                                            <i class="bi bi-arrow-down-square-fill"></i>
                                                        </a>
                                                        <a style="font-size:20px; margin-left: 10px; background: none; border: none; cursor: pointer;" onclick="confirmDelete('{{ encrypt($item->id) }}')">
                                                            <i class="bi bi-x-square-fill"></i>
                                                        </a>
                                                        <form id="deleteForm" action="{{ route('delete.dokumen.bantuan.hukum', encrypt($item->id)) }}" method="POST" style="display: none;">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        @endforeach
                                        <div class="form-group">
                                            <label for="email-id-column">Upload</label>
                                            <input type="file" class="filepond" name="file" id="file" multiple
                                                data-allow-reorder="true" data-max-file-size="2MB" data-max-files="5"
                                                accept="image/png, image/jpeg, application/pdf, application/msword,
                                                application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-end">
                                        <button style="display: none" id="loading" class="btn btn-primary" type="button"
                                            disabled>
                                            <span class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span>
                                            Loading...
                                        </button>
                                        <button style="display: block" id="send" type="submit"
                                            class="btn btn-primary me-1 mb-1">Perbarui</button>
                                    </div>
                                </div>
                            </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('placeholder.page-loader')
    </div>
    @include('dashboard.component.alert-delete')
    @include('dashboard.component.button-loading')
    @include('dashboard.component.page-loader')
@endsection
@section('script')
    @include('dashboard.component.filepond')
@endsection
