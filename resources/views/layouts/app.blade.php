<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="author" content="Truong Minh Hieu" />
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>{{ config('app.name', 'iNews') }}</title>
	<link href="{{ URL::asset('images/agulogo.png') }}" type="image/x-icon" rel="shortcut icon" />
	<link href="{{ URL::asset('css/app.css') }}" type="text/css" rel="stylesheet" />
	<link href="{{ URL::asset('css/dataTables.bootstrap4.min.css') }}" type="text/css" rel="stylesheet" />
	<link href="{{ URL::asset('css/font-awesome.min.css') }}" type="text/css" rel="stylesheet" /> @yield('css')
	<link href="{{ URL::asset('css/custom.css') }}" type="text/css" rel="stylesheet" />
</head>

<body>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light" style="background:#00bfff;">
			<a class="navbar-brand" href="{{ url('/home') }}">
				<img src="{{ URL::asset('images/logo.png') }}" width="100" height="30" alt="" />
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
			    aria-expanded="false" aria-label="Điều hướng">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav ml-auto">
					@if (Auth::guest())
					<li class="nav-item">
						<a class="nav-link" href="{{ route('login') }}">
							<i class="fa fa-address-card" aria-hidden="true"></i> Đăng nhập</a>
					</li>
					@else
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#tongquan" id="navbarQuanLy" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Quản lý</a>
						<div class="dropdown-menu" aria-labelledby="navbarQuanLy">
							@if(Auth::user()->role == 1)
							<a class="dropdown-item" href="{{ url('/categories') }}">Quản lý chủ đề</a>
							<a class="dropdown-item" href="#">Quản lý bài viết</a>
							<a class="dropdown-item" href="#">Quản lý người dùng</a>
							@else @endif
							<a class="dropdown-item" href="#">Quản lý bài viết của tôi</a>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#tongquan" id="navbarTaiKhoan" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-user-circle" aria-hidden="true"></i> {{ Auth::user()->email }}</a>
						<div class="dropdown-menu" aria-labelledby="navbarTaiKhoan">
							<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
								<i class="fa fa-power-off" aria-hidden="true"></i> Đăng xuất</a>
							<form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none;">{{ csrf_field() }}</form>
							<a class="dropdown-item" href="{{ url('/admin/hoso/doimatkhau') }}">
								<i class="fa fa-key" aria-hidden="true"></i> Đổi mật khẩu</a>
						</div>
					</li>
					@endif
				</ul>
			</div>
		</nav>
		@yield('content')
		<hr />
		<footer class="footer">
			<p>&copy; {{ @date("Y") }} {{ config('app.name', 'Laravel') }}</p>
		</footer>
	</div>
	<script src="{{ URL::asset('js/popper.min.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('js/app.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
	<script src="{{ URL::asset('js/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			$("#DataList").DataTable({
				"aLengthMenu": [
					[10, 25, 50, 100, -1],
					[10, 25, 50, 100, "Tất cả"]
				],
				"iDisplayLength": 25,
				"oLanguage": {
					"sLengthMenu": "Hiện _MENU_ dòng",
					"oPaginate": {
						"sFirst": "<i class='fa fa-step-backward' aria-hidden='true'></i>",
						"sLast": "<i class='fa fa-step-forward' aria-hidden='true'></i>",
						"sNext": "<i class='fa fa-chevron-right' aria-hidden='true'></i>",
						"sPrevious": "<i class='fa fa-chevron-left' aria-hidden='true'></i>"
					},
					"sEmptyTable": "Không có dữ liệu",
					"sSearch": "Tìm kiếm:",
					"sZeroRecords": "Không có dữ liệu",
					"sInfo": "Hiện từ _START_ đến _END_ của _TOTAL_ dòng",
					"sInfoEmpty": "Không tìm thấy",
					"sInfoFiltered": " (tổng số _MAX_ dòng)"
				}
			});

			$("#DataList_wrapper").removeClass("container-fluid");
		});
	</script>
	@yield('javascript')
</body>

</html>