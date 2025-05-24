/**
 * Document Preview Script
 * Handles conversion and preview of DOC/DOCX files
 */

document.addEventListener('DOMContentLoaded', function() {
  // Function to initialize document preview
  function initDocumentPreview() {
    // Find all document preview containers
    document.querySelectorAll('[id^="doc-preview-container-"]').forEach(function(container) {
      const contentId = container.id.replace('doc-preview-container-', '');
      const loadingIndicator = container.querySelector('.doc-loading-indicator');
      const previewContent = container.querySelector('.doc-preview-content');
      const pdfObject = previewContent.querySelector('object');

      // Start conversion process
      convertDocument(contentId, loadingIndicator, previewContent, pdfObject);
    });
  }

  // Function to convert document
  function convertDocument(contentId, loadingIndicator, previewContent, pdfObject) {
    // Make AJAX request to convert document
    fetch(`/explore/convert-document/${contentId}`)
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          // Set the PDF path to the object data attribute
          pdfObject.setAttribute('data', `/storage/${data.data.pdf_path}#toolbar=0&navpanes=0&scrollbar=0&view=FitH`);

          // Hide loading indicator and show preview
          loadingIndicator.classList.add('hidden');
          previewContent.classList.remove('hidden');
        } else {
          // Show error message
          loadingIndicator.innerHTML = `
            <div class="text-center">
              <p class="text-red-500 mb-2">Error converting document:</p>
              <p>${data.message}</p>
              <p class="mt-4">Please download the file to view it.</p>
            </div>
          `;
        }
      })
      .catch(error => {
        console.error('Error converting document:', error);
        // Show error message
        loadingIndicator.innerHTML = `
          <div class="text-center">
            <p class="text-red-500 mb-2">Error converting document</p>
            <p>Please download the file to view it.</p>
          </div>
        `;
      });
  }

  // Initialize document preview when modal is shown
  document.addEventListener('click', function(e) {
    // Check if the clicked element or its parent has a data-modal-toggle attribute
    const toggleElement = e.target.closest('[data-modal-toggle]');
    if (toggleElement) {
      const modalId = toggleElement.getAttribute('data-modal-toggle');
      const modal = document.querySelector(modalId);

      if (modal) {
        // Wait for modal to be fully visible
        setTimeout(function() {
          // Check if this modal has document preview containers
          const docPreviewContainers = modal.querySelectorAll('[id^="doc-preview-container-"]');
          if (docPreviewContainers.length > 0) {
            initDocumentPreview();
          }
        }, 300); // Short delay to ensure modal is visible
      }
    }
  });

  // Also initialize for any modals that might be open on page load
  initDocumentPreview();
});
