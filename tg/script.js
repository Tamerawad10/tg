// تخزين بيانات القطع في مصفوفة
let parts = [];

// وظيفة لإضافة قطعة جديدة
function addPart() {
    const name = document.getElementById('partName').value;
    const quantity = document.getElementById('partQuantity').value;
    const price = document.getElementById('partPrice').value;

    if (name && quantity > 0 && price >= 0) {
        parts.push({ name, quantity, price });
        updateTable();
        clearForm();
    } else {
        alert('يرجى إدخال بيانات صحيحة!');
    }
}

// وظيفة لتحديث جدول عرض القطع
function updateTable() {
    const tableBody = document.getElementById('partsTableBody');
    tableBody.innerHTML = '';

    parts.forEach((part, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${part.name}</td>
            <td>${part.quantity}</td>
            <td>${part.price}</td>
            <td>
                <button onclick="editPart(${index})">تعديل</button>
                <button onclick="deletePart(${index})">حذف</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}

// وظيفة لحذف قطعة
function deletePart(index) {
    parts.splice(index, 1);
    updateTable();
}

// وظيفة لتعديل قطعة
function editPart(index) {
    const part = parts[index];
    document.getElementById('partName').value = part.name;
    document.getElementById('partQuantity').value = part.quantity;
    document.getElementById('partPrice').value = part.price;

    // حذف القطعة القديمة وإضافة الجديدة عند الحفظ
    deletePart(index);
}

// وظيفة لتفريغ النموذج بعد الإدخال
function clearForm() {
    document.getElementById('partName').value = '';
    document.getElementById('partQuantity').value = '';
    document.getElementById('partPrice').value = '';
}

// وظيفة للبحث عن قطع معينة
function searchPart() {
    const query = document.getElementById('searchInput').value.toLowerCase();
    const filteredParts = parts.filter(part =>
        part.name.toLowerCase().includes(query)
    );

    displayFilteredParts(filteredParts);
}

// عرض القطع المطابقة لعملية البحث
function displayFilteredParts(filteredParts) {
    const tableBody = document.getElementById('partsTableBody');
    tableBody.innerHTML = '';

    filteredParts.forEach((part, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${part.name}</td>
            <td>${part.quantity}</td>
            <td>${part.price}</td>
            <td>
                <button onclick="editPart(${index})">تعديل</button>
                <button onclick="deletePart(${index})">حذف</button>
            </td>
        `;
        tableBody.appendChild(row);
    });
}
