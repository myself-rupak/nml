<div class="relative">
	<div class="hidden-xs">
		<div class="banners owl-carousel">
			@foreach ($sliders as $slider)
			<div>
				<img src="{{ URL('/uploads/hero_slider/'.$slider->slider_image )}}" alt="">
				@if ($slider->template == '1')
					<div class="welcome text-center">
						<?php echo $slider->description; ?>
					</div>
				@elseif ($slider->template == '2')
					<div class="tata-prima">
						<?php echo $slider->description; ?>
					</div>
				@elseif ($slider->template == '3')
					<div class='tata-prima bg'>
						<?php echo $slider->description; ?>
					</div>
				@endif
			</div>
			@endforeach
		</div>
	</div>
	<div class="visible-xs">
		<div class="banners owl-carousel">
			@foreach ($sliders as $slider)
			<div>
				<img src="{{ URL('/uploads/hero_slider/mobile/'.$slider->mobile_slider_image )}}" alt="">
				@if ($slider->template == '1')
					<div class="mobile-welcome slide-1">
						<?php echo $slider->mobile_description; ?>
					</div>
				@elseif ($slider->template == '2')
					<div class="mobile-welcome slide-2">
						<?php echo $slider->mobile_description; ?>
					</div>
				@elseif ($slider->template == '3')
					<div class="mobile-welcome slide-3">
						<?php echo $slider->mobile_description; ?>
					</div>
				@endif
			</div>
			@endforeach
		</div>
	</div>
	<div class="hotline-container">
		<div class="hotline">
			<a class="external" href="tel:16307"><img src="assets/images/hotline.png" alt=""></a>
		</div>
	</div>
</div>