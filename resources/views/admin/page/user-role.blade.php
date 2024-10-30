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
                         <div class="accordion accordion-flush" id="accordion-{{ $item['id_opd_jabatan'] }}">
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
                                         <p style="margin-bottom: -0.3%;">Nama : {{ $item['nama_pegawai'] }}</p>
                                         <p style="margin-bottom: -0.3%;">Kode Jabatan : {{ $item['kode_jabatan'] }}</p>
                                         <p class="mb-1">NIP : {{ $item['nip'] }}</p>
                                         <button type="button" class="btn btn-outline-primary block"
                                             data-bs-toggle="modal"
                                             data-bs-target="#modal-{{ $item['id_opd_jabatan'] }}">
                                             Tambahkan Rule
                                         </button>

                                         @foreach ($filteredArray as $sub)
                                             @if (Str::startsWith($sub['kode_jabatan'], $item['kode_jabatan']))
                                                 <div class="accordion mt-3" id="innerAccordion-{{ $sub['id_opd_jabatan'] }}">
                                                     <div class="accordion-item">
                                                         <h2 class="accordion-header" id="innerHeading-{{ $sub['id_opd_jabatan'] }}">
                                                             <button class="accordion-button collapsed" type="button"
                                                                 data-bs-toggle="collapse"
                                                                 data-bs-target="#innerCollapse-{{ $sub['id_opd_jabatan'] }}"
                                                                 aria-expanded="false"
                                                                 aria-controls="innerCollapse-{{ $sub['id_opd_jabatan'] }}">
                                                                 {{ $sub['nama_jabatan'] }}
                                                             </button>
                                                         </h2>
                                                         <div id="innerCollapse-{{ $sub['id_opd_jabatan'] }}"
                                                             class="accordion-collapse collapse"
                                                             aria-labelledby="innerHeading-{{ $sub['id_opd_jabatan'] }}"
                                                             data-bs-parent="#innerAccordion-{{ $sub['id_opd_jabatan'] }}">
                                                             <div class="accordion-body">
                                                                 <p style="margin-bottom: -0.3%;">Nama : {{ $sub['nama_pegawai'] }}</p>
                                                                 <p style="margin-bottom: -0.3%;">Kode Jabatan : {{ $sub['kode_jabatan'] }}</p>
                                                                 <p class="mb-1">NIP : {{ $sub['nip'] }}</p>
                                                                 <button type="button" class="btn btn-outline-primary block"
                                                                     data-bs-toggle="modal"
                                                                     data-bs-target="#modal-{{ $sub['id_opd_jabatan'] }}">
                                                                     Tambahkan Rule
                                                                 </button>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                                             @endif
                                         @endforeach
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <!-- Modal code here -->
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
