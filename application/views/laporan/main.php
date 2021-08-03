
<!-- Content -->
<div class="content">
	<!-- Animated -->
	<div class="animated fadeIn">
		
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<h4 class="box-title">Laporan </h4>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="card-body">
								<div class="col-lg-12 mb-4">
									<button data-toggle="modal" data-target="#mymodal" onclick="prosesdata('input','0')" type="button" class="btn btn-success ">Buat Laporan</button>
									
								</div>

								<table id="exampledatatable" class="table  table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Tanggal</th>
											<th>Laporan</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										$i=0;
										$k=1;
										foreach ($menu as $key => $value) {
											$k+=1;
											?>
											<tr id="cek<?php echo $value['id_laporan']; ?>" class="" ondblclick="lihatdata('<?php echo $value['id_laporan']; ?>','<?php echo $k; ?>')" title="double klik melihat gambar" style="cursor:pointer">
												<td ><?php echo $i+=1; ?></td>
												<td><?php echo $value['tgl']; ?></td>
												<td><?php echo $value['isilaporan']; ?></td>
												<td>
													<?php echo $value['id_laporan']; ?>
													<button data-toggle="modal" data-target="#mymodal" onclick="prosesdata('edit','<?php echo $value['id_laporan']; ?>')" type="button" class="btn btn-warning ">Ubah</button>
													<button onclick="prosesdata('hapus','<?php echo $value['id_laporan']; ?>')" type="button" class="btn btn-danger ">Hapus</button>
												</td>
											</tr>
											<?php 
										}

										?>
										
										
									</tbody>
								</table>

							</div>
						</div>

					</div> <!-- /.row -->
					<div class="card-body"></div>
				</div>
			</div><!-- /# column -->
		</div>

		<script type="text/javascript">

			$(document).ready(function () {

				$('#exampledatatable').DataTable({
					// "ordering": false,
					// "searching": false
				});


			});
			


			function lihatdata(id,baris) {


				$('#tambahtr').remove();




				$('#cek'+id).attr('class','tambah_tr');

				$('.tambah_tr').after('<tr id="tambahtr"></tr>');
				

				

				// var cek =$("#exampledatatable tr").length+1;

				// alert(cek);

				// var empTab = document.getElementById('exampledatatable');
				
				// var row = empTab.insertRow(cek);
				// row.setAttribute("id","tambahtr");
				// row.setAttribute("class","classtambahtr");

				var x = document.createElement("TD");
				x.colSpan=4;
				var div = document.createElement("div");
				div.setAttribute("class","col-lg-12");
				div.setAttribute("id","listgambar");
				// var t = document.createTextNode("new cell");
				// div.appendChild(t);
				x.appendChild(div);
				document.getElementById("tambahtr").appendChild(x);


				$.ajax({
					url: '<?= base_url('listgambar')  ?>',
					type: 'post',
					data: {id:id},
					success: function(response){ 

						$('#listgambar').html(response); 
						$('#cek'+id).attr('class','hasil');
						

					},
					error:function(respone){
		                // Add response in Modal body
		                $('#listgambar').html('Server Respone Error'); 

		            }
		        });

				

				
			}



			function prosesdata(ket,id) {
				let pesan;
				let tgl='<?php echo date('Y-m-d') ?>';
				if (ket === 'edit') {
					pesan='Mengubah Laporan';
					$.ajax({
						url: '<?= base_url('tambahdanedit')  ?>',
						type: 'post',
						data: {ket: ket,id:id,tgl:tgl},
						success: function(response){ 
                			// Add response in Modal body
                			$('.modal-body').html(response); 
                			$('#largeModalLabel').html(pesan);
               		 		// Display Modal
               		 		$('#mymodal').modal('show'); 
               		 	},
               		 	error:function(respone){
                			// Add response in Modal body
                			$('.modal-body').html('Server Respone Error'); 

	                		// Display Modal
	                		$('#mymodal').Modal('show');  
	                	}

	                });
				}
				else if(ket === 'gambar'){
					pesan='menambah file';
					$.ajax({
						url: '<?= base_url('tambahgambar')  ?>',
						type: 'post',
						data: {ket: ket,id:id},
						success: function(response){ 
                			// Add response in Modal body
                			$('.modal-body').html(response); 
                			$('#largeModalLabel').html(pesan);
               		 		// Display Modal
               		 		$('#mymodal').modal('show'); 
               		 	},
               		 	error:function(respone){
                			// Add response in Modal body
                			$('.modal-body').html('Server Respone Error'); 

	                		// Display Modal
	                		$('#mymodal').Modal('show');  
	                	}

	                });
				}
				else if(ket === 'hapus' || ket ==='hapusgambar') {
					const swalWithBootstrapButtons = Swal.mixin({
						customClass: {
							confirmButton: 'btn btn-success',
							cancelButton: 'btn btn-danger'
						},
						buttonsStyling: true
					})


					swalWithBootstrapButtons.fire({
						title: 'Anda Yakin',
						text: "Menghapus data ini?",
						type: 'warning',
						customClass: 'swal-wide',
						heightAuto: true,
						showCancelButton: true,
						confirmButtonText: 'Yes',
						cancelButtonText: 'No',
						reverseButtons: true
					}).then((result) => {
						if (result.value) {
							$.ajax({
								"type"   : "post",
								"url"    : '<?= base_url('hapusdata')  ?>',
								"data"   : {ket: ket,id:id},
								"cache": false,
								"contentType": false,
								"processData": false,
								"dataType" : "json",

								success:function(data){
									if (data.status === 'berhasil') {
										Swal.fire({

											position: 'center',
											type: 'success',
											title: data.keterangan,
											showConfirmButton: false,
											customClass: 'swal-wide',
											timer: 2000,

										}).then((result) => {
											location.reload();
										});
									}
									else{
										Swal.fire({

											position: 'center',
											type: 'error',
											title: data.keterangan,
											showConfirmButton: false,
											customClass: 'swal-wide',
											timer: 2000,

										})
									}


								},error:function(data){
									console.log(data);
									$("#wait").css("display", "none");
									$("#hasil_pencarian_oss").html(data);
								}
							});
						} 
						else if (result.dismiss === Swal.DismissReason.cancel
							) {
							Swal.fire({

								type: 'error',
								title: 'Anda Membatalkan Konfirmasi',
								showConfirmButton: false,
								customClass: 'swal-wide',
								timer: 1500
							})
					}
				})
				}
				else if(ket === 'input'){
					pesan='Membuat Laporan';

					$.ajax({
						url: '<?= base_url('tambahdanedit')  ?>',
						type: 'post',
						data: {ket: ket,id:id,tgl:tgl},
						success: function(response){ 
                			// Add response in Modal body
                			$('.modal-body').html(response); 
                			$('#largeModalLabel').html(pesan);
               		 		// Display Modal
               		 		$('#mymodal').modal('show'); 
               		 	},
               		 	error:function(respone){
                			// Add response in Modal body
                			$('.modal-body').html('Server Respone Error'); 

	                		// Display Modal
	                		$('#mymodal').Modal('show');  
	                	}

	                });
				}



			}





		</script>	