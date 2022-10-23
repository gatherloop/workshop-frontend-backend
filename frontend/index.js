const listuser = document.getElementById("list-user-wrapper");
const tBodyUser = document.getElementById("table-user");
let data;

async function fetchData() {
  await fetch("http://localhost:4000/users")
    .then((res) => res.json())
    .then((res) => (data = res))
    .catch((err) => console.log(err));

  data.map((user) => {
    const tr = document.createElement("tr");
    const tdName = document.createElement("td");
    const tdAge = document.createElement("td");
    const tdAddress = document.createElement("td");
    const tdPhone = document.createElement("td");

    tdName.textContent = user.name;
    tdAge.textContent = user.age;
    tdAddress.textContent = user.address;
    tdPhone.textContent = user.phone;
    tr.appendChild(tdName);
    tr.appendChild(tdAge);
    tr.appendChild(tdAddress);
    tr.appendChild(tdPhone);

    tBodyUser.appendChild(tr);
  });
}

fetchData();

const formAddUser = document.getElementById("addUser");

formAddUser.addEventListener("submit", function (e) {
  e.preventDefault();
  const payload = {
    name: e.target.name.value,
    age: e.target.age.value,
    address: e.target.address.value,
    phone: e.target.phone.value
  };

  fetch("http://localhost:4000/users", {
    method: "POST",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json"
    },
    body: JSON.stringify(payload)
  })
    .then((res) => console.log(res))
    .catch((err) => console.log(err));
});
