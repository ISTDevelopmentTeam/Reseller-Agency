<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Enhanced viewport control -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- Additional viewport control -->
    <meta name="HandheldFriendly" content="true">
    <meta name="MobileOptimized" content="width">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title>Application Verification - AAP Track & Trace</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        /* Strict zoom prevention */
        html {
            touch-action: none;
            -ms-touch-action: none;
            overflow: hidden;
        }

        body {
            touch-action: none;
            -ms-touch-action: none;
            -webkit-text-size-adjust: none;
            -moz-text-size-adjust: none;
            -ms-text-size-adjust: none;
            text-size-adjust: none;
            overflow: hidden;
            position: fixed;
            width: 100%;
            height: 100%;
        }

        #mainContent {
            overflow-y: auto;
            height: calc(100vh - 64px);
            width: 100%;
            -webkit-overflow-scrolling: touch;
        }

        /* Prevent text selection */
        * {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
            -webkit-touch-callout: none;
        }

        /* Allow text selection in inputs */
        input {
            -webkit-user-select: text;
            -moz-user-select: text;
            -ms-user-select: text;
            user-select: text;
        }

        /* Custom Colors */
        .bg-aap-blue { background-color: #003876; }
        .text-aap-blue { color: #003876; }
        .bg-aap-yellow { background-color: #FFB81C; }
        .text-aap-yellow { color: #FFB81C; }

        /* Custom Scrollbar */
        #mainContent::-webkit-scrollbar {
            width: 10px;
        }
        
        #mainContent::-webkit-scrollbar-track {
            background: #E8F0F8;
            border: 1px solid #003876;
            border-radius: 5px;
        }
        
        #mainContent::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #003876 50%, #FFB81C 50%);
            border-radius: 5px;
            border: 2px solid #003876;
        }
        
        #mainContent::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #002d5f 50%, #f0a500 50%);
        }

        @media (max-width: 640px) {
            input, button {
                font-size: 16px !important;
            }
        }
    </style>
    
    <script>
        // Comprehensive zoom prevention
        window.addEventListener('load', function() {
            // Prevent zoom on double tap
            let lastTouchEnd = 0;
            document.addEventListener('touchend', function(e) {
                const now = (new Date()).getTime();
                if (now - lastTouchEnd <= 300) {
                    e.preventDefault();
                }
                lastTouchEnd = now;
            }, false);

            // Prevent all gesture events
            document.addEventListener('gesturestart', function(e) {
                e.preventDefault();
            }, false);

            document.addEventListener('gesturechange', function(e) {
                e.preventDefault();
            }, false);

            document.addEventListener('gestureend', function(e) {
                e.preventDefault();
            }, false);

            // Prevent pinch zoom
            document.addEventListener('touchmove', function(e) {
                if (e.scale !== 1) {
                    e.preventDefault();
                }
            }, { passive: false });

            // Handle keyboard shortcuts for zooming
            document.addEventListener('keydown', function(e) {
                if ((e.ctrlKey || e.metaKey) && (e.key === '+' || e.key === '-' || e.key === '0')) {
                    e.preventDefault();
                }
            });

            // Prevent mouse wheel zoom
            document.addEventListener('wheel', function(e) {
                if (e.ctrlKey) {
                    e.preventDefault();
                }
            }, { passive: false });
        });

        // Lock viewport on orientation change
        window.addEventListener('orientationchange', function() {
            viewport = document.querySelector("meta[name=viewport]");
            viewport.setAttribute('content', 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0');
        });
    </script>
</head>
<body>
    <!-- Fixed Header -->
    <header class="bg-aap-blue h-16 flex-shrink-0 border-b-4 border-aap-yellow">
        <div class="container mx-auto px-4 h-full">
            <div class="flex justify-between items-center h-full">
                <img src="{{ asset('image/aap_logo_white.png') }}" alt="AAP Logo" class="h-8">
                <nav class="hidden md:flex space-x-6">
                    <a href="#" class="text-white hover:text-aap-yellow transition-colors">Home</a>
                    <a href="#" class="text-white hover:text-aap-yellow transition-colors">Help</a>
                    <a href="#" class="text-white hover:text-aap-yellow transition-colors">Contact</a>
                </nav>
                <button class="md:hidden text-aap-yellow">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                    </svg>
                </button>
            </div>
        </div>
    </header>

    <!-- Scrollable Content Area -->
    <div id="mainContent">
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-md mx-auto">
                <!-- Main Content Card -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <!-- Blue Header Section -->
                    <div class="bg-aap-blue p-6 text-center">
                        <h1 class="text-2xl font-bold text-white mb-2">Track Your Application</h1>
                        <p class="text-aap-yellow">Enter your Application ID to view status</p>
                    </div>

                    <!-- Form Section -->
                    <div class="p-6">
                        <form class="space-y-6" onsubmit="event.preventDefault();">
                            <!-- Application ID Input -->
                            <div>
                                <label for="applicationId" class="block text-sm font-medium text-aap-blue mb-2">
                                    Application ID
                                </label>
                                <input
                                    type="text"
                                    id="applicationId"
                                    name="applicationId"
                                    placeholder="Enter your Application ID (e.g., APP-2024-0123)"
                                    class="w-full p-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-aap-yellow focus:border-aap-blue"
                                    required
                                    autocomplete="off"
                                >
                            </div>

                            <!-- Track Button -->
                            <button
                                type="submit"
                                class="w-full bg-aap-blue text-white py-3 px-4 rounded-lg hover:bg-blue-900 focus:ring-4 focus:ring-aap-yellow transition-colors"
                            >
                                Track Application
                            </button>
                        </form>

                        <!-- Help Section -->
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <h2 class="text-lg font-semibold text-aap-blue mb-4">Can't find your Application ID?</h2>
                            <div class="space-y-4">
                                <div class="flex items-start space-x-3 p-4 bg-gray-50 rounded-lg border-l-4 border-aap-yellow">
                                    <div class="flex-shrink-0">
                                        <svg class="w-6 h-6 text-aap-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-medium text-aap-blue">Check Your Email</h3>
                                        <p class="text-sm text-gray-600">Your Application ID was sent to your registered email address</p>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3 p-4 bg-gray-50 rounded-lg border-l-4 border-aap-yellow">
                                <div class="flex-shrink-0">
                                    <svg class="w-6 h-6 text-aap-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-aap-blue">Contact Support</h3>
                                    <p class="text-sm text-gray-600">Our support team is available 24/7 to help you recover your Application ID</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Links -->
                <div class="mt-6 flex justify-center space-x-4 text-sm">
                    <a href="#" class="text-aap-blue hover:text-aap-yellow transition-colors">Privacy Policy</a>
                    <span class="text-gray-300">|</span>
                    <a href="#" class="text-aap-blue hover:text-aap-yellow transition-colors">Terms of Service</a>
                    <span class="text-gray-300">|</span>
                    <a href="#" class="text-aap-blue hover:text-aap-yellow transition-colors">FAQs</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>