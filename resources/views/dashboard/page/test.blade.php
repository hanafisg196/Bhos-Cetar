@extends('dashboard.template.main')
@section('content')
<div class="page-heading email-application overflow-hidden">
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

                                 </div>
                             </div>
                             <div class="email-user-list list-group ps ps--active-y">
                                 <ul class="users-list-wrapper media-list">
                                    <li class="media mail-read">
                                       <div class="user-action">
                                           <div class="checkbox-con me-3">
                                               <div class="checkbox checkbox-shadow checkbox-sm">
                                                   <input type="checkbox" id="checkboxsmall1"
                                                       class='form-check-input'>
                                                   <label for="checkboxsmall1"></label>
                                               </div>
                                           </div>
                                           <span class="favorite text-warning">
                                               <svg class="bi" width="1.5em" height="1.5em" fill="currentColor">
                                                   <use
                                                       xlink:href="assets/static/images/bootstrap-icons.svg#star-fill" />
                                               </svg>
                                           </span>
                                       </div>
                                       <div class="pr-50">
                                           <div class="avatar">
                                               <img src="./assets/compiled/jpg/1.jpg" alt="avtar img holder">
                                           </div>
                                       </div>
                                       <div class="media-body">
                                           <div class="user-details">
                                               <div class="mail-items">
                                                   <span class="list-group-item-text text-truncate">Open source
                                                       project public release 👍</span>
                                               </div>
                                               <div class="mail-meta-item">
                                                   <span class="float-right">
                                                       <span class="mail-date">4:14 AM</span>
                                                   </span>
                                               </div>
                                           </div>
                                           <div class="mail-message">
                                               <p class="list-group-item-text truncate mb-0">
                                                   Hey John, bah kivu decrete epanorthotic unnotched
                                                   Argyroneta nonius veratrine preimaginary
                                               </p>
                                               <div class="mail-meta-item">
                                                   <span class="float-right">
                                                       <span class="bullet bullet-success bullet-sm"></span>
                                                   </span>
                                               </div>
                                           </div>
                                       </div>
                                   </li>
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

@endsection
