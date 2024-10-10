@extends('dashboard.template.main')
@section('content')
<section id="multiple-column-form">
   <div class="row match-height">
       <div class="col-10">
           <div class="card">
               <div class="card-header">
                   <h4 class="card-title">E-correction</h4>
               </div>
               <div class="card-content">
                   <div class="card-body">
                        <form class="form" action="">
                           @csrf
                           <div class="row">
                              <div class="col-md-8 col-12">
                                 <div class="form-group">
                                     <label for="last-name-column">Judul</label>
                                     <input type="text" id="last-name-column"
                                         class="form-control @error('title') is-invalid @enderror"
                                         value="{{ old('title') }}" placeholder="Judul Surat atau Dokumen.." name="nama">
                                     @error('title')
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
