@extends('dashboard.template.main')
@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Aksi Ham</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                           <ul class="nav nav-tabs" id="myTab" role="tablist">
                              <li class="nav-item" role="presentation">
                                  <a class="nav-link active" id="list-lah" data-bs-toggle="tab" href="#listLah"
                                      role="tab" aria-controls="list" aria-selected="true">List Aksi Hukum</a>
                              </li>
                              <li class="nav-item" role="presentation">
                                  <a class="nav-link " id="form-lah" data-bs-toggle="tab" href="#formLah" role="tab"
                                      aria-controls="form" aria-selected="true">Buat Aksi Hukum</a>
                              </li>
                          </ul>
                          <div class="tab-content" id="myTabContent">
                           <div class="tab-pane fade show active" id="listLah" role="tabpanel"
                               aria-labelledby="table-tab">
                               <div class="table-responsive">
                                 <table class="table table-hover table-lg">
                                     <thead>
                                         <tr>
                                             <th>Waktu</th>
                                             <th>Kode</th>
                                             <th>Status</th>
                                             <th>Link</th>
                                             <th>Lihat</th>
                                         </tr>
                                     </thead>
                                     @foreach ($ranham as $val)
                                     <tbody>
                                         <tr style="padding: 0;">
                                             <td class="col-auto" style="padding: 5px;">
                                                 <p class="mb-0" style="margin: 0;">{{$val->created_at->diffForHumans()}}</p>
                                             </td>
                                             <td class="col-auto" style="padding: 5px;">
                                                 <p class="mb-0" style="margin: 0;">{{$val->code}}</p>
                                             </td>
                                             <td class="col-auto" style="padding: 5px;">
                                                 <p class="mb-0"
                                                 style="margin: 0;color:
                                                 {{$val->status === 'Disetujui' ? 'green' : ($val->status === 'Ditolak' ? 'red':($val->status === 'Usulan' ? 'orange' : 'blue'))}}">
                                                 {{$val->status}}
                                             </p>
                                             </td>
                                             <td class="col-auto" style="padding: 5px;">
                                                 <p class="mb-0" style="margin: 0;">{{$val->link}}</p>
                                             </td>
                                             <td class="col-auto" style="padding: 5px;">
                                                 <a href="{{$val->link}}" class="btn icon btn-primary" style="padding: 5px 10px;">
                                                     <i class="bi bi-eye"></i>
                                                 </a>
                                             </td>
                                         </tr>
                                     </tbody>
                                     @endforeach
                                 </table>
                                 {{$ranham->links()}}
                             </div>
                           </div>

                           <div class="tab-pane fade" id="formLah" role="tabpanel" aria-labelledby="table-tab">
                              <form class="form ms-3 mt-2" action="{{ route('ranham.create') }}" method="post" id="inputForm">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Link</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="bi bi-link-45deg"></i></span>
                                                <input type="text" class="form-control @error('link') is-invalid @enderror" name="link" id="link"
                                                    aria-label="Dollar amount (with dot and two decimal places)" value="{{old('link')}}">
                                                    @error('link')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="last-name-column">KKP</label>
                                            <ul class="list-unstyled mb-0">

                                                <li class="d-inline-block me-2 mb-1">
                                                    @foreach ($kkp as $item)
                                                        <div class="form-check">
                                                            <input class="form-check-input @error('kkp') is-invalid @enderror" type="radio" name="kkp"
                                                                id="flexRadioDefault{{ $item->id }}"
                                                                value="{{ $item->id }}" {{ old('kkp') == $item->id ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="flexRadioDefault{{ $item->id }}">
                                                                {{ $item->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                    @error('kkp')
                                                    <p style="color: red; font-size: 0.9rem;">{{$message}}</p>
                                                     @enderror
                                                </li>
                                            </ul>
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
            </div>
        </div>
        @include('dashboard.component.tab-active-session')
    </section>
    @include('dashboard.component.sweet-toast')
    @include('dashboard.component.button-loading')
@endsection
