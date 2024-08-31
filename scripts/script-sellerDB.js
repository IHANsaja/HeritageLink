function showSection(sectionId) {
    // Hide all sections
    document.getElementById('dashboard').style.display = 'none';
    document.getElementById('products').style.display = 'none';
    document.getElementById('analytics').style.display = 'none';

    // Show the selected section
    document.getElementById(sectionId).style.display = 'flex';
}

document.querySelector('.menu-link').forEach(link => {
    link.addEventListener('click', function() {
        document.querySelector('.tab-content').forEach(content => content.style.display = 'none');
        document.querySelector(`#${this.getAttribute('data-tab')}`).style.display = 'block';
    });
});

document.querySelector('#dashboard').style.display = 'block'; // Show dashboard by default
