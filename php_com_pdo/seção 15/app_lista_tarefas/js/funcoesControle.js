
			
			function editar(id, descricao, destino) {

				

				let form = document.createElement('form');
				form.action = destino + '?'+ 'pag='+ destino + '&acao=atualizar';
				form.method = 'post';
				form.className = 'row'

				let inputTarefa = document.createElement('input');
				inputTarefa.type = 'text';
				inputTarefa.name = 'tarefa';
				inputTarefa.className = 'form-control col-9';
				inputTarefa.value = descricao;

				let inputID = document.createElement('input');
				inputID.type = 'hidden';
				inputID.name = 'id';
				inputID.value = id;

				let button = document.createElement('button');
				button.type = 'submit';
				button.className = 'btn btn-info col-3';
				button.innerHTML = 'Atualizar';

				form.appendChild(inputTarefa);

				form.appendChild(inputID);
				
				form.appendChild(button);	


				// console.log(form);
				let tarefa = document.getElementById('tarefa_'+id);

				tarefa.innerHTML = '';

				tarefa.insertBefore(form, tarefa[0]);

			}

			function remover(id, destino) {
				location.href = destino + '?'+ 'pag='+ destino + '&acao=remover&id='+id;
			}

			function marcarRealizada(id, destino) {
				location.href = destino + '?'+ 'pag='+ destino + '&acao=marcarRealizada&id='+id;
			}
