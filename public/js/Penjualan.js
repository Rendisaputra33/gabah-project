const URL_ORIGIN = document.getElementById('baseurl').value;
const token = document.getElementById('token').value;

// function add penjualan global
const addPenjualan = () => {
    const tgl = document.querySelector('input[name=tgl]').value;
    const customer = document.querySelector('select[name=customeradd]').value;

    fetch(`${URL_ORIGIN}/penjualan/action/add`, {
        method: 'post',
        body: JSON.stringify({
            tgl: tgl,
            customer: customer,
        }),
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': token,
        },
    })
        .then(res => {
            getGlobal();
            document.getElementById('id02').style.display = 'none';
        })
        .catch(err => {
            console.log(err);
        });
};

// function add detail penjualan
const addDetail = () => {
    const barang = document.querySelector('select[name=barang]').value;
    const jumlah = document.querySelector('input[name=jumlah]').value;
    const invo = document.getElementById('inv').value;

    fetch(`${URL_ORIGIN}/penjualan/action/addDetail`, {
        method: 'post',
        body: JSON.stringify({
            barang: barang,
            customer: document.getElementById('customer').value,
            jumlah: jumlah,
            inv: invo,
        }),
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-Token': token,
        },
    })
        .then(res => {
            getDetail(invo, document.getElementById('customer').value);
            getGlobal();
            document.getElementById('id03').style.display = 'none';
        })
        .catch(err => {});
};

// function get detail penjualan
const getDetail = async (inv, customer) => {
    document.getElementById('id01').style.display = 'block';
    document.getElementById('customer').value = customer;
    document.getElementById('inv').value = inv;
    const invoice = replaceUrl(inv);
    let html = '';
    const pro = await fetch(`${URL_ORIGIN}/penjualan/invoice/${invoice}`);
    const data = await pro.json();
    await data.data.forEach(element => (html += elementHtml(element)));
    document.getElementById('list-detail').innerHTML = html;
    document.getElementById('cetak').addEventListener('click', function () {
        printInv(inv);
    });
};

const formatRupiah = (angka, prefix) => {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? 'Rp. ' + rupiah : '';
};

const replaceUrl = inv => {
    let temp = '';
    const split = inv.split('/');
    for (i = 0; i < split.length; i++) {
        if (i === split.length - 1) {
            temp += `${split[i]}`;
        } else {
            temp += `${split[i]}-`;
        }
    }
    return temp;
};

// function render ui detail penjualan
const elementHtml = res => {
    return `
    <tr>
        <td>${res.namab}</td>
        <td>${res.namac}</td>
        <td>${res.jumlah}</td>
        <td>${formatRupiah(res.pcs.toString(), 'Rp.')}</td>
        <td>${formatRupiah(res.harga.toString(), 'Rp.')}</td>
    </tr> `;
};

const getGlobal = async () => {
    let inner = '';
    let no = 1;
    const process = await fetch(`${URL_ORIGIN}/penjualan/action/getAll`);
    const data = await process.json();
    await data.data.forEach(res => (inner += element(no++, res)));
    document.getElementById('list-data').innerHTML = inner;
};

const element = (no, res) => {
    return `
    <tr>
        <td>${no}</td>
        <td>${res.invoice_penjualan}</td>
        <td>${res.namaCustomer}</td>
        <td>${formatRupiah(res.total_harga.toString(), 'Rp.')}</td>
        <td>${formatTanggal(res.tanggal_penjualan)}</td>
        <td>
            <button class="header-icons" id="modal" onclick="getDetail('${
                res.invoice_penjualan
            }', '${
        res.customer
    }')"><span class="material-icons-outlined">visibility</span></button>
        </td>
     </tr>`;
};

const selectBarang = async () => {
    let selectorBarang = '';
    const process = await fetch(`${URL_ORIGIN}/penjualan/materi/barang`);
    const data = await process.json();
    await data.data.forEach(res => (selectorBarang += elementBarang(res)));
    document.getElementById('barangSelect').innerHTML = selectorBarang;
};

const elementBarang = res => {
    return `<option value="${res.id_barang}">${res.nama}</option>`;
};

const selectCustomer = async () => {
    let selectorCustomer = `<option value="0">Umum</option>`;
    const process = await fetch(`${URL_ORIGIN}/penjualan/materi/customer`);
    const data = await process.json();
    await data.data.forEach(res => (selectorCustomer += elementCustomer(res)));
    document.getElementById('customerSelect').innerHTML = selectorCustomer;
};

const elementCustomer = res => {
    return `<option value="${res.id_customer}">${res.nama}</option>`;
};

const modalGlobal = async () => {
    document.getElementById('id00').style.display = 'block';
    await selectCustomer();
};

const modalAdd = async () => {
    document.getElementById('id03').style.display = 'block';
    await selectBarang();
};

const printInv = inv => {
    const invoice = replaceUrl(inv);
    window.location.href = `${URL_ORIGIN}/penjualan/invoice/print/${invoice}`;
};

const formatTanggal = tgl => {
    const listMonth = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'November',
        'Desember',
    ];
    const month = tgl.split('-');
    return `${month[2]}-${listMonth[parseInt(month[1]) - 1]}-${month[0]}`;
};

const addCustomer = () => {
    const data = {
        anama: document.getElementById('nama').value,
        aalamat: document.getElementById('alamat').value,
        ano: document.getElementById('no_telp').value,
    };

    return fetch(`${URL_ORIGIN}/penjualan/materi/add/customer`, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { 'Content-Type': 'application/json', 'X-CSRF-Token': token },
    })
        .then(async res => {
            document.getElementById('id04').style.display = 'none';
            await selectCustomer();
        })
        .catch(err => err);
};

getGlobal();
