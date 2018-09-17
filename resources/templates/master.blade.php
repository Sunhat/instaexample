<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Example Page</title>

	<link rel="stylesheet" href="<?=mix('dist/app.css')?>">
	<script async src="<?=mix('dist/app.js')?>"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item {{ $controller->isRoute('user.create', 'user.store') }}">
					<a class="nav-link" href="/">nav 1 <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item {{ $controller->isRoute('example1') }}">
					<a class="nav-link" href="/e1">nav 2</a>
				</li>
				<li class="nav-item {{ $controller->isRoute('example2') }}">
					<a class="nav-link" href="/e2">nav 3</a>
				</li>
				<li class="nav-item {{ $controller->isRoute('example3') }}">
					<a class="nav-link" href="/e3">nav 4</a>
				</li>
			</ul>
			<ul class="navbar-nav">
				<li class="nav-item {{ $controller->isRoute('example4') }}">
					<a class="nav-link" href="/e4">nav 5</a>
				</li>
			</ul>
		</div>
	</nav>


	<main class="container">
		@foreach($errors as $key => $error)
			<div class="alert alert-danger">
			{{ $error }}
			</div>
		@endforeach
		@yield('content')
	</main>
</body>
</html>