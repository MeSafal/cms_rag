// const fileDropArea = document.getElementById('fileDropArea');
// const formFileInput = document.getElementById('formFile');
const placeholder = document.getElementById('placeholder');
const imagePreview = document.getElementById('imagePreview');
const previewImage = document.getElementById('previewImage');
const hoverInfo = document.getElementById('hoverInfo');
const fileName = document.getElementById('fileName');
// const removeImageButton = document.getElementById('removeImage');

// // Handle clicking on the drop area
// fileDropArea.addEventListener('click', () => {
//     formFileInput.click();
// });

// // Handle drag-and-drop functionality
// fileDropArea.addEventListener('dragover', (e) => {
//     e.preventDefault();
//     fileDropArea.classList.add('drag-over');
// });

// fileDropArea.addEventListener('dragleave', () => {
//     fileDropArea.classList.remove('drag-over');
// });

// fileDropArea.addEventListener('drop', (e) => {
//     e.preventDefault();
//     fileDropArea.classList.remove('drag-over');

//     const files = e.dataTransfer.files;
//     if (files.length > 0) {
//         handleFileSelection(files[0]);
//     }
// });

// Handle file input change
// formFileInput.addEventListener('change', () => {
//     if (formFileInput.files.length > 0) {
//         handleFileSelection(formFileInput.files[0]);
//     }
// });

// Function to handle file selection
function handleFileSelection(file) {
    if (file.type.startsWith('image/')) {
        const reader = new FileReader();

        reader.onload = (e) => {
            // Hide placeholder and show image preview
            placeholder.style.display = 'none';
            imagePreview.style.display = 'flex';
            previewImage.src = e.target.result;

            // Update file name in hover info
            fileName.textContent = file.name;
        };

        reader.readAsDataURL(file);
    } else {
        alert('Please select a valid image file.');
        resetFileInput();
    }
}

// Function to reset the file input and preview
function resetFileInput() {
    formFileInput.value = ''; // Clear the input
    placeholder.style.display = 'block';
    imagePreview.style.display = 'none';
    previewImage.src = '';
    fileName.textContent = '';
}

// Handle removing the image
// removeImageButton.addEventListener('click', (e) => {
//     e.stopPropagation(); // Prevent triggering the file input click
//     resetFileInput();
// });


