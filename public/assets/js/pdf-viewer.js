
/**
 * PDF Viewer Script
 * Ensures the toolbar is hidden in PDF viewers
 */

document.addEventListener('DOMContentLoaded', function() {
  // Instead of trying to modify iframe content directly (which can cause cross-origin issues),
  // we'll modify how PDFs are embedded by adding URL parameters to hide the toolbar

  // Function to update PDF object URLs with toolbar hiding parameters
  function updatePdfObjectUrls() {
    document.querySelectorAll('object[type="application/pdf"]').forEach(function(pdfObject) {
      const currentSrc = pdfObject.getAttribute('data');

      if (currentSrc) {
        // Add parameters to hide toolbar if not already present
        let newSrc = currentSrc;

        // If URL doesn't have any parameters yet
        if (!currentSrc.includes('#toolbar=0')) {
          newSrc = currentSrc.includes('#')
            ? currentSrc + '&toolbar=0&navpanes=0&scrollbar=0&view=FitH'
            : currentSrc + '#toolbar=0&navpanes=0&scrollbar=0&view=FitH';
        }
        // If URL has parameters but not view=FitH
        else if (!currentSrc.includes('view=FitH')) {
          newSrc = currentSrc + '&view=FitH';
        }

        pdfObject.setAttribute('data', newSrc);
      }
    });
  }

  // Update existing PDF objects
  updatePdfObjectUrls();

  // Handle dynamically added PDF objects
  const observer = new MutationObserver(function(mutations) {
    let pdfObjectAdded = false;

    mutations.forEach(function(mutation) {
      if (mutation.addedNodes) {
        mutation.addedNodes.forEach(function(node) {
          if (node.nodeType === 1) {
            // Check if this node is a PDF object or contains PDF objects
            if (node.matches('object[type="application/pdf"]') ||
                node.querySelectorAll('object[type="application/pdf"]').length > 0) {
              pdfObjectAdded = true;
            }
          }
        });
      }
    });

    if (pdfObjectAdded) {
      updatePdfObjectUrls();
    }
  });

  observer.observe(document.body, { childList: true, subtree: true });
});
