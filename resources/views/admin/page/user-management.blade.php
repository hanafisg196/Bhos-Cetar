@extends('admin.component.main')
@section('content')
    <div class="email-app-area">
        <div class="email-app-list-wrapper">
            <div class="email-app-list" style="margin-top: 15px;">
                <div class="email-action">
                    <div class="action-right d-flex flex-grow-1 align-items-center justify-content-around">
                        <div class="sidebar-toggle d-block d-lg-none">
                            <button class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-list fs-5"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="row" id="table-hover-row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">List User</h4>
                                    <a href="{{route('admin.dashboard.rule.form')}}" class="btn btn-primary btn-md" style="margin-left: 10px;">
                                        <i class="bi bi-plus-lg"></i>&nbsp;Tambah Anggota
                                    </a>
                                </div>
                                <div class="card-content">
                                    <!-- table hover -->
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Nama</th>
                                                    <th>Nip</th>
                                                    <th>Role</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data as $item)
                                                <tr>
                                                    <td class="text-bold-500">{{$item->nama}}</td>
                                                    <td>{{$item->nip}}</td>
                                                    <td class="text-bold-500">{{$item->ruleType->nama}}</td>
                                                    <td>Edit</td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
