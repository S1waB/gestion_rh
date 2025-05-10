import './bootstrap';

import Alpine from 'alpinejs';
import 'bootstrap/dist/css/bootstrap.min.css';
window.Alpine = Alpine;

Alpine.start();
// Search Functionality
document.getElementById('search').addEventListener('input', function () {
    let query = this.value.toLowerCase();
    let rows = document.querySelectorAll('#userTableBody tr');
    rows.forEach(function (row) {
        let firstName = row.cells[1].textContent.toLowerCase();
        let lastName = row.cells[2].textContent.toLowerCase();
        let email = row.cells[3].textContent.toLowerCase();
        let phone = row.cells[4].textContent.toLowerCase();
        let role = row.cells[5].textContent.toLowerCase();
        let department = row.cells[6].textContent.toLowerCase();
        let position = row.cells[7].textContent.toLowerCase();

        if (
            firstName.includes(query) ||
            lastName.includes(query) ||
            email.includes(query) ||
            phone.includes(query) ||
            role.includes(query) ||
            department.includes(query) ||
            position.includes(query)
        ) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});

// Filter Search functionality
document.getElementById('filterSearch').addEventListener('click', function () {
    let query = document.getElementById('search').value.toLowerCase();
    let filter = document.getElementById('filter').value;
    let rows = document.querySelectorAll('#userTableBody tr');

    rows.forEach(function (row) {
        let firstName = row.cells[1].textContent.toLowerCase();
        let lastName = row.cells[2].textContent.toLowerCase();
        let email = row.cells[3].textContent.toLowerCase();
        let phone = row.cells[4].textContent.toLowerCase();
        let role = row.cells[5].textContent.toLowerCase();
        let department = row.cells[6].textContent.toLowerCase();
        let position = row.cells[7].textContent.toLowerCase();

        let isMatch = false;
        if (filter === 'name' && (firstName.includes(query) || lastName.includes(query))) {
            isMatch = true;
        } else if (filter === 'email' && email.includes(query)) {
            isMatch = true;
        } else if (filter === 'role' && role.includes(query)) {
            isMatch = true;
        } else if (filter === 'department' && department.includes(query)) {
            isMatch = true;
        } else if (filter === 'position' && position.includes(query)) {
            isMatch = true;
        }

        if (isMatch) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});