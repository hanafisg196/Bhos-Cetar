@foreach ($kabagKesra as $kbk)
@if (Str::startsWith($kbk['kode_jabatan'], $item['kode_jabatan']))
<div class="accordion mt-3" id="innerAccordion-{{ $kbk['id_opd_jabatan'] }}">
  <div class="accordion-item">
      <h2 class="accordion-header" id="innerHeading-{{ $kbk['id_opd_jabatan'] }}">
          <button class="accordion-button collapsed" type="button"
              data-bs-toggle="collapse"
              data-bs-target="#innerCollapse-{{ $kbk['id_opd_jabatan'] }}"
              aria-expanded="false"
              aria-controls="innerCollapse-{{ $kbk['id_opd_jabatan'] }}">
              @if (empty($kbk['nama_pegawai']))
              {{ 'Kosong'. ' - '.$kbk['nama_jabatan']}}
              @else
              {{ $kbk['nama_pegawai']. ' ' .$kbk['gelar_belakang'] . ' - '.$kbk['nama_jabatan']}}
              @endif
          </button>
      </h2>
      <div id="innerCollapse-{{ $kbk['id_opd_jabatan'] }}"
          class="accordion-collapse collapse"
          aria-labelledby="innerHeading-{{ $kbk['id_opd_jabatan'] }}"
          data-bs-parent="#innerAccordion-{{ $kbk['id_opd_jabatan'] }}">
          <div class="accordion-body">
              <p style="margin-bottom: -0.3%;">Nama : {{ $kbk['nama_pegawai'] }}</p>
              <p style="margin-bottom: -0.3%;">Kode Jabatan : {{ $kbk['kode_jabatan'] }}</p>
              <p class="mb-1">NIP : {{ $kbk['nip'] }}</p>
              <button type="button" class="btn btn-outline-primary block"
                  data-bs-toggle="modal"
                  data-bs-target="#modal-{{ $kbk['id_opd_jabatan'] }}">
                  Tambahkan Rule
              </button>
              @include('admin.sekda.kabagkesra.spritual')
              @include('admin.sekda.kabagkesra.sosial')
              @include('admin.sekda.kabagkesra.masyarakat')
              @include('admin.sekda.kabagkesra.swadaya')
          </div>
      </div>
  </div>
</div>
      @include('admin.sekda.modals.modal-sekda-kabag-kesra')
@endif
@endforeach
