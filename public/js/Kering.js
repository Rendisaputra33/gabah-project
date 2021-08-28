const selector = document.getElementById('selector')

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

function ele(res) {
    return `<option value="${res.kode_penerimaan}">${res.nama_gabah} - ${res.tanggal}</option>  `
}

document.getElementById('tkering').addEventListener('click', async function () {
    try {
        this.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Loading'
        await addKering()
    } catch (error) {
        console.log(error)
    } finally {
        this.innerHTML = 'success'
        setTimeout(() => {
            document.getElementById('id01').style.display = 'none'
        }, 2000)
    }
})

document.getElementById('modal')
    .addEventListener('click', async function () {
        await display()
    })

function addKering() {

    const kode = document.getElementById('selector').value
    const tgl = document.getElementById('tanggal').value

    fetch(`${url_origin}/gabah/kering`, {
        method: 'POST',
        body: JSON.stringify({ kode: kode, tgl: tgl }),
        headers: { 'Content-Type': 'application/json', 'X-CSRF-Token': token }
    }).then(response => getData()).catch(err => console.log(err))
}