@extends('admin.component.main')
@section('content')
<div class="app-content-overlay"></div>
    <div class="email-app-area">
        <div class="email-app-list-wrapper">
            <div class="email-app-list">
                <div class="email-action">

                    <div class="action-right d-flex flex-grow-1 align-items-center justify-content-around">
                        <div class="sidebar-toggle d-block d-lg-none">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-list fs-5"></i>
                            </button>
                        </div>

                        <div class="email-fixed-search flex-grow-1">
                            <div class="form-group position-relative  mb-0 has-icon-left">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="email-user-list list-group ps ps--active-y">
                    <ul class="users-list-wrapper media-list" style="margin-left: 10px; margin-right: 10px; margin-top: 10px;">
                        <div class="row">
                           <h5>Total Laporan</h5>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card" style="background:#364b98">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon blue mb-2">
                                                    <i class="iconly-boldDocument"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-white font-semibold">Tahun ini</h6>
                                                <h6 class="text-white font-extrabold mb-0">{{ $tahun }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card" style="background:#364b98">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon blue mb-2">
                                                    <i class="iconly-boldDocument"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-white font-semibold">Bulan ini</h6>
                                                <h6 class="text-white font-extrabold mb-0">{{ $bulan }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card" style="background:#364b98">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon blue mb-2">
                                                    <i class="iconly-boldDocument"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-white font-semibold">Minggu ini</h6>
                                                <h6 class="text-white font-extrabold mb-0">{{ $minggu }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
