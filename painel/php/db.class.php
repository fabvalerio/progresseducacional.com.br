<?php


date_default_timezone_set('America/Sao_Paulo');

$GLOBALS['url'] = $url;

define( '_dir_' , '/' );


###################################################################################################################
/*
  Desenvolvido por Fabio Valerio
*/
###################################################################################################################


  class db{
  	private $host   = 'localhost';
  	private $dbName = 'progre_registro';
  	private $user   = 'root';
  	private $pass   = '';
  	private $port   = '3307';
  	private $dbh;
  	private $error;
  	private $qError;
  	private $stmt;

  	public function __construct(){

    //dsn for mysql
    // $db = new PDO("mysql:dbname=sys_site;host=localhost;charset=utf8;","root","root2016");
  		$dsn = "mysql:host=".$this->host.";dbname=".$this->dbName."";
  		$options = array(
  			PDO::ATTR_PERSISTENT    => true,
  			PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
  		);

  		try{
  			$this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
  		}

        //catch any errors
  		catch (PDOException $e){
  			$this->error = $e->getMessage();
  		}

  	}

	//Aquis�o
  	public function query($query){
  		$this->stmt = $this->dbh->prepare($query);
  	}

	//Conecatar
  	public function bind($param, $value, $type = null){
  		if(is_null($type)){
  			switch (true){
  				case is_int($value):
  				$type = PDO::PARAM_INT;
  				break;
  				case is_bool($value):
  				$type = PDO::PARAM_BOOL;
  				break;
  				case is_null($value):
  				$type = PDO::PARAM_NULL;
  				break;
  				default:
  				$type = PDO::PARAM_STR;
  			}
  		}
  		$this->stmt->bindValue($param, $value, $type);
  	}

    //Executar
  	public function execute(){
  		return $this->stmt->execute();

  		$this->qError = $this->dbh->errorInfo();
  		if(!is_null($this->qError[2])){
  			echo $this->qError[2];
  		}
  		echo 'done with query';
  	}

	//Exibir em objeto
  	public function object(){
  		return $this->stmt->fetchObject();
  	}

	//Exibir Array
  	public function row(){
  		$this->execute();
  		return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
  	}

	//�nico
  	public function single(){
  		$this->execute();
  		return $this->stmt->fetch(PDO::FETCH_ASSOC);
  	}

	//lista de tabela
  	public function table(){
  		$this->execute();
  		return $this->stmt->fetchAll(PDO::FETCH_COLUMN);
  	}

	// Numero de Linha
  	public function rowCount(){ 
  		return $this->stmt->rowCount();
  	}

	//Ultimo Id cadastrado
  	public function lastInsertId(){
  		return $this->dbh->lastInsertId();
  	}

	//Iniciar Transa��o
  	public function beginTransaction(){
  		return $this->dbh->beginTransaction();
  	}

	//final transa��o
  	public function endTransaction(){
  		return $this->dbh->commit();
  	}

	//cancelar trasa��o
  	public function cancelTransaction(){
  		return $this->dbh->rollBack();
  	}

	//depurar params de despejo
  	public function debugDumpParams(){
  		return $this->stmt->debugDumpParams();
  	}

	//Erro query
  	public function queryError(){
  		$this->qError = $this->dbh->errorInfo();
  		if(!is_null($qError[2])){
  			echo $qError[2];
  		}
  	}

	//***************************************************************




  }


//********************************************************************************************************
/*
try {

	$cli = new db();	   
	$cli->query("SELECT * FROM dados");
	$cli->execute();
  #$resultCli2 = $cli->row();
	$resultCli = $cli->object();

	print_r($cli->table());

	echo $resultCli->dados_id;
	echo "<br>";
//print_r($resultCli2);
//echo "<br>";
//echo $resultCli2[0]['dados_nome'];

} catch (PDOException $e) {
	echo $e->getMessage();
}
*/



