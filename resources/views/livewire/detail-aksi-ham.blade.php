<div>
    @php
        $statusOptions = ['Disetujui', 'Ditolak'];
    @endphp
    <div  style="margin-top: -30px; margin-bottom: 30px;">
       <a href="{{url('/list/inbox/aksi-ham')}}" class="btn btn-primary">
         <i class="bi bi-arrow-left"></i> Kembali
     </a>
    </div>
    <section class="section"
        style="max-height: 650px;
    overflow-y: scroll; scrollbar-width: none;
     -ms-overflow-style: none;">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="card-body py-1">
                        <div class="collapse-title media">
                            <div class="pr-1">
                                <div class="avatar me-3">
                                    <img src="/dist/assets/compiled/png/user.png" alt="avtar img holder" width="30"
                                        height="30">
                                </div>
                            </div>
                            <div class="media-body mt-25">
                                <span class="text-primary">{{ $data->name }}</span>
                                <span class="d-sm-inline d-none">&lt;Status - {{ $data->status }}&gt;</span>
                                <small class="text-muted d-block">to Bhos Ce-Tar System</small>
                            </div>
                        </div>
                        <p class="text-bold-500" style="margin-top: 15px;">Kode File : {{ $data->code }}</p>
                        <p class="text-bold-500">Nama : {{ $data->name }}</p>
                        <p class="text-bold-500">Nip : {{ $data->user_id }}</p>
                        <p class="text-bold-500">Link : <a href="{{$data->link}}">{{$data->link}}</a></p>
                        <p class="text-bold-500">KKP : {{ $data['kkps']['name'] }}</p>


                    </div>
                    <div style="margin-top: 60px; margin-left:10px;">
                        <div>
                            <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal"
                                data-bs-target="#default">
                                Ubah Status
                            </button>
                        </div>
                    </div>
                    <!--Basic Modal -->
                    <div wire:ignore.self class="modal fade text-left" id="default" tabindex="-1" role="dialog"
                        aria-labelledby="myModalLabel1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel1">Ubah Status</h5>
                                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                        aria-label="Close">
                                        <i data-feather="x"></i>
                                    </button>
                                </div>
                                <form>
                                    @csrf
                                    <div class="modal-body">
                                        <div class="col-md-6 col-12">
                                            <fieldset class="form-group">
                                              <p>Status saat ini - {{$data->status}}</p>
                                                <select wire:model="status" class="form-select" id="basicSelect">
                                                    <option selected>Pilih...</option>
                                                    @foreach ($statusOptions as $option)
                                                        <option value="{{ $option }}">{{ $option }}</option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                            <div>
                                                @error('status')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="company-column">Pesan</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="message" rows="3" wire:model="pesan"></textarea>
                                                <div>
                                                    @error('pesan')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Tutup</span>
                                        </button>
                                        <button wire:click="updateStat('{{ $data->id }}')" type="button"
                                            class="btn btn-primary ms-1">
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Simpan</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
