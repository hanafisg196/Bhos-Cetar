@foreach ($kasubagSpritual as $ksbsp)
@if (Str::startsWith($ksbsp['kode_jabatan'], $kbk['kode_jabatan']))
<div class="accordion mt-3" id="innerAccordion-{{ $ksbsp['id_opd_jabatan'] }}">
  <div class="accordion-item">
      <h2 class="accordion-header" id="innerHeading-{{ $ksbsp['id_opd_jabatan'] }}">
          <button class="accordion-button collapsed" type="button"
              data-bs-toggle="collapse"
              data-bs-target="#innerCollapse-{{ $ksbsp['id_opd_jabatan'] }}"
              aria-expanded="false"
              aria-controls="innerCollapse-{{ $ksbsp['id_opd_jabatan'] }}">
              @if (empty($ksbsp['nama_pegawai']))
              {{ 'Kosong'. ' - '.$ksbsp['nama_jabatan']}}
              @else
              {{ $ksbsp['nama_pegawai']. ' ' .$ksbsp['gelar_belakang'] . ' - '.$ksbsp['nama_jabatan']}}
              @endif
          </button>
      </h2>
      <div id="innerCollapse-{{ $ksbsp['id_opd_jabatan'] }}"
          class="accordion-collapse collapse"
          aria-labelledby="innerHeading-{{ $ksbsp['id_opd_jabatan'] }}"
          data-bs-parent="#innerAccordion-{{ $ksbsp['id_opd_jabatan'] }}">
          <div class="accordion-body">
              <p style="margin-bottom: -0.3%;">Nama : {{ $ksbsp['nama_pegawai'] }}</p>
              <p style="margin-bottom: -0.3%;">Kode Jabatan : {{ $ksbsp['kode_jabatan'] }}</p>
              <p class="mb-1">NIP : {{ $ksbsp['nip'] }}</p>
              <button type="button" class="btn btn-outline-primary block"
                  data-bs-toggle="modal"
                  data-bs-target="#modal-{{ $ksbsp['id_opd_jabatan'] }}">
                  Tambahkan Rule
              </button>
          </div>
      </div>
  </div>
</div>
      @include('admin.sekda.modals.mdal-sekda-subag-kesra-spritual')
@endif
@endforeach
