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
                <div class="row">
                    <div class="page-heading">
                        <h3>Selamat Datang</h3>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h4>List Bantuan</h4>
                        <p> {{$data->links()}}</p>
                    </div>
                    <div class="card-body">
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
                                @foreach ($data as $key['dokumens'] =>  $item)
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
                                                    <p><strong>Dokument  </strong></p>
                                                    @foreach ($item['dokumens'] as $value)
                                                    <p>
                                                        {{ strCut($value->file) }}
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
                </div>
            </div>

        </section>
    </div>
@endsection
