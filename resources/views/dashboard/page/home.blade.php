@extends('dashboard.template.main')
@section('content')
{{timeMachine()}}
<div class="page-content">
    <section class="row">
      <div id="chart"></div>
    </section>
</div>
@include('dashboard.report.report-bar')
@include('dashboard.component.tab-active-session')
@endsection






