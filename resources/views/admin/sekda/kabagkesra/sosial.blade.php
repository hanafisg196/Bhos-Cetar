@foreach ($kasubagSosial as $ksbs)
@if (Str::startsWith($ksbs['kode_jabatan'], $kbk['kode_jabatan']))
<div class="accordion mt-3" id="innerAccordion-{{ $ksbs['id_opd_jabatan'] }}">
  <div class="accordion-item">
      <h2 class="accordion-header" id="innerHeading-{{ $ksbs['id_opd_jabatan'] }}">
          <button class="accordion-button collapsed" type="button"
              data-bs-toggle="collapse"
              data-bs-target="#innerCollapse-{{ $ksbs['id_opd_jabatan'] }}"
              aria-expanded="false"
              aria-controls="innerCollapse-{{ $ksbs['id_opd_jabatan'] }}">
              @if (empty($ksbs['nama_pegawai']))
              {{ 'Kosong'. ' - '.$ksbs['nama_jabatan']}}
              @else
              {{ $ksbs['nama_pegawai']. ' ' .$ksbs['gelar_belakang'] . ' - '.$ksbs['nama_jabatan']}}
              @endif
          </button>
      </h2>
      <div id="innerCollapse-{{ $ksbs['id_opd_jabatan'] }}"
          class="accordion-collapse collapse"
          aria-labelledby="innerHeading-{{ $ksbs['id_opd_jabatan'] }}"
          data-bs-parent="#innerAccordion-{{ $ksbs['id_opd_jabatan'] }}">
          <div class="accordion-body">
              <p style="margin-bottom: -0.3%;">Nama : {{ $ksbs['nama_pegawai'] }}</p>
              <p style="margin-bottom: -0.3%;">Kode Jabatan : {{ $ksbs['kode_jabatan'] }}</p>
              <p class="mb-1">NIP : {{ $ksbs['nip'] }}</p>
              <button type="button" class="btn btn-outline-primary block"
                  data-bs-toggle="modal"
                  data-bs-target="#modal-{{ $ksbs['id_opd_jabatan'] }}">
                  Tambahkan Rule
              </button>
          </div>
      </div>
  </div>
</div>
      @include('admin.sekda.modals.modal-sekda-subag-kesra-sosial')
@endif
@endforeach
