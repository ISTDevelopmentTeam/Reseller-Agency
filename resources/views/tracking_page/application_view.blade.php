<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Application Status Tracker - AAP</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom Colors */
        .bg-aap-blue { background-color: #003876; }
        .text-aap-blue { color: #003876; }
        .border-aap-blue { border-color: #003876; }
        .bg-aap-yellow { background-color: #FFB81C; }
        .text-aap-yellow { color: #FFB81C; }
        .border-aap-yellow { border-color: #FFB81C; }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 12px;
        }
        
        ::-webkit-scrollbar-track {
            background: #E8F0F8;
            border: 1px solid #003876;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #003876 50%, #FFB81C 50%);
            border-radius: 6px;
            border: 2px solid #003876;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(45deg, #002d5f 50%, #e5a619 50%);
        }

        html {
            overflow-y: scroll;
            scrollbar-color: #003876 #E8F0F8;
            scrollbar-width: thin;
        }
        
        /* Progress Bar Animation */
        @keyframes progress {
            from { width: 0; }
            to { width: 60%; }
        }
        
        .animate-progress {
            animation: progress 1.5s ease-out forwards;
        }

        /* Timeline dot styles */
        .timeline-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }

        .timeline-line {
            width: 2px;
            height: 100%;
            position: absolute;
            left: 5px;
            background-color: #E5E7EB;
        }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-aap-blue border-b-4 border-aap-yellow sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <img src="{{ asset('image/aap_logo_white.png') }}" alt="AAP Logo" class="h-8">
            <nav class="flex space-x-6">
                <a href="#" class="text-white hover:text-aap-yellow transition-colors font-medium">Home</a>
                <a href="#" class="text-white hover:text-aap-yellow transition-colors font-medium">Help</a>
                <a href="#" class="text-white hover:text-aap-yellow transition-colors font-medium">Contact</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-6">
        <!-- Status Card -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header Section -->
            <div class="bg-aap-blue p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-white text-2xl font-bold">Student Visa Application</h1>
                        <p class="text-aap-yellow mt-2">Submitted on Feb 14, 2024</p>
                    </div>
                    <div class="bg-aap-yellow text-aap-blue px-4 py-2 rounded-full font-medium">
                        Processing
                    </div>
                </div>
            </div>

            <!-- Progress Section -->
            <div class="p-6">
                <div class="mb-4">
                    <div class="flex justify-between mb-2">
                        <span class="text-sm text-gray-600">Progress</span>
                        <span class="text-sm text-gray-600">60%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-aap-blue rounded-full h-2 animate-progress"></div>
                    </div>
                </div>

                <!-- Timeline -->
                <div class="flex justify-between text-sm text-gray-600 mb-8">
                    <span>Start: Feb 14</span>
                    <span>Estimated Completion: Feb 16</span>
                </div>

                <!-- Application Details Grid -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Type</p>
                        <p class="font-medium text-aap-blue">Student Visa</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Priority</p>
                        <p class="font-medium text-aap-blue">Normal</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Documents</p>
                        <p class="font-medium text-green-600">Verified ✓</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Processing Time</p>
                        <p class="font-medium text-aap-blue">2-3 Days</p>
                    </div>
                </div>

                <!-- Application Timeline -->
                <div class="mt-8">
                    <h2 class="text-xl font-semibold text-aap-blue mb-6">Application Timeline</h2>
                    <div class="relative">
                        <div class="timeline-line"></div>
                        
                        <!-- Completed Step -->
                        <div class="ml-8 mb-8 relative">
                            <div class="absolute -left-8 top-1.5 timeline-dot bg-green-500"></div>
                            <div class="bg-green-50 p-4 rounded-lg">
                                <div class="flex justify-between mb-1">
                                    <h3 class="font-medium text-green-800">Application Submitted</h3>
                                    <span class="text-sm text-gray-500">Feb 14, 9:30 AM</span>
                                </div>
                                <p class="text-sm text-gray-600">All required documents have been received</p>
                            </div>
                        </div>

                        <!-- Current Step -->
                        <div class="ml-8 mb-8 relative">
                            <div class="absolute -left-8 top-1.5 timeline-dot bg-aap-blue animate-pulse"></div>
                            <div class="bg-blue-50 p-4 rounded-lg border-l-4 border-aap-blue">
                                <div class="flex justify-between mb-1">
                                    <h3 class="font-medium text-aap-blue">Document Verification</h3>
                                    <span class="text-sm text-gray-500">Feb 14, 11:45 AM</span>
                                </div>
                                <p class="text-sm text-gray-600">Your documents are being reviewed by our team</p>
                                <div class="mt-2">
                                    <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded">In Progress</span>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Steps -->
                        <div class="ml-8 mb-8 relative">
                            <div class="absolute -left-8 top-1.5 timeline-dot bg-gray-300"></div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="flex justify-between mb-1">
                                    <h3 class="font-medium text-gray-500">Application Review</h3>
                                    <span class="text-sm text-gray-500">Pending</span>
                                </div>
                                <p class="text-sm text-gray-500">Comprehensive review of your application</p>
                            </div>
                        </div>

                        <div class="ml-8 relative">
                            <div class="absolute -left-8 top-1.5 timeline-dot bg-gray-300"></div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="flex justify-between mb-1">
                                    <h3 class="font-medium text-gray-500">Final Approval</h3>
                                    <span class="text-sm text-gray-500">Pending</span>
                                </div>
                                <p class="text-sm text-gray-500">Final review and approval process</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>