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
                                             Your data
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
