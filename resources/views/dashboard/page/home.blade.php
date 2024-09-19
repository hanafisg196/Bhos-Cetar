@extends('dashboard.template.main')
@section('content')
{{timeMachine()}}
<div class="page-content">
    <section class="row" style="margin-top: -25px;">
        <div class="col-12 col-lg-9">
            <div class="page-heading">
                <h3>Selamat Datang</h3>
            </div>
        </div>
        <div class="col-12 col-xl-10">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="table-tab" data-bs-toggle="tab" href="#tableContent" role="tab" aria-controls="tableContent" aria-selected="true">Laporan Bantuan Hukum</a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="other-tab" data-bs-toggle="tab" href="#otherContent" role="tab" aria-controls="otherContent" aria-selected="false">Laporan Aksi Ham</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tableContent" role="tabpanel" aria-labelledby="table-tab">
                            {{-- <div class="col-md-6 mt-3">
                                <div class="input-group mb-2">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="bi bi-search" style="margin-bottom: 8px;"></i>
                                    </span>
                                    <input type="text" class="form-control" placeholder="Pencarian"
                                        aria-label="Pencarian" aria-describedby="button-addon2">
                                    <button class="btn btn-outline-secondary" type="button"
                                        id="button-addon2">Cari</button>
                                </div>
                            </div> --}}
                            <div class="table-responsive" style="overflow-y: scroll; max-height: 400px; overflow-x: hidden">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Waktu</th>
                                            <th>Status</th>
                                            <th>Code</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    @foreach ($bantuan as $key['dokumens'] =>  $item)
                                   <tbody>
                                        <tr style="margin-bottom: 0; padding-bottom: 0;">
                                            <td class="col-auto" style="padding: 5px 0;">
                                                <p class="mb-0" style="margin-bottom: 0;">{{$item->created_at->diffForHumans()}}</p>
                                            </td>
                                            <td class="col-3" style="padding: 5px 0;">
                                                <div class="d-flex align-items-center">
                                                    <p class="font-bold ms-3 mb-0" style="margin-bottom: 0;
                                                    color: {{$item->status === 'Disetujui' ? 'green' :
                                                     ($item->status === 'Ditolak' ? 'red':
                                                     ($item->status === 'Usulan' ? 'orange' : 'blue'))}}">
                                                     {{ $item->status }}</p>
                                                </div>

                                            </td>
                                            <td class="col-auto" style="padding: 5px 0;">
                                                <p class="mb-0" style="margin-bottom: 0;">{{$item->code}}</p>
                                            </td>
                                            <td class="col-auto" style="padding: 5px 0;">
                                                <a class="btn icon btn-primary" data-bs-toggle="modal" data-bs-target="#modal-{{ $item->id }}">
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
                                                    <p style="margin-bottom: -2px;"><strong>Dokument :
                                                    @foreach ($item['dokumens'] as $value)
                                                    <p style="margin: 0px;">
                                                     </strong>{{ strCut($value->file) }}
                                                        <a style="size: 15px; margin-left: 10px;" href="{{route('schedule.download', ['file' => strCut($value->file)])}}"  >
                                                            <i class="bi bi-arrow-down-square-fill"></i>
                                                        </a>
                                                        @endforeach
                                                    </p>
                                                    </p>
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
                                {{$bantuan->links()}}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="otherContent" role="tabpanel" aria-labelledby="other-tab">
                            <div class="table-responsive" style="overflow-y: scroll; max-height: 400px; overflow-x: hidden">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Waktu</th>
                                            <th>Kode</th>
                                            <th>Status</th>
                                            <th>Link</th>
                                            <th>Lihat</th>
                                        </tr>
                                    </thead>
                                    @foreach ($ranham as $val)
                                    <tbody>
                                        <tr style="padding: 0;">
                                            <td class="col-auto" style="padding: 5px;">
                                                <p class="mb-0" style="margin: 0;">{{$item->created_at->diffForHumans()}}</p>
                                            </td>
                                            <td class="col-auto" style="padding: 5px;">
                                                <p class="mb-0" style="margin: 0;">{{$val->code}}</p>
                                            </td>
                                            <td class="col-auto" style="padding: 5px;">
                                                <p class="mb-0"
                                                style="margin: 0;color:
                                                {{$val->status === 'Disetujui' ? 'green' : ($val->status === 'Ditolak' ? 'red':($val->status === 'Usulan' ? 'orange' : 'blue'))}}">
                                                {{$val->status}}
                                            </p>
                                            </td>
                                            <td class="col-auto" style="padding: 5px;">
                                                <p class="mb-0" style="margin: 0;">{{$val->link}}</p>
                                            </td>
                                            <td class="col-auto" style="padding: 5px;">
                                                <a href="{{$val->link}}" class="btn icon btn-primary" style="padding: 5px 10px;">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                                {{$ranham->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('dashboard.component.tab-active-session')
@endsection






