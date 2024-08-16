// script associated to editsequence.html.twig

document.addEventListener('DOMContentLoaded', () => {
    const changeDocSelect = document.getElementById('sequence_form_changeImage');
    const editFileDiv = document.getElementById('editFile');

    // Set the default value to 'no' on page load
    changeDocSelect.value = 'no';
    editFileDiv.classList.add('d-none'); // Ensure the file div is hidden

    // Handle the change event
    changeDocSelect.addEventListener('change', () => {
        if(changeDocSelect.value === 'yes') {
            editFileDiv.classList.remove('d-none');
        } else {
            editFileDiv.classList.add('d-none');
        }
    });
});
