<?php 
	$acao = 'recuperar';
	require 'tarefa_controller.php';
	/*
		echo "<pre>";
		print_r($tarefa);
		echo "</pre>";
	*/
?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
		<script>
			function editar(id, edit) {
				let form = document.createElement('form')
				form.action = 'tarefa_controller.php?acao=editar1';
				form.method = 'post';
				form.className = 'row'

				let inputTarefa = document.createElement('input')
				inputTarefa.type = 'text';
				inputTarefa.name = 'tarefa';
				inputTarefa.className = 'col-9 form-control';
				inputTarefa.value = edit;

				let inputID = document.createElement('input');
				inputID.type = 'hidden';
				inputID.name = 'ID';
				inputID.value = id;


				let button = document.createElement('button')
				button.type = 'submit';
				button.className = 'col-3 btn btn-info';
				button.innerHTML = 'Atualizar';

				form.appendChild(inputTarefa)
				form.appendChild(inputID)
				form.appendChild(button)

				//console.log(form)
				let tarefa = document.getElementById(`tarefa_${id}`)

				//limpar texto da tarefa
				tarefa.innerHTML = '';
				console.log(edit)
				//incluir form
				tarefa.insertBefore(form, tarefa[0])
			}

			function delet(id) {
				location.href = 'tarefa_controller.php?acao=remover1&id=' + id;
			}

			function atualizar(id) {
				location.href = 'tarefa_controller.php?acao=atualizar1&id=' + id;
			}
		</script>
	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
			</div>
		</nav>

		<? if(isset($_GET['edicao']) && $_GET['edicao'] == 1) { ?>
				<div class="bg-success pt-2 text-white d-flex justify-content-center">
					<h5>Tarefa editada com sucesso!</h5>
				</div>
		<? } else if(isset($_GET['delecao']) && $_GET['delecao'] == 1) { ?>
			<div class="bg-danger pt-2 text-white d-flex justify-content-center">
					<h5>Tarefa foi deletada com sucesso!</h5>
				</div>
		<? } ?>

		<div class="container app">
			<div class="row">
				<div class="col-md-3 menu">
					<ul class="list-group">
						<li class="list-group-item active"><a href="#">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item"><a href="todas_tarefas.php">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-md-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Tarefas pendentes</h4>
								<hr />

								<? foreach($tarefa as $tarefas) { ?>
								<? if($tarefas->status == "pendente") { ?>
											<div class="row mb-3 d-flex align-items-center tarefa">
											<div class="col-sm-9" id="tarefa_<?= $tarefas->id ?>">
												<?= $tarefas->tarefa ?>
											</div>

											<div class="col-sm-3 mt-2 d-flex justify-content-between">
												<i class="fas fa-trash-alt fa-lg text-danger" onclick="delet(<?= $tarefas->id ?>)"></i>
												<i class="fas fa-edit fa-lg text-info" onclick="editar(<?= $tarefas->id ?>, '<?= $tarefas->tarefa ?>')"></i>
												<i class="fas fa-check-square fa-lg text-success" onclick="atualizar(<?= $tarefas->id ?>)"></i>
											</div>
										</div>
										<? } ?>
								<? } ?>
								
								
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>