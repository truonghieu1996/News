@extends('layouts.app') 
@section('content')
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">Trang chủ</div>
				<div class="card-body">
					@php 
						function getFirstImage($strContent) {
							$first_img = "";
							ob_start();
							ob_end_clean();
							$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $strContent, $matches);
							
							if (!empty($output))
								$first_img = $matches[1][0];
							else
								$first_img = "images/noimage.png";
							return $first_img;
						}
					@endphp 
						@foreach($news as $value)
						<div class="col-12">
							<div class="single-news">
								<div class="row">
									<div class="col-md-2">
										<div class="view overlay hm-white-slight z-depth-1-half">
									<?php 
										echo "<img class='d-flex mr-3 rounded img-thumbnail' src='". getFirstImage($value->content) ."' width='90' alt='' />";
									?>
											<a>
												<div class="mask"></div>
											</a>
										</div>
									</div>
									<div class="col-md-10">
										<p>
											<strong>
												<a href="{{ url('/news/detail/' . $value->id .'/'.$value->amount_view.'/'.$value->user_id) }}">{{ $value->title }}</a>
												<br/>
												<span class='small text-muted'>Đăng bởi {{ $value->name }}, đăng vào lúc {{ $value->created_at }}, có {{ $value->amount_view }} lượt xem.</span>
											</strong>
										</p>
										<a>{{ $value->summary }}
											<i class="fa fa-angle-right"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
						@endforeach
				</div>
			</div>
		</div>
	</div>
@endsection