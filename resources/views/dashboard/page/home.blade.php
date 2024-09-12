@extends('dashboard.template.main')
@section('content')
<div class="page-content">
    <section class="row" style="margin-top: -25px;">
        <div class="col-12 col-lg-9">
            <div class="page-heading">
                <h3>Selamat Datang</h3>
            </div>
        </div>
        <div class="col-12 col-xl-8">
            <div class="card">
                <div class="card-body">

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="table-tab" data-bs-toggle="tab" href="#tableContent" role="tab" aria-controls="tableContent" aria-selected="true">Bantuan Hukum</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="other-tab" data-bs-toggle="tab" href="#otherContent" role="tab" aria-controls="otherContent" aria-selected="false">Laporan Ham</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="tableContent" role="tabpanel" aria-labelledby="table-tab">
                            <div class="card-header">
                                <p> {{$bantuan->links()}}</p>
                            </div>
                            <div class="table-responsive" style="overflow-y: scroll; max-height: 400px; overflow-x: hidden">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Kode</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    @foreach ($bantuan as $key['dokumens'] =>  $item)
                                    <tbody>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <hr style="border: none; border-left: 5px solid #435ebe; height: 30px;">
                                                    <p class="font-bold ms-3 mb-0">{{ $item->status }}</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0">{{$item->code}}</p>
                                            </td>
                                            <td class="col-auto">
                                                <a class="btn icon btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#modal-{{ $item->id }}">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                     <!-- Disabled Backdrop Modal -->
                                     <div class="modal fade text-left" id="modal-{{ $item->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="myModalLabel-{{ $item->id }}"
                                        data-bs-backdrop="false" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                            role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myModalLabel-{{ $item->id }}">Detail
                                                    </h4>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i data-feather="x"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p><strong>Nama : </strong>{{ $item->nama }}</p>
                                                    <p><strong>Email :  </strong>{{ $item->email }}</p>
                                                    <p><strong>WA : </strong>{{ $item->wa }}</p>
                                                    <p><strong>Alamat : </strong>{{ $item->alamat }}</p>
                                                    <p><strong>Kronologi : </strong>{{ $item->kronologi }}</p>

                                                    @foreach ($item['dokumens'] as $value)
                                                    <p><strong>Dokument : </strong>{{ strCut($value->file) }}
                                                        <a style="size: 15px; margin-left: 10px;" href="{{route('schedule.download', ['file' => strCut($value->file)])}}"  >
                                                            <i class="bi bi-arrow-down-square-fill"></i>
                                                        </a>
                                                    </p>

                                                    @endforeach
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-secondary"
                                                        data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Tutup</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="otherContent" role="tabpanel" aria-labelledby="other-tab">
                            <div class="table-responsive" style="overflow-y: scroll; max-height: 400px; overflow-x: hidden">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Link</th>
                                            <th>Lihat</th>
                                        </tr>
                                    </thead>
                                    @foreach ($ranham as $val)
                                    <tbody>
                                        <tr>
                                            <td class="col-auto">
                                                <p class="mb-0">{{$val->code}}</p>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0">{{$val->link}}</p>
                                            </td>
                                            <td class="col-auto">
                                                <a  href="{{$val->link}}" class="btn icon btn-primary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

@endsection






