<div class="modal fade text-left" id="modal-{{ $ksbh['id_opd_jabatan'] }}"
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
                    value="{{ $ksbh['nip'] }}" hidden>
               <label for="nama">Kode Jabatan</label>
               <input type="text" class="form-control" name="kode_jabatan"
                     value="{{ $ksbh['kode_jabatan'] }}" readonly>
                <label for="nama">Nama</label>
                <input type="text" class="form-control" name="name"
                    value="{{ $ksbh['nama_pegawai'] }}" readonly>
                <label for="nip">Nip</label>
                <input type="text"class="form-control" name="nip"
                    value="{{ $ksbh['nip'] }}" readonly>
                <label for="nip">Jabatan</label>
                <input type="text"class="form-control" name="jabatan"
                    value="{{ $ksbh['nama_jabatan'] }}" readonly>
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
                        type="ksbhmit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
