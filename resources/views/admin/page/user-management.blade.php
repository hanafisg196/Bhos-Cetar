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
      <section class="section mt-2">
         <div class="row justify-content-center">
             <div class="col-12 col-md-10" id="page" style="display: none;">
                 <div class="card">
                     <div class="card-header d-flex justify-content-between align-items-center">
                         <h4 class="card-title">Manajemen Anggota</h4>
                         <a href="{{ route('admin.dashboard.rule.form') }}" class="btn btn-primary btn-md">
                             <i class="bi bi-plus-lg"></i>&nbsp;Tambah Anggota
                         </a>
                     </div>
                     <div class="card-content">
                         <div class="table-responsive" style="padding: 20px;">
                             <table class="table table-hover mb-0">
                                 <thead>
                                     <tr>
                                         <th>Nama</th>
                                         <th>NIP</th>
                                         <th>Rule</th>
                                         <th>Aksi</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($data as $item)
                                         <tr>
                                             <td class="text-bold-500">{{ $item->name }}</td>
                                             <td>{{ $item->nip }}</td>
                                             <td class="text-bold-500">{{ $item['rules'][0]['nama'] }}</td>
                                             <td>
                                                 <div class="d-flex gap-2">
                                                     <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                         data-bs-target="#modal-{{ $item->id }}">Edit</button>

                                                     <form
                                                         action="{{ route('admin.dashboard.rule.delete', encrypt($item->id)) }}"
                                                         method="POST" class="d-inline">
                                                         @csrf
                                                         <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                     </form>
                                                 </div>
                                             </td>
                                         </tr>
                                         <div class="modal fade text-left" id="modal-{{ $item->id }}" tabindex="-1"
                                             role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true"
                                             name="lol">
                                             <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                 <div class="modal-content">
                                                     <div class="modal-header">
                                                         <h5 class="modal-title" id="myModalLabel1">Edit</h5>
                                                         <button type="button" class="close rounded-pill"
                                                             data-bs-dismiss="modal" aria-label="Close">
                                                             <i data-feather="x"></i>
                                                         </button>
                                                     </div>
                                                     <form class="form"action="{{ route('admin.dashboard.rule.update', encrypt($item->id)) }}"
                                                         method="post" id="inputForm">
                                                         @csrf
                                                         <div class="modal-body">
                                                          <p>{{ $item->nama }}</p>
                                                          <select name="rule" class="form-select" id="basicSelect">
                                                              @foreach ($rule as $value)
                                                                  <option value="{{ $value->id }}"
                                                                      {{ old('rule', $item['rules'][0]['id']) == $value->id ? 'selected' : '' }}>
                                                                      {{ $value->nama }}
                                                                  </option>
                                                              @endforeach
                                                          </select>
                                                      </div>
                                                         <div class="modal-footer">
                                                             <div class="col-12 d-flex justify-content-end">
                                                                 <button type="button" class="btn"
                                                                     data-bs-dismiss="modal">
                                                                     <i class="bx bx-x d-block d-sm-none"></i>
                                                                     <span class="d-none d-sm-block">Tutup</span>
                                                                 </button>
                                                                 <button style="display: none" id="loading"
                                                                     class="btn btn-primary" type="button" disabled>
                                                                     <span class="spinner-border spinner-border-sm"
                                                                         role="status" aria-hidden="true"></span>
                                                                     Loading...
                                                                 </button>
                                                                 <button style="display: block" id="send" type="submit"
                                                                     class="btn btn-primary">Ubah</button>
                                                             </div>
                                                         </div>
                                                     </form>
                                                 </div>
                                             </div>
                                         </div>
                                     @endforeach
                                 </tbody>
                             </table>
                         </div>
                         <div class="mt-3 d-flex justify-content-center">
                   {{ $data->links() }} <!-- Pagination -->
               </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     @include('placeholder.page-loader')
    </div>
    @include('dashboard.component.page-loader')
@endsection
