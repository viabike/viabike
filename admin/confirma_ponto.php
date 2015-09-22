<?php include_once("../conexao/conexao.php");
$pdo = conectar();

//LEMBRETE EM TODAS AS PAGINAS QUE HOUVER CONEXÃO COM O BANCO DE DADOS
//USAR "REQUIRE_ONCE('CONEXAO/CONEXAO.PHP')";
//$pdo = conectar();

// ======== REQUISIÇÕES VINDAS DA PAGINA formulario.php ========
$nome      = addslashes(trim($_POST["nome"      ]));
$bairro    = addslashes(trim($_POST["bairro"    ]));
$rua       = addslashes(trim($_POST["rua"       ]));
$numero    = addslashes(trim($_POST["num"       ]));
$cep       = addslashes(trim($_POST["cep"       ]));
$telefone  = addslashes(trim($_POST["telefone"  ]));
$hr_inicio = addslashes(trim($_POST["hr_inicio" ]));
$hr_fecha  = addslashes(trim($_POST["hr_fecha"  ]));
$categoria = addslashes(trim($_POST["categoria" ]));
$latitude  = addslashes(trim($_POST["latitude"  ]));
$longitude = addslashes(trim($_POST["longitude" ]));

// ======== TERMINO REQUISIÇÕES ================================

// PREPARANDO A QUERY
$sql = $pdo -> prepare("INSERT INTO ponto_interesse(nome, bairro, rua, num, cep, telefone, hr_inicio, hr_fecha, categoria, latitude, longitude) VALUES(:nome, :bairro,:rua, :num, :cep, :telefone, :hr_inicio, :hr_fecha, :categoria, :latitude, :longitude)");
	$sql -> bindValue(":nome"      , $nome      , PDO::PARAM_STR  );
	$sql -> bindValue(":bairro"    , $bairro    , PDO::PARAM_STR  );
	$sql -> bindValue(":rua"       , $rua       , PDO::PARAM_STR  );
	$sql -> bindValue(":num"       , $numero    , PDO::PARAM_INT  );
	$sql -> bindValue(":cep"       , $cep       , PDO::PARAM_INT  );
	$sql -> bindValue(":telefone"  , $telefone  , PDO::PARAM_INT  );
	$sql -> bindValue(":hr_inicio" , $hr_inicio                   ); //PROCURAR ESTE TIPO
	$sql -> bindValue(":hr_fecha"  , $hr_fecha                    ); //PROCURAR ESTE TIPO
	$sql -> bindValue(":categoria" , $categoria , PDO::PARAM_STR  );
	$sql -> bindValue(":latitude"  , $latitude  , PDO::PARAM_BOOL );
	$sql -> bindValue(":longitude" , $longitude , PDO::PARAM_BOOL );

// EXECUTANDO A QUERY
$sql -> execute();

header("location:consulta_pontos.php");
?>
