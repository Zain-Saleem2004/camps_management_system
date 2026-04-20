
  families.push({
    id,
    name,
    members,
    list: []
  });

  localStorage.setItem("families", JSON.stringify(families));
  renderFamilies();
}

// ===== عرض العائلات =====
function renderFamilies() {
  const table = document.getElementById("familyTable");
  if (!table) return;

  table.innerHTML = "";

  families.forEach((f, i) => {
    table.innerHTML += `
      <tr>
        <td>${f.id}</td>
        <td>${f.name}</td>
        <td>${f.members}</td>
        <td>
          <button class="btn btn-sm btn-primary" onclick="goToMembers(${i})">
            >
          </button>
        </td>
      </tr>
    `;
  });
}

// ===== انتقال لصفحة الأفراد =====
function goToMembers(index) {
  localStorage.setItem("currentFamily", index);
  window.location.href = "members.html";
}

// ===== إضافة فرد =====
function addMember() {
  let index = localStorage.getItem("currentFamily");

  const name = document.getElementById("memberName").value;
  const age = document.getElementById("memberAge").value;

  families[index].list.push({ name, age });

  localStorage.setItem("families", JSON.stringify(families));
  renderMembers();
}

// ===== عرض الأفراد =====
function renderMembers() {
  const table = document.getElementById("membersTable");
  if (!table) return;

  let index = localStorage.getItem("currentFamily");

  table.innerHTML = "";

  families[index].list.forEach((m, i) => {
    table.innerHTML += `
      <tr>
        <td>${i + 1}</td>
        <td>${m.name}</td>
        <td>${m.age}</td>
      </tr>
    `;
  });
}

// ===== رجوع =====
function goBack() {
  window.location.href = "index.html";
}

// تشغيل تلقائي
window.onload = function () {
  renderFamilies();
  renderMembers();
};