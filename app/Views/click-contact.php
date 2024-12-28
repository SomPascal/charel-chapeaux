<a href="<?= esc($link) ?>" id="clickable-link" target="_blank"></a>

<script>
    document.addEventListener('DOMContentLoaded', ()=> {
        document.querySelector('#clickable-link').click()
        // history.back()
    })
</script>