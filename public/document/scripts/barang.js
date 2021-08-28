const modalBarang = document.getElementsByClassName("modalBarang");
const origin = document.getElementById("baseurl").value;
const urlBarang = `${origin}/admin/barang/getup/`;

const handleClick = function () {
    const id = this.getAttribute("data-id");
    document.getElementById(
        "editBarang"
    ).action = `${origin}/admin/barang/${id}`;

    fetch(urlBarang + id)
        .then((res) => res.json())
        .then((res) => res.data)
        .then((res) => {
            document.querySelector("input[name=unama]").value = res.nama;
            document.querySelector("input[name=usatuan]").value = res.satuan;
            document.querySelector("input[name=ukemasan]").value = res.kemasan;
            document.querySelector("input[name=ujenis]").value = res.jenis;
            document.querySelector("input[name=uharga]").value = res.hrg_jual;
        });
};

for (let i = 0; i < modalBarang.length; i++) {
    modalBarang[i].addEventListener("click", handleClick, false);
}
