@extends('admin.component.main')
@section('content')
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
                            </div>
                        </div>
                    </div>
                </div>
                <section>
                    <div class="d-flex justify-content-center mt-10">
                        <div class="col-12 col-md-10">
                            <div class="card d-flex justify-content-center">
                                <div class="card-header">
                                    <form action="">
                                        <div class="form-group position-relative has-icon-right  col-6">
                                            <input type="text" class="form-control" placeholder="Masukan Kode Jabatan">
                                            <div class="form-control-icon">
                                                <i class="bi bi-search"></i>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-body">
                                    @foreach ($data['pegawai'] as $item)
                                        <div class="accordion accordion-flush" id="accordion-{{ $item['id_opd_jabatan'] }}">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="heading-{{ $item['id_opd_jabatan'] }}">
                                                    <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#collapse-{{ $item['id_opd_jabatan'] }}"
                                                        aria-expanded="false"
                                                        aria-controls="collapse-{{ $item['id_opd_jabatan'] }}">
                                                        {{ $item['nama'] }}
                                                    </button>
                                                </h2>
                                                <div id="collapse-{{ $item['id_opd_jabatan'] }}"
                                                    class="accordion-collapse collapse"
                                                    aria-labelledby="heading-{{ $item['id_opd_jabatan'] }}"
                                                    data-bs-parent="#accordion-{{ $item['id_opd_jabatan'] }}">
                                                    <div class="accordion-body">
                                                        <p>Kode Jabatan : {{ $item['kode_jabatan'] }}</p>
                                                        <p>NIP : {{ $item['nip'] }}</p>
                                                        <button type="button" class="btn btn-outline-primary block"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-{{ $item['id_opd_jabatan'] }}">
                                                            Tambahkan Rule
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal fade text-left" id="modal-{{ $item['id_opd_jabatan'] }}"
                                            tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true"
                                            name="lol">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel1">Tambahkan Rule</h5>
                                                        <button type="button" class="close rounded-pill"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <i data-feather="x"></i>
                                                        </button>
                                                    </div>

                                                    <form class="form"
                                                        action="{{ route('admin.dashboard.rule.create') }}" method="post"
                                                        id="inputForm">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <label for="nip">NIP</label>
                                                            <input type="text"
                                                                class="form-control @error('nip') is-invalid @enderror"
                                                                name="nip" value="{{ $item['nip'] }}" readonly>
                                                            @error('nip')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                            <label for="nama">Jabatan</label>
                                                            <input type="text"
                                                                class="form-control @error('nip') is-invalid @enderror"
                                                                name="nama" value="{{ $item['nama'] }}" readonly>
                                                            @error('nama')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                            <label for="nip">Rule</label>
                                                            <select name="rule_id"
                                                                class="form-select @error('rule_id') is-invalid @enderror"
                                                                id="basicSelect">
                                                                @foreach ($rule as $value)
                                                                    <option value="{{ $value->id }}"
                                                                        {{ old('rule_id') == $value->id ? 'selected' : '' }}>
                                                                        {{ $value->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('rule_id')
                                                                <div class="invalid-feedback">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="col-12 d-flex justify-content-end">
                                                                <button type="button" class="btn"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Tutup</span>
                                                                </button>
                                                                <button style="display: none" id="loading"
                                                                    class="btn btn-primary" type="button" disabled>
                                                                    <span class="spinner-border spinner-border-sm"
                                                                        role="status" aria-hidden="true"></span>
                                                                    Loading...
                                                                </button>
                                                                <button style="display: block" id="send"
                                                                    type="submit" class="btn btn-primary">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                @include('dashboard.component.button-loading')
            </div>
        </div>
    </div>
    @if ($errors->any())
        <script>
           Swal.fire("SweetAlert2 is working!");
        </script>
    @endif
@endsection
