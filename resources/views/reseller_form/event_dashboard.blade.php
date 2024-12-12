<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Application Form</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style/style.css') }}">
    <link rel="stylesheet" href="{{ asset('style/new_reseller.css') }}">
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
@include("layout.sidebar")
@include("layout.nav")

    <div class="dashboard-main-body p-5">
    <div style="position: relative; color: red; padding-right: 150px;">
    <p style="margin: 0;">
        Free emergency roadside and towing services can be availed of only after 7 days from the date of activation of membership.
    </p>
    <button class="btn btn-primary customer-fillout-btn"
        style="position: absolute; right: 0.8rem; top: 50%; transform: translateY(-50%);"
        onclick="window.open('{{ route('customer_qr') }}', '_blank')">
        <i class="fas fa-user-edit me-2"></i>Customer Fill-out
    </button>
</div>
        <br>
        <div class="row col-md-12 justify-content-center">
            <div class="card p-0 mb-5">
                <div class="card-header header-bg-custom"> PIDP - PHILIPPINE INTERNATIONAL DRIVING PERMIT </div>
                
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-md-4">
                            <div class="yellow-bottom">
                                @foreach ($results as $plan)
                                    @if ($plan->plan_id == 8)
                                        <p><strong>{{ $plan->plan_name }} - {{ $plan->plan_amount }}</strong></p>
                                        <a href="{{ route('new_pidp.index', ['planId' => $plan->plan_id]) }}"
                                            class="btn btn-custom">
                                            APPLY NOW
                                        </a>
                                    @endif
                                @endforeach
                                <br>
                                <br>
                                <p>Register up to 2 vehicles. FREE 24/7 Emergency Roadside Assistance of 4 interventions
                                    or 100-km tow distance, whichever comes first. FREE P300,000 Personal Accident
                                    Insurance.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="yellow-bottom">
                                <!-- <p><strong>TWO YEARS (PIDP) - 8100</strong></p> -->
                                @foreach ($results as $plan)
                                    @if ($plan->plan_id == 9)
                                        <p><strong>{{ $plan->plan_name }} - {{ $plan->plan_amount }}</strong></p>
                                        <a href="{{ route('new_pidp.index', ['planId' => $plan->plan_id]) }}"
                                            class="btn btn-custom">
                                            APPLY NOW
                                        </a>
                                    @endif
                                @endforeach
                                <br>
                                <br>
                                <p>Register up to 2 vehicles. FREE 24/7 Emergency Roadside Assistance of 8 interventions
                                    or 200-km tow distance, whichever comes first. FREE P300,000 Personal Accident
                                    Insurance.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="yellow-bottom">
                                <!-- <p><strong>THREE YEARS (PIDP) - 9200</strong></p> -->
                                @foreach ($results as $plan)
                                    @if ($plan->plan_id == 10)
                                        <p><strong>{{ $plan->plan_name }} - {{ $plan->plan_amount }}</strong></p>
                                        <a href="{{ route('new_pidp.index', ['planId' => $plan->plan_id]) }}"
                                            class="btn btn-custom">
                                            APPLY NOW
                                        </a>
                                    @endif
                                @endforeach
                                <br>
                                <br>
                                <p>Register up to 2 vehicles. FREE 24/7 Emergency Roadside Assistance of 12
                                    interventions or 300-km tow distance, whichever comes first. FREE P300,000 Personal
                                    Accident Insurance.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row col-md-12 justify-content-center">
            <div class="card p-0 mb-5">
                <div class="card-header header-bg-custom"> REGULAR INDIVIDUAL</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="yellow-bottom">
                                <!-- <p><strong>ANNUAL FEE (REGULAR) - 2500</strong></p> -->
                                @foreach ($results as $plan)
                                    @if ($plan->plan_id == 1)
                                        <p><strong>{{ $plan->plan_name }} - {{ $plan->plan_amount }}</strong></p>
                                        <button class="btn btn-custom"><a href="{{ route('new_membership.index', ['planId' => $plan->plan_id]) }}">
                                        APPLY NOW</a></button>
                                    @endif
                                @endforeach
                                <br>
                                <br>
                                <p>Register up to 2 vehicles. FREE 24/7 Emergency Roadside Assistance of 4 interventions
                                    or 100-km tow distance, whichever comes first. FREE P300,000 Personal Accident
                                    Insurance.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="yellow-bottom">
                                <!-- <p><strong>THREE YEAR FEE (REGULAR) - 5900</strong></p> -->
                                @foreach ($results as $plan)
                                    @if ($plan->plan_id == 2)
                                        <p><strong>{{ $plan->plan_name }} - {{ $plan->plan_amount }}</strong></p>
                                    @endif
                                @endforeach
                                <br>
                                <br>
                                <p>Register up to 2 vehicles. FREE 24/7 Emergency Roadside Assistance of 12
                                    interventions or 300-km tow distance, whichever comes first. FREE P300,000 Personal
                                    Accident Insurance</p>
                                <button class="btn btn-custom"><a href="{{ route('new_membership.index', ['planId' => $plan->plan_id]) }}">
                                    APPLY NOW</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row col-md-12 justify-content-center">
            <div class="card p-0 mb-5">
                <div class="card-header header-bg-custom"> ASSOCIATE INDIVIDUAL</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="yellow-bottom">
                                <!-- <p><strong>ANNUAL FEE (ASSOCIATE) - 2000</strong></p> -->
                                @foreach ($results as $plan)
                                    @if ($plan->plan_id == 3)
                                        <p><strong>{{ $plan->plan_name }} - {{ $plan->plan_amount }}</strong></p>
                                    @endif
                                @endforeach
                                <br>
                                <br>
                                <p>Register up to 1 vehicle. FREE 24/7 Emergency Roadside Assistance of 3 interventions
                                    or 60-km tow distance, whichever comes first. FREE P200,000 Personal Accident
                                    Insurance.</p>
                                <button class="btn btn-custom"><a href="{{ route('new_membership.index', ['planId' => $plan->plan_id]) }}">
                                    APPLY NOW</a></button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="yellow-bottom">
                                <!-- <p><strong>THREE YEAR FEE (ASSOCIATE) - 4500</strong></p> -->
                                @foreach ($results as $plan)
                                    @if ($plan->plan_id == 4)
                                        <p><strong>{{ $plan->plan_name }} - {{ $plan->plan_amount }}</strong></p>
                                    @endif
                                @endforeach
                                <br>
                                <br>
                                <p>Register up to 1 vehicle. FREE 24/7 Emergency Roadside Assistance of 9 interventions
                                    or 180-km tow distance, whichever comes first. FREE P200,000 Personal Accident
                                    Insurance</p>
                                <button class="btn btn-custom"><a href="{{ route('new_membership.index', ['planId' => $plan->plan_id]) }}">
                                    APPLY NOW</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row col-md-12 justify-content-center">
            <div class="card p-0 mb-5">
                <div class="card-header header-bg-custom">MEMBERSHIP LITE</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="yellow-bottom">
                                <!-- <p><strong>ANNUAL FEE (MEMBERSHIP LITE) - 900</strong></p> -->
                                @foreach ($results as $plan)
                                    @if ($plan->plan_id == 7)
                                        <p><strong>{{ $plan->plan_name }} - {{ $plan->plan_amount }}</strong></p>
                                    @endif
                                @endforeach
                                <br>
                                <br>
                                <p>Register 1 vehicle only. FREE 24/7 Emergency Roadside Assistance of 2 non-towing
                                    interventions per year (flat tire change, battery boosting, fuel provision and minor
                                    mechanical repairs). FREE P200,000 Personal Accident Insurance.</p>
                                <button class="btn btn-custom"><a href="{{ route('new_membership.index', ['planId' => $plan->plan_id]) }}">
                                    APPLY NOW</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row col-md-12 justify-content-center">
            <div class="card p-0 mb-5">
                <div class="card-header header-bg-custom">ELITE</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="yellow-bottom">
                                <!-- <p><strong>ANNUAL FEE (ELITE) - 5000</strong></p> -->
                                @foreach ($results as $plan)
                                    @if ($plan->plan_id == 5)
                                        <p><strong>{{ $plan->plan_name }} - {{ $plan->plan_amount }}</strong></p>
                                    @endif
                                @endforeach
                                <br>
                                <br>
                                <p>Register up to 5 vehicles. FREE 24/7 Emergency Roadside Assistance of 8 interventions
                                    or 200-km tow distance, whichever comes first. FREE P300,000 Personal Accident
                                    Insurance.</p>
                                <button class="btn btn-custom"><a href="{{ route('new_membership.index', ['planId' => $plan->plan_id]) }}">
                                    APPLY NOW</a></button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="yellow-bottom">
                                <!-- <p><strong>THREE YEAR FEE (ELITE) - 10000</strong></p> -->
                                @foreach ($results as $plan)
                                    @if ($plan->plan_id == 6)
                                        <p><strong>{{ $plan->plan_name }} - {{ $plan->plan_amount }}</strong></p>
                                    @endif
                                @endforeach
                                <br>
                                <br>
                                <p>Register up to 5 vehicles. FREE 24/7 Emergency Roadside Assistance of 24
                                    interventions or 600-km tow distance, whichever comes first. FREE P300,000 Personal
                                    Accident Insurance.</p>
                                <button class="btn btn-custom"><a href="{{ route('new_membership.index', ['planId' => $plan->plan_id]) }}">
                                    APPLY NOW</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row col-md-12 justify-content-center">
            <div class="card p-0 mb-5">
                <div class="card-header header-bg-custom">MOTORCYCLE MEMBERSHIP PLUS</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="yellow-bottom">
                                <!-- <p><strong>ANNUAL FEE(MOTORCYCLE PACKAGE 1) - 600</strong></p> -->
                                @foreach ($results as $plan)
                                    @if ($plan->plan_id == 11)
                                        <p><strong>{{ $plan->plan_name }} - {{ $plan->plan_amount }}</strong></p>
                                    @endif
                                @endforeach
                                <br>
                                <br>
                                <p>Register 1 motorcycle (200cc and below). FREE AAP-Caltex SavePlus Discount Card upon
                                    registration (valid in Luzon, Visayas, and Davao region only).</p>
                                <button class="btn btn-custom"><a href="/motorcycle">APPLY NOW</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <!-- <footer class="sticky-footer bg-white">
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
    </footer> -->
    <!-- End of Footer -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('script/sidebar.js')}}"></script>
</body>

</html>