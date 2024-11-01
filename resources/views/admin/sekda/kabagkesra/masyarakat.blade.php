@foreach ($details['kasubagMasyarakat'] as $ksbm)
@if (Str::startsWith($ksbm['kode_jabatan'], $kbk['kode_jabatan']))
<div class="accordion mt-3" id="innerAccordion-{{ $ksbm['id_opd_jabatan'] }}">
  <div class="accordion-item">
      <h2 class="accordion-header" id="innerHeading-{{ $ksbm['id_opd_jabatan'] }}">
          <button class="accordion-button collapsed" type="button"
              data-bs-toggle="collapse"
              data-bs-target="#innerCollapse-{{ $ksbm['id_opd_jabatan'] }}"
              aria-expanded="false"
              aria-controls="innerCollapse-{{ $ksbm['id_opd_jabatan'] }}">
              @if (empty($ksbm['nama_pegawai']))
              {{ 'Kosong'. ' - '.$ksbm['nama_jabatan']}}
              @else
              {{ $ksbm['nama_pegawai']. ' ' .$ksbm['gelar_belakang'] . ' - '.$ksbm['nama_jabatan']}}
              @endif
          </button>
      </h2>
      <div id="innerCollapse-{{ $ksbm['id_opd_jabatan'] }}"
          class="accordion-collapse collapse"
          aria-labelledby="innerHeading-{{ $ksbm['id_opd_jabatan'] }}"
          data-bs-parent="#innerAccordion-{{ $ksbm['id_opd_jabatan'] }}">
          <div class="accordion-body">
              <p style="margin-bottom: -0.3%;">Nama : {{ $ksbm['nama_pegawai'] }}</p>
              <p style="margin-bottom: -0.3%;">Kode Jabatan : {{ $ksbm['kode_jabatan'] }}</p>
              <p class="mb-1">NIP : {{ $ksbm['nip'] }}</p>
              <button type="button" class="btn btn-outline-primary block"
                  data-bs-toggle="modal"
                  data-bs-target="#modal-{{ $ksbm['id_opd_jabatan'] }}">
                  Tambahkan Rule
              </button>
          </div>
      </div>
  </div>
</div>
      @include('admin.sekda.modals.modal-sekda-subag-kesra-masyarakat')
@endif
@endforeach
