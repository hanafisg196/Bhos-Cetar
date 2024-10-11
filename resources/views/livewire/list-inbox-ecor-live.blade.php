<div>
   {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
   {{ timeMachine() }}
   <style>
       .email-user-list {
           overflow-y: scroll !important;
       }
   </style>
     <div class="page-heading email-application overflow-hidden" style="margin-top:-20px; ">
        <section class="section content-area-wrapper">
            <div class="content-right" style="width: 120%">
                <div class="content-overlay">
                </div>
                <div class="content-wrapper">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                       <div class="email-app-area">
                          <div class="email-app-list-wrapper">
                              <div class="email-app-list" style="margin-top: 15px;">
                                  <div class="email-action">
                                      <div class="action-right d-flex flex-grow-1 align-items-center justify-content-around">
                                          <div class="email-fixed-search flex-grow-1">

                                          </div>

                                      </div>
                                  </div>
                                  <div class="email-user-list list-group ps ps--active-y">
                                      <ul class="users-list-wrapper media-list">
                                       @if ($data->isNotEmpty())
                                       @foreach ($data as $item)
                                       <li class="media">
                                          <a href="#" class="d-flex align-items-center
                                          text-decoration-none text-dark w-100">
                                             <div class="pr-50">
                                                 <div class="avatar">
                                                     <img src="/dist/assets/compiled/png/document.png" alt="avatar img holder">
                                                 </div>
                                             </div>
                                             <div class="media-body">
                                                 <div class="user-details">
                                                     <div class="mail-items">
                                                      <span class="list-group-item-text text-truncate">{{ $item->nama }}</span>
                                                      @if ($item->status == 'Ditolak')
                                                      <span class="list-group-item-text text-truncate"
                                                          style="color: red">{{ $item->status }}</span>
                                                  @elseif ($item->status == 'Disetujui')
                                                      <span class="list-group-item-text text-truncate"
                                                          style="color: green">{{ $item->status }}</span>
                                                  @elseif ($item->status == 'Revisi')
                                                      <span class="list-group-item-text text-truncate"
                                                          style="color: #007aff">{{ $item->status }}</span>
                                                  @else
                                                      <span class="list-group-item-text text-truncate"
                                                          style="color: burlywood">{{ $item->status }}</span>
                                                  @endif
                                                     </div>
                                                     <div class="mail-meta-item">
                                                      <span class="float-right">
                                                      <span
                                                              class="mail-date">{{ $item->created_at->diffForHumans() }}</span>
                                                      </span>
                                                  </div>
                                                 </div>
                                                 <div class="mail-message">
                                                     <p class="list-group-item-text truncate mb-0">
                                                         {{ trimString($item->title) }}
                                                     </p>
                                                     <div class="mail-meta-item">
                                                         <span class="float-right">
                                                             <span class="bullet bullet-success bullet-sm"></span>
                                                         </span>
                                                     </div>
                                                 </div>
                                             </div>
                                         </a>
                                       </li>
                                       @endforeach
                                       @else
                                       <div class="d-flex justify-content-center mt-5">Data tidak ditemukan.</div>
                                       @endif
                                      </ul>
                                  </div>

                              </div>
                          </div>
                      </div>

                    </div>
                </div>
            </div>
        </section>
     </div>
@if (session()->has('status'))
       <script>
           document.addEventListener('livewire:navigated', () => {
               Toastify({
                   text: "{{ session('status') }}",
                   duration: 3000,
                   close: true,
               }).showToast();
           }, {
               once: true
           })
       </script>
   @endif
</div>
