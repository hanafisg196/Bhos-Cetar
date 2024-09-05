@extends('dashboard.template.main')
@section('content')
    @php
        function stringReplace($string)
        {
            $words = explode(' ', $string);
            $limit = 6;
            $replace = '....';
            $setence = count($words) > $limit ? implode(' ', array_slice($words, 0, $limit)) . $replace : $string;
            return $setence;
        }

        function strCut($string){
            return substr($string, 6);
        }
    @endphp
<div class="page-content">
    <section class="row">
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
                                            <th>Nama</th>
                                            <th>Pesan</th>
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
                                                <p class="mb-0">{{ $item->nama }}</p>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0">{{$item->message}}</p>
                                            </td>
                                            <td class="col-auto">
                                                <a class="btn icon btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#modal-{{ $item->id }}">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
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
                                        </tr>
                                    </thead>
                                    @foreach ($ranham as $item)
                                    <tbody>
                                        <tr>
                                            <td class="col-auto">
                                                <p class="mb-0">DOC190899</p>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0">{{$item->link}}</p>
                                            </td>
                                            {{-- <td class="col-auto">
                                                <a class="btn icon btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#modal-{{ $item->id }}">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td> --}}
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
