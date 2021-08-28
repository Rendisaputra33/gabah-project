const URL_ORIGIN = document.getElementById("baseurl").value;
const TOKEN = document.getElementById("token").value;

const getAll = () => {
    return fetch(`${URL_ORIGIN}/pengambilan/allpenjualan`)
        .then(res => res.json())
        .then(res => res.data);

}

const displayData = async () => {
    let temp = ''
    const data = await getAll()
    data.forEach(element => {
        temp += elementModal(element)
    });
    document.getElementById('list-detail').innerHTML = temp
}

function modalOpen() {
    document.getElementById('id01').style.display = 'block'
    displayData()
}

const elementModal = (res) => {
    return `
    <tr>
        <td>${res.invoice_penjualan}</td>
        <td>${formatRupiah(res.total_harga.toString(), 'Rp.')}</td>
        <td>${formatTanggal(res.tanggal_penjualan)}</td>
        <td><button class="header-icons" onclick="getAdd('${res.invoice_penjualan}')"><span class="material-icons-outlined">pan_tool</span></button></td>
    </tr>
    `
}

const replaceUrl = (inv) => {
    let temp = ''
    const split = inv.split('/')
    for (i = 0; i < split.length; i++) {
        if (i === split.length - 1) {
            console.log('true')
            temp += `${split[i]}`
        } else {
            console.log('false');
            temp += `${split[i]}-`
        }
    }
    return temp
}

const getAdd = (inv) => {

    const invoice = replaceUrl(inv)
    window.location.href = `${URL_ORIGIN}/pengambilan/action/add/${invoice}`

}

const formatTanggal = (tgl) => {
    const listMonth = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'November', 'Desember']
    const month = tgl.split('-')
    return `${month[2]}-${listMonth[parseInt(month[1]) - 1]}-${month[0]}`
}

const formatRupiah = (angka, prefix) => {
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