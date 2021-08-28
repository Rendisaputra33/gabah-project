const tombol = document.getElementById('btn-cetak')
const documen = document.getElementById('cetak')

tombol.addEventListener('click', () => {
    var restorepage = document.body.innerHTML
    var printcontent = documen.innerHTML
    document.body.innerHTML = printcontent
    window.print()
    document.body.innerHTML = restorepage
})