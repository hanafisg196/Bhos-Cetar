@extends('admin.template.main')
@section('content')
@if ($errors->any())
<div class="d-flex justify-content-center">
    <div class="alert alert-danger alert-dismissible show fade col-12 col-md-10">
        <p> Gagal Menambahkan Rule</p>
        @foreach ($errors->all() as $error)
            <div class="invalid-feedback d-block" style="color: white;">
                {{ $error }}
            </div>
        @endforeach
        <button type="button" class="btn-close" style="color: white" data-bs-dismiss="alert"
            aria-label="Close"></button>
    </div>
</div>
@endif
<div class="page-content">
   <section>
      <div class="d-flex justify-content-center">
          <div class="col-12 col-md-10" id="page" style="display: none;">
              <div class="card d-flex justify-content-center">
                  <div class="card-header">
                     <div class="col-md-8 mb-4">
                        <h6>Pilih OPD</h6>
                        <div class="form-group">
                           <select class="choices form-select"  id="opdSelect" onchange="filterEmployees()">
                              @foreach ($opd as $item)
                              <option value="{{ $item->kode_jabatan }}"
                                 {{ request('code') == $item->kode_jabatan ? 'selected' : '' }}>
                                 {{ $item->nama }}
                             </option>
                              @endforeach
                          </select>
                        </div>
                    </div>
                  </div>
                  <div class="card-body">
                      @foreach ($data as $item)
                          <div class="accordion accordion-flush" id="accordion-{{$item['id_opd_jabatan'] }}">
                              <div class="accordion-item">
                                  <h2 class="accordion-header" id="heading-{{ $item['id_opd_jabatan'] }}">
                                      <button class="accordion-button collapsed" type="button"
                                          data-bs-toggle="collapse"
                                          data-bs-target="#collapse-{{ $item['id_opd_jabatan'] }}"
                                          aria-expanded="false"
                                          aria-controls="collapse-{{ $item['id_opd_jabatan'] }}">
                                          @if (empty($item['nama_pegawai']))
                                          {{ 'Kosong'. ' - '.$item['nama_jabatan']}}
                                          @else
                                          {{ $item['nama_pegawai']. ' ' .$item['gelar_belakang'] . ' - '.$item['nama_jabatan']}}
                                          @endif

                                      </button>
                                  </h2>
                                  <div id="collapse-{{ $item['id_opd_jabatan'] }}"
                                      class="accordion-collapse collapse"
                                      aria-labelledby="heading-{{ $item['id_opd_jabatan'] }}"
                                      data-bs-parent="#accordion-{{ $item['id_opd_jabatan'] }}">
                                      <div class="accordion-body">
                                          <p>Nama : {{ $item['nama_pegawai']}}</p>
                                          <p>Kode Jabatan : {{ $item['kode_jabatan'] }}</p>
                                          <p>NIP : {{ $item['nip'] }}</p>
                                          <button type="button" class="btn btn-outline-primary block"
                                              data-bs-toggle="modal"
                                              data-bs-target="#modal-{{ $item['id_opd_jabatan'] }}">
                                              Tambahkan Rule
                                          </button>
                                    @include('admin.sekda.kabagtata.kabag-tata')
                                    @include('admin.sekda.kabaghukum.kabag-hukum')
                                    @include('admin.sekda.kabagkesra.kabag-kesra')
                                      </div>
                                  </div>
                              </div>
                          </div>
                         @include('admin.sekda.modals.modal-universal')
                      @endforeach
                  </div>
              </div>
          </div>
      </div>
      </section>
      @include('placeholder.page-loader')
</div>
@include('dashboard.component.select-option')
@include('dashboard.component.button-loading')
@include('dashboard.component.page-loader')
@endsection
