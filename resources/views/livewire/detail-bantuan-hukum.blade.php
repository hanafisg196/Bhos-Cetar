<div>
   <style>
      p{
         margin-bottom: -1px;
       }
   </style>
    @php
        $statusOptions = ['Disetujui','Revisi','Ditolak'];
    @endphp
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div  style="margin-top: -30px; margin-bottom: 30px;">
      <a href="{{ url('/inbox/list/bantuan-hukum') }}" class="btn btn-primary">
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
                                <span class="text-primary">{{ $data->users->name }}</span>
                                <span class="d-sm-inline d-none">&lt;Status - {{ $data->status }}&gt;</span>s
                                <small class="text-muted d-block">Kepada Sistem Bhos Cetar</small>
                            </div>
                        </div>
                        <p class="text-bold-500 mb-1">Nama Pengirim : {{ $data->users->name }}</p>
                        <p class="text-bold-500">Nama : {{ $data->nama }}</p>
                        <p class="text-bold-500">Email : {{ $data->email }}</p>
                        <p class="text-bold-500">Whatsapp : {{ $data->wa }}</p>
                        <p class="text-bold-500">Alamat : {{ $data->alamat }}</p>
                        <p class="text-bold-500">Kronologi :</p>
                        <p>
                            {{ $data->kronologi }}


                    </div>
                    <h7 class="sidebar-label mt-2" style="margin-left: 10px;">
                        Lampiran
                    </h7>
                    @foreach ($data['documents'] as $item)
                        <ul class="list-unstyled mb-1">
                            <li class="cursor-pointer pb-25" style="margin-left: 10px;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <!-- Bagian Gambar -->
                                    <div style="display: flex; align-items: center;">
                                        @if (str_contains($item->file, 'pdf'))
                                            <img src="/dist/assets/compiled/png/pdf.png" height="25" alt="">
                                        @else
                                            <img src="/dist/assets/compiled/png/image.png" height="25"
                                                alt="">
                                        @endif
                                        <!-- Bagian Teks -->
                                        <small class="text-muted attachment-text" style="margin-left: 10px;">
                                            {{ strCut($item->file) }}
                                        </small>
                                    </div>
                                    <div style="margin-inline-end: 60%">
                                        <button wire:click="download('{{ $item->file }}')"
                                            class="btn icon btn-primary btn-sm">
                                            <i class="bi bi-download"></i>
                                        </button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    @endforeach
                    <div class="d-flex justify-content-center mt-5">
                        <div>
                           @if ($validVerifikator)
                           <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal"
                           data-bs-target="#default">
                           Ubah Status
                          </button>
                           @endif
                            @if ($kabag === true)
                            <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal"
                            data-bs-target="#default2">
                            Disposisi
                           </button>
                            @endif
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
                                                <select wire:model="status" class="form-select" id="basicSelect">
                                                    @if ($data->status !== 'Usulan')
                                                        <option value="{{ $data->status }}" selected>
                                                            {{ $data->status }}</option>
                                                    @endif
                                                    @foreach ($statusOptions as $option)
                                                        <option value="{{ $option }}">{{ $option }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </fieldset>
                                            <div>
                                                @error('status')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                          <label for="message">Pesan</label>
                                          <textarea class="form-control" id="message" name="message" rows="5" wire:model="pesan"></textarea>
                                          <div>
                                              @error('pesan')
                                                  {{ $message }}
                                              @enderror
                                          </div>
                                      </div>

                                    </div>

                                       <div class="modal-footer">
                                          <button type="button" class="btn" data-bs-dismiss="modal">
                                              <i class="bx bx-x d-block d-sm-none"></i>
                                              <span class="d-none d-sm-block">Tutup</span>
                                          </button>
                                            <button wire:loading.remove wire:click="updateStatus('{{ $data->id }}')" type="button"
                                            class="btn btn-primary ms-1">
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Simpan</span>
                                        </button>
                                          <div wire:loading id="loadingSpinner" class="spinner-border ms-1" style="width: 2rem; height: 2rem;" role="status">
                                              <span class="visually-hidden">Loading...</span>
                                          </div>
                                      </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <div wire:ignore.self class="modal fade text-left" id="default2" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                       <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel1">Disposisi</h5>
                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                                <div class="modal-body">
                                  <fieldset class="form-group">
                                   <select wire:model="verifikator" class="form-select" id="basicSelect">
                                      <option selected>Pilih Verifikator 1...</option>
                                      @foreach ($verifikatorOne as $verifikator)
                                          <option value="{{ $verifikator->nip }}">{{ $verifikator->name }}
                                          </option>
                                      @endforeach
                                      <input type="text" wire:model="vname" hidden>
                                  </select>
                                  <div>
                                    @error('verifikator')
                                    {{ $message }}
                                     @enderror
                                  </div>
                                   <label for="message">Pesan Khusus</label>
                                        <textarea class="form-control" id="message" name="message" rows="5" wire:model="pesanKhusus" placeholder="Opsional"></textarea>
                                        <div>
                                            @error('pesanKhusus')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                  </fieldset>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn" data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Tutup</span>
                                    </button>
                                    <button wire:loading.remove wire:click="updateVerifikatorOne('{{ $data->id }}')" type="button"
                                        class="btn btn-primary ms-1">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Simpan</span>
                                    </button>
                                    <div wire:loading id="loadingSpinner" class="spinner-border ms-1" style="width: 2rem; height: 2rem;" role="status">
                                       <span class="visually-hidden">Loading...</span>
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
        </div>
    </section>
</div>
