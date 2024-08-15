@extends('dashboard.template.main')
@section('content')
@php

function stringReplace($string)
{
$words = explode(' ', $string);
$limit = 6;
$replace = '....';
$setence = (count($words) > $limit) ? implode(' ', array_slice($words, 0, $limit)).$replace : $string;
return $setence;
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
                        <h4>List Schedule</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive"  style="overflow-y: scroll; max-height: 400px; overflow-x: hidden">
                            <table class="table table-hover table-lg" >
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>Nama</th>
                                        <th>Kronologi</th>
                                    </tr>
                                </thead>
                                @foreach ($data as $item)
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
                                            <p class="mb-0">{{ stringReplace($item->kronologi)  }}</p>
                                        </td>
                                    </tr>

                                </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection
