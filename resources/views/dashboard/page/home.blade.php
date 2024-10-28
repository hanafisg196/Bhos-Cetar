@extends('dashboard.template.main')
@section('content')
{{timeMachine()}}
<div class="page-content">
    <section class="row">
      <div class="col-12">
         <div class="card">
             <div class="card-header">
                 <h4 class="card-title">Grafik Laporan</h4>
             </div>
             <div class="card-content">
               <div class="card-body">
                  <div id="chart"></div>
               </div>
            </div>
            </div>
         </div>
    </section>
</div>
@include('dashboard.report.report-bar')
@include('dashboard.component.tab-active-session')
@endsection






