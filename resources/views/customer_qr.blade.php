<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reseller Form Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0e63e2 0%, #0e264e 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .card {
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .qr-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        .qr-code {
            width: 200px;
            height: 200px;
            margin: auto;
        }
        .url-section {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
        }
        .copy-btn {
            border: none;
            background: none;
            color: #4361ee;
            padding: 0;
        }
        .copy-btn:hover {
            color: #3151ee;
        }
        .copy-success {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
        .url-display {
            word-break: break-all;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <!-- Toast for copy success -->
    <div class="toast copy-success align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-check-circle me-2"></i>URL copied to clipboard!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-body p-4">
                        <!-- Header -->
                        <div class="text-center mb-4">
                            <h4 class="card-title mb-1">Scan QR Code or Use Link</h4>
                            <p class="text-muted">Access your content using either method below</p>
                        </div>

                        <!-- QR Code Section -->
                        <div class="qr-container mb-4">
                            <div class="qr-code mb-3">
                             <!-- Displaying the Image -->
                             @if(isset($imageData))
                                 <img src="data:image/png;base64,{{ base64_encode($imageData) }}" alt="Generated Image">
                             @endif                            </div>
                            <small class="text-muted">Scan with your phone's camera or QR code reader</small>
                        </div>

                        <!-- URL Section -->
                        <div class="url-section">
                            <label class="form-label mb-3">
                                <i class="fas fa-link me-2"></i>Direct URL Link
                            </label>
                            <div class="d-flex align-items-center">
                                <span class="url-display flex-grow-1" id="urlText">{{ $url }}</span>
                                <button class="copy-btn" onclick="copyUrl()">
                                    <i class="fas fa-copy fs-5"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Additional Info -->
                        <div class="mt-4">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-clock text-muted me-2"></i>
                                <small class="text-muted">Valid For: 1 Hour</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fas fa-shield-alt text-muted me-2"></i>
                                <small class="text-muted">Secure, encrypted connection</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function copyUrl() {
            // text to copy
            const urlText = document.getElementById('urlText').textContent;
            
            // Copy to clipboard
            navigator.clipboard.writeText(urlText).then(() => {
                // Show toast
                const toast = new bootstrap.Toast(document.querySelector('.toast'));
                toast.show();
            });
        }
    </script>
</body>
</html>