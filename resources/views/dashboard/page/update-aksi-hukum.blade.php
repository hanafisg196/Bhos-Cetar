@extends('dashboard.template.main')
@section('content')
    <style>
        .card-header p {
            margin-bottom: 5px;
        }
    </style>
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"></h4>
                        <p><strong>Kode - </strong>{{ $data->code }}</p>
                        <p><strong>Status - </strong>{{ $data->status }}</p>
                        <p><strong>Pesan - </strong>{{ $data->message }}</p>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('update.aksi.ham', encrypt($data->id)) }}"
                                method="post" id="inputForm" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Link</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="bi bi-link-45deg"></i></span>
                                                <input type="text" class="form-control" name="link" id="link"
                                                    aria-label="Dollar amount (with dot and two decimal places)"
                                                    value="{{ $data->link }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="last-name-column">KKP</label>
                                            <ul class="list-unstyled mb-0">

                                                <li class="d-inline-block me-2 mb-1">
                                                    @foreach ($kkp as $item)
                                                        <div class="form-check">
                                                            @if (old('kkp_id', $data['kkp_id']) == $item->id)
                                                                <input class="form-check-input" type="radio"
                                                                    name="kkp_id" id="flexRadioDefault{{ $item->id }}"
                                                                    value="{{ $item->id }}" checked>
                                                                <label class="form-check-label"
                                                                    for="flexRadioDefault{{ $item->id }}">
                                                                    {{ $item->name }}
                                                                </label>
                                                            @else
                                                                <input class="form-check-input" type="radio"
                                                                    name="kkp_id" id="flexRadioDefault{{ $item->id }}"
                                                                    value="{{ $item->id }}">
                                                                <label class="form-check-label"
                                                                    for="flexRadioDefault{{ $item->id }}">
                                                                    {{ $item->name }}
                                                                </label>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </li>

                                            </ul>
                                        </div>
                                    </div>

                                    <div class="col-12 d-flex justify-content-end">
                                        <button style="display: none" id="loading" class="btn btn-primary" type="button"
                                            disabled>
                                            <span class="spinner-border spinner-border-sm" role="status"
                                                aria-hidden="true"></span>
                                            Loading...
                                        </button>
                                        <button style="display: block" id="send" type="submit"
                                            class="btn btn-primary me-1 mb-1">Kirim</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('dashboard.component.sweet-toast')
    @include('dashboard.component.button-loading')
@endsection
