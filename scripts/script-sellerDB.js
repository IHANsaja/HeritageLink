// Function to show a specific section and hide others
function showSection(sectionId) {
    // Hide all sections
    document.querySelectorAll('.content').forEach(section => {
        section.style.display = 'none';
    });

    // Show the selected section
    document.getElementById(sectionId).style.display = 'flex';
}

// Handle form submission
document.getElementById('add-product-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission

    const formData = new FormData(this);

    // Disable submit button to prevent multiple submissions
    document.getElementById('submit-btn').disabled = true;

    fetch('add_product.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        const messageDiv = document.getElementById('message');
        messageDiv.style.display = 'block'; // Make sure the message is visible
        messageDiv.style.color = data.includes('Error:') ? 'red' : 'green'; // Set message color based on content
        messageDiv.textContent = data; // Set the message text

        // Optionally, you might want to clear the form or reset it
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
        // Re-enable the submit button after processing
        document.getElementById('submit-btn').disabled = false;
    });
});

// Set up click event listeners for menu links
document.querySelectorAll('.menu-link').forEach(link => {
    link.addEventListener('click', function() {
        const sectionId = this.getAttribute('data-tab');
        showSection(sectionId);
    });
});

// Show the dashboard section by default
showSection('dashboard');
