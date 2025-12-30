/**
 * Venus Library Management - Interface Logic
 * Developer: Jangbu Sherpa
 */

// Function to open any modal
function openModal(id) {
    const modal = document.getElementById(id);
    modal.style.display = 'flex';
    
    // Focus the first input field automatically
    const firstInput = modal.querySelector('input:not([type="hidden"])');
    if (firstInput) firstInput.focus();
}

// Function to close any modal
function closeModal(id) {
    document.getElementById(id).style.display = 'none';
}

// Function to handle Edit button click and populate data
function handleEdit(data) {
    document.getElementById('edit_id').value = data.id;
    document.getElementById('edit_title').value = data.title;
    document.getElementById('edit_author').value = data.author;
    document.getElementById('edit_email').value = data.email;
    document.getElementById('edit_phone').value = data.phone;
    document.getElementById('edit_address').value = data.address;
    document.getElementById('edit_isbn').value = data.isbn;
    
    openModal('editModal');
}

// Close modal if user clicks outside the modal box
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
};

// Keyboard Shortcuts
document.addEventListener('keydown', function(event) {
    // Close modal on 'Escape' key
    if (event.key === "Escape") {
        document.querySelectorAll('.modal').forEach(modal => {
            modal.style.display = 'none';
        });
    }
});