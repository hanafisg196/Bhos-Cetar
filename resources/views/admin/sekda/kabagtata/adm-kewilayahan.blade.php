@foreach ($kasubagAdmKewilayahan as $ksbadk)
@if (Str::startsWith($ksbadk['kode_jabatan'], $kbt['kode_jabatan']))
<div class="accordion mt-3" id="innerAccordion-{{ $ksbadk['id_opd_jabatan'] }}">
  <div class="accordion-item">
      <h2 class="accordion-header" id="innerHeading-{{ $ksbadk['id_opd_jabatan'] }}">
          <button class="accordion-button collapsed" type="button"
              data-bs-toggle="collapse"
              data-bs-target="#innerCollapse-{{ $ksbadk['id_opd_jabatan'] }}"
              aria-expanded="false"
              aria-controls="innerCollapse-{{ $ksbadk['id_opd_jabatan'] }}">
              @if (empty($ksbadk['nama_pegawai']))
              {{ 'Kosong'. ' - '.$ksbadk['nama_jabatan']}}
              @else
              {{ $ksbadk['nama_pegawai']. ' ' .$ksbadk['gelar_belakang'] . ' - '.$ksbadk['nama_jabatan']}}
              @endif
          </button>
      </h2>
      <div id="innerCollapse-{{ $ksbadk['id_opd_jabatan'] }}"
          class="accordion-collapse collapse"
          aria-labelledby="innerHeading-{{ $ksbadk['id_opd_jabatan'] }}"
          data-bs-parent="#innerAccordion-{{ $ksbadk['id_opd_jabatan'] }}">
          <div class="accordion-body">
              <p style="margin-bottom: -0.3%;">Nama : {{ $ksbadk['nama_pegawai'] }}</p>
              <p style="margin-bottom: -0.3%;">Kode Jabatan : {{ $ksbadk['kode_jabatan'] }}</p>
              <p class="mb-1">NIP : {{ $ksbadk['nip'] }}</p>
              <button type="button" class="btn btn-outline-primary block"
                  data-bs-toggle="modal"
                  data-bs-target="#modal-{{ $ksbadk['id_opd_jabatan'] }}">
                  Tambahkan Rule
              </button>
          </div>
      </div>
  </div>
</div>
 @include('admin.sekda.modals.modal-sekda-subag-tata-adm-kewilayahan')
@endif
@endforeach