document.addEventListener("DOMContentLoaded", function () {

    /*
    ============================
    FILE MANAGER INTEGRATION
    ============================
    - Opens Laravel File Manager (LFM) for image selection.
    - Stores selected images in the appropriate input field.
    */

    document.querySelectorAll('.lfm-btn').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            document.querySelectorAll('[id="lfm"]').forEach(btn => btn.removeAttribute(
                'id'));
            this.setAttribute('id', 'lfm');
            currentInputId = this.getAttribute('data-input');
            window.open('/laravel-filemanager?type=image&multiple=1', 'FileManager',
                'width=900,height=600');
        });
    });

    // SetUrl function for file manager
    window.SetUrl = function (response) {
        if (Array.isArray(response) && response.length > 0) {
            const csvUrls = response
                .map(file => file.url.replace(/^https?:\/\/[^\/]+\//, '')) // Remove only the base URL
                .join(',');

            if (currentInputId) {
                const inputField = document.getElementById(currentInputId);
                if (inputField) {
                    inputField.value = csvUrls;
                    inputField.dispatchEvent(new Event('input'));
                    inputField.dispatchEvent(new Event('change'));
                }
            }
        } else {
            console.error('Invalid response from file manager:', response);
        }
    };

    /*
         ============================
         FILE MANAGER IMAGE PREVIEW
         ============================
      */

    // Create a modal element for full-size image preview
    const modalContainer = document.createElement('div');
    modalContainer.className = 'full-image-modal';
    modalContainer.style.cssText = `
       position: fixed;
       top: 0; left: 0;
       width: 100vw; height: 100vh;
       display: none;
       justify-content: center;
       align-items: center;
       background: rgba(0, 0, 0, 0.2);
       backdrop-filter: blur(7px);
       z-index: 9999;
   `;

    document.body.appendChild(modalContainer);

    // Create inner modal content container
    const modalContent = document.createElement('div');
    modalContent.className = 'modal-content';
    modalContent.style.cssText = `
       background: transparent;
       align-items: center;
       justify-content: center;
       width: 100%;
       height: 100%;
   `;
    modalContainer.appendChild(modalContent);

    // Create image element for full-screen preview
    const modalImage = document.createElement('img');
    modalImage.style.cssText = `
       max-width: 90vw;
       max-height: 90vh;
       object-fit: contain;
       display: block;
       margin: auto;
   `;
    modalContent.appendChild(modalImage);

    // Create Close button
    const closeButton = document.createElement('button');
    closeButton.innerHTML = '×';
    closeButton.style.cssText = `
       position: absolute;
       top: 20px;
       right: 20px;
       font-size: 30px;
       background: none;
       border: none;
       color: white;
       cursor: pointer;
   `;
    modalContent.appendChild(closeButton);

    // Create Prev & Next buttons
    const prevButton = document.createElement('button');
    prevButton.innerHTML = '❮';
    prevButton.style.cssText = `
       position: absolute;
       left: 20px;
       font-size: 40px;
       background: rgba(0,0,0,0.6);
       border: none;
       color: white;
       cursor: pointer;
       padding: 10px;
       border-radius: 5px;
       display: none;
   `;
    modalContent.appendChild(prevButton);

    const nextButton = document.createElement('button');
    nextButton.innerHTML = '❯';
    nextButton.style.cssText = `
       position: absolute;
       right: 20px;
       font-size: 40px;
       background: rgba(0,0,0,0.6);
       border: none;
       color: white;
       cursor: pointer;
       padding: 10px;
       border-radius: 5px;
       display: none;
   `;
    modalContent.appendChild(nextButton);

    // Variables to track current images and index
    let currentImageList = [];
    let currentIndex = 0;

    // Function to show image in modal at given index
    function showImage(index) {
        if (index < 0 || index >= currentImageList.length) return;
        currentIndex = index;
        modalImage.src = currentImageList[index];

        // Display next/prev buttons if more than one image exists
        prevButton.style.display = (index > 0) ? 'block' : 'none';
        nextButton.style.display = (index < currentImageList.length - 1) ? 'block' : 'none';

        // Once the image loads, adjust size based on aspect ratio.
        modalImage.onload = function () {
            const naturalWidth = modalImage.naturalWidth;
            const naturalHeight = modalImage.naturalHeight;
            if (naturalWidth > naturalHeight) {
                // Landscape: fit by width
                modalImage.style.maxWidth = '90vw';
                modalImage.style.maxHeight = 'none';
            } else {
                // Portrait: fit by height
                modalImage.style.maxHeight = '90vh';
                modalImage.style.maxWidth = 'none';
            }
        };

        modalContainer.style.display = 'flex';
    }

    // Event listeners for navigation buttons
    prevButton.addEventListener('click', function (e) {
        e.stopPropagation();
        if (currentIndex > 0) showImage(currentIndex - 1);
    });
    nextButton.addEventListener('click', function (e) {
        e.stopPropagation();
        if (currentIndex < currentImageList.length - 1) showImage(currentIndex + 1);
    });

    // Close modal on clicking the close button or backdrop
    closeButton.addEventListener('click', function () {
        modalContainer.style.display = 'none';
    });
    modalContainer.addEventListener('click', function (e) {
        if (e.target === modalContainer) {
            modalContainer.style.display = 'none';
        }
    });

    // Keyboard events: Esc, Left arrow, Right arrow
    document.addEventListener('keydown', function (e) {
        // Only act if modal is visible
        if (modalContainer.style.display === 'flex') {
            if (e.key === 'Escape') {
                modalContainer.style.display = 'none';
            } else if (e.key === 'ArrowLeft') {
                // Navigate to previous image if available
                if (currentIndex > 0) showImage(currentIndex - 1);
            } else if (e.key === 'ArrowRight') {
                // Navigate to next image if available
                if (currentIndex < currentImageList.length - 1) showImage(currentIndex + 1);
            }
        }
    });

    // FILE MANAGER HANDLING
    let currentInputId;
    document.querySelectorAll('.lfm-btn').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            document.querySelectorAll('[id="lfm"]').forEach(btn => btn.removeAttribute(
                'id'));
            this.setAttribute('id', 'lfm');
            currentInputId = this.getAttribute('data-input');
            window.open('/laravel-filemanager?type=image&multiple=1', 'FileManager',
                'width=900,height=600');
        });
    });
    window.SetUrl = function (response) {
        if (Array.isArray(response) && response.length > 0) {
            const csvUrls = response
                .map(file => file.url.replace(/^https?:\/\/[^\/]+\//, ''))
                .join(',');
            if (currentInputId) {
                const inputField = document.getElementById(currentInputId);
                if (inputField) {
                    inputField.value = csvUrls;
                    inputField.dispatchEvent(new Event('input'));
                    inputField.dispatchEvent(new Event('change'));
                }
            }
        } else {
            console.error('Invalid response from file manager:', response);
        }
    };

    // Function to add click events on preview images for full-screen view
    function updatePreviewWithClickEvents() {
        document.querySelectorAll('.image-preview-container img').forEach(img => {
            img.style.cursor = 'pointer';
            img.addEventListener('click', function () {
                // Get the URL of the clicked image
                const clickedUrl = this.src;
                // Find all images in the same container
                const container = this.closest('.image-preview-container');
                if (!container) return;
                const imgs = Array.from(container.querySelectorAll('img'));
                currentImageList = imgs.map(i => i.src);
                // Set the index to the clicked image's index
                currentIndex = currentImageList.indexOf(clickedUrl);
                showImage(currentIndex);
            });
        });
    }

    // PROCESS EACH INPUT (File Manager Preview)
    var inputs = document.querySelectorAll('.lfm-input');
    inputs.forEach(function (input) {
        var previewId = input.getAttribute('data-preview');
        if (previewId) {
            var previewContainer = document.getElementById(previewId);
            if (previewContainer) {
                var updatePreview = function () {
                    previewContainer.innerHTML = '';
                    var val = input.value.trim();
                    if (val !== '') {
                        var urls = val.split(',');
                        urls.forEach(function (url) {
                            url = url.trim();
                            if (url) {
                                if (!/^https?:\/\//i.test(url) && url.charAt(0) !==
                                    '/') {
                                    url = '/' + url;
                                }
                                var img = document.createElement('img');
                                img.src = url;
                                img.style.cssText = `
                               width: 80px;
                               height: 80px;
                               object-fit: cover;
                               margin-right: 5px;
                               border: 2px solid white;
                               border-radius: 5px;
                           `;
                                img.className = 'img-thumbnail';
                                previewContainer.appendChild(img);
                            }
                        });
                        updatePreviewWithClickEvents();
                    }
                };
                updatePreview();
                input.addEventListener('change', updatePreview);
                input.addEventListener('input', updatePreview);
            }
        }
    });
});

