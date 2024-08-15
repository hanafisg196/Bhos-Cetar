@extends('admin.component.main')
@section('content')
@livewire('inbox-detail-live', ['id' => $id])
@endsection
