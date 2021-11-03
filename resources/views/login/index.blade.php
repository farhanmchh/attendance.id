<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" />

	<title>{{ $title }}</title>

	<link href="/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100" style="background-color: {{ $bg ?? '' }}">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

            
            <div class="card text-white" style="background-color: {{ $bg_card ?? '' }}">
              <div class="text-center mt-5">
                <h1 class="h2">{{ $regards }}</h1>
								@if (session('success'))
                <p class="lead">{{ session('success') }}</p>
								@else
                <p class="lead text-danger">{{ session('error') }}</p>
								@endif
              </div>

							<div class="card-body">
								<div class="m-sm-4">
									<form action="/" method="POST">
                    @csrf
										<div class="mb-3 text-center">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg text-center" type="text" name="email" placeholder="Enter your email" autocomplete="off" autofocus>
										</div>
										<div class="mb-3 text-center">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg text-center" type="password" name="password" placeholder="Enter your password" autocomplete="off">
										</div>
                    {{-- <small>
                      <a href="index.html">Forgot password?</a>
                    </small> --}}
										<div class="form-check">
											<input class="form-check-input" type="checkbox" name="remember">
											<label class="form-check-label">
												Remember me
											</label>
										</div>
										<div class="d-grid text-center mt-3">
											<button type="submit" class="btn btn-lg btn-primary">
												<i class="fas fa-sign-in"></i> Log in
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="/js/app.js"></script>

</body>

</html>