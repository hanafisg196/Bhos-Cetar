@foreach ($kasubagOtonomi as $ksbot)
@if (Str::startsWith($ksbot['kode_jabatan'], $kbt['kode_jabatan']))
<div class="accordion mt-3" id="innerAccordion-{{ $ksbot['id_opd_jabatan'] }}">
  <div class="accordion-item">
      <h2 class="accordion-header" id="innerHeading-{{ $ksbot['id_opd_jabatan'] }}">
          <button class="accordion-button collapsed" type="button"
              data-bs-toggle="collapse"
              data-bs-target="#innerCollapse-{{ $ksbot['id_opd_jabatan'] }}"
              aria-expanded="false"
              aria-controls="innerCollapse-{{ $ksbot['id_opd_jabatan'] }}">
              @if (empty($ksbot['nama_pegawai']))
              {{ 'Kosong'. ' - '.$ksbot['nama_jabatan']}}
              @else
              {{ $ksbot['nama_pegawai']. ' ' .$ksbot['gelar_belakang'] . ' - '.$ksbot['nama_jabatan']}}
              @endif
          </button>
      </h2>
      <div id="innerCollapse-{{ $ksbot['id_opd_jabatan'] }}"
          class="accordion-collapse collapse"
          aria-labelledby="innerHeading-{{ $ksbot['id_opd_jabatan'] }}"
          data-bs-parent="#innerAccordion-{{ $ksbot['id_opd_jabatan'] }}">
          <div class="accordion-body">
              <p style="margin-bottom: -0.3%;">Nama : {{ $ksbot['nama_pegawai'] }}</p>
              <p style="margin-bottom: -0.3%;">Kode Jabatan : {{ $ksbot['kode_jabatan'] }}</p>
              <p class="mb-1">NIP : {{ $ksbot['nip'] }}</p>
              <button type="button" class="btn btn-outline-primary block"
                  data-bs-toggle="modal"
                  data-bs-target="#modal-{{ $ksbot['id_opd_jabatan'] }}">
                  Tambahkan Rule
              </button>
          </div>
      </div>
  </div>
</div>
@include('admin.sekda.modals.modal-sekda-subag-tata-otonomi')
@endif
@endforeach
