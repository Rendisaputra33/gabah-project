const url_origin = document.getElementById('baseurl').value
const token = document.getElementById('token').value

async function getData() {
    let elemen = ''
    let no = 1
    const data = await get()
    console.log(data.data.length)
    if (data.data.length == 0) {
        document.getElementById('list-data').innerHTML = 'data not found'
    } else {
        data.data.forEach(elements => elemen += element(no++, elements))
        document.getElementById('list-data').innerHTML = elemen
    }
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

getData()

function element(no, data) {
    return `
    <tr>
        <td>${no}</td>
        <td>${data.nama_gabah}</td>
        <td>${data.total_berat}</td>
        <td>${formatRupiah(data.total_bayar.toString(), 'Rp.')}</td>
        <td>${formatTanggal(data.tanggal)}</td>
    </tr>
    `
}

async function get() {
    const process = await fetch(`${url_origin}/gabah/kering/data`)
    const result = await process.json()
    return result
}

function getmodal(kode) {
    document.getElementById('id02').style.display = 'block'
    document.getElementById('kodepe').value = kode
}

const formatTanggal = (tgl) => {
    const listMonth = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'November', 'Desember']
    const month = tgl.split('-')
    return `${month[2]}-${listMonth[parseInt(month[1]) - 1]}-${month[0]}`
}
