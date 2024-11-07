<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing Table</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">

            @foreach($details as $detail)
            <div class="col-md-4">
                <div class="card pricing-card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="card-title text-center">{{ $detail->subscription_title }}</h5>
                        <p class="card-subtitle text-center">PER MONTH</p>
                    </div>
                    <div class="card-body text-center">
                        <h1 class="card-price">₱ {{ $detail->price }}</h1>
                        <ul class="list-group list-group-flush">

                            <li class="list-group-item"><i class="fas fa-check-circle"></i> {{ $detail->line_1_detail }}</li>
                            <li class="list-group-item"><i class="fas fa-check-circle"></i> {{ $detail->line_2_detail }}</li>
                            <li class="list-group-item"><i class="fas fa-check-circle"></i> {{ $detail->line_3_detail }}</li>
                            <li class="list-group-item"><i class="fas fa-check-circle"></i> {{ $detail->line_4_detail }}</li>
                            <li class="list-group-item"><i class="fas fa-check-circle"></i> {{ $detail->line_5_detail }}</li>


                        </ul>
                        <a href="#" class="btn btn-primary">ORDER NOW <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach

                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>