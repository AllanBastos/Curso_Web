<?php 

/**
 * 
 */
class conexao
{
	
	private $host = 'localhostsql210.epizy.com';
	private $dbname = 'epiz_28718418_app_tarefas';
	private $user = 'epiz_28718418';
	private $pass = 'A214MyAeDZaaV';

	public function conectar()
		{
			try {

				$conexao = new PDO(
					"mysql:host=$this->host;dbname=$this->dbname" ,
					"$this->user", 
					"$this->pass"
				);

				return $conexao;
				
			} catch (PDOException $e) {
				echo "<p>" . $e->getMessege() . '</p.>';
			}
		}	
	
}

?>