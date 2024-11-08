<div class="modal fade text-left"  id="modals-{{ $item->id }}" tabindex="-1" role="dialog"
   aria-labelledby="myModalLabel1" aria-hidden="true">
   <div class="modal-dialog modal-dialog-scrollable" role="document">
       <div class="modal-content">
           <div class="modal-header">
               <h5 class="modal-title" id="myModalLabel1">Pelacakan Status</h5>
               <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                   <i data-feather="x"></i>
               </button>
           </div>
           <div class="modal-body">
            @foreach ($item['trackingPoints'] as $track)
            <div class="card mb-1">
                <div class="card-body">
                  @if ($track->nama_pemohon)
                  <p class="mb-1"><strong>Pemohon - {{$track->nama_pemohon}}</strong> </p>
                  @elseif ($track->status === 'Disposisi')
                  <p style="margin-bottom: -3px;">Di dispoisikan oleh Kabag Hukum - <strong>{{$track->nama_kabag}}</strong></p>
                  <p class="mb-1">Kepada <strong>Pemeriksa - {{$track->nama_pemeriksa}}</strong> </p>
                  @else
                  <p class="mb-1"><strong>Pemeriksa - {{$track->nama_pemeriksa}}</strong> </p>
                  @endif
                    <h6 class="card-title">Status: {{ $track->status }}</h6>
                    <p class="text-muted mb-0"><small>{{ $track->created_at->diffForHumans() }}</small></p>
                </div>
            </div>
            @endforeach
           </div>
           <div class="modal-footer">
               <button type="button" class="btn" data-bs-dismiss="modal">
                   <i class="bx bx-x d-block d-sm-none"></i>
                   <span class="d-none d-sm-block">Tutup</span>
               </button>
           </div>
       </div>
   </div>
  </div>
