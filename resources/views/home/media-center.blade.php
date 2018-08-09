<div class="media-center">
	<div class="container relative">
		<div class="row">
			<div class="col-md-12">
				<h3><span>MEDIA</span> CENTER</h3>
			</div>
			<div class="col-md-7">
				<a data-fancybox="gallery" href="{{ URL('/uploads/media/'.$media_center->image_1 )}}">
					<img src="{{ URL('/uploads/media/'.$media_center->image_1 )}}" alt="">
				</a>
			</div>
			<div class="col-md-5">
				<h3>{{ $media_center->title }}</h3>
				<?php echo $media_center->content; ?>
			</div>
		</div>
		<div class="row absolute">
			<div class="col-lg-3 hidden-md hidden-sm hidden-xs"></div>
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
				<a 
					data-fancybox="gallery" 
					href="{{ URL('/uploads/media/'.$media_center->image_2 )}}">
					<img src="{{ URL('/uploads/media/'.$media_center->image_2 )}}" alt="">
				</a>
			</div>
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
				<a data-fancybox="gallery" href="{{ URL('/uploads/media/'.$media_center->image_3 )}}">
					<img src="{{ URL('/uploads/media/'.$media_center->image_3 )}}" alt="">
				</a>
			</div>
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-4">
				<a data-fancybox="gallery" href="{{ URL('/uploads/media/'.$media_center->image_4 )}}">
					<img src="{{ URL('/uploads/media/'.$media_center->image_4 )}}" alt="">
				</a>
			</div>
		</div>
	</div>
</div>