@foreach ($details['pegerakSwadaya'] as $pgs)
@if (Str::startsWith($pgs['kode_jabatan'], $kbk['kode_jabatan']))
<div class="accordion mt-3" id="innerAccordion-{{ $pgs['id_opd_jabatan'] }}">
  <div class="accordion-item">
      <h2 class="accordion-header" id="innerHeading-{{ $pgs['id_opd_jabatan'] }}">
          <button class="accordion-button collapsed" type="button"
              data-bs-toggle="collapse"
              data-bs-target="#innerCollapse-{{ $pgs['id_opd_jabatan'] }}"
              aria-expanded="false"
              aria-controls="innerCollapse-{{ $pgs['id_opd_jabatan'] }}">
              @if (empty($pgs['nama_pegawai']))
              {{ 'Kosong'. ' - '.$pgs['nama_jabatan']}}
              @else
              {{ $pgs['nama_pegawai']. ' ' .$pgs['gelar_belakang'] . ' - '.$pgs['nama_jabatan']}}
              @endif
          </button>
      </h2>
      <div id="innerCollapse-{{ $pgs['id_opd_jabatan'] }}"
          class="accordion-collapse collapse"
          aria-labelledby="innerHeading-{{ $pgs['id_opd_jabatan'] }}"
          data-bs-parent="#innerAccordion-{{ $pgs['id_opd_jabatan'] }}">
          <div class="accordion-body">
              <p style="margin-bottom: -0.3%;">Nama : {{ $pgs['nama_pegawai'] }}</p>
              <p style="margin-bottom: -0.3%;">Kode Jabatan : {{ $pgs['kode_jabatan'] }}</p>
              <p class="mb-1">NIP : {{ $pgs['nip'] }}</p>
              <button type="button" class="btn btn-outline-primary block"
                  data-bs-toggle="modal"
                  data-bs-target="#modal-{{ $pgs['id_opd_jabatan'] }}">
                  Tambahkan Rule
              </button>
          </div>
      </div>
  </div>
</div>
      @include('admin.sekda.modals.modal-sekda-subag-kesra-swadaya')
@endif
@endforeach
