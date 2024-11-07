<div>
    {{-- Be like water. --}}
    @php
        $statusOptions = ['Disetujui', 'Revisi', 'Ditolak'];
    @endphp
    <div style="margin-top: -30px; margin-bottom: 30px;">
        <a href="{{ route('admin.list.ecorrection') }}" class="btn btn-primary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>


    <section class="section"
        style="max-height: 700px;  overflow-y: scroll; scrollbar-width: none;-ms-overflow-style: none;">
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
                              @if ($data->status === 'Disposisi')
                              <span class="d-sm-inline d-none">&nbsp;&nbsp;
                               <strong>{{ ($data->message && $data->message !== '-') ? 'Pesan - ' . $data->message : '' }}</strong>
                              </span>
                              @endif
                              <small class="text-muted d-block">Kepada Sistem Bhos Cetar</small>
                          </div>
                        </div>
                        <div class="mb-2">
                           <p class="text-bold-500" style="margin-top: 15px;">Nama : {{ $data->users->name }}</p>
                           <p class="text-bold-500" style="margin-top: 15px;">Nip : {{ $data->users->nip }}</p>
                           <p class="text-bold-500" style="margin-top: 15px;">Kode dokumen : {{ $data->code }}</p>
                           <p class="text-bold-500" style="margin-top: 15px;">Judul : {{ $data->title }}</p>

                        </div>

                    </div>
                    <h7 class="sidebar-label" style="margin-left: 10px;">
                        Lampiran
                    </h7>
                    @foreach ($data['dokumens'] as $item)
                        <ul class="list-unstyled mb-1">
                            <li class="cursor-pointer pb-25" style="margin-left: 10px;">
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div style="display: flex; align-items: center;">
                                        @if (str_contains($item->file, 'pdf'))
                                            <img src="/dist/assets/compiled/png/pdf.png" height="25" alt="">
                                        @else
                                            <img src="/dist/assets/compiled/png/image.png" height="25"
                                                alt="">
                                        @endif
                                        <small class="text-muted attachment-text" style="margin-left: 10px;">
                                            {{ strCut($item->file) }}
                                        </small>
                                    </div>
                                    <div style="margin-inline-end: 70%">
                                        <button wire:click="download('{{ $item->file }}')"
                                            class="btn icon btn-primary btn-sm">
                                            <i class="bi bi-download"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <div>

                                        @if ($hasDispos)
                                        <button type="button" class="btn btn-outline-primary block"
                                        data-bs-toggle="modal" data-bs-target="#default2">
                                        Disposisi
                                        </button>
                                        @else
                                        <button type="button" class="btn btn-outline-primary block"
                                        data-bs-toggle="modal" data-bs-target="#default">
                                        Ubah Status
                                       </button>
                                         @endif

                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <iframe src="{{ asset('storage/' . $item->file) }}"
                                        style="width:818px; height:800px;" title="doc" name="contents"></iframe>
                                </div>

                            </li>
                        </ul>
                    @endforeach
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
                                <form  enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="col-md-6 col-12">
                                            <fieldset class="form-group">
                                                <p>Status saat ini - {{ $data->status }}</p>
                                                <select wire:model="status" class="form-select" id="basicSelect">
                                                    <option selected>Pilih...</option>
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


                                          <div class="form-group">
                                             <label for="message">Detail Pebaikan (Opsional)</label>
                                             <input class="form-control form-control-sm" wire:model="file" name="file" id="file" type="file">
                                             <div>
                                                @error('file')
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
                                        <button wire:loading.remove wire:click="updateEcor('{{ $data->id }}')" type="button"
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

                     <!--Basic Modal -->
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
                                       <option selected>Pilih Verifikator 2...</option>
                                       @foreach ($verifikatorTwo as $ver)
                                           <option value="{{ $ver->nip }}">{{ $ver->name }}
                                           </option>
                                       @endforeach
                                       <input type="text" wire:model="vname" hidden>
                                   </select>
                                   </fieldset>
                                   <div>
                                    @error('verifikator')
                                        {{ $message }}
                                    @enderror
                                  </div>
                                  <label for="message">Pesan</label>
                                  <textarea class="form-control" id="message" name="message" rows="5" wire:model="pesan"></textarea>
                                  <div>
                                      @error('pesan')
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
                                     <button wire:click="updateVerifikatorTwo('{{ $data->id }}')" type="button"
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
    <div>
