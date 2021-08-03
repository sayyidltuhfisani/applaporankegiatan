<form id="form_proses" action="<?= base_url('formproses') ?>" method="post" enctype="multipart/form-data">
	<input type="hidden" name="ket" value="<?= $ket;  ?>">
	<input type="hidden" name="id" value="<?= $id;  ?>">
		
	<div class="form-group">
		<label for="exampleFormControlFile1">Upload Gambar</label>
		<input type="file" name="files[]" class="form-control-file" multiple  accept="image/*">
	</div>

	
	<div class="form-group row">
		<div class="col-sm-10">
			<button type="submit" class="btn btn-primary">Simpan</button>
		</div>
	</div>
</form>


<script type="text/javascript">
	$(document).ready(function(){
		
		
		$("#form_proses").submit(function(event){
			event.preventDefault();
			$("#wait").css("display", "block");
			var formData = new FormData(this);

			$.ajax({
				"type"   : "post",
				"url"    : $("#form_proses").attr("action"),
				"data"   : formData,
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
							// $('#mymodal').modal('hide');
							// $('#mymodal').hide();
						
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
		});
	});
	
</script>