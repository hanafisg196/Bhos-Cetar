@foreach ($analisAhliMuda as $aam)
@if (Str::startsWith($aam['kode_jabatan'], $kbt['kode_jabatan']))
<div class="accordion mt-3" id="innerAccordion-{{ $aam['id_opd_jabatan'] }}">
  <div class="accordion-item">
      <h2 class="accordion-header" id="innerHeading-{{ $aam['id_opd_jabatan'] }}">
          <button class="accordion-button collapsed" type="button"
              data-bs-toggle="collapse"
              data-bs-target="#innerCollapse-{{ $aam['id_opd_jabatan'] }}"
              aria-expanded="false"
              aria-controls="innerCollapse-{{ $aam['id_opd_jabatan'] }}">
              @if (empty($aam['nama_pegawai']))
              {{ 'Kosong'. ' - '.$aam['nama_jabatan']}}
              @else
              {{ $aam['nama_pegawai']. ' ' .$aam['gelar_belakang'] . ' - '.$aam['nama_jabatan']}}
              @endif
          </button>
      </h2>
      <div id="innerCollapse-{{ $aam['id_opd_jabatan'] }}"
          class="accordion-collapse collapse"
          aria-labelledby="innerHeading-{{ $aam['id_opd_jabatan'] }}"
          data-bs-parent="#innerAccordion-{{ $aam['id_opd_jabatan'] }}">
          <div class="accordion-body">
              <p style="margin-bottom: -0.3%;">Nama : {{ $aam['nama_pegawai'] }}</p>
              <p style="margin-bottom: -0.3%;">Kode Jabatan : {{ $aam['kode_jabatan'] }}</p>
              <p class="mb-1">NIP : {{ $aam['nip'] }}</p>
              <button type="button" class="btn btn-outline-primary block"
                  data-bs-toggle="modal"
                  data-bs-target="#modal-{{ $aam['id_opd_jabatan'] }}">
                  Tambahkan Rule
              </button>
          </div>
      </div>
  </div>
</div>
@include('admin.sekda.modals.modal-sekda-subag-tata-analis-muda')
@endif
@endforeach
