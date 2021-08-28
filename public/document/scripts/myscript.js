const origin = document.getElementById("baseurl").value;
const modalUser = document.getElementsByClassName("modalUser");
const urlUser = `${origin}/admin/user/`;

const handleClick = function () {
    const id = this.getAttribute("data-id");
    document.getElementById("editUser").action = `${origin}/admin/user/${id}`;

    fetch(urlUser + id)
        .then((res) => res.json())
        .then((res) => res.data)
        .then((res) => {
            document.querySelector("input[name=name]").value = res.name;
            document.querySelector("input[name=eemail]").value = res.email;
        });
};

for (let i = 0; i < modalUser.length; i++) {
    modalUser[i].addEventListener("click", handleClick, false);
}
