@foreach ($details['subBagAnalis'] as $sba)
    @if (Str::startsWith($sba['kode_jabatan'], $ksbh['kode_jabatan']))
        <div class="accordion mt-3" id="innerAccordion-{{ $sba['id_opd_jabatan'] }}">
            <div class="accordion-item">
                <h2 class="accordion-header" id="innerHeading-{{ $sba['id_opd_jabatan'] }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#innerCollapse-{{ $sba['id_opd_jabatan'] }}" aria-expanded="false"
                        aria-controls="innerCollapse-{{ $sba['id_opd_jabatan'] }}">
                        @if (empty($sba['nama_pegawai']))
                            {{ 'Kosong' . ' - ' . $sba['nama_jabatan'] }}
                        @else
                            {{ $sba['nama_pegawai'] . ' ' . $sba['gelar_belakang'] . ' - ' . $sba['nama_jabatan'] }}
                        @endif
                    </button>
                </h2>
                <div id="innerCollapse-{{ $sba['id_opd_jabatan'] }}" class="accordion-collapse collapse"
                    aria-labelledby="innerHeading-{{ $sba['id_opd_jabatan'] }}"
                    data-bs-parent="#innerAccordion-{{ $sba['id_opd_jabatan'] }}">
                    <div class="accordion-body">
                        <p style="margin-bottom: -0.3%;">Nama : {{ $sba['nama_pegawai'] }}</p>
                        <p style="margin-bottom: -0.3%;">Kode Jabatan : {{ $sba['kode_jabatan'] }}</p>
                        <p class="mb-1">NIP : {{ $sba['nip'] }}</p>
                        <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal"
                            data-bs-target="#modal-{{ $sba['id_opd_jabatan'] }}">
                            Tambahkan Rule
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.sekda.modals.modal-sekda-subBag-analis')
    @endif
@endforeach
