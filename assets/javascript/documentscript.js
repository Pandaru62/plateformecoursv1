// script associated to both editdocument.html.twig and adddocument.html.twig

const fileTypeInput = document.getElementById('document_form_type');
        checkFileType();

        // checks the chosen file type

        function checkFileType() {
            const uploadFileInput = document.getElementById('document_form_file_path');
            const addLinkInput = document.getElementById('document_form_link_path');

            if(fileTypeInput.value === 'lien' || fileTypeInput.value === 'video') {
                // if user selects link or video, the displayed field is a text type 
                uploadFileInput.parentElement.classList.add('d-none');
                addLinkInput.parentElement.classList.remove('d-none');

            } else {
                // in the case of others docs, a file type field appears to upload a document 
                addLinkInput.parentElement.classList.add('d-none');
                uploadFileInput.parentElement.classList.remove('d-none');
            }
        }

        fileTypeInput.addEventListener('change', () => {
            checkFileType();
            
        })

// concerning editdocument.html.twig
// shows or hides the change of file depending on user's choice

const changeDocSelect = document.getElementById('document_form_changedoc');
const editFileDiv = document.getElementById('editFile');

changeDocSelect.addEventListener('change', () => {
    if(changeDocSelect.value == 'changeDocYes') {
        editFileDiv.classList.remove('d-none');
    } else {
        editFileDiv.classList.add('d-none');
    }
})