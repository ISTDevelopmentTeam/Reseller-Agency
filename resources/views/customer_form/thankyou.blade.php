<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Application Submitted Successfully</title>
    <style>
        :root {
            --navy: #000066;
            --yellow: #FFD700;
            --light-blue: #EDF5FF;
            --success-blue: #E8F4FD;
            --text-dark: #1A1A1A;
            --text-gray: #4A5568;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            margin: 0;
            min-height: 100vh;
            background: var(--light-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .container {
            background: white;
            border-radius: 24px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            width: 100%;
            max-width: 600px;
            overflow: hidden;
        }

        .header {
            background: var(--navy);
            padding: 2.5rem 2rem;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--yellow);
        }

        .header h1 {
            margin: 0;
            font-size: 2rem;
            font-weight: 600;
        }

        .success-icon {
            width: 84px;
            height: 84px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: -42px auto 1.5rem;
            position: relative;
            z-index: 1;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .success-icon svg {
            width: 44px;
            height: 44px;
            fill: var(--navy);
        }

        .content {
            padding: 0 2rem 2rem;
            text-align: center;
        }

        .message {
            color: var(--text-dark);
            font-size: 1.1rem;
            line-height: 1.6;
            margin: 1.5rem 0 2rem;
            max-width: 480px;
            margin-left: auto;
            margin-right: auto;
        }

        .message p {
            margin: 0.75rem 0;
        }

        .application-details {
            background: var(--success-blue);
            border-radius: 16px;
            padding: 2rem;
            margin: 1rem 0 2rem;
            text-align: left;
        }

        .details-title {
            color: var(--navy);
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0 0 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .details-title i {
            color: var(--navy);
            font-size: 1.25rem;
        }

        .id-box {
            background: white;
            border-radius: 12px;
            padding: 1.25rem 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(0, 0, 0, 0.08);
        }

        .id-label {
            color: var(--text-gray);
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .id-value {
            color: var(--navy);
            font-size: 1.25rem;
            font-weight: 600;
            font-family: monospace;
        }

        .notice-box {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid rgba(0, 0, 0, 0.08);
        }

        .notice-title {
            color: var(--navy);
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
        }

        .notice-title i {
            color: var(--navy);
        }

        .notice-content {
            color: var(--text-gray);
            font-size: 0.95rem;
            line-height: 1.6;
            margin: 0 0 1.25rem;
        }

        .notice-content p {
            margin: 0.5rem 0;
        }

        .track-link {
            display: inline-block;
            background: var(--navy);
            color: white;
            text-decoration: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .track-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .track-link i {
            margin-right: 0.5rem;
        }

        @media (max-width: 640px) {
            body {
                padding: 1rem;
                background: white;
            }

            .container {
                box-shadow: none;
            }

            .header {
                padding: 2rem 1.5rem;
            }

            .content {
                padding: 0 1.5rem 1.5rem;
            }

            .application-details {
                padding: 1.5rem;
            }

            .message {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Thank you!</h1>
        </div>
        
        <div class="content">
            <div class="success-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                </svg>
            </div>

            <div class="message">
                <p>Your application has been successfully submitted! We appreciate your time and effort in completing the form.</p>
            </div>

            <div class="application-details">
                <h2 class="details-title">
                    <i class="fas fa-file-alt"></i>
                    Application Details
                </h2>
                
                <div class="id-box">
                    <div class="id-label">Application ID</div>
                    <div class="id-value">APP-202502-6777</div>
                </div>

                <div class="notice-box">
                    <div class="notice-title">
                        <i class="fas fa-info-circle"></i>
                        Next Steps
                    </div>
                    <div class="notice-content">
                        <p>Your unique Application ID has been generated and stored in our system. For your convenience, we'll send you an email containing:</p>
                        <ul style="margin: 0.75rem 0; padding-left: 1.5rem; color: inherit;">
                            <li>Your Application ID for reference</li>
                            <li>A secure link to track your application status</li>
                            <li>Additional information about the next steps</li>
                        </ul>
                    </div>
                    <a href="https://www.example.com/track" class="track-link">
                        <i class="fas fa-external-link-alt"></i>
                        Track Your Application
                    </a>
                </div>
            </div>
        </div>
    </div>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</body>
</html>