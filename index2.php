<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
    <body>

    <nav class="navbar navbar-dark bg-primary">
	  <a class="navbar-brand" href="index.php" style="color: #fff;">
	    starbhak soft
	  </a>
	</nav>

	<div class="container">
		<h2 align="center" style="margin: 30px;">CRUD Ajax No Loading</h2>

        <form method="post" class="form-data" id="form-data">  
        	<div class="row">

        		<div class="col-sm-3">
        			<div class="form-group">
                        <label>Nama siswa</label>
                        <input type="hidden" name="id" id="id">
                        <input type="text" name="nama_siswa" id="nama_siswa" class="form-control" required="true">
                        <p class="text-danger" id="err_nama_siswa"></p>
					</div>
                </div>
                
	            <div class="col-sm-3">
	            	<div class="form-group">
						<label>Jurusan</label>
						<select name="jurusan" id="jurusan" class="form-control" required="true">
							<option value=""></option>
                            <option value="Rakayasa Perangkat Lunak">Rakayasa Perangkat Lunak</option>
                            <option value="Teknik Komputer dan jaringan">Teknik Komputer dan jaringan</option>
                            <option value="Multimedia">Multimedia</option>
                            <option value="Brodcasting">Brodcasting</option>
							<option value="Teknik Elektronika dan industri">Teknik Elektronika dan industri</option>
                        </select>
                        <p class="text-danger" id="err_jurusan"></p>
					</div>
                </div>
                
	            <div class="col-sm-3">
	            	<div class="form-group">
						<label>Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" required="true">
                        <p class="text-danger" id="err_tanggal_masuk"></p>
					</div>
                </div>
                
	            <div class="col-sm-3">
	            	<div class="form-group">
						<label>Jenis Kelamin</label><br>
						<input type="radio" name="jenkel" id="jenkel1" value="Laki-laki" required="true"> Laki-laki
						<input type="radio" name="jenkel" id="jenkel2" value="Perempuan"> Perempuan
                    </div>
                    <p class="text-danger" id="err_jenkel"></p>
                </div>
                
			</div>
			
			<div class="form-group">
				<label>Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" required="true"></textarea>
                <p class="text-danger" id="err_alamat"></p>
			</div>
			
			<div class="form-group">
				<button type="button" name="simpan" id="simpan" class="btn btn-primary">
					<i class="fa fa-save"></i> Simpan
				</button>
            </div>

        </form>
        <hr>

		<div class="data"></div>
		
    </div>

    <div class="text-center">© <?php echo date('Y'); ?> Copyright:
	                                                                                                                                                                                                                                            
	</div>

    

        <div id="viewModal" class="modal fade mr-tp-100" role="dialog">
		    <div class="modal-dialog modal-lg flipInX animated">
		        <div class="modal-content">
		            <div class="modal-header">
		                <h4 class="modal-title" id="myModalLabel" >View Data</h4>
		                <button type="button" class="close" data-dismiss="modal" >
		                    <span aria-hidden="true">&times;</span>
		                    <span class="sr-only">Close</span>
		                </button>
		            </div>
		            <div class="modal-body">
		            	<div class="form-group">
		            		<label>ID</label>
		            		<input type="text" id="id" class="form-control" readonly="">
		            	</div>
		            	<div class="form-group">
		            		<label>Nama Siswa</label>
		            		<input type="text" id="nama_siswa" class="form-control" readonly="">
		            	</div>
		            	<div class="form-group">
		            		<label>Alamat</label>
		            		<input type="text" id="alamat" class="form-control" readonly="">
		            	</div>
		            	<div class="form-group">
		            		<label>Jurusan</label>
		            		<input type="text" id="jurusan" class="form-control" readonly="">
		            	</div>
		            	<div class="form-group">
		            		<label>Jenis Kelamin</label>
		            		<input type="text" id="jenis_kelamin" class="form-control" readonly="">
		            	</div>
		            	<div class="form-group">
		            		<label>Tanggal Masuk</label>
		            		<input type="text" id="tgl_masuk" class="form-control" readonly="">
		            	</div>
		            </div>
		            <div class="modal-footer">
		            	<button class="btn btn-default" data-dismiss="modal">
		            		Close
		            	</button>
		            </div>
		        </div>
		    </div>
		</div>
        
    </div>

   

    <script type="text/javascript">
        $(document).ready(function() {
        let table = $('#data').DataTable();
 
        $('#data tbody').on( 'click', '#detail', function () {
	        var current_row = $(this).parents('tr');
	        if (current_row.hasClass('child')) {
	            current_row = current_row.prev();
	        }
	        var data = table.row( current_row ).data();
	        console.log(data)
 
	        document.getElementById("id").value = data[0];
	        document.getElementById("nama_siswa").value = data[1];
	        document.getElementById("alamat").value = data[2];
	        document.getElementById("jurusan").value = data[3];
	        document.getElementById("jenis_kelamin").value = data[4];
	        document.getElementById("tgl_masuk").value = data[5];
 
	        $("#viewModal").modal("show");
	    });
 
    });
$(document).ready(function () {
    

    $('.data').load("data.php");
	    $("#simpan").click(function(){
	        var data = $('.form-data').serialize();
	        var jenkel1 = document.getElementById("jenkel1").value;
	        var jenkel2 = document.getElementById("jenkel2").value;
            var nama_siswa = document.getElementById("nama_siswa").value;
            var tanggal_masuk = document.getElementById("tanggal_masuk").value;
            var alamat = document.getElementById("alamat").value;
            var jurusan = document.getElementById("jurusan").value;

            if (nama_siswa=="") {
            	document.getElementById("err_nama_siswa").innerHTML = "Nama siswa Harus Diisi";
            } else {
            	document.getElementById("err_nama_siswa").innerHTML = "";
            }
            if (alamat=="") {
            	document.getElementById("err_alamat").innerHTML = "Alamat siswa Harus Diisi";
            } else {
            	document.getElementById("err_alamat").innerHTML = "";
            }
            if (jurusan=="") {
            	document.getElementById("err_jurusan").innerHTML = "Jurusan siswa Harus Diisi";
            } else {
            	document.getElementById("err_jurusan").innerHTML = "";
            }
            if (tanggal_masuk=="") {
            	document.getElementById("err_tanggal_masuk").innerHTML = "Tanggal Masuk siswa Harus Diisi";
            } else {
            	document.getElementById("err_tanggal_masuk").innerHTML = "";
            }
            if (document.getElementById("jenkel1").checked==false && document.getElementById("jenkel2").checked==false) {
            	document.getElementById("err_jenkel").innerHTML = "Jenis Kelamin Harus Dipilih";
            } else {
            	document.getElementById("err_jenkel").innerHTML = "";
            }

            if (nama_siswa!="" && tanggal_masuk!=""  && alamat!=""  && jurusan!=""  && (document.getElementById("jenkel1").checked==true || document.getElementById("jenkel2").checked==true)) {
            	$.ajax({
		            type: 'POST',
		            url: "form_action.php",
		            data: data,
		            success: function() {
		                $('.data').load("data.php");
		                document.getElementById("id").value = "";
		                document.getElementById("form-data").reset();
		            }, error: function(response){
		            	console.log(response.responseText);
		            }
		        });
            }
	        
        });
    });
    </script>
    </body>
</html>
