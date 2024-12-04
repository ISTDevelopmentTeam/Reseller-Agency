<!doctype html>
<html lang="en">
<head>
    <title>AAP Reseller</title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
	
		body {
			font-family: 'Roboto', sans-serif;
			background-color: #f8f9fa; 
			background-image: url('images/asp8.jpg'); 
			background-size: cover; 
			background-position: center; 
		}

        .login-container {
            max-width: 900px;
            margin: 0 auto;
        }
        .login-image {
            background-image: url('images/bg-ads.jpg');
            background-size: cover;
            background-position: center;
            min-height: 600px;
        }

		a {
			color: rgb(128, 126, 126);
			text-decoration: none;
		}

		a:hover {
			color: rgb(90, 90, 99); 
		}

		.clicked {
			color: red !important;
		}

    </style>
</head>
<body>

    <section class="py-5">
        <div class="container login-container">
            <div class="row justify-content-center mt-5">
                <div class="col-md-6 text-center">
                </div>
            </div>
            <div class="row g-5 shadow-lg">
                <div class="col-md-6 login-image"></div>
                <div class="col-md-6 bg-white p-5">	
                    <div class="mb-4 d-flex flex-column justify-content-center align-items-center fw-bold">
                        <img src="images/aap_logo.png" alt="Logo" class="mb-2" style="max-width: 150px;">
                        <h3>Sign In</h3>
                    </div>					
                    <form id="login" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                        </div>
                        <div class="mb-3 position-relative">
							<label for="password" class="form-label">Password</label>
							<div class="input-group">
							  <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
							  <span class="input-group-text">
								<i class="bi bi-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
							  </span>
							</div>
						</div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember Me</label>
                        </div>
                         <button type="submit" class="btn btn-primary w-100">Login</button>

                    </form>
                    <div class="mt-3 text-center">
						<a href="#" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal">Forgot Password?</a>
					  </div>
					  <div class="mt-3 text-center">
						<p>Not a member? <a href="#" data-bs-toggle="modal" data-bs-target="#signUpModal">Sign Up Now</a></p>
					  </div>
					
                </div>
            </div>
        </div>
    </section>

    <!-- Forgot Password Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Forgot Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="forgotPasswordForm">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Sign Up Modal -->
    <div class="modal fade" id="signUpModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sign Up</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="signUpForm">
                        <div class="mb-3">
                            <label for="newUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="newUsername" required>
                        </div>
                        <div class="mb-3">
                            <label for="newEmail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="newEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="newPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


	<script>
		const togglePassword = document.querySelector('#togglePassword');
		const password = document.querySelector('#password');

		togglePassword.addEventListener('click', function (e) {
		
		const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
		password.setAttribute('type', type);
		
		this.classList.toggle('bi-eye');
		this.classList.toggle('bi-eye-slash');
		
		this.classList.toggle('clicked');
		});

	</script>

<script>
    document.getElementById('login').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        const form = new FormData(this);

        fetch('{{ route('login') }}', {
            method: 'POST',
            body: form
        })

        .then(response => response.json())

        .then(data => {
            if (data.status === 'error') {
                // Trigger SweetAlert on error
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message, // Show the error message
                });
            }else {
                // Redirect if login is successful
                window.location.href = data.redirect || '{{ route('dashboard') }}';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });

    });
</script>



</body>
</html>