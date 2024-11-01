@foreach ($details['subBagDokumentasi'] as $sbd)
    @if (Str::startsWith($sbd['kode_jabatan'], $ksbh['kode_jabatan']))
        <div class="accordion mt-3" id="innerAccordion-{{ $sbd['id_opd_jabatan'] }}">
            <div class="accordion-item">
                <h2 class="accordion-header" id="innerHeading-{{ $sbd['id_opd_jabatan'] }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#innerCollapse-{{ $sbd['id_opd_jabatan'] }}" aria-expanded="false"
                        aria-controls="innerCollapse-{{ $sbd['id_opd_jabatan'] }}">
                        @if (empty($sbd['nama_pegawai']))
                            {{ 'Kosong' . ' - ' . $sbd['nama_jabatan'] }}
                        @else
                            {{ $sbd['nama_pegawai'] . ' ' . $sbd['gelar_belakang'] . ' - ' . $sbd['nama_jabatan'] }}
                        @endif
                    </button>
                </h2>
                <div id="innerCollapse-{{ $sbd['id_opd_jabatan'] }}" class="accordion-collapse collapse"
                    aria-labelledby="innerHeading-{{ $sbd['id_opd_jabatan'] }}"
                    data-bs-parent="#innerAccordion-{{ $sbd['id_opd_jabatan'] }}">
                    <div class="accordion-body">
                        <p style="margin-bottom: -0.3%;">Nama : {{ $sbd['nama_pegawai'] }}</p>
                        <p style="margin-bottom: -0.3%;">Kode Jabatan : {{ $sbd['kode_jabatan'] }}</p>
                        <p class="mb-1">NIP : {{ $sbd['nip'] }}</p>
                        <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal"
                            data-bs-target="#modal-{{ $sbd['id_opd_jabatan'] }}">
                            Tambahkan Rule
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.sekda.modals.modal-sekda-subBag-dokumentasi')
    @endif
@endforeach
