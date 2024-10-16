<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}

</div>
<div class="card-body">
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
       <div class="modal fade text-left" id="modal-{{ $item['id_opd_jabatan'] }}"
           tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true"
           name="lol">
           <div class="modal-dialog modal-dialog-scrollable" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="myModalLabel1">Tambahkan Rule</h5>
                       <button type="button" class="close rounded-pill"
                           data-bs-dismiss="modal" aria-label="Close">
                           <i data-feather="x"></i>
                       </button>
                   </div>
                   <form class="form"
                       action="{{ route('admin.dashboard.rule.create') }}" method="post"
                       id="inputForm">
                       @csrf
                       <div class="modal-body">
                          <input type="text"class="form-control" name="username"
                               value="{{ $item['nip'] }}" hidden>
                           <label for="nama">Nama</label>
                           <label for="nip">NIP</label>
                           <input type="text"class="form-control" name="nip"
                               value="{{ $item['nip'] }}" readonly>
                           <label for="nip">JABATAN</label>
                           <input type="text"class="form-control" name="jabatan"
                               value="{{ $item['nama_jabatan'] }}" readonly>
                           <label for="nama">Nama</label>
                           <input type="text" class="form-control" name="name"
                               value="{{ $item['nama_pegawai'] }}" readonly>
                           <label for="nip">Rule</label>
                           <select name="rule_id" class="form-select" id="basicSelect">
                               <option value="">Pilih Rule</option>
                               @foreach ($rule as $value)
                                   <option value="{{ $value->id }}">
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
                               <button style="display: block" id="send"
                                   type="submit" class="btn btn-primary">Simpan</button>
                           </div>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   @endforeach
</div>
