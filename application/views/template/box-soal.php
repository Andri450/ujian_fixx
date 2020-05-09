<input type="hidden" class="no_sekarang" value="0">
<p style="display: none;" class="total" value="<?= $total_soal ?>"><?= $total_soal ?></p>
	<!-- number scroll muncul hanya saat di device handphone -->
	<div class="container-fluid hidden-lg hidden-md hidden-sm num-scroll-xs">
		<div class="scrollmenu" id="style-1">
			<?php for ($i=1; $i < 9 ; $i++) { ?>
				<button class="btn-arrow cs-btn-num-soal"><?php echo $i; ?></button>
			<?php } ?>
			<button class="btn-arrow cs-btn-num-soal right-btn-num-soal">
				<?php echo $i; ?>
			</button>
		</div>
	</div>
	<!-- number scroll muncul hanya saat di device handphone -->

	<div class="container-fluid box-soal">
		
		<div class="col-md-8 col-sm-8">
			<!-- top-sec-soal -->
			<div class="top-section-soal">
				<p class="sub-sec-soal">
					<span class="word-soal">Soal Ke</span>&nbsp;
					<span class="nomor-soal"></span>
					<span class="coutdown">
						<span id="day"></span>
						<span id="hour"></span>&nbsp;<span>:</span>
						<span id="minute"></span>&nbsp;<span>:</span>
						<span id="second"></span> 
						<span id="demo"></span> 
					</span>
				</p>	
			</div>
			<!-- top-sec-soal  -->

			<!-- middle-sec-soal -->
			<div class="panel panel-body isi-soal">

				<!-- isi soal -->
				<div class="sub-isi-soal" id="hasil">
					
				</div>
				<!-- isi-soal -->

				<!-- daftar-jawaban-soal -->
				<div class="sub-jawaban">
					
						<a href="#pilih-jawaban" class="pilihan-jawaban">
							<div class="abjad-jawaban"><p>A</p></div>
							<div class="isi-jawaban a">
							</div>
						</a>

						<a href="#pilih-jawaban" class="pilihan-jawaban">
							<div class="abjad-jawaban"><p>B</p></div>
							<div class="isi-jawaban b">
							</div>
						</a>

						<a href="#pilih-jawaban" class="pilihan-jawaban">
							<div class="abjad-jawaban"><p>C</p></div>
							<div class="isi-jawaban c">
							</div>
						</a>
						
						<a href="#pilih-jawaban" class="pilihan-jawaban">
							<div class="abjad-jawaban"><p>D</p></div>
							<div class="isi-jawaban isi_d">
							<p></p></div>
						</a>

				</div>
				<!-- daftar-jawaban-soal -->
			</div>
			<!-- middle-sec-soal -->

			<!-- bottom-sec-soal -->
			<div class="bottom-section-soal no-mt">
				<button class="btn-arrow prevs">
					<i class="fas fa-chevron-left"></i>&nbsp;<span>Prev</span>
				</button>

				<button class="btn-arrow next">
					<span>Next</span>&nbsp;<i class="fas fa-chevron-right"></i>
				</button>

				<button class="btn-arrow btn-akhiri-ujian" class="button-pilihan" data-toggle="modal" data-target=".bs-example-modal-sm">
					<i class="far fa-stop-circle"></i>&nbsp;<span>Akhiri Ujian</span>
				</button>
			</div>
			<!-- bottom-sec-soal -->
		</div>
		
		<!-- navigasi-soal -->
		<div class="col-md-4 col-sm-4 hidden-xs">
			<div class="top-section-soal num-soal">
				<p class="sub-sec-soal title-nav-soal">Navigasi Soal</p>	
			</div>
			<div class="panel panel-body isi-soal cs-panel-num-soal">	
				<div class="sub-isi-soal">

					<?php foreach ($jumlah as $sl) : ?> 				
						<button class="btn-arrow cs-btn-num-soal no"><?= $sl->nomor_soal ?></button>

					<?php endforeach; ?>

					<!-- button hijau jika jawaban sudah terisi -->
					<!-- <button class="btn-arrow cs-btn-num-soal right-btn-num-soal">
						
					</button> -->
					<!-- button hijau jika jawaban sudah terisi -->

				</div>
			</div>
		</div>
		<!-- navigasi-soal -->
	</div>

	<!-- load soal awal -->
	<script>
		$(document).ready(function () {

			load_awal();

			function load_awal() {
				$.ajax({
					type: 'POST',
					url: '<?= base_url('index.php/Siswa/ujian') ?>',
					data: {
						ids: 1
					},
					success: function (respon) {
						$('.no_sekarang').val(1);
						$('.nomor-soal').text(1);
						var dt = JSON.parse(respon);
						$('#hasil').html(dt.soal);
						$('.a').html(dt.a);
						$('.b').html(dt.b);
						$('.c').html(dt.c);
						$('.isi_d').html(dt.d);
					}
				});
			}

		});
	</script>

	<!-- klik nomor soal -->
	<script type="text/javascript">
            $(document).ready(function () {
                $('.no').click(function () {
                    var nomor = $(this).text();
                    $('.no_sekarang').val(nomor);
					$('.nomor-soal').text(nomor);
                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url('index.php/Siswa/ujian') ?>',
                        data: { ids: nomor },
                        success: function (respon) {
                            var dt = JSON.parse(respon);
                                $('#hasil').html(dt.soal);
								$('.a').html(dt.a);
								$('.b').html(dt.b);
								$('.c').html(dt.c);
								$('.isi_d').html(dt.d);
                        }
                    });
                });
            });
        </script>

		<!-- klik tombol next -->
        <script type="text/javascript">
            $(document).ready(function () {
                $('.next').click(function () {

                    var total_soal = $('.total').text();
                    var nomor = parseInt($('.no_sekarang').val()) + parseInt(1);
                    
                    if(parseInt(nomor) > parseInt(total_soal)){
                        alert('Soal Sudah Habis');
                    }else{
                        $('.no_sekarang').val(nomor);
						$('.nomor-soal').text(nomor);

                        $.ajax({
                            type: 'POST',
                            url: '<?= base_url('index.php/Siswa/ujian') ?>',
                            data: { ids: nomor },
                            success: function (respon) {
                                var dt = JSON.parse(respon);
                                $('#hasil').html(dt.soal);
								$('.a').html(dt.a);
								$('.b').html(dt.b);
								$('.c').html(dt.c);
								$('.isi_d').html(dt.d);
                            }
                        });

                    }
                    
                });
            });
        </script>

		<!-- klik tombol prev(sebelumnya) -->
		<script type="text/javascript">
            $(document).ready(function () {
                $('.prevs').click(function () {

                    var total_soal = $('.total').text();
                    var nomor = parseInt($('.no_sekarang').val()) - parseInt(1);
                    
                    if(parseInt(nomor) < parseInt(1)){
                        alert('Soal Awal');
                    }else{
                        $('.no_sekarang').val(nomor);
						$('.nomor-soal').text(nomor);

                        $.ajax({
                            type: 'POST',
                            url: '<?= base_url('index.php/Siswa/ujian') ?>',
                            data: { ids: nomor },
                            success: function (respon) {
								var dt = JSON.parse(respon);
                                $('#hasil').html(dt.soal);
								$('.a').html(dt.a);
								$('.b').html(dt.b);
								$('.c').html(dt.c);
								$('.isi_d').html(dt.d);
                            }
                        });

                    }
                    
                });
            });
        </script>