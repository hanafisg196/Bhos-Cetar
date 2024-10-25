@extends('admin.template.main')
@section('content')
<div class="page-content">
   <section class="row" style="margin-top: -30px;">
       <div class="col-12 col-xl-12">
         <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="lap-satu" data-bs-toggle="tab" href="#lapSatu "
                      role="tab" aria-controls="lapSatu" aria-selected="true">Statistik Laporan</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="lap-dua" data-bs-toggle="tab" href="#lapDua"
                     role="tab" aria-controls="lapDua" aria-selected="false">Statistik Kinerja</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" id="lap-tiga" data-bs-toggle="tab" href="#lapTiga"
                     role="tab" aria-controls="lapTiga" aria-selected="false">Statistik Kinerja</a>
                  </li>
               </ul>
              <div class="tab-content" id="myTabContent">
                @include('admin.tabs.tabs-satu')
                @include('admin.tabs.tabs-dua')
                @include('admin.tabs.tabs-tiga')
              </div>
            </div>
         </div>
       </div>
   </section>
      </div>
      @include('admin.tabs.laporan-satu-data')
      @include('admin.tabs.laporan-dua-data')
      @include('admin.tabs.laporan-tiga-data')
@endsection

