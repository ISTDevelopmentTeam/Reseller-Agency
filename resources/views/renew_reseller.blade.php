<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renew Dashboard</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href={{ asset('style/renew_reseller.css') }}>

</head>
<body>
@include("layout.sidebar");
@include("layout.nav");

                <div class="row justify-content-center mt-5">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-10">
                            <div class="search-card">
                                <h2 class="text-center mb-4">Search Membership Record</h2>
                                <!-- PIN Search -->
                                <form action="{{ route('search_member')}}" method="post">
                                @csrf
                                    <div class="mb-4" id="search_pin">
                                        <label class="form-label">Pincode</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                            <input onkeyup="countChar(this); validatePincode(this);" type="text" name="search[pincode]" id="pin_code" class="form-control" placeholder="Enter PIN code">
                                            <p style="color: red;"></p>
                                                @error('search.pincode')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror  
                                        </div>
                                    </div>
                                    <h4 class="text-center p-1" id="or">OR</h4>
                                    <div id="search_name">
                                        <!-- Name Search -->
                                        <div class="row g-3 mb-4">
                                            <div class="col-md-6">
                                                <label class="form-label">First Name</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    <input onkeyup="countCharN(this); validateFirstName(this);" type="text" name="search[members_firstname]" class="form-control" id="first_name" placeholder="Enter first name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Last Name</label>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                    <input onkeyup="countCharN(this); validateLastName(this);" name="search[members_lastname]" type="text" class="form-control" id="last_name" placeholder="Enter last name">
                                                </div>
                                            </div>
                                        </div>
                    
                                        <!-- Birth Date -->
                                        <div class="row g-3 mb-4">
                                            <div class="col-md-4">
                                                <label class="form-label">Birth Month</label>
                                                <Select onkeyup="countCharN(this); validateBirthMonth(this);" field="birth_month" name="search[birth_month]" class="form-control birthdate-select" id="b_month">
                                                    <option value = "" selected disabled> Select birth month.</option>
                                                    <option value = "01">JANUARY</option>
                                                    <option value = "02">FEBRUARY</option>
                                                    <option value = "03">MARCH</option>
                                                    <option value = "04">APRIL</option>
                                                    <option value = "05">MAY</option>
                                                    <option value = "06">JUNE</option>
                                                    <option value = "07">JULY</option>
                                                    <option value = "08">AUGUST</option>
                                                    <option value = "09">SEPTEMBER</option>
                                                    <option value = "10">OCTOBER</option>
                                                    <option value = "11">NOVEMBER</option>
                                                    <option value = "12">DECEMBER</option>
                                                </Select>
                                                <p style="color: red;"></p> <!-- Error message placeholder -->
                                                @error('search.birth_month')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Birth Day</label>
                                                <select onkeyup="countCharN(this); validateBirthDay(this);" class="form-select birthdate-select" id="b_day" name="search[bday_date]">
                                                <?php for ($i = 1; $i <= 31; $i++): ?>
                                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php endfor; ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Birth Year</label>
                                                <select onkeyup="countCharN(this); validateBirthYear(this);" class="form-control birthdate-select" id="b_year" name="search[bday_year]">
                                                <option value="" disabled selected>Select a year</option>
                                                    <?php 
                                                        $current = date("Y");
                                                        for ($year = $current; $year >= 1920; $year--): 
                                                        $selected = ($year == 1985) ? 'selected' : '';?>
                                                        <option value="<?php echo $year; ?>" <?php echo $selected; ?>><?php echo $year; ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-primary search-btn" type="submit">
                                            <i class="fas fa-search me-2"></i>Search
                                        </button>
                                    </div>
                                </form>
                            </div>

                            @if (request()->has('search') && isset($membership_info) && count($membership_info) > 0)
                            <!-- Results Table -->
                            <div class="table-container mt-4">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Record No.</th>
                                            <th scope="col">Vehicle</th>
                                            <th scope="col">Membership Category</th>
                                            <th scope="col">Last Name</th>
                                            <th scope="col">First Name</th>
                                            <th scope="col">Activation Date</th>
                                            <th scope="col">Expiration Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($membership_info as $member)
                                        <tr>
                                            <td>{{ $member['vehicleinfohead_order'] }}</td>
                                            {{-- <td>{!! (implode("\n", $member['car_details'])) !!}</td> --}}
                                            {{-- <td>{{ implode('\n', $member['car_details']) }}</td> --}}
                                            <td>
                                                @foreach($member['car_details'] as $index => $detail)
                                                    {{ $detail }}
                                                    @if($index < count($member['car_details']) - 1)
                                                        <hr style="margin: 5px 0;">
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>{{ $member['sponsor_name'] }}</td>
                                            <td>{{ $member['members_lastname'] }}</td>
                                            <td>{{ $member['members_firstname'] }}</td>
                                            <td>{{ $member['vehicleinfohead_activedate'] }}</td>
                                            <td>{{ $member['vehicleinfohead_expiredate'] }}</td>
                                            <td style="color: {{ strtoupper($member['vehicleinfohead_status']) === 'ACTIVE' ? 'green' : 'red' }}">{{ $member['vehicleinfohead_status'] }}</td>
                                            <td>
                                                <a href="{{ route('reseller_form', ['id' => $member['members_id'], 'vehicle' => $member['vehicleinfohead_id']]) }}" class="btn btn-primary">Renew</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @elseif (request()->has('search') && empty($membership_info))
                                <div class="text-center mt-5">
                                    <p class="alert alert-danger"><b>No results found.</b></p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="small text-muted mt-4 text-center">
                        Copyright © 2024 Automobile Association of the Philippines
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="/script/renew_reseller.js"></script>
    <script src="/script/sidebar.js"></script>
    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     const searchBtn = document.getElementById('searchBtn');
        //     const resetBtn = document.getElementById('resetBtn');
        //     const renewalForm = document.getElementById('renewalForm');

        //     // Show form when search button is clicked
        //     searchBtn.addEventListener('click', function() {
        //         renewalForm.classList.add('show');
        //     });

        //     // Hide form when reset button is clicked
        //     resetBtn.addEventListener('click', function() {
        //         renewalForm.classList.remove('show');
        //         // Clear all input fields
        //         document.querySelectorAll('input, select, textarea').forEach(element => {
        //             element.value = '';
        //         });
        //     });
        // });
    </script>
</body>
</html>