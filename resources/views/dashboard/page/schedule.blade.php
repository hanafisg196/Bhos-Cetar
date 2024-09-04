@extends('dashboard.template.main')
@section('content')
    <style>
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1055;
            width: auto;
        }
    </style>
    @if (session()->has('success'))
        <div class="toast-container">
            <div class="card-body">
                <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <svg class="bd-placeholder-img rounded me-2" width="20" height="20"
                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice"
                            focusable="false">
                            <rect width="100%" height="100%" fill="#007aff"></rect>
                        </svg>
                        <strong class="me-auto">Notifikasi</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Bantuan Hukum</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('schedule.store') }}" method="post" id="inputForm"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Nama</label>
                                            <input type="text" id="last-name-column"
                                                class="form-control @error('nama') is-invalid @enderror"
                                                value="{{ old('nama') }}" placeholder="Nama.." name="nama">
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
                                                value="{{ old('email') }}" placeholder="Alamat Email" name="email">
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
                                                value="{{ old('wa') }}" placeholder="Nomor Whatsapp">
                                            @error('wa')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="company-column">Alamat</label>
                                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="exampleFormControlTextarea1" name="alamat"
                                                rows="3">{{ old('alamat') }}</textarea>
                                            @error('alamat')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="company-column">Kronologi</label>
                                            <textarea class="form-control @error('kronologi') is-invalid @enderror" id="exampleFormControlTextarea1"
                                              name="kronologi" rows="3">{{ old('kronologi') }}</textarea>
                                            @error('kronologi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email-id-column">Dokumen</label>
                                            <input type="file" class="filepond" name="file" id="file" multiple
                                                data-allow-reorder="true" data-max-file-size="2MB" data-max-files="5"
                                                accept="image/png, image/jpeg, application/pdf" required>
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
    </section>
    <script>
        document.addEventListener('livewire:navigated', () => {
            var inputForm = document.getElementById('inputForm');
            var sendButton = document.getElementById('send');
            var loading = document.getElementById('loading');

            inputForm.addEventListener('submit', function() {
                sendButton.style.display = 'none';
                loading.style.display = 'block';
            });

        });
    </script>
@endsection
@section('script')
    <script>
        document.addEventListener('livewire:navigated', () => {
            FilePond.registerPlugin(
                FilePondPluginImagePreview,
                FilePondPluginImageExifOrientation,
                FilePondPluginFileValidateSize,
                FilePondPluginFileValidateType,
            );
            const inputElement = document.querySelector('input[type="file"]');
            const pond = FilePond.create(inputElement, {
                allowMultiple: true,
                server: {
                    process: '{{ route('upload') }}',
                    revert: '/delete',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }
            });
        })
    </script>
@endsection
