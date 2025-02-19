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
        /* Print-specific styles */
    @media print {
        /* Hide unnecessary elements when printing */
        header, 
        .no-print,
        button {
            display: none !important;
        }

        /* Ensure white background and black text */
        body {
            background: white !important;
            color: black !important;
            margin: 0;
            padding: 20px;
        }

        /* Format the main content for printing */
        #mainContent {
            height: auto !important;
            overflow: visible !important;
            padding: 0 !important;
        }

        /* Ensure cards print properly */
        .bg-white {
            background: white !important;
            border: none !important;
            box-shadow: none !important;
        }

        /* Format header sections */
        .bg-aap-blue {
            background: white !important;
            color: black !important;
            padding: 10px 0 !important;
            border-bottom: 2px solid #003876 !important;
        }

        /* Make text black for printing */
        .text-white,
        .text-aap-yellow,
        .text-aap-blue {
            color: black !important;
        }

        /* Format status badge */
        .status-badge {
            border: 1px solid black !important;
            background: none !important;
            color: black !important;
        }

        /* Ensure proper page breaks */
        .page-break {
            page-break-before: always;
        }

        /* Proper margins and spacing */
        .container {
            max-width: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /* Format grid layouts for print */
        .grid {
            display: block !important;
        }

        .grid > div {
            margin-bottom: 15px !important;
        }

        /* Remove shadows and borders */
        .shadow-lg {
            box-shadow: none !important;
        }

        /* Format info sections */
        .border-b {
            border-bottom: 1px solid #ddd !important;
            padding-bottom: 10px !important;
            margin-bottom: 10px !important;
        }

        /* Ensure all content is visible */
        * {
            overflow: visible !important;
        }
        
        /* Format text for better print readability */
        p, h1, h2, h3, h4, h5, h6 {
            color: black !important;
            margin-bottom: 0.5em !important;
        }

        /* Ensure images print properly */
        img {
            max-width: 100% !important;
            height: auto !important;
        }

        /* Add print header */
        .print-header {
            text-align: center;
            margin-bottom: 20px;
            display: block !important;
        }

        /* Hide scrollbar */
        ::-webkit-scrollbar {
            display: none !important;
        }
    }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-aap-blue border-b-4 border-aap-yellow sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <img src="{{ asset('images/aap_logo_white.png') }}" alt="AAP Logo" class="h-8">
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
                        <h1 class="text-white text-2xl font-bold">{{ $membership->application_track_no }}</h1>
                        <p class="text-aap-yellow mt-2">Submitted on {{ $membership->application_date }}</p>
                    </div>
                    <div class="bg-aap-yellow text-aap-blue px-4 py-2 rounded-full font-medium">
                                {{ $membership->status }}
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
                <!-- <div class="flex justify-between text-sm text-gray-600 mb-8">
                    <span>Start: Feb 14</span>
                    <span>Estimated Completion: Feb 16</span>
                </div> -->

                <!-- Application Details Grid -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Type</p>
                        <p class="font-medium text-aap-blue">{{ $membership->membership_type }}({{ $membership->plan_type }})</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Full Name</p>
                        <p class="font-medium text-aap-blue">{{ $membership->members_firstname }} {{ $membership->members_middlename }} {{ $membership->members_lastname }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Email Address</p>
                        <p class="font-medium text-green-600">{{ $membership->members_emailaddress }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-sm text-gray-600">Phone Number</p>
                        <p class="font-medium text-aap-blue">{{ $membership->members_mobileno }}</p>
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
                <!-- Action Buttons -->
                <div class="flex justify-between items-center pt-4">
                    <a href="{{ route('tracking') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Search
                    </a>
                    <button onclick="window.print()" 
                            class="inline-flex items-center px-4 py-2 bg-aap-blue text-white rounded-lg hover:bg-blue-900 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                        Print Details
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>