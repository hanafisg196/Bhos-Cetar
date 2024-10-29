@extends('dashboard.template.main')
@section('content')
<section id="multiple-column-form">
   <div class="row match-height">
       <div class="col-12">
           <div class="card">
               <div class="card-header">
                   <p><strong>Kode - </strong>{{$data->code}}</p>
                   <p><strong>Status - </strong>{{$data->status}}</p>
                   <p><strong>Pesan - </strong>{{$data->message}}</p>
                   @foreach ($data->fixFiles as $file)
                   <p><strong>Detail Perbaikan</strong> - {{ strCutTwo($file->file) }}
                     <a class="btn icon btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#modals-{{ $file->id }}">
                        <i class="bi bi-eye-fill"></i>
                      </a>
                  </p>

                   @endforeach
               </div>
               <div class="modal fade" id="modals-{{ $file->id }}" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalScrollableTitle-{{$file->id}}" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable " role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Detail File</h5>
                              <button type="button" class="close" data-bs-dismiss="modal"
                                  aria-label="Close">
                                  <i data-feather="x"></i>
                              </button>
                          </div>
                          <div class="modal-body">
                             <div class="d-flex justify-content-center mt-3">
                                <iframe src="{{asset('storage/'. $file->file)}}" style="width:718px; height:700px;"
                                title="doc" name="contents"></iframe>
                               </div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-light-secondary"
                                  data-bs-dismiss="modal">
                                  <i class="bx bx-x d-block d-sm-none"></i>
                                  <span class="d-none d-sm-block">Close</span>
                              </button>
                          </div>
                      </div>
                  </div>
              </div>
               <div class="card-content">
                   <div class="card-body">
                       <form class="form" action="{{ route('ecorrection.update', encrypt($data->id)) }}"
                           method="post" id="inputForm" enctype="multipart/form-data">
                           @csrf
                           @if ($data->status === 'Disetujui')
                           <fieldset disabled>
                            @else
                            <fieldset>
                           @endif
                           <div class="row">
                               <div class="col-md-6 col-12">
                                   <div class="form-group">
                                       <label for="last-name-column">Judul</label>
                                       <div class="input-group mb-3">
                                           <input type="text" class="form-control" name="judul" id="judul"
                                               aria-label="Dollar amount (with dot and two decimal places)"
                                               value="{{ $data->title }}">
                                       </div>
                                       <label for="last-name-column">Dokumen</label>
                                          <div class="input-group mb-3">
                                          @foreach ($data['dokumens'] as $item)
                                                 <div class="d-flex align-items-center mb-2">
                                                     @if (str_contains($item->file, 'pdf'))
                                                         <img src="/dist/assets/compiled/png/pdf.png" height="35" alt="PDF Icon" class="me-2">
                                                     @else
                                                         <img src="/dist/assets/compiled/png/image.png" height="35" alt="" class="me-2">
                                                     @endif
                                                     <p class="mb-0">{{ strCut($item->file) }}</p>
                                                     <a class="btn icon btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#modal-{{ $item->id }}">
                                                         <i class="bi bi-eye-fill"></i>
                                                     </a>
                                                 </div>
                                           @endforeach
                                        </div>
                                        <div class="form-group">
                                          <label for="email-id-column">Upload Ulang</label>
                                          <input type="file" class="filepond" name="file" id="file" multiple
                                              data-allow-reorder="true" data-max-file-size="20MB" data-max-files="1"
                                              accept="application/pdf, application/msword,
                                                  application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                                      </div>
                                    </div>
                                    <div class="modal fade" id="modal-{{ $item->id }}" tabindex="-1" role="dialog"
                                       aria-labelledby="exampleModalScrollableTitle-{{$item->id}}" aria-hidden="true">
                                       <div class="modal-dialog modal-dialog-scrollable " role="document">
                                           <div class="modal-content">
                                               <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalScrollableTitle">Detail File</h5>
                                                   <button type="button" class="close" data-bs-dismiss="modal"
                                                       aria-label="Close">
                                                       <i data-feather="x"></i>
                                                   </button>
                                               </div>
                                               <div class="modal-body">
                                                  <div class="d-flex justify-content-center mt-3">
                                                     <iframe src="{{asset('storage/'. $item->file)}}" style="width:718px; height:700px;"
                                                     title="doc" name="contents"></iframe>
                                                    </div>
                                               </div>
                                               <div class="modal-footer">
                                                   <button type="button" class="btn btn-light-secondary"
                                                       data-bs-dismiss="modal">
                                                       <i class="bx bx-x d-block d-sm-none"></i>
                                                       <span class="d-none d-sm-block">Close</span>
                                                   </button>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               <div class="col-12 d-flex justify-content-end">
                                   <button style="display: none" id="loading" class="btn btn-primary" type="button"
                                       disabled>
                                       <span class="spinner-border spinner-border-sm" role="status"
                                           aria-hidden="true"></span>
                                       Loading...
                                   </button>
                                   <button style="display: block" id="send" type="submit"
                                       class="btn btn-primary me-1 mb-1">Perbarui</button>
                               </div>
                           </div>
                          </fieldset>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   </div>
</section>
@include('dashboard.component.button-loading')
@endsection
@section('script')
    @include('dashboard.component.filepond')
@endsection
