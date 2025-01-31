<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Application Form</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style/style.css') }}">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Your+Font+Name&display=swap');

    body {
        margin: 0 !important;
        padding: 0 !important;
    }

    .yellow-bottom {
        border: 1px solid #d4d5d3;
        border-bottom: 4px solid #ffcd00;
        border-radius: 0.5rem;
        padding: 0.5rem;
        text-align: center;
        margin-bottom: 3%;
    }

    .header-bg-custom {
        background-color: #110176 !important;
        color: #fff !important;
    }

    .btn-custom {
        background-color: #ffcd00;
    }

    .btn-custom:hover {
        background-color: #110176;
        color: #ffcd00;
    }

    .dashboard-main {
        margin-inline-start: 0;
        display: flex;
        flex-wrap: wrap;
        flex-flow: column;
        min-height: 100vh;
        transition: all 0.3s;
    }

    .dashboard-main.active {
        margin-inline-start: 4.875rem;
    }


    @font-face {
        font-family: 'InfiniteJustice';
        src: url({{ asset('font/INFINITE.TTF')}})
    }

    .font_IJ {
        font-family: 'Your Font Name', sans-serif;
        color: #002d6a;
        margin-left: 1rem !important;
    }

    /* Target the scrollbar for WebKit-based browsers (Chrome, Safari, Edge) */
    ::-webkit-scrollbar {
        width: 6px;
        /* Set the width of the scrollbar */
    }

    ::-webkit-scrollbar-thumb {
        background-color: #ffdd00;
        /* Set the color of the scrollbar thumb */
        border-radius: 10px;
        /* Round the edges for a sleeker look */
    }

    ::-webkit-scrollbar-thumb:hover {
        background-color: #555;
        /* Change the color on hover */
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        /* Set the track's background color */
        border-radius: 10px;
        /* Optional: round the track edges */
    }

    /* For Firefox */
    .scrollable-area {
        scrollbar-width: thin;
        /* Use 'thin' for a slimmer scrollbar */
        scrollbar-color: #ffdd00 #f1f1f1;
        /* Set thumb and track colors */
    }
</style>

<body>
    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">



        <!-- Topbar Search -->
        <div class="form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100">
            <h5 class="font_IJ mt-4">Automobile Association Philippines</h5>
        </div>



    </nav>
    <div class="dashboard-main-body p-5">
        <div style="position: relative; color: red; padding-right: 150px;">
            <p style="margin: 0;">
                Free emergency roadside and towing services can be availed of only after 7 days from the date of activation of membership.
            </p>
        </div>
        <br>
    
        @foreach($membershipTypes as $membershipType)
            <div class="row col-md-12 justify-content-center">
                <div class="card p-0 mb-5">
                    <div class="card-header header-bg-custom">
                        {{ $membershipType->membership_name }}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{-- Debug information --}}
                            @php
                                \Log::info('Plans for ' . $membershipType->membership_name, ['plans' => $membershipType->planTypes->toArray()]);
                            @endphp
                            
                            @foreach($membershipType->planTypes as $plan)
                                <div class="col-md-{{ $membershipType->planTypes->count() > 2 ? '4' : '6' }}">
                                    <div class="yellow-bottom">
                                        <p><strong>{{ $plan->plan_name }} - {{ $plan->plan_amount }}</strong></p>
                                        <button class="btn btn-custom">
                                            @if($membershipType->membership_code === 'MP')
                                                <a href="{{ route('motorcycle.fetch', [
                                                'planId' => $plan->plan_id,
                                                'token'  => $token
                                                ]) }}">
                                                    APPLY NOW
                                                </a>
                                            @elseif($membershipType->membership_code === 'P')
                                                <a href="{{ route('pidp.fetch', [
                                                    'membershipId' => $membershipType->membership_id,
                                                    'planId'       => $plan->plan_id,
                                                    'token'        => $token
                                                ]) }}">
                                                    APPLY NOW
                                                </a>
                                            @else
                                                <a href="{{ route('membership.fetch', [
                                                    'membershipId' => $membershipType->membership_id,
                                                    'planId'       => $plan->plan_id,
                                                    'token'        => $token
                                                ]) }}">
                                                    APPLY NOW
                                                </a>
                                            @endif
                                        </button>
                                        <br>
                                        <br>
                                        <p>{{ $plan->remarks ?: 
                                            "Register up to " . $membershipType->vehicle_num . " vehicles. FREE 24/7 Emergency Roadside Assistance of " .
                                            ($membershipType->membership_code === 'MP' ? "2 non-towing interventions" : 
                                            ($plan->plan_name === 'ANNUAL FEE (REGULAR)' ? "4 interventions or 100-km tow distance" :
                                            ($plan->plan_name === 'THREE YEAR FEE (REGULAR)' ? "12 interventions or 300-km tow distance" :
                                            "interventions based on plan"))) . ", whichever comes first. " . 
                                            ($membershipType->membership_code === 'MP' ? "" : "FREE P300,000 Personal Accident Insurance.") }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto py-3">
            <div class="row align-items-center justify-content-center">
                <div class="col-auto me-1">
                    <a href="{{ asset('pdf_file/certificate-aap.pdf') }}" target="_blank">
                        <img src="{{ asset('images/npc-seal.png') }}" alt="Logo" class="img-fluid"
                            style="max-width: 85px; transition: transform 0.3s ease;"
                            onmouseover="this.style.transform='scale(1.1)'"
                            onmouseout="this.style.transform='scale(1)'">
                    </a>
                </div>
                <div class="col-auto">
                    <span mr-5>Copyright © 2020 Automobile Association of the Philippines</span>
                </div>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->
</body>

</html>