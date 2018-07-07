<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('<?php echo base_url('assets/front/images/contact-page.jpg') ?>');">
		
	</section>	


	<!-- Content page -->
	<section class="bg0 p-t-104 p-b-116">
		<div class="container">
			<div class="flex-w flex-tr">
				<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
					<img width="80%" src="<?php echo base_url('assets/front/images/contact-image.jpg') ?>" alt="">
				</div>

				<div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Alamat
							</span>

							<p class="stext-115 cl6 size-213 p-t-18">
								<?php echo $row['alamat'] ?>
							</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Whatsapp/Telepon
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								<?php echo $row['no_telp'] ?>
							</p>
						</div>
					</div>

					<div class="flex-w w-full">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-envelope"></span>
						</span>

						<div class="size-212 p-t-2 p-b-42">
							<span class="mtext-110 cl2">
								Alamat Email
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								<?php echo $row['email'] ?>
							</p>
						</div>
					</div>
					<div class="flex-w w-full">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="fa fa-facebook"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Alamat Facebook
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								<?php echo $row['facebook'] ?>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>