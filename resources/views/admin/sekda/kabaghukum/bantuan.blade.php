@foreach ($subBagHukumBantuan as $sbhb)
@if (Str::startsWith($sbhb['kode_jabatan'], $ksbh['kode_jabatan']))
    <div class="accordion mt-3" id="innerAccordion-{{ $sbhb['id_opd_jabatan'] }}">
        <div class="accordion-item">
            <h2 class="accordion-header" id="innerHeading-{{ $sbhb['id_opd_jabatan'] }}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#innerCollapse-{{ $sbhb['id_opd_jabatan'] }}" aria-expanded="false"
                    aria-controls="innerCollapse-{{ $sbhb['id_opd_jabatan'] }}">
                    {{ $sbhb['nama_jabatan'] }}
                </button>
            </h2>
            <div id="innerCollapse-{{ $sbhb['id_opd_jabatan'] }}" class="accordion-collapse collapse"
                aria-labelledby="innerHeading-{{ $sbhb['id_opd_jabatan'] }}"
                data-bs-parent="#innerAccordion-{{ $sbhb['id_opd_jabatan'] }}">
                <div class="accordion-body">
                    <p style="margin-bottom: -0.3%;">Nama : {{ $sbhb['nama_pegawai'] }}</p>
                    <p style="margin-bottom: -0.3%;">Kode Jabatan : {{ $sbhb['kode_jabatan'] }}</p>
                    <p class="mb-1">NIP : {{ $sbhb['nip'] }}</p>
                    <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal"
                        data-bs-target="#modal-{{ $sbhb['id_opd_jabatan'] }}">
                        Tambahkan Rule
                    </button>
                </div>
            </div>
        </div>
    </div>
    @include('admin.modals.modal-sekda-subBag-bantuan')
@endif
@endforeach
