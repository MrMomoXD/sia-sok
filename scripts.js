document.addEventListener('DOMContentLoaded', () => {
    loadSections();
});

function loadSections() {
    fetch('sections.php')
        .then(response => response.json())
        .then(data => {
            const tree = document.getElementById('tree');
            tree.innerHTML = buildTree(data);
        });
}

function buildTree(data) {
    let html = '<ul>';
    data.forEach(section => {
        html += `<li>
            <div>Name:${section.name}</div>
            <div>Description:${section.description}</div>
            <div>Id:${section.id}</div>
            <button type="button" class="btn btn-info pe-5" onclick="editSection(${section.id})">Edit</button>
            <button type="button" class="btn btn-danger" onclick="deleteSection(${section.id})">Delete</button>
            ${section.children ? buildTree(section.children) : ''}
        </li>`;
    });
    html += '</ul>';
    return html;
}

function addSection() {
    const name = prompt("Enter section name:");
    const description = prompt("Enter section description:");
    const parent_id = prompt("Enter parent section ID (leave empty if it's a root section):");

    if (name && description) {
        fetch('add_section.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `name=${encodeURIComponent(name)}&description=${encodeURIComponent(description)}&parent_id=${parent_id}`
        }).then(response => {
            if (response.ok) {
                loadSections();
            } else {
                alert('Failed to add section.');
            }
        });
    }
}

function editSection(id) {
    const name = prompt("Enter new section name:");
    const description = prompt("Enter new section description:");

    if (name && description) {
        fetch('edit_section.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id=${id}&name=${encodeURIComponent(name)}&description=${encodeURIComponent(description)}`
        }).then(response => {
            if (response.ok) {
                loadSections();
            } else {
                alert('Failed to edit section.');
            }
        });
    }
}

function deleteSection(id) {
    if (confirm("Are you sure you want to delete this section?")) {
        fetch(`delete_section.php`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id=${id}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadSections();
            } else {
                alert('Failed to delete section.');
            }
        });
    }
}

function logout() {
    fetch('logout.php')
        .then(() => {
            window.location.href = 'login.php';
        });
}
