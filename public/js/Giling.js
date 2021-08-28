const selector = document.getElementById('selector')
const url_origin = document.getElementById('baseurl').value
const token = document.getElementById('token').value

async function getk() {
    const data = await fetch(`${url_origin}/getSelect`)
    return await data.json()
}

async function display() {
    let html = ''
    const data = await getk()
    data.data.forEach(res => html += ele(res))
    selector.innerHTML = html
}

function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? '.' : ''
        rupiah += separator + ribuan.join('.')
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '')
}

function ele(res) {
    return `<option value="${res.kode_penerimaan}">${res.nama_gabah} - ${res.tanggal}</option>  `
}

document.getElementById('selep').addEventListener('click', async function () {
    try {
        this.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Loading'
        await addKering()
        console.log(document.getElementById('selector').value)
    } catch (error) {
        console.log(error)
    } finally {
        this.innerHTML = 'success'
        setTimeout(() => {
            document.getElementById('id02').style.display = 'none'
        }, 2000)
    }
})

document.getElementById('modal').addEventListener('click', async function () {
    await display()
})

function addKering() {

    const kode = document.getElementById('selector').value
    const tgl = document.getElementById('tanggal').value
    const berat = document.getElementById('berat').value

    fetch(`${url_origin}/gabah/giling`, {
        method: 'POST',
        body: JSON.stringify({ kode: kode, tgl: tgl, berat: berat }),
        headers: { 'Content-Type': 'application/json', 'X-CSRF-Token': token }
    })
        .then(response => displayGiling())
        .catch(err => console.log(err))
}

async function getG() {
    const process = await fetch(`${url_origin}/gabah/getGil`)
    const result = await process.json()
    return result
}

async function displayGiling() {
    let el = ''
    let no = 1
    const data = await getG()
    data.data.forEach(res => el += elementGiling(res, no++))
    document.getElementById('data-giling').innerHTML = el
}

function elementGiling(res, no) {
    return `
        <tr>
            <td>${no}</td>
            <td>${res.nama_gabah}</td>
            <td>${res.total_berat}</td>
            <td>${formatRupiah(res.total_bayar.toString(), 'Rp.')}</td>
            <td>${formatTanggal(res.tanggal)}</td>
        </tr>
    `
}

const formatTanggal = (tgl) => {
    const listMonth = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'November', 'Desember']
    const month = tgl.split('-')
    return `${month[2]}-${listMonth[parseInt(month[1]) - 1]}-${month[0]}`
}

displayGiling()