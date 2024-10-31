@foreach ($kepSubBagHukum as $ksbh)
@if (Str::startsWith($ksbh['kode_jabatan'], $item['kode_jabatan']))
<div class="accordion mt-3" id="innerAccordion-{{ $ksbh['id_opd_jabatan'] }}">
  <div class="accordion-item">
      <h2 class="accordion-header" id="innerHeading-{{ $ksbh['id_opd_jabatan'] }}">
          <button class="accordion-button collapsed" type="button"
              data-bs-toggle="collapse"
              data-bs-target="#innerCollapse-{{ $ksbh['id_opd_jabatan'] }}"
              aria-expanded="false"
              aria-controls="innerCollapse-{{ $ksbh['id_opd_jabatan'] }}">
              @if (empty($ksbh['nama_pegawai']))
              {{ 'Kosong'. ' - '.$ksbh['nama_jabatan']}}
              @else
              {{ $ksbh['nama_pegawai']. ' ' .$ksbh['gelar_belakang'] . ' - '.$ksbh['nama_jabatan']}}
              @endif
          </button>
      </h2>
      <div id="innerCollapse-{{ $ksbh['id_opd_jabatan'] }}"
          class="accordion-collapse collapse"
          aria-labelledby="innerHeading-{{ $ksbh['id_opd_jabatan'] }}"
          data-bs-parent="#innerAccordion-{{ $ksbh['id_opd_jabatan'] }}">
          <div class="accordion-body">
              <p style="margin-bottom: -0.3%;">Nama : {{ $ksbh['nama_pegawai'] }}</p>
              <p style="margin-bottom: -0.3%;">Kode Jabatan : {{ $ksbh['kode_jabatan'] }}</p>
              <p class="mb-1">NIP : {{ $ksbh['nip'] }}</p>
              <button type="button" class="btn btn-outline-primary block"
                  data-bs-toggle="modal"
                  data-bs-target="#modal-{{ $ksbh['id_opd_jabatan'] }}">
                  Tambahkan Rule
              </button>
              @include('admin.sekda.kabaghukum.perundangan')
              @include('admin.sekda.kabaghukum.bantuan')
              @include('admin.sekda.kabaghukum.dokumentasi')
              @include('admin.sekda.kabaghukum.analis')
          </div>
      </div>
  </div>
</div>
      @include('admin.sekda.modals.modal-sekda-kabag-hukum')
@endif
@endforeach
