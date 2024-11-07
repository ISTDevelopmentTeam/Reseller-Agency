@include('includes.header')

  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }
    .form-container {
      max-width: 500px;
      margin: 50px auto;
      padding: 20px;
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .form-title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
      color: #343a40;
      text-align: center;
    }
    .form-control:focus {
      border-color: #495057;
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    .btn-primary {
      width: 100%;
      padding: 10px;
      border-radius: 8px;
    }
  </style>
</head>
<body>

  <div class="form-container">
    <form action="{{ route('insert-data') }}" method="POST">
        @csrf

        <div class="form-title">User Registration</div>
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" name="full_name" placeholder="Enter your name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" name="email_address" placeholder="Enter your email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" name="phone_number" placeholder="Enter your phone number" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>


  @include('includes.footer')

      @if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    </script>
@endif
