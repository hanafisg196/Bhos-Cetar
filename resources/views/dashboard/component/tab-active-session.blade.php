<script>
    document.querySelectorAll('.nav-link').forEach(tab => {
        tab.addEventListener('click', function () {
            localStorage.setItem('activeTab', this.getAttribute('href'));
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            var tab = document.querySelector(`a[href="${activeTab}"]`);
            var tabInstance = new bootstrap.Tab(tab);
            tabInstance.show();
        }
    });
    </script>


