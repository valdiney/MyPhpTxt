<?php

header('Content-Type: text/html; charset=utf-8');
include "MyPhpTxt.php";

if($_SERVER['REQUEST_METHOD'] == "POST") {
	try {
		$path = $_POST['path'];
		$fileName = $_POST['fileName'];
		$userContent = $_POST['content'];

		$txt = new MyPhpTxt($path);
		$txt->setFile($fileName);

		if($_POST['toDO'] == "create") {
			$txt->createFile();
			$txt->setContent($userContent);
		} else {
			if($_POST['append'] == 'y') {
				$txt->appendCotent($userContent);
			} else {
				$txt->setContent($userContent);
			}
		}

		$fileContent = $txt->getContent();
	} catch(Exception $e) {
		$error = $e->getMessage();
	}
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Teste de gravação e leitura em arquivos de texto!!!</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

</head>
<body>

	<nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">MyPhpTxt Project</a>
        </div>
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

    <div class="container">
    	
		<div class="row">
			
			<div class="col-md-12">
				
				<form action="" method="post">

					<h1>Take a tour</h1>

					<hr>

					<?php if(isset($error)): ?>
					<div class="alert alert-danger">
						<?php echo $error; ?>
					</div>
					<?php endif; ?>

					<?php if($_SERVER['REQUEST_METHOD'] == "POST" && !isset($error)): ?>
					<div class="well well-lg">
						<strong>File content:</strong><br><br>
						<?php echo @ $fileContent; ?>
					</div>
					<hr>
					<?php endif; ?>

					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="toDO">What do you want to do?</label>
								<select name="toDO" class="form-control" id="toDO">
									<option value="create">Create a file</option>
									<option value="modify">Modify an existing file</option>
								</select>
							</div>
						</div>

						<div class="form-group col-md-3">
							<label for="path">Path</label>
							<input type="text" class="form-control" name="path" id="path" value="files">
						</div>
						
						<div class="form-group col-md-3">
							<label for="fileName">File name</label>
							<input type="text" class="form-control" name="fileName" id="fileName" placeholder="Name without file extension">
						</div>

						<div id="appendField" class="col-md-3">
							<div class="form-group">
								<label for="append">Append?</label>
								<select type="append" class="form-control" name="append" id="append">
									<option value="">No</option>
									<option value="y">Yes</option>
								</select>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12">
							<textarea class="form-control" name="content" id="content" rows="6"></textarea>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="form-group col-md-12">
							<button type="submit" class="btn btn-success">Process</button>
						</div>
					</div>

				</form>

			</div>

		</div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

    <script type="text/javascript">

    	$("#appendField").hide();
    	
    	$("#toDO").change(function(){
    		if($(this).val() == "modify") {
    			$("#appendField").show();
    		} else {
    			$("#appendField").hide();
    		}
    	});

    </script>
	
</body>
</html>