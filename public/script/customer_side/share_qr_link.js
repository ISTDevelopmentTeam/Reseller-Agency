// Global state
let isSharing = false;
let currentShareType = 'link'; // Can be 'link' or 'qr'

// Initialize when document loads
document.addEventListener('DOMContentLoaded', function() {
    initializeSharing();
});

// Initialize sharing functionality
function initializeSharing() {
    setupShareButtons();
    setupModalListeners();
}

// Setup share buttons
function setupShareButtons() {
    // QR Share button
    const qrShareBtn = document.querySelector('.qr-section .btn-secondary');
    if (qrShareBtn) {
        qrShareBtn.onclick = () => openQRShareModal();
    }

    // Link Share button
    const linkShareBtn = document.querySelector('.url-section .btn-secondary');
    if (linkShareBtn) {
        linkShareBtn.onclick = () => openLinkShareModal();
    }

    // Copy Link button
    const copyLinkBtn = document.querySelector('.url-section .btn-primary');
    if (copyLinkBtn) {
        copyLinkBtn.onclick = copyUrl;
    }

    // Save QR button
    const saveQRBtn = document.querySelector('.qr-section .btn-primary');
    if (saveQRBtn) {
        saveQRBtn.onclick = downloadQR;
    }
}

// Function to open QR share modal
function openQRShareModal() {
    currentShareType = 'qr';
    const shareOptions = getQRShareOptions();
    showShareModal(shareOptions, 'qr');
}

// Function to open link share modal
function openLinkShareModal() {
    currentShareType = 'link';
    const shareOptions = getLinkShareOptions();
    showShareModal(shareOptions, 'link');
}

// Get QR share options
function getQRShareOptions() {
    return [
        { platform: 'whatsapp', icon: 'fab fa-whatsapp', label: 'WhatsApp' },
        { platform: 'facebook', icon: 'fab fa-facebook', label: 'Facebook' },
        { platform: 'twitter', icon: 'fab fa-twitter', label: 'Twitter' },
        { platform: 'email', icon: 'fas fa-envelope', label: 'Email' },
        { platform: 'copy', icon: 'fas fa-copy', label: 'Copy Image' },
        { platform: 'download', icon: 'fas fa-download', label: 'Save QR' }
    ];
}

// Get link share options
function getLinkShareOptions() {
    return [
        { platform: 'whatsapp', icon: 'fab fa-whatsapp', label: 'WhatsApp' },
        { platform: 'facebook', icon: 'fab fa-facebook', label: 'Facebook' },
        { platform: 'twitter', icon: 'fab fa-twitter', label: 'Twitter' },
        { platform: 'email', icon: 'fas fa-envelope', label: 'Email' },
        { platform: 'copy', icon: 'fas fa-copy', label: 'Copy Link' },
        { platform: 'download', icon: 'fas fa-download', label: 'Download' }
    ];
}

// Show share modal
function showShareModal(options, type) {
    const modalHTML = generateModalHTML(options, type);

    // Remove existing modal if present
    const existingModal = document.getElementById('shareModal');
    if (existingModal) {
        existingModal.remove();
    }

    // Add new modal
    document.body.insertAdjacentHTML('beforeend', modalHTML);

    // Show modal
    const modal = document.getElementById('shareModal');
    modal.style.display = 'flex';
    requestAnimationFrame(() => modal.classList.add('show'));

    // Setup modal listeners
    setupModalListeners();
}

// Generate modal HTML
function generateModalHTML(options, type) {
    return `
        <div class="share-modal" id="shareModal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Share via</h5>
                    <button class="close-modal" onclick="closeShareModal()">×</button>
                </div>
                <div class="modal-body">
                    <p class="share-description">Choose how you want to share the ${type === 'qr' ? 'QR Code' : 'link'}</p>
                    <div class="share-options">
                        ${options.map(option => `
                            <div class="share-option" onclick="${option.platform === 'copy' ? 'copyToClipboard()' :
                                                              option.platform === 'download' ? 'downloadContent()' :
                                                              `shareVia('${option.platform}')`}">
                                <i class="${option.icon}"></i>
                                <div>${option.label}</div>
                            </div>
                        `).join('')}
                    </div>
                </div>
            </div>
        </div>`;
}

// Setup modal listeners
function setupModalListeners() {
    const modal = document.getElementById('shareModal');
    if (!modal) return;

    // Close on outside click
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeShareModal();
        }
    });

    // Close on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('show')) {
            closeShareModal();
        }
    });
}

