@foreach ($details['kasubagAdmPemerintah'] as $ksbadp)
@if (Str::startsWith($ksbadp['kode_jabatan'], $kbt['kode_jabatan']))
<div class="accordion mt-3" id="innerAccordion-{{ $ksbadp['id_opd_jabatan'] }}">
  <div class="accordion-item">
      <h2 class="accordion-header" id="innerHeading-{{ $ksbadp['id_opd_jabatan'] }}">
          <button class="accordion-button collapsed" type="button"
              data-bs-toggle="collapse"
              data-bs-target="#innerCollapse-{{ $ksbadp['id_opd_jabatan'] }}"
              aria-expanded="false"
              aria-controls="innerCollapse-{{ $ksbadp['id_opd_jabatan'] }}">
              @if (empty($ksbadp['nama_pegawai']))
              {{ 'Kosong'. ' - '.$ksbadp['nama_jabatan']}}
              @else
              {{ $ksbadp['nama_pegawai']. ' ' .$ksbadp['gelar_belakang'] . ' - '.$ksbadp['nama_jabatan']}}
              @endif
          </button>
      </h2>
      <div id="innerCollapse-{{ $ksbadp['id_opd_jabatan'] }}"
          class="accordion-collapse collapse"
          aria-labelledby="innerHeading-{{ $ksbadp['id_opd_jabatan'] }}"
          data-bs-parent="#innerAccordion-{{ $ksbadp['id_opd_jabatan'] }}">
          <div class="accordion-body">
              <p style="margin-bottom: -0.3%;">Nama : {{ $ksbadp['nama_pegawai'] }}</p>
              <p style="margin-bottom: -0.3%;">Kode Jabatan : {{ $ksbadp['kode_jabatan'] }}</p>
              <p class="mb-1">NIP : {{ $ksbadp['nip'] }}</p>
              <button type="button" class="btn btn-outline-primary block"
                  data-bs-toggle="modal"
                  data-bs-target="#modal-{{ $ksbadp['id_opd_jabatan'] }}">
                  Tambahkan Rule
              </button>
          </div>
      </div>
  </div>
</div>
@include('admin.sekda.modals.modal-sekda-subag-tata-adm-pemeritahan')
@endif
@endforeach
