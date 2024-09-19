<script>
    window.onload = function() {

        const holders = document.querySelectorAll('tbody[id^="holder"]');
        const contents = document.querySelectorAll('tbody[id^="content"]');

        holders.forEach((holder, index) => {
            const content = contents[index];
            if (holder && content) {
               setTimeout(() => {
                holder.style.display = 'none';
                content.style.display = '';
               }, 500);
            }
        });
    };
</script>
