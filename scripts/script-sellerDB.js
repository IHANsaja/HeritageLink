function showSection(sectionId) {
    // Hide all sections
    document.getElementById('dashboard').style.display = 'none';
    document.getElementById('products').style.display = 'none';
    document.getElementById('analytics').style.display = 'none';

    // Show the selected section
    document.getElementById(sectionId).style.display = 'flex';
}

document.getElementById('add-product-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    fetch('add_product.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => showMessage(data))
    .catch(error => console.error('Error:', error));
});

document.getElementById('add-product-form').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent the form from submitting traditionally

    var formData = new FormData(this); // Get the form data

    // Send the data using Fetch API
    fetch('add_product.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text()) // Expect text response
    .then(data => {
        var messageDiv = document.getElementById('message'); // Find the message display div
        messageDiv.style.color = 'green'; // Default to green color
        messageDiv.textContent = data; // Set the message text

        if (data.includes('Error:')) {
            messageDiv.style.color = 'red'; // Set to red color on error
        }
    })
    .catch(error => console.error('Error:', error));
});




// Set up click event listeners for menu links
document.querySelectorAll('.menu-link').forEach(link => {
    link.addEventListener('click', function() {
        document.querySelectorAll('.tab-content').forEach(content => content.style.display = 'none');
        document.querySelector(`#${this.getAttribute('data-tab')}`).style.display = 'flex';
    });
});

// Show dashboard by default
showSection('dashboard');

