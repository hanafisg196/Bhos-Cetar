<div>
    {{-- The whole world belongs to you. --}}
    <div class="recent-message d-flex px-2 py-2">
        <div class="avatar avatar-lg">
            <img src="/assets/compiled/jpg/4.jpg">
        </div>
        <div class="name" style="margin-left:20px;">
            @foreach ($data as $key['jabatan'] => $val)
             <h6 class="text ms-10">{{ $val['nama'] }}</h6>
             @endforeach
        </div>

    </div>
</div>
