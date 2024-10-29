@extends('dashboard.template.main')
@section('content')
<div class="page-content">
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12" id="page" style="display: none;">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Bantuan Hukum</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                           <ul class="nav nav-tabs" id="myTab" role="tablist">
                              <li class="nav-item" role="presentation">
                                  <a class="nav-link active" id="list-lbh" data-bs-toggle="tab" href="#listLbh"
                                      role="tab" aria-controls="list" aria-selected="true">List Bantuan Hukum</a>
                              </li>
                              <li class="nav-item" role="presentation">
                                  <a class="nav-link " id="form-lbh" data-bs-toggle="tab" href="#formLbh" role="tab"
                                      aria-controls="form" aria-selected="true">Buat Bantuan Hukum</a>
                              </li>
                          </ul>
                          <div class="tab-content" id="myTabContent">
                           <div class="tab-pane fade show active" id="listLbh" role="tabpanel"
                               aria-labelledby="table-tab">
                               <div class="table-responsive">
                                 <table class="table table-hover table-lg">
                                     <thead>
                                         <tr>
                                             <th>Waktu</th>
                                             <th>Status</th>
                                             <th>Code</th>
                                             <th>Aksi</th>
                                         </tr>
                                     </thead>
                                     @foreach ($bantuan as $key['documents'] =>  $item)
                                    <tbody>
                                         <tr style="margin-bottom: 0; padding-bottom: 0;">
                                             <td class="col-auto" style="padding: 5px 0;">
                                                 <p class="mb-0" style="margin-bottom: 0;">{{$item->created_at->diffForHumans()}}</p>
                                             </td>
                                             <td class="col-3" style="padding: 5px 0;">
                                                 <div class="d-flex align-items-center">
                                                     <p class="font-bold ms-3 mb-0" style="margin-bottom: 0;
                                                     color: {{$item->status === 'Disetujui' ? 'green' :
                                                      ($item->status === 'Ditolak' ? 'red':
                                                      ($item->status === 'Usulan' ? 'orange' : 'blue'))}}">
                                                      {{ $item->status }}</p>
                                                 </div>

                                             </td>
                                             <td class="col-auto" style="padding: 5px 0;">
                                                 <p class="mb-0" style="margin-bottom: 0;">{{$item->code}}</p>
                                             </td>
                                             <td class="col-auto" style="padding: 5px 0;">
                                                 <a class="btn icon btn-primary" data-bs-toggle="modal" data-bs-target="#modal-{{ $item->id }}">
                                                     <i class="bi bi-eye"></i>
                                                 </a>
                                             </td>
                                         </tr>
                                     </tbody>
                                      <!-- Disabled Backdrop Modal -->
                                      <div class="modal fade text-left" id="modal-{{ $item->id }}" tabindex="-1"
                                         role="dialog" aria-labelledby="myModalLabel-{{ $item->id }}"
                                         data-bs-backdrop="false" aria-hidden="true">
                                         <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                             role="document">
                                             <div class="modal-content">
                                                 <div class="modal-header">
                                                     <h4 class="modal-title" id="myModalLabel-{{ $item->id }}">Detail
                                                     </h4>
                                                     <button type="button" class="close" data-bs-dismiss="modal"
                                                         aria-label="Close">
                                                         <i data-feather="x"></i>
                                                     </button>
                                                 </div>
                                                 <div class="modal-body">
                                                     <p><strong>Nama : </strong>{{ $item->nama }}</p>
                                                     <p><strong>Email :  </strong>{{ $item->email }}</p>
                                                     <p><strong>WA : </strong>{{ $item->wa }}</p>
                                                     <p><strong>Alamat : </strong>{{ $item->alamat }}</p>
                                                     <p><strong>Kronologi : </strong>{{ $item->kronologi }}</p>
                                                     <p style="margin-bottom: -2px;"><strong>Dokument :
                                                     @foreach ($item['documents'] as $value)
                                                     <p style="margin: 0px;">
                                                      </strong>{{ strCut($value->file) }}
                                                         <a style="size: 15px; margin-left: 10px;" href="{{route('schedule.download', ['file' => strCut($value->file)])}}"  >
                                                             <i class="bi bi-arrow-down-square-fill"></i>
                                                         </a>
                                                         @endforeach
                                                     </p>
                                                     </p>
                                                 </div>
                                                 <div class="modal-footer">
                                                     <button type="button" class="btn btn-light-secondary"
                                                         data-bs-dismiss="modal">
                                                         <i class="bx bx-x d-block d-sm-none"></i>
                                                         <span class="d-none d-sm-block">Tutup</span>
                                                     </button>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                     @endforeach
                                 </table>
                                 {{$bantuan->links()}}
                             </div>
                           </div>

                           <div class="tab-pane fade" id="formLbh" role="tabpanel" aria-labelledby="table-tab">
                              <form class="form" action="{{ route('schedule.store') }}" method="post" id="inputForm"
                                  enctype="multipart/form-data">
                                  @csrf

                                  <div class="row">
                                      <div class="col-md-6 col-12">
                                          <div class="form-group">
                                              <label for="last-name-column">Nama</label>
                                              <input type="text" id="last-name-column"
                                                  class="form-control @error('nama') is-invalid @enderror"
                                                  value="{{ old('nama') }}" placeholder="Nama.." name="nama">
                                              @error('nama')
                                                  <div class="invalid-feedback">
                                                      {{ $message }}
                                                  </div>
                                              @enderror
                                          </div>
                                      </div>
                                      <div class="col-md-6 col-12">
                                          <div class="form-group">
                                              <label for="city-column">Email</label>
                                              <input type="email" id="city-column"
                                                  class="form-control @error('email') is-invalid @enderror"
                                                  value="{{ old('email') }}" placeholder="Alamat Email" name="email">
                                              @error('email')
                                                  <div class="invalid-feedback">
                                                      {{ $message }}
                                                  </div>
                                              @enderror
                                          </div>
                                      </div>
                                      <div class="col-md-6 col-12">
                                          <div class="form-group">
                                              <label for="country-floating">Whatsapp</label>
                                              <input type="phone" id="country-floating"
                                                  class="form-control @error('wa') is-invalid @enderror" name="wa"
                                                  value="{{ old('wa') }}" placeholder="Nomor Whatsapp">
                                              @error('wa')
                                                  <div class="invalid-feedback">
                                                      {{ $message }}
                                                  </div>
                                              @enderror
                                          </div>
                                      </div>
                                      <div class="col-md-6 col-12">
                                          <div class="form-group">
                                              <label for="alamat">Alamat</label>
                                              <textarea class="form-control @error('alamat') is-invalid @enderror" id="exampleFormControlTextarea1" name="alamat"
                                                  rows="3">{{ old('alamat') }}</textarea>
                                              @error('alamat')
                                                  <div class="invalid-feedback">
                                                      {{ $message }}
                                                  </div>
                                              @enderror
                                          </div>
                                      </div>
                                      <div class="col-md-6 col-12" style="margin-top: -48px;">
                                          <div class="form-group">
                                              <label for="kronologi">Kronologi</label>
                                              <textarea class="form-control @error('kronologi') is-invalid @enderror" id="exampleFormControlTextarea1"
                                                name="kronologi" rows="5">{{ old('kronologi') }}</textarea>
                                              @error('kronologi')
                                                  <div class="invalid-feedback">
                                                      {{ $message }}
                                                  </div>
                                              @enderror
                                          </div>
                                      </div>
                                      <div class="col-md-6 col-12">
                                          <div class="form-group">
                                              <label for="email-id-column">Dokumen</label>
                                              <input type="file" class="filepond" name="file" id="file" multiple
                                                  data-allow-reorder="true" data-max-file-size="2MB" data-max-files="5"
                                                  accept="image/png, image/jpeg, application/pdf, application/msword,
                                                  application/vnd.openxmlformats-officedocument.wordprocessingml.document" required>
                                          </div>
                                      </div>

                                      <div class="col-12 d-flex justify-content-end">
                                          <button style="display: none" id="loading" class="btn btn-primary"
                                              type="button" disabled>
                                              <span class="spinner-border spinner-border-sm" role="status"
                                                  aria-hidden="true"></span>
                                              Loading...
                                          </button>
                                          <button style="display: block" id="send" type="submit"
                                              class="btn btn-primary me-1 mb-1">Kirim</button>
                                      </div>
                                  </div>
                              </form>
                           </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('dashboard.component.tab-active-session')
    </section>
    @include('placeholder.page-loader')
</div>
@include('dashboard.component.button-loading')
@include('dashboard.component.page-loader')
@endsection
@section('script')
@include('dashboard.component.filepond')
@endsection
