<div>
    {{-- The whole world belongs to you. --}}
    <div class="user-menu d-flex">
        <div class="user-name text-end me-3">
            <h6 class="mb-0 text-gray-600">{{$data['name']}}</h6>
            <p class="mb-0 text-sm text-gray-600" title="{{$data['jabatan']}}">{{trimName($data['jabatan'])}}</p>
        </div>
        <div class="user-img d-flex align-items-center">
            <div class="avatar avatar-md">
                <img src="/dist/assets/compiled/png/user.png" alt="">
            </div>
        </div>
    </div>
</div>



