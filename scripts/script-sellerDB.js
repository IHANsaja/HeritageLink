document.addEventListener('DOMContentLoaded', function() {
    var today = new Date();
    if (today.getDate() === 1) {
        location.reload();
    }
});


// Function to show a specific section and hide others
function showSection(sectionId) {
    console.log(`Attempting to show section: ${sectionId}`);
    document.querySelectorAll('.content, .products-tab').forEach(section => {
        section.style.display = 'none'; 
    });
    const selectedSection = document.getElementById(sectionId);
    if (selectedSection) {
        selectedSection.style.display = ''; 
        console.log(`Section ${sectionId} is now visible.`);
    } else {
        console.error(`Section with ID ${sectionId} not found.`);
    }
}

// Handle form submission for adding products
document.getElementById('add-product-form').addEventListener('submit', function(event) {
    event.preventDefault(); 
    const formData = new FormData(this);
    document.getElementById('submit-btn').disabled = true;
    fetch('add_product.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        const messageDiv = document.getElementById('message');
        messageDiv.style.display = 'block'; 
        messageDiv.style.color = data.includes('Error:') ? 'red' : 'green'; 
        messageDiv.textContent = data;
        this.reset(); 
    })
    .catch(error => {
        console.error('Error:', error);
        const messageDiv = document.getElementById('message');
        messageDiv.style.display = 'block';
        messageDiv.style.color = 'red';
        messageDiv.textContent = 'An error occurred. Please try again.';
    })
    .finally(() => {
        document.getElementById('submit-btn').disabled = false;
    });
});

// Set up click event listeners for menu links
document.querySelectorAll('.menu-link').forEach(link => {
    link.addEventListener('click', function(event) {
        event.preventDefault(); 
        const sectionId = this.getAttribute('data-tab');
        showSection(sectionId);
    });
});

// Ensure the dashboard is displayed by default on page load
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded and parsed');
    showSection('dashboard'); // Ensures the 'dashboard' section is shown on page load
});
