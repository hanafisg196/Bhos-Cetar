@section('script')
    <script>
        document.addEventListener('livewire:navigated', () => {
            FilePond.registerPlugin(
                FilePondPluginImagePreview,
                FilePondPluginImageExifOrientation,
                FilePondPluginFileValidateSize,
                FilePondPluginFileValidateType,
            );
            const inputElement = document.querySelector('input[type="file"]');
            const pond = FilePond.create(inputElement, {
                allowMultiple: true,
                server: {
                    process: '{{ route('upload') }}',
                    revert: '/delete',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }
            });
        })
    </script>
@endsection
