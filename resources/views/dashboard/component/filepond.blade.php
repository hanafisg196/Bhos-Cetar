@section('script')
    <script>
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginFileValidateSize,
            FilePondPluginFileValidateType
        );
        const inputElement = document.querySelector('input[type="file"]');
        const subMit = document.getElementById('send');
        const load = document.getElementById('loading');
        const pond = FilePond.create(inputElement, {
            allowMultiple: true,
            server: {
                process: '/upload',
                revert: '/delete',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }
        });
        pond.on('addfilestart', (e) => {
            subMit.style.display = 'none'
            load.style.display = 'block'

        });

        pond.on('processfile', (error, file) => {
            if (!error) {
                load.style.display = 'none'
                subMit.style.display = 'block'
            }
        });
    </script>
@endsection
