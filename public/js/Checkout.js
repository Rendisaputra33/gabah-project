const documen = document.getElementById('cetak')
const tombolCetak = document.getElementById('tombol')

tombolCetak.addEventListener('click', () => {
    document.getElementById('btn').innerHTML = `<button class="btn btn-primary" type="button" disabled>
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Loading...
    </button>`

    setTimeout(() => {
        var restorepage = document.body.innerHTML
        var printcontent = documen.innerHTML
        document.body.innerHTML = printcontent
        window.print()
        document.body.innerHTML = restorepage
        document.getElementById('btn').innerHTML = `<button type="button" class="btn btn-success mb-2 tmbl" id="tombol">
        <i class="bi bi-printer"></i> Cetak
        </button>`
    }, 2000)

})
