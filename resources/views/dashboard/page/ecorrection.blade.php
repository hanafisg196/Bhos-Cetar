@extends('dashboard.template.main')
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
<section id="multiple-column-form">
   <div class="row match-height">
       <div class="col-10">
           <div class="card">
               <div class="card-header">
                   <h4 class="card-title">E-correction</h4>
               </div>
               <div class="card-content">
                   <div class="card-body">
                        <form class="form" action="{{route('ecorrection.create')}}" method="post" enctype="multipart/form-data">
                           @csrf
                           <div class="row">
                              <div class="col-md-8 col-12">
                                 <div class="form-group">
                                     <label for="last-name-column">Judul</label>
                                     <input type="text" id="last-name-column"
                                         class="form-control @error('judul') is-invalid @enderror"
                                         value="{{ old('judul') }}" placeholder="Judul Surat atau Dokumen.." name="judul">
                                     @error('judul')
                                         <div class="invalid-feedback">
                                             {{ $message }}
                                         </div>
                                     @enderror
                                 </div>
                                 <div class="form-group">
                                    <label for="email-id-column">Dokumen</label>
                                    <input type="file" class="filepond" name="file" id="file" multiple
                                        data-allow-reorder="true" data-max-file-size="2MB" data-max-files="5"
                                        accept="image/png, image/jpeg, application/pdf" required>
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
                                  class="btn btn-primary me-1 mb-1">Kirim</button>
                          </div>
                           </div>
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
