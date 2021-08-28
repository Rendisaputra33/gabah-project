const origin = document.getElementById("baseurl").value;
const urlCustomer = `${origin}/admin/customer/getup/`;
const modalCustomer = document.getElementsByClassName("modalCustomer");

const handleClick = function () {
    const id = this.getAttribute("data-id");
    document.getElementById("editCustomer").action = `${origin}/admin/customer/${id}`;

    fetch(urlCustomer + id)
        .then((res) => res.json())
        .then((res) => res.data)
        .then((res) => {
            document.querySelector("input[name=unama]").value = res.nama;
            document.querySelector("input[name=ualamat]").value = res.alamat;
            document.querySelector("input[name=uno]").value = res.no_telp;
        });
};

for (let i = 0; i < modalCustomer.length; i++) {
    modalCustomer[i].addEventListener("click", handleClick, false);
}
