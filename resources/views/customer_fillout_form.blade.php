<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membership Application Form</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
            padding: 2rem 0;
        }

        .form-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 2rem;
        }

        .breadcrumb-container {
            margin-bottom: 2rem;
            position: relative;
            padding: 0;
        }

        .breadcrumb-item {
            flex: 1;
            text-align: center;
            padding: 1rem;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .breadcrumb-item::before {
            display: none !important;
        }

        .breadcrumb-item::after {
            content: '';
            position: absolute;
            top: 50%;
            right: -50%;
            width: 100%;
            height: 2px;
            background-color: #dee2e6;
            z-index: 1;
        }

        .breadcrumb-item:last-child::after {
            display: none;
        }

        .breadcrumb-number {
            width: 35px;
            height: 35px;
            background-color: #dee2e6;
            color: #6c757d;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.5rem;
            position: relative;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .breadcrumb-item.active .breadcrumb-number,
        .breadcrumb-item.completed .breadcrumb-number {
            background-color: #0d6efd;
            color: white;
        }

        .breadcrumb-item.completed::after {
            background-color: #0d6efd;
        }

        .breadcrumb-title {
            font-size: 0.875rem;
            color: #6c757d;
            margin: 0;
            transition: all 0.3s ease;
        }

        .breadcrumb-item.active .breadcrumb-title,
        .breadcrumb-item.completed .breadcrumb-title {
            color: #0d6efd;
            font-weight: 600;
        }

        .form-section {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .form-section.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }

        .vehicle-item {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .vehicle-item:hover {
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        .btn-remove {
            color: #dc3545;
            background: none;
            border: none;
            padding: 0;
            font: inherit;
            cursor: pointer;
            outline: inherit;
            transition: all 0.3s ease;
        }

        .btn-remove:hover {
            color: #bb2d3b;
        }

        .navigation-buttons {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #dee2e6;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center mb-4">Customer's Fill-out</h2>
            
            <!-- Breadcrumbs -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-container d-flex justify-content-between">
                    <li class="breadcrumb-item active" data-step="1">
                        <div class="breadcrumb-number">1</div>
                        <p class="breadcrumb-title">Membership</p>
                    </li>
                    <li class="breadcrumb-item" data-step="2">
                        <div class="breadcrumb-number">2</div>
                        <p class="breadcrumb-title">Personal Info</p>
                    </li>
                    <li class="breadcrumb-item" data-step="3">
                        <div class="breadcrumb-number">3</div>
                        <p class="breadcrumb-title">Contact</p>
                    </li>
                    <li class="breadcrumb-item" data-step="4">
                        <div class="breadcrumb-number">4</div>
                        <p class="breadcrumb-title">Vehicle</p>
                    </li>
                    <li class="breadcrumb-item" data-step="5">
                        <div class="breadcrumb-number">5</div>
                        <p class="breadcrumb-title">Summary</p>
                    </li>
                </ol>
            </nav>

            <!-- Form -->
            <form id="membershipForm">
                <!-- Membership Section -->
                <div class="form-section active" id="section1">
                    <h4 class="mb-4">Membership Details</h4>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Type of Application</label>
                            <select class="form-select">
                                <option value="NEW" selected>NEW</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Membership Type</label>
                            <input type="text" class="form-control" value="ASSOCIATE INDIVIDUAL" readonly>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="planType" class="form-label">Plan Type</label>
                          <input type="text" class="form-control" id="planType" value="ANNUAL FEE (ASSOCIATE)" readonly>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="pidpPlanType" class="form-label">PIDP Plan Type</label>
                            <input type="text" class="form-control" id="pidpPlanType">
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3 mb-3">
                          <label for="activationDate" class="form-label">Activation Date</label>
                          <input type="date" class="form-control" id="activationDate" required>
                      </div>
                      <div class="col-md-3 mb-3">
                          <label for="pinCode" class="form-label">PIN Code</label>
                          <input type="text" class="form-control" id="pinCode" required>
                      </div>
                      <div class="col-md-3 mb-3">
                          <label for="initiator" class="form-label">Initiator</label>
                          <select class="form-select" id="initiator" required>
                              <option value="REGULAR" selected>REGULAR</option>
                              <option value="PREMIUM">PREMIUM</option>
                          </select>
                      </div>
                      <div class="col-md-3 mb-3">
                          <label for="paInsurance" class="form-label">PA Insurance</label>
                          <input type="text" class="form-control" id="paInsurance">
                      </div>
                  </div>
                </div>

                <!-- Personal Information Section -->
                <div class="form-section" id="section2">
                    <h4 class="mb-4">Personal Information</h4>
                    <div class="row g-3">
                        <div class="col-md-2">
                            <label class="form-label">Title</label>
                            <select class="form-select">
                                <option value="MR">MR.</option>
                                <option value="MS">MS.</option>
                                <option value="MRS">MRS.</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                          <label for="firstName" class="form-label">First Name</label>
                          <input type="text" class="form-control" id="firstName" required>
                        </div>
                        <div class="col-md-3">
                            <label for="middleName" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middleName">
                        </div>
                        <div class="col-md-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastName" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                      <div class="col-md-3">
                          <label for="gender" class="form-label">Gender</label>
                          <select class="form-select" id="gender" required>
                              <option value="MALE">MALE</option>
                              <option value="FEMALE">FEMALE</option>
                          </select>
                      </div>
                      <div class="col-md-3">
                          <label for="birthdate" class="form-label">Birthdate</label>
                          <input type="date" class="form-control" id="birthdate" required>
                      </div>
                      <div class="col-md-3">
                          <label for="birthplace" class="form-label">Birthplace</label>
                          <input type="text" class="form-control" id="birthplace" required>
                      </div>
                      <div class="col-md-3">
                          <label for="citizenship" class="form-label">Citizenship</label>
                          <input type="text" class="form-control" id="citizenship" required>
                      </div>
                      </div>
                      <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="nationality" class="form-label">Nationality</label>
                            <input type="text" class="form-control" id="nationality" required>
                        </div>
                        <div class="col-md-3">
                            <label for="acrNo" class="form-label">ACR No.</label>
                            <input type="text" class="form-control" id="acrNo">
                        </div>
                        <div class="col-md-3">
                            <label for="civilStatus" class="form-label">Civil Status</label>
                            <select class="form-select" id="civilStatus" required>
                                <option value="SINGLE">SINGLE</option>
                                <option value="MARRIED">MARRIED</option>
                                <option value="DIVORCED">DIVORCED</option>
                                <option value="WIDOWED">WIDOWED</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="occupation" class="form-label">Occupation</label>
                            <input type="text" class="form-control" id="occupation" required>
                        </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-md-3">
                              <label for="mobileNumber" class="form-label">Mobile Number</label>
                              <input type="tel" class="form-control" id="mobileNumber" required>
                          </div>
                          <div class="col-md-3">
                              <label for="emailAddress" class="form-label">Email Address</label>
                              <input type="email" class="form-control" id="emailAddress" required>
                          </div>
                          <div class="col-md-3">
                              <label for="telephoneNumber" class="form-label">Telephone Number</label>
                              <input type="tel" class="form-control" id="telephoneNumber">
                          </div>
                          <div class="col-md-3">
                              <label for="alternateMobile" class="form-label">Alternate Mobile Number</label>
                              <input type="tel" class="form-control" id="alternateMobile">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <div class="col-md-6">
                              <label for="alternateEmail" class="form-label">Alternate Email Address</label>
                              <input type="email" class="form-control" id="alternateEmail">
                          </div>
                          <div class="col-md-6">
                              <label for="officePhone" class="form-label">Office Phone Number</label>
                              <input type="tel" class="form-control" id="officePhone">
                          </div>
                        </div>
                </div>

                <!-- Contact Information Section -->
                <div class="form-section" id="section3">
                  <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="searchOfficeTown" class="form-label">Search Town</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="searchOfficeTown" placeholder="Search town...">
                            <button class="btn btn-secondary" type="button">Search</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="companyName" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="companyName" required>
                    </div>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">
                      <label for="officeBuildingStreet" class="form-label">Building No. / Street</label>
                      <input type="text" class="form-control" id="officeBuildingStreet" required>
                  </div>
                  <div class="col-md-3">
                      <label for="officeBarangay" class="form-label">Barangay / Towns</label>
                      <input type="text" class="form-control" id="officeBarangay" required>
                  </div>
                  <div class="col-md-3">
                      <label for="officeCityMunicipality" class="form-label">City/Municipality</label>
                      <input type="text" class="form-control" id="officeCityMunicipality" required>
                  </div>
                </div>
                <div class="row mb-3">                          
                  <div class="col-md-3">
                      <label for="officeProvince" class="form-label">Province</label>
                      <input type="text" class="form-control" id="officeProvince" required>
                  </div>
                  <div class="col-md-3">
                      <label for="officeZipCode" class="form-label">Zip</label>
                      <input type="text" class="form-control" id="officeZipCode" required>
                  </div>
                  <div class="col-md-6">
                      <label for="mailingPreference" class="form-label">Mailing Preference</label>
                      <select class="form-select" id="mailingPreference" required>
                          <option value="HOME">HOME</option>
                          <option value="OFFICE">OFFICE</option>
                      </select>
                  </div>
                  <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="availMagazine" class="form-label">Avail Online AQ Magazine</label>
                        <select class="form-select" id="availMagazine" required>
                            <option value="YES">YES</option>
                            <option value="NO">NO</option>
                        </select>
                      </div>
                  </div>

                <!-- Vehicle Information Section -->
                <div class="form-section" id="section4">
                    <!-- Add vehicle form fields -->

                    <div id="vehicleContainer">
                    </div>

                </div>

                <!-- Summary Section -->
                <div class="form-section" id="section5">
                    <!-- Add summary content -->
                </div>

                <!-- Navigation Buttons -->
                <div class="navigation-buttons d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" id="prevBtn" style="display: none;">Previous</button>
                    <button type="button" class="btn btn-primary" id="nextBtn">Next</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentStep = 1;
            const totalSteps = 5;
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const breadcrumbItems = document.querySelectorAll('.breadcrumb-item');
            const formSections = document.querySelectorAll('.form-section');

            function updateButtons() {
                prevBtn.style.display = currentStep === 1 ? 'none' : 'block';
                nextBtn.textContent = currentStep === totalSteps ? 'Submit' : 'Next';
            }

            function updateBreadcrumbs() {
                breadcrumbItems.forEach((item, index) => {
                    const step = index + 1;
                    item.classList.remove('active', 'completed');
                    
                    if (step === currentStep) {
                        item.classList.add('active');
                    } else if (step < currentStep) {
                        item.classList.add('completed');
                    }
                });
            }

            function showSection(step) {
                formSections.forEach((section, index) => {
                    section.classList.remove('active');
                    if (index + 1 === step) {
                        section.classList.add('active');
                    }
                });
            }

            function navigate(direction) {
                if (direction === 'next' && currentStep < totalSteps) {
                    currentStep++;
                } else if (direction === 'prev' && currentStep > 1) {
                    currentStep--;
                }

                updateButtons();
                updateBreadcrumbs();
                showSection(currentStep);
            }

            // Event Listeners
            prevBtn.addEventListener('click', () => navigate('prev'));
            nextBtn.addEventListener('click', () => navigate('next'));

            breadcrumbItems.forEach((item, index) => {
                item.addEventListener('click', () => {
                    const step = index + 1;
                    if (step <= currentStep) {
                        currentStep = step;
                        updateButtons();
                        updateBreadcrumbs();
                        showSection(currentStep);
                    }
                });
            });

            // Initialize
            updateButtons();
            updateBreadcrumbs();
        });

        
    </script>
</body>
</html>