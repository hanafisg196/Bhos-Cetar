@foreach ($kabagTata as $kbt)
@if (Str::startsWith($kbt['kode_jabatan'], $item['kode_jabatan']))
<div class="accordion mt-3" id="innerAccordion-{{ $kbt['id_opd_jabatan'] }}">
  <div class="accordion-item">
      <h2 class="accordion-header" id="innerHeading-{{ $kbt['id_opd_jabatan'] }}">
          <button class="accordion-button collapsed" type="button"
              data-bs-toggle="collapse"
              data-bs-target="#innerCollapse-{{ $kbt['id_opd_jabatan'] }}"
              aria-expanded="false"
              aria-controls="innerCollapse-{{ $kbt['id_opd_jabatan'] }}">
              @if (empty($kbt['nama_pegawai']))
              {{ 'Kosong'. ' - '.$kbt['nama_jabatan']}}
              @else
              {{ $kbt['nama_pegawai']. ' ' .$kbt['gelar_belakang'] . ' - '.$kbt['nama_jabatan']}}
              @endif
          </button>
      </h2>
      <div id="innerCollapse-{{ $kbt['id_opd_jabatan'] }}"
          class="accordion-collapse collapse"
          aria-labelledby="innerHeading-{{ $kbt['id_opd_jabatan'] }}"
          data-bs-parent="#innerAccordion-{{ $kbt['id_opd_jabatan'] }}">
          <div class="accordion-body">
              <p style="margin-bottom: -0.3%;">Nama : {{ $kbt['nama_pegawai'] }}</p>
              <p style="margin-bottom: -0.3%;">Kode Jabatan : {{ $kbt['kode_jabatan'] }}</p>
              <p class="mb-1">NIP : {{ $kbt['nip'] }}</p>
              <button type="button" class="btn btn-outline-primary block"
                  data-bs-toggle="modal"
                  data-bs-target="#modal-{{ $kbt['id_opd_jabatan'] }}">
                  Tambahkan Rule
              </button>
              @include('admin.sekda.kabagtata.adm-kewilayahan')
              @include('admin.sekda.kabagtata.adm-pemerintah')
              @include('admin.sekda.kabagtata.otonomi')
              @include('admin.sekda.kabagtata.analis-ahli-muda')
              @include('admin.sekda.kabagtata.analis-dukcapil')
              @include('admin.sekda.kabagtata.analis-data-informasi')
          </div>
      </div>
  </div>
</div>
      @include('admin.sekda.modals.modal-sekda-kabag-tata')
@endif
@endforeach