// Updated shareVia function
async function shareVia(platform) {
    if (isSharing) return;
    isSharing = true;

    try {
        const url = document.getElementById('urlText')?.textContent.trim() || window.location.href;
        const message = currentShareType === 'qr' ? 'Scan this QR code to access: ' : 'Check out this link: ';

        switch(platform) {
            case 'whatsapp':
                window.open(`https://api.whatsapp.com/send?text=${encodeURIComponent(message + url)}`, '_blank');
                showToast('Opening WhatsApp...');
                break;

            case 'facebook':
                openPopup(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}&quote=${encodeURIComponent(message)}`);
                showToast('Opening Facebook...');
                break;

            case 'twitter':
                openPopup(`https://twitter.com/intent/tweet?text=${encodeURIComponent(message)}&url=${encodeURIComponent(url)}`);
                showToast('Opening Twitter...');
                break;

            case 'email':
                await shareViaEmail();
                break;
        }
    } catch (error) {
        console.error('Sharing failed:', error);
        showToast('Sharing failed. Please try again.');
    } finally {
        closeShareModal();
        setTimeout(() => {
            isSharing = false;
        }, 1000);
    }
}

// Function to handle email sharing specifically
async function shareViaEmail() {
    try {
        const qrImage = document.querySelector('.qr-code img');
        const url = document.getElementById('urlText')?.textContent.trim() || window.location.href;

        if (currentShareType === 'qr' && qrImage) {
            let imageData = qrImage.src;

            // If the image source doesn't start with data:image, convert it
            if (!imageData.startsWith('data:image')) {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');

                // Set canvas dimensions to match QR code
                canvas.width = qrImage.naturalWidth || 200;
                canvas.height = qrImage.naturalHeight || 200;

                // Draw the QR code on canvas
                ctx.drawImage(qrImage, 0, 0);

                // Get base64 data
                imageData = canvas.toDataURL('image/png');
            }

            // Create a simple email body with the QR code image embedded
            const emailBody = `
Please scan this QR code to access:

<img src="${imageData}" alt="QR Code" />

${url}`;

            // Create the mailto link
            const mailtoLink = `mailto:?subject=${encodeURIComponent('QR Code Access')}&body=${encodeURIComponent(emailBody)}`;

            // Open email client
            window.location.href = mailtoLink;

            showToast('Email client opened with QR code embedded');
        } else {
            // Regular link sharing
            const mailtoLink = `mailto:?subject=${encodeURIComponent('Check out this link')}&body=${encodeURIComponent('I thought you might be interested in this: ' + url)}`;
            window.location.href = mailtoLink;
            showToast('Email client opened');
        }
    } catch (error) {
        console.error('Failed to share via email:', error);
        showToast('Failed to share via email. Please try again.');
    }
}


// Copy URL to clipboard
async function copyUrl() {
    const url = document.getElementById('urlText')?.textContent.trim();
    if (!url) {
        showToast('URL not found');
        return;
    }

    try {
        await navigator.clipboard.writeText(url);
        showToast('URL copied to clipboard!');
    } catch (error) {
        console.error('Copy failed:', error);
        showToast('Failed to copy URL. Please try again.');
    }
}

// Copy to clipboard
async function copyToClipboard() {
    try {
        if (currentShareType === 'qr') {
            const qrImage = document.querySelector('.qr-code img');
            if (!qrImage) {
                showToast('QR code image not found');
                return;
            }

            const response = await fetch(qrImage.src);
            const blob = await response.blob();
            await navigator.clipboard.write([
                new ClipboardItem({
                    [blob.type]: blob
                })
            ]);
            showToast('QR Code copied to clipboard!');
        } else {
            await copyUrl();
        }
        closeShareModal();
    } catch (err) {
        console.error('Failed to copy:', err);
        showToast('Failed to copy. Please try again.');
    }
}

// Download QR code
function downloadQR() {
    const qrImage = document.querySelector('.qr-code img');
    if (!qrImage) {
        showToast('QR code image not found');
        return;
    }

    const link = document.createElement('a');
    link.href = qrImage.src;
    link.download = 'qr-code.png';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    showToast('QR code downloaded successfully!');
}

// Download content
function downloadContent() {
    if (currentShareType === 'qr') {
        downloadQR();
    }
    closeShareModal();
}

// Close share modal
function closeShareModal() {
    const modal = document.getElementById('shareModal');
    if (!modal) return;

    modal.classList.remove('show');
    setTimeout(() => {
        modal.style.display = 'none';
    }, 300);
}

// Open popup window
function openPopup(url) {
    const width = 550;
    const height = 450;
    const left = Math.floor((window.screen.width - width) / 2);
    const top = Math.floor((window.screen.height - height) / 2);

    window.open(
        url,
        'share-dialog',
        `width=${width},height=${height},left=${left},top=${top},toolbar=0,location=0,menubar=0,directories=0,scrollbars=0`
    );
}

// Helper function to show toast messages
function showToast(message) {
    const toastElement = document.querySelector('.copy-success');
    if (!toastElement) return;

    const toastBody = toastElement.querySelector('.toast-body');
    if (toastBody) {
        toastBody.innerHTML = `<i class="fas fa-check-circle"></i> ${message}`;
    }

    const toast = bootstrap.Toast.getInstance(toastElement) ||
                 new bootstrap.Toast(toastElement, {
                     animation: true,
                     autohide: true,
                     delay: 3000
                 });
    toast.show();
}
