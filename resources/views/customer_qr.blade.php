<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Share Your Generated Link</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --navy: #000066;
            --navy-dark: #000044;
            --yellow: #FFD700;
            --bg-color: #EDF5FF;
        }

        body {
            background-color: var(--bg-color);
            min-height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            overflow: hidden;
        }

        .page-container {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            padding: 1rem;
        }

        .share-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }

        .back-link {
            position: absolute;
            top: 1.5rem;
            left: 1.5rem;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
            transition: transform 0.3s ease;
            z-index: 10;
        }

        .back-link:hover {
            color: var(--yellow);
            transform: translateX(-3px);
        }

        .share-header {
            background: var(--navy);
            padding: 2rem;
            color: white;
            text-align: center;
            position: relative;
        }

        .content-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            padding: 2rem;
            background: white;
        }

        .section {
            padding: 1.5rem;
            background: var(--bg-color);
            border-radius: 16px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .qr-section {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .qr-code {
            width: 200px;
            height: 200px;
            padding: 1rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 1rem;
        }

        .btn-action {
            padding: 0.75rem;
            border-radius: 8px;
            border: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-primary {
            background: var(--yellow);
            color: var(--navy);
        }

        .btn-secondary {
            background: var(--navy);
            color: var(--yellow);
        }

        .btn-action:hover {
            opacity: 0.9;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .url-display {
            background: white;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            margin-bottom: 1rem;
            word-break: break-all;
            font-family: monospace;
            font-size: 0.9rem;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-top: 1rem;
        }

        .validity-footer {
            padding: 1rem 2rem;
            display: flex;
            justify-content: flex-start;
            gap: 2rem;
            margin-top: 1rem;
            background: #000066;
            border-radius: 0 0 24px 24px;
        }

        .validity-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            font-size: 0.875rem;
        }

        .validity-item i {
            color: white;
            font-size: 0.875rem;
        }

        .share-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .share-modal.show {
            display: flex;
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            width: 90%;
            max-width: 400px;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            color: var(--navy);
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--navy);
            padding: 0;
        }

        .share-options {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .share-option {
            background: var(--bg-color);
            padding: 1rem;
            border-radius: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .share-option:hover {
            transform: translateY(-2px);
            background: var(--yellow);
        }

        .share-option i {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: var(--navy);
        }

        /* Toast Styling */
        .toast-container {
            position: fixed;
            top: 40px;
            right: 24px;
            transform: translateY(-50%);
            z-index: 1100;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .toast {
            min-width: 300px;
            background-color: #000066 !important;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            margin: 0;
            opacity: 0;
            transform: translateX(100%);
        }

        .toast.showing {
            opacity: 0;
            transform: translateX(100%);
        }

        .toast.show {
            opacity: 1;
            transform: translateX(0);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .toast.hide {
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .toast-body {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 16px;
            color: white;
            font-size: 0.9rem;
        }

        .toast-body i {
            color: #FFD700;
            font-size: 1.1rem;
        }

        .btn-close-white {
            opacity: 0.8;
            transition: opacity 0.2s ease;
        }

        .btn-close-white:hover {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .content-container {
                grid-template-columns: 1fr;
            }

            .validity-footer {
                flex-direction: column;
                align-items: center;
                gap: 1rem;
                padding: 1rem;
            }

            .back-link {
                top: 1rem;
                left: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="toast-container">
        <!-- Toast for copy success -->
        <div class="toast copy-success align-items-center text-white border-0" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-check-circle"></i>
                    URL copied to clipboard!
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
    <!-- Previous HTML structure remains the same -->
    <div class="page-container">
        <div class="share-card">
            <a href="{{ route('event_dashboard') }}" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </a>

            <div class="share-header">
                <h2 class="mb-2">Share Your Generated Link</h2>
                <p class="mb-0">Choose your preferred method to share the link</p>
            </div>

            <div class="content-container">
                <!-- QR Code Section -->
                <div class="section qr-section">
                    <div class="qr-code">
                        @if(isset($imageData))
                            <img src="data:image/png;base64,{{ base64_encode($imageData) }}" alt="QR Code"
                                class="img-fluid">
                        @endif
                    </div>
                    <p>Scan with your mobile device</p>

                    <div class="action-buttons">
                        <button class="btn-action btn-primary" onclick="downloadQR()">
                            <i class="fas fa-download"></i>
                            Save QR
                        </button>
                        <!-- For QR code sharing -->
                        <button class="btn-action btn-secondary" onclick="handleShareButtonClick('qr')">
                            <i class="fas fa-share-alt"></i>
                            Share
                        </button>
                    </div>
                </div>

                <!-- Link Section -->
                <div class="section url-section">
                    <h5>Direct Link</h5>
                    <div class="url-display" id="urlText">
                        {{ $url }}
                    </div>
                    <div class="action-buttons">
                        <button class="btn-action btn-primary" onclick="copyUrl()">
                            <i class="fas fa-copy"></i>
                            Copy Link
                        </button>
                        <!-- For URL sharing -->
                        <button class="btn-action btn-secondary" onclick="openShareModal('link')">
                            <i class="fas fa-share-alt"></i>
                            Share
                        </button>
                    </div>
                </div>
            </div>

            <!-- Validity Footer -->
            <div class="validity-footer">
                <div class="validity-item">
                    <i class="fas fa-clock"></i>
                    <span>Valid For: 1 Day</span>
                </div>
                <div class="validity-item">
                    <i class="fas fa-shield-alt"></i>
                    <span>Secure, encrypted connection</span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('script/customer_side/share_qr_link.js') }}"></script>
</body>

</html>