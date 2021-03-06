class Despesa{
	constructor(ano, mes, dia, tipo, descricao, valor){
		this.ano = ano
		this.mes = mes
		this.dia = dia
		this.tipo = tipo
		this.descricao = descricao
		this.valor = valor
	}
	validarDados(){
		for(let i in this){
			if (this[i] == '' || this[i] == undefined || this[i] == null  ){
				return false
			}
		}

		return true
	}
}

class Bd{

	constructor(){
		let id = localStorage.getItem('id')
		if (!id) {
			localStorage.setItem('id', 0)
		}
	}

	getProximoId(){
		let proximoId = localStorage.getItem('id')//null
		return parseInt(proximoId) + 1
	}

	gravar(d) {
		let id = this.getProximoId()	
		localStorage.setItem(id, JSON.stringify(d))
		localStorage.setItem('id', id)
	}
	recuperarTodosRegistros(){
		let despesas = Array()

		let id = localStorage.getItem('id')

		for (let i = 1; i <= id; i++){
			let despesa = JSON.parse(localStorage.getItem(i))

			if(despesa === null){
				continue
			}

			despesa.id = i

			despesas.push(despesa)
			
		}
		return despesas
	}

	pesquisar(despesa){

		let despesasFiltradas = Array() 

		despesasFiltradas = this.recuperarTodosRegistros()

		console.log(despesa)
		console.log(despesasFiltradas)

		//ano 
		if (despesa.ano != ''){
			despesasFiltradas = (despesasFiltradas.filter(d => (d.ano == despesa.ano )))
		}

		//mes
		if (despesa.mes != ''){
			despesasFiltradas = (despesasFiltradas.filter(d => (d.mes == despesa.mes )))
		}

		//dia
		if (despesa.dia != ''){
			despesasFiltradas = (despesasFiltradas.filter(d => (d.dia == despesa.dia )))
		}

		//tipo
		if (despesa.tipo != ''){
			despesasFiltradas = (despesasFiltradas.filter(d => (d.tipo == despesa.tipo )))
		}

		//descricao
		if (despesa.descricao != ''){
			despesasFiltradas = (despesasFiltradas.filter(d => (d.descricao == despesa.descricao )))
		}

		//valor
		if (despesa.valor != ''){
			despesasFiltradas = (despesasFiltradas.filter(d => (d.valor == despesa.valor )))
		}

		
		return despesasFiltradas

	}

	remover(id){
		localStorage.removeItem(id)
	}

}

let bd = new Bd()

function cadastrarDespesa() {
	let ano = document.getElementById('ano')
	let mes = document.getElementById('mes')
	let dia = document.getElementById('dia')
	let tipo = document.getElementById('tipo')
	let descricao = document.getElementById('descricao')
	let valor = document.getElementById('valor')

	let despesa = new Despesa(ano.value, mes.value, dia.value, tipo.value, descricao.value, valor.value)
	

	let titulo = document.getElementById('titulo_modal')
	let mensagem = document.getElementById('corpo_Mensagem')
	let botao = document.getElementById('botao_Modal')


	if (despesa.validarDados()){
		bd.gravar(despesa)

		titulo.innerHTML = "Sucesso na inclus??o"
		titulo.className = "modal-title text-success"
		mensagem.innerHTML = "Grava????o Realizada com sucesso, dados gravados"
		botao.className = "btn btn-success"
		botao.innerHTML = "Voltar"


		$('#modalRegistraDespesas').modal('show')

		//limpando area

		ano.value = ""
		mes.value = ""
		dia.value = ""
		tipo.value = ""
		descricao.value = ""
		valor.value = ""

	}
	else{
		// //alert('Dados Invalidos!')
		
		titulo.innerHTML = "Erro na inclus??o do registro"
		titulo.className = "modal-title text-danger"
		mensagem.innerHTML = "Campos obrigatorios n??o foram preenchidos."
		botao.className = "btn btn-danger"
		botao.innerHTML = "Voltar e corrigir"
		
		$('#modalRegistraDespesas').modal('show')
	}
}


function carregaListaDespesas(despesas = Array(), filtro = false) {

	if (despesas.length == 0 && !filtro){
		despesas = bd.recuperarTodosRegistros()
	}


   	var listaDespesas = document.getElementById('listaDespesas')

	listaDespesas.innerHTML = ''

	/*<tr>
        <td>15/03/2020</td>
        <td>Alimenta??a??</td>
        <td>Compras do mes</td>
        <td>444.77</td>
      </tr>*/

	despesas.forEach(function(d) {

    	// criar linha (tr)
    	let linha = listaDespesas.insertRow()

    	// criar colunas (td)
    	linha.insertCell(0).innerHTML =`${d.dia}/${d.mes}/${d.ano}`  

    	switch(d.tipo){
    		case '1': d.tipo = 'Alimenta????o'
    				break
    		case '2': d.tipo = 'Educa????o'
    				break
    		case '3': d.tipo = 'Lazer'
    				break
    		case '4': d.tipo = 'Sa??de'
    				break				
    		case '5': d.tipo = 'Transporte'
    				break		
    	}
    	linha.insertCell(1).innerHTML = d.tipo
    	linha.insertCell(2).innerHTML = d.descricao
    	linha.insertCell(3).innerHTML = d.valor
    	
    	// botao de exclusao
    	let btn = document.createElement("button");
    	btn.className = 'btn btn-danger'
    	btn.innerHTML = '<i class="fas fa-times"></i>'
    	btn.id = `id_despesa_${d.id}`
    	btn.onclick = function() {

    		let id = this.id.replace('id_despesa_', '')

    		bd.remover(id)
    		window.location.reload()
    	}
    	linha.insertCell(4).append(btn)

 
    })

    
	
}

function pesquisarDespesa() {
	let ano = document.getElementById('ano').value
	let mes = document.getElementById('mes').value
	let dia = document.getElementById('dia').value
	let tipo = document.getElementById('tipo').value
	let descricao = document.getElementById('descricao').value
	let valor = document.getElementById('valor').value


	let despesa = new Despesa(ano, mes, dia, tipo, descricao, valor)

	let despesas = bd.pesquisar(despesa)

	carregaListaDespesas(despesas, true)
}