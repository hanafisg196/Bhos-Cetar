@foreach ($details['analisDataInformasi'] as $adi)
@if (Str::startsWith($adi['kode_jabatan'], $kbt['kode_jabatan']))
<div class="accordion mt-3" id="innerAccordion-{{ $adi['id_opd_jabatan'] }}">
  <div class="accordion-item">
      <h2 class="accordion-header" id="innerHeading-{{ $adi['id_opd_jabatan'] }}">
          <button class="accordion-button collapsed" type="button"
              data-bs-toggle="collapse"
              data-bs-target="#innerCollapse-{{ $adi['id_opd_jabatan'] }}"
              aria-expanded="false"
              aria-controls="innerCollapse-{{ $adi['id_opd_jabatan'] }}">
              @if (empty($adi['nama_pegawai']))
              {{ 'Kosong'. ' - '.$adi['nama_jabatan']}}
              @else
              {{ $adi['nama_pegawai']. ' ' .$adi['gelar_belakang'] . ' - '.$adi['nama_jabatan']}}
              @endif
          </button>
      </h2>
      <div id="innerCollapse-{{ $adi['id_opd_jabatan'] }}"
          class="accordion-collapse collapse"
          aria-labelledby="innerHeading-{{ $adi['id_opd_jabatan'] }}"
          data-bs-parent="#innerAccordion-{{ $adi['id_opd_jabatan'] }}">
          <div class="accordion-body">
              <p style="margin-bottom: -0.3%;">Nama : {{ $adi['nama_pegawai'] }}</p>
              <p style="margin-bottom: -0.3%;">Kode Jabatan : {{ $adi['kode_jabatan'] }}</p>
              <p class="mb-1">NIP : {{ $adi['nip'] }}</p>
              <button type="button" class="btn btn-outline-primary block"
                  data-bs-toggle="modal"
                  data-bs-target="#modal-{{ $adi['id_opd_jabatan'] }}">
                  Tambahkan Rule
              </button>
          </div>
      </div>
  </div>
</div>
@include('admin.sekda.modals.modal-sekda-subag-tata-analis-data')
@endif
@endforeach
