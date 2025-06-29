@extends('dashboard.template.main')
@section('content')
{{ timeMachine() }}
<div class="page-content">
   <section id="multiple-column-form">
      <div class="row match-height">
          <div class="col-12" id="page" style="display: none;">
              <div class="card">
                  <div class="card-header">
                      <h4 class="card-title">Kami Peduli</h4>
                  </div>
                  <div class="card-content">
                      <div class="card-body">
                         <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="list-lah" data-bs-toggle="tab" href="#listLah"
                                    role="tab" aria-controls="list" aria-selected="true">List data</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link " id="form-lah" data-bs-toggle="tab" href="#formLah" role="tab"
                                    aria-controls="form" aria-selected="true">Buat baru</a>
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
                                   @foreach ($ranham as $item)
                                   <tbody>
                                       <tr style="padding: 0;">
                                           <td class="col-auto" style="padding: 5px;">
                                               <p class="mb-0" style="margin: 0;">{{$item->created_at->diffForHumans()}}</p>
                                           </td>
                                           <td class="col-auto" style="padding: 5px;">
                                               <p class="mb-0" style="margin: 0;">{{$item->code}}</p>
                                           </td>
                                           <td class="col-auto" style="padding: 5px;">
                                             <p class="mb-0"
                                                 style="margin: 0;color:
                                             {{ $item->status === 'Disetujui' ? 'green' : ($item->status === 'Ditolak' || $item->status === 'Revisi' ? 'red' : 'orange') }}">
                                                 {{ $item->status }}
                                             </p>
                                         </td>
                                           <td class="col-auto" style="padding: 5px;">
                                               <p class="mb-0" style="margin: 0;">{{cutLink($item->link)}}</p>
                                           </td>
                                           <td class="col-auto" style="padding: 5px;">
                                               <a href="{{$item->link}}" class="btn icon btn-primary" style="padding: 5px 10px;">
                                                   <i class="bi bi-eye"></i>
                                               </a>
                                               <a class="btn icon btn-primary" style="padding: 5px 10px;" data-bs-toggle="modal" data-bs-target="#modals-{{ $item->id }}">
                                                <i class="bi bi-info-circle"></i>
                                              </a>
                                           </td>
                                       </tr>
                                   </tbody>
                                   @include('dashboard.component.modal-tracking-point')
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
  @include('placeholder.page-loader')
</div>
    @include('dashboard.component.sweet-toast')
    @include('dashboard.component.button-loading')
    @include('dashboard.component.page-loader')
@endsection