/*Fun��o de cadastro*/
function cadastro($tabela, $postagem, $url){

  echo '<pre>';
  print_r($postagem);
  echo '</pre>';
  
  /*Verificar coluna no banco*/
  $ver = new db();
  $ver->query( "DESCRIBE ".$tabela );
  $ver->execute();
  $table_fields = $ver->table();

  foreach ($ver->table() as $key) {
    $tabelasSQL[$key] = $key;
  }

  /* Listar */
  foreach( $postagem AS $val => $key ){
    if( $val == $tabelasSQL[$val] ){
      $Into[]   = " {$val} " ;
      $Values[] = " :{$val}" ;
    }
  }

  /* Arrays Implode */
  $QueryInto   = @implode(',', $Into);
  $QueryValues = @implode(',', $Values);

  /* registro */
  try{
    $sql = "INSERT INTO {$tabela} ({$QueryInto}) VALUES ({$QueryValues})";
    $db = new db();
    $db->query($sql);

    foreach( $postagem AS $val => $key ){
      if( $val == $tabelasSQL[$val] ){
       $db->bind(":{$val}", $key);
     }
   }

   /* registro sucesso */
   if($db->execute()){
    echo notify('success');
  } else{
    echo notify('danger');
  }

  /* Redirecionar */
  if( !empty( $_POST['redirecionar'] ) ){
    echo '<meta http-equiv="refresh" content="1;URL='.$_POST['url'].'!/'.$tabela.'/'.$_POST['redirecionar'].'/'.$db->lastInsertId().'" />';
  }

} catch (PDOException $e) {
  throw new PDOException($e);
}

}


/*Fun��o de editar*/
function editar($tabela, $postagem = array(), $coluna, $valor, $url){

  // echo '<pre>';
  // print_r($postagem);
  // echo '</pre>';


  /*Verificar coluna no banco*/
  $ver = new db();
  $ver->query( "DESCRIBE ".$tabela );
  $ver->execute();
  $table_fields = $ver->table();

  foreach ($ver->table() as $key) {
    $tabelasSQL[$key] = $key;
  }

  /* Listar */
  foreach( $postagem AS $val => $key ){
    if( $val == $tabelasSQL[$val] ){
      $Into[]  = " {$val} = :{$val}" ;
    }
  }

  /* Arrays Implode */
  $QueryInto   = @implode(',', $Into);


  /* Editar */
  try{

    $sql = "UPDATE {$tabela} SET {$QueryInto} WHERE {$coluna} = :{$coluna}";
    $db = new db();
    $db->query($sql);

    foreach( $postagem AS $val => $key ){
      if( $val == $tabelasSQL[$val] ){
       $db->bind(":{$val}", $key);
     }
   }


   /* Editado sucesso */
   if($db->execute()){
    echo notify('success');
  } else{
    echo notify('danger');
  }

  /* Redirecionar */
  if( !empty( $_POST['redirecionar'] ) ){
    echo '<meta http-equiv="refresh" content="1;URL='.$_POST['url'].'!/'.$tabela.'/'.$_POST['redirecionar'].'" />';
  }

} catch (PDOException $e) {
  throw new PDOException($e);
}

}


/*Fun��o de deletar*/
function deletar($tabela, $coluna, $valor, $url, $delPasta = NULL){

  try{ 

    $dir = 'images/'.$delPasta.'/'.$valor;
    $dirArray = array('p', 'm', 'g', 'u', 'original');

    $del = new db();
    $del->query("DELETE FROM {$tabela} WHERE {$coluna} = :{$coluna}");
    $del->bind(":{$coluna}" , $valor);

    /* registro sucesso */
    if($del->execute()){
      echo notify('success');

      /* deletar pasta */
      if( !empty($delPasta) ){

        foreach( $dirArray AS $extensoes ){

          $dirExt = '../'.$dir.'/'.$extensoes;

          if( is_dir($dirExt) ){

                     function apagar($dirDeletar)
                     {
                      if(is_dir($dirDeletar)){
                        if($handle = @opendir($dirDeletar)){
                          while(false !== ($file = @readdir($handle))){
                            if(($file == ".") or ($file == "..")){
                              continue;
                            }
                            if(is_dir($file)){
                              apagar($dirDeletar.'/'.$file);
                            }else{
                              unlink($dirDeletar.'/'.$file);
                            }
                          }
                        }else{
                          return false;
                        }

                        @closedir($handle);
                        @unlink($dirDeletar);
                        @rmdir($dirDeletar);
                      }
                      else
                      {
                        return false;
                      }
                    }

                    /* deletar */
                    apagar($dirExt);

        }

      }
      if(is_dir($dir)){
       /* deletar */
       apagar($dir);
      }

    }
    
  echo '<meta http-equiv="refresh" content="1;URL='.$_POST['url'].'!/'.$tabela.'/'.$_POST['redirecionar'].'" />';

    exit;


  }else{
    echo notify('danger');
  }

  echo '<meta http-equiv="refresh" content="1;URL='.$_POST['url'].'!/'.$tabela.'/'.$_POST['redirecionar'].'" />';

} catch (PDOException $e) {
  throw new PDOException($e);
}

}

?>