async function filter() {
    console.log('ok');
    try {
        await display();
    } catch (e) {
        console.log(e);
        document.getElementById('list-data').innerHTML = 'error';
    }
}

/** function get data from route **/
async function getFilter() {
    const tgl1 = document.getElementById('tgl1').value;
    const tgl2 = document.getElementById('tgl2').value;

    const data = await fetch(`${url_origin}/filter`, {
        method: 'post',
        body: JSON.stringify({ tgl2: tgl2, tgl1: tgl1 }),
        headers: { 'Content-Type': 'application/json', 'X-CSRF-Token': token },
    });

    return await data.json();
}

async function display() {
    let html = '';
    let no = 1;
    const data = await getFilter();
    data.data.forEach(res => {
        res.length == 0
            ? (html += 'data not found')
            : (html += htmldata(res, no++));
    });
    document.getElementById('list-data').innerHTML = html;
}

function htmldata(res, no) {
    return `
        <tr>
            <td>${no}</td>
            <td>${res.nama_gabah}</td>
            <td>${res.nama_gabah}</td>
            <td>${res.total_berat} kg</td>
            <td>${res.total_pot_zak}</td>
            <td>${formatRupiah(res.harga.toString(), 'Rp.')}</td>
            <td>${formatRupiah(res.total_bayar.toString(), 'Rp.')}</td>
            <td>
                <a><button class="header-icons" id="modal" onClick="getmodal('${
                    res.kode_penerimaan
                }')" class="button icons-button" value="${
        res.kode_penerimaan
    }"><span class="material-icons-outlined">create</span></button></a>
                <a><button class="header-icons" onClick="getmodal4('${
                    res.kode_penerimaan
                }')"><span class="material-icons-outlined"> visibility</span></button></a>
            </td>
        </tr>
    `;
}

const ud = document.getElementById('ude');

ud.addEventListener('click', async () => {
    const berat = document.getElementById('uppot').value;
    const code = document.getElementById('idpe').value;
    ud.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Loading';
    await fetch(`${url_origin}/gabah/udetail`, {
        method: 'post',
        body: JSON.stringify({ kode: code, pot: berat }),
        headers: { 'Content-Type': 'application/json', 'X-CSRF-Token': token },
    })
        .then(async response => {
            ud.innerHTML = 'success';
            await displayDetail();
            setTimeout(() => {
                document.getElementById('id05').style.display = 'none';
            }, 2000);
        })
        .catch(error => {
            ud.innerHTML = 'error';
        });
});
