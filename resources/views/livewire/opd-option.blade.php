<div>
    {{-- Success is as dangerous as failure. --}}
    <div class="col-md-8 mb-4">
      <h6>Pilih OPD</h6>
      <div class="form-group">
         <select wire:model.live="selectedOpd" name="opd" id="opd" class="choices form-select">
            @foreach ($opd as $item)
                <option value="{{ $item['kode_jabatan'] }}">{{ $item['nama'] }}</option>
            @endforeach
        </select>
      </div>

      <p>Selected OPD: {{ $selectedOpd }}</p>
      @foreach ($data['pegawai'] as $item)
      <div class="accordion accordion-flush" id="accordion-{{$item['id_opd_jabatan'] }}">
          <div class="accordion-item">
              <h2 class="accordion-header" id="heading-{{ $item['id_opd_jabatan'] }}">
                  <button class="accordion-button collapsed" type="button"
                      data-bs-toggle="collapse"
                      data-bs-target="#collapse-{{ $item['id_opd_jabatan'] }}"
                      aria-expanded="false"
                      aria-controls="collapse-{{ $item['id_opd_jabatan'] }}">
                      {{ $item['nama_jabatan'] }}
                  </button>
              </h2>
              <div id="collapse-{{ $item['id_opd_jabatan'] }}"
                  class="accordion-collapse collapse"
                  aria-labelledby="heading-{{ $item['id_opd_jabatan'] }}"
                  data-bs-parent="#accordion-{{ $item['id_opd_jabatan'] }}">
                  <div class="accordion-body">
                      <p>Nama : {{ $item['nama_pegawai'] }}</p>
                      <p>Kode Jabatan : {{ $item['kode_jabatan'] }}</p>
                      <p>NIP : {{ $item['nip'] }}</p>
                      <button type="button" class="btn btn-outline-primary block"
                          data-bs-toggle="modal"
                          data-bs-target="#modal-{{ $item['id_opd_jabatan'] }}">
                          Tambahkan Rule
                      </button>
                  </div>
              </div>
          </div>
      </div>
      @endforeach
  </div>

</div>

