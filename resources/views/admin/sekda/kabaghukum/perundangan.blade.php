@foreach ($details['subBagHukumPerundangan'] as $sbhp)
    @if (Str::startsWith($sbhp['kode_jabatan'], $ksbh['kode_jabatan']))
        <div class="accordion mt-3" id="innerAccordion-{{ $sbhp['id_opd_jabatan'] }}">
            <div class="accordion-item">
                <h2 class="accordion-header" id="innerHeading-{{ $sbhp['id_opd_jabatan'] }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#innerCollapse-{{ $sbhp['id_opd_jabatan'] }}" aria-expanded="false"
                        aria-controls="innerCollapse-{{ $sbhp['id_opd_jabatan'] }}">
                        @if (empty($sbhp['nama_pegawai']))
                            {{ 'Kosong' . ' - ' . $sbhp['nama_jabatan'] }}
                        @else
                            {{ $sbhp['nama_pegawai'] . ' ' . $sbhp['gelar_belakang'] . ' - ' . $sbhp['nama_jabatan'] }}
                        @endif
                    </button>
                </h2>
                <div id="innerCollapse-{{ $sbhp['id_opd_jabatan'] }}" class="accordion-collapse collapse"
                    aria-labelledby="innerHeading-{{ $sbhp['id_opd_jabatan'] }}"
                    data-bs-parent="#innerAccordion-{{ $sbhp['id_opd_jabatan'] }}">
                    <div class="accordion-body">
                        <p style="margin-bottom: -0.3%;">Nama : {{ $sbhp['nama_pegawai'] }}</p>
                        <p style="margin-bottom: -0.3%;">Kode Jabatan : {{ $sbhp['kode_jabatan'] }}</p>
                        <p class="mb-1">NIP : {{ $sbhp['nip'] }}</p>
                        <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal"
                            data-bs-target="#modal-{{ $sbhp['id_opd_jabatan'] }}">
                            Tambahkan Rule
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.sekda.modals.modal-sekda-subBag-perundangan')
    @endif
@endforeach
