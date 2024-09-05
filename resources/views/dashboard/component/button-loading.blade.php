<script>
        var inputForm = document.getElementById('inputForm');
        var sendButton = document.getElementById('send');
        var loading = document.getElementById('loading');

        inputForm.addEventListener('submit', function() {
            sendButton.style.display = 'none';
            loading.style.display = 'block';
        });
</script>
