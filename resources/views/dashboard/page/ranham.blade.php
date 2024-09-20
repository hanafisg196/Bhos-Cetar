@extends('dashboard.template.main')
@section('content')
    <section id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Laporan Ham</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('ranham.create') }}" method="post" id="inputForm"
                                style="margin-top: -40px; ">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="last-name-column">Link</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text"><i class="bi bi-link-45deg"></i></span>
                                                <input type="text" class="form-control @error('link') is-invalid @enderror" name="link" id="link"
                                                    aria-label="Dollar amount (with dot and two decimal places)" value="{{old('link')}}">
                                                    @error('link')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="last-name-column">KKP</label>
                                            <ul class="list-unstyled mb-0">

                                                <li class="d-inline-block me-2 mb-1">
                                                    @foreach ($kkp as $item)
                                                        <div class="form-check">
                                                            <input class="form-check-input @error('kkp') is-invalid @enderror" type="radio" name="kkp"
                                                                id="flexRadioDefault{{ $item->id }}"
                                                                value="{{ $item->id }}" {{ old('kkp') == $item->id ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="flexRadioDefault{{ $item->id }}">
                                                                {{ $item->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                    @error('kkp')
                                                    <p style="color: red; font-size: 0.9rem;">{{$message}}</p>
                                                     @enderror
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
