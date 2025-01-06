<a href="<?= esc($link) ?>" id="clickable-link"></a>

<script>
    document.addEventListener('DOMContentLoaded', ()=> {
        document.querySelector('#clickable-link').click()
        // history.back()
    })
</script>