const URL_ORIGIN = document.getElementById("baseurl").value;
const TOKEN = document.getElementById("token").value;

function getAdd(id) {

    document.getElementById('id01').style.display = 'block'

    fetch(`${URL_ORIGIN}/pengambilan/action/get/${id}`)
        .then(res => res.json())
        .then(res => {
            document.getElementById('id').value = res.jumlah.id_detail_penjualan
            document.getElementById("jumlah").value = res.jumlah.sisa
            document.getElementById("inv").value = res.jumlah.invoice_penjualan
        })
}

document.getElementById('ambil').addEventListener("click", () => {

    const id = document.getElementById("id").value
    const jumlah = document.getElementById("jumlah").value
    const inv = document.getElementById("inv").value

    fetch(`${URL_ORIGIN}/pengambilan/action/saveTemp`, {
        method: 'POST',
        body: JSON.stringify({ id, jumlah, inv }),
        headers: { "Content-Type": "application/json", "X-CSRF-Token": TOKEN }
    }).then(res => document.getElementById('id01').style.display = 'none')
        .catch(err => console.log(err))

})
