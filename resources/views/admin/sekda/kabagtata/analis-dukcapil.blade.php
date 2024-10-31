@foreach ($analisDukcapil as $adc)
@if (Str::startsWith($adc['kode_jabatan'], $kbt['kode_jabatan']))
<div class="accordion mt-3" id="innerAccordion-{{ $adc['id_opd_jabatan'] }}">
  <div class="accordion-item">
      <h2 class="accordion-header" id="innerHeading-{{ $adc['id_opd_jabatan'] }}">
          <button class="accordion-button collapsed" type="button"
              data-bs-toggle="collapse"
              data-bs-target="#innerCollapse-{{ $adc['id_opd_jabatan'] }}"
              aria-expanded="false"
              aria-controls="innerCollapse-{{ $adc['id_opd_jabatan'] }}">
              @if (empty($adc['nama_pegawai']))
              {{ 'Kosong'. ' - '.$adc['nama_jabatan']}}
              @else
              {{ $adc['nama_pegawai']. ' ' .$adc['gelar_belakang'] . ' - '.$adc['nama_jabatan']}}
              @endif
          </button>
      </h2>
      <div id="innerCollapse-{{ $adc['id_opd_jabatan'] }}"
          class="accordion-collapse collapse"
          aria-labelledby="innerHeading-{{ $adc['id_opd_jabatan'] }}"
          data-bs-parent="#innerAccordion-{{ $adc['id_opd_jabatan'] }}">
          <div class="accordion-body">
              <p style="margin-bottom: -0.3%;">Nama : {{ $adc['nama_pegawai'] }}</p>
              <p style="margin-bottom: -0.3%;">Kode Jabatan : {{ $adc['kode_jabatan'] }}</p>
              <p class="mb-1">NIP : {{ $adc['nip'] }}</p>
              <button type="button" class="btn btn-outline-primary block"
                  data-bs-toggle="modal"
                  data-bs-target="#modal-{{ $adc['id_opd_jabatan'] }}">
                  Tambahkan Rule
              </button>
          </div>
      </div>
  </div>
</div>
@include('admin.sekda.modals.modal-sekda-subag-tata-analis-dukcapil')
@endif
@endforeach
