<?php 
require_once "conectar.php";

$hour=date('H');
$hora=date("H:i:s",mktime($hour-1));

function Utf8_ansi($str) {
$utf8_ansi2=array("\u00c0"=>"À","\u00c1"=>"Á","\u00c2"=>"Â","\u00c3"=>"Ã","\u00c4"=>"Ä","\u00c5"=>"Å","\u00c6"=>"Æ","\u00c7"=>"Ç","\u00c8"=>"È","\u00c9"=>"É","\u00ca"=>"Ê","\u00cb"=>"Ë","\u00cc"=>"Ì","\u00cd"=>"Í","\u00ce"=>"Î","\u00cf"=>"Ï","\u00d1"=>"Ñ","\u00d2"=>"Ò","\u00d3"=>"Ó","\u00d4"=>"Ô","\u00d5"=>"Õ","\u00d6"=>"Ö","\u00d8"=>"Ø","\u00d9"=>"Ù","\u00da"=>"Ú","\u00db"=>"Û","\u00dc"=>"Ü","\u00dd"=>"Ý","\u00df"=>"ß","\u00e0"=>"à","\u00e1"=>"á","\u00e2"=>"â","\u00e3"=>"ã","\u00e4"=>"ä","\u00e5"=>"å","\u00e6"=>"æ","\u00e7"=>"ç","\u00e8"=>"è","\u00e9"=>"é","\u00ea"=>"ê","\u00eb"=>"ë","\u00ec"=>"ì","\u00ed"=>"í","\u00ee"=>"î","\u00ef"=>"ï","\u00f0"=>"ð","\u00f1"=>"ñ","\u00f2"=>"ò","\u00f3"=>"ó","\u00f4"=>"ô","\u00f5"=>"õ","\u00f6"=>"ö","\u00f8"=>"ø","\u00f9"=>"ù","\u00fa"=>"ú","\u00fb"=>"û","\u00fc"=>"ü","\u00fd"=>"ý","\u00ff"=>"ÿ");return strtr($str,$utf8_ansi2);
}

if($_GET['act'] && $_GET['act'] == "go" 
	&& isset($_POST['nome']) && $_POST['nome'] != "" && isset($_POST['email']) && $_POST['email'] != "" 
	&& isset($_POST['cidade']) && $_POST['cidade'] != "" && isset($_POST['estado']) && $_POST['estado'] != "") {

$token = "---";		
$parceiro = "WebJuris";	


$i=0;
$nome = trim($_POST['nome']);
$telefone = trim($_POST['telefone']);
$Telefone = str_replace(array("(",")"),array("",""),$telefone);
$email = trim($_POST['email']);
$cidade = trim($_POST['cidade']);
$estado = trim($_POST['estado']);
$profissao = trim($_POST['profissao']);
$programas = trim($_POST['programas']);

$userip = get_client_ip();
$date = date('d/m/Y').' '.$hora;
$from = 'https://www.webjuris.com.br/';
$novo = "Não";
		
if($programas == 'previus') {
	$programa = 'Prévius 3.0';
	$texto = 'ilimitados Cálculos Previdenciários.';
	$texto_add = ', no Prévius e nos cálculos previdenciários, ';
  $from = 'https://www.webjuris.com.br/testes-gratis/5/Previus-3-0-como-obter-a-minha-copia-de-teste-por-7-dias';
	$msg_id = 3;
} elseif ($programas == 'abacus') {
	$programa = 'Ábacus 6.0';
	$texto = 'ilimitados Cálculos Cíveis.';
	$texto_add = ' ';
  $from = 'https://www.webjuris.com.br/testes-gratis/1/Abacus-6-0-como-obter-a-minha-copia-de-teste-por-7-dias-sem-compromisso';
	$msg_id = 2;
} elseif ($programas == 'peritus') {
	$programa = 'Peritus 6.0';
	$texto = 'ilimitados Cálculos Trabalhistas.';
	$texto_add = ' ';
  $from = 'https://www.webjuris.com.br/testes-gratis/3/Peritus-6-0-como-obter-a-minha-copia-de-teste-por-7-dias-sem-compromisso';
	$msg_id = 1;
}

if(isset($_POST['site']) && $_POST['site'] != '') {
  $site = trim($_POST['site']);
} else {
  $site = $from;
}


$cadProgramas = '';
$informa = '';
$http_code = 0;
$http_codes = 0;

 //Consulta se contato já está cadastrado na logike
 $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://www.api.logikesoftwares.com.br/v1/Leads?email='.$email,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
      'token: '.$token,
      'parceiro: '.$parceiro,
    ),
  ));

  $response = curl_exec($curl);
  $http_code = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);
  $json = json_decode($response,true);
  curl_close($curl);
  
  if($http_code == 200) {
	 $retorno = Utf8_ansi($response); 
	 $DataCadastro = str_replace("\/","/",$json['DataCadastro']);
	 $cadProgramas .= '<p><b>Programas</b><br>';
	if(isset($json['Programas']) && $json['Programas']!='') {
		foreach($json['Programas'] as $Pro) {
			$cadProgramas .= '
			<p>Nome do Programa: '.Utf8_ansi($Pro['NomePrograma']).'<br>
			Versao: '.Utf8_ansi($Pro['Versao']).'<br>
			Tipo: '.Utf8_ansi($Pro['Tipo']).'<br>
			Data de Vencimento: '.str_replace("\/","/",$Pro['DataVencimento']).'<br></p>';
		}
    }
	$cadProgramas .= '</p>';
	  
	 $informa = '
	 <p>Contato Cadastrado na Logike em <b>'.$DataCadastro.'</b></p>
	 <p>Código de Parceiro: '.Utf8_ansi($json['CodigoParceiro']).'</p>
	 <p>Observação: '.Utf8_ansi($json['Observacao']).'</p>';
	 
  }

  //Se retornar codigo 404 cadastra contato
if($http_code == 404 || $http_code != 200) { 

$novo = "Sim";
	
$post = array(
      'Nome'=>$nome,
      'Cidade'=>$cidade,
      'Estado'=>$estado,
      'Email'=>$email,
      'Telefone'=>$Telefone
  );


//Cadastrando contato
    $curls = curl_init();

    curl_setopt_array($curls, array(
    CURLOPT_URL => 'https://www.api.logikesoftwares.com.br/v1/Leads',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>json_encode($post, JSON_HEX_QUOT),
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
      'token: '.$token,
      'parceiro: '.$parceiro,
      ),
    ));
	$responses = curl_exec($curls);
	$http_codes = curl_getinfo($curls, CURLINFO_RESPONSE_CODE);
	curl_close($curls);
	$retorno = Utf8_ansi($responses);
}  
$resposta = $http_code;


if($http_codes > 0) {
	$resposta = $http_codes;
}


$assunto = utf8_decode('Solicitação de Teste - '.$programa);
$email_contato = $email_admin;
//$email_contato = "suporte@kitsites.com";


$html = '<p><strong>Dados do Cliente</strong></p>
<p>Nome: '.$nome.'</p>
<p>E-mail: '.$email.'</p>
<p>Telefone: '.$telefone.'</p>
<p>Cidade: '.$cidade.'/'.$estado.'</p>
<p>Profissão: '.$profissao.'</p>
<p>Programa: '.$programa.'</p>
<p>Código do Vendedor: 1800</p>
<p>IP: '.$userip.'</p>
<p>Cadastro Novo Logike: '.$novo.'</p>
'.$informa.'
'.$cadProgramas.'
<p>Site: '.$site.'</p>
<p>Data: '.$date.' hs.</p>';

$sqlInsert = mysql_query("INSERT INTO contr_cadastros (nome, email, telefone, cidade, estado, profissao, produto, vendedor, msg_id, novo, response, retorno, site, data, ip, hora) 
		VALUES(
				'".utf8_decode($nome)."',
				'".$email."',
				'".utf8_decode($telefone)."',
				'".utf8_decode($cidade)."',
				'".utf8_decode($estado)."',
        '".utf8_decode($profissao)."',
				'".utf8_decode($programa)."',
				'1800',
				'".$msg_id."',
				'".utf8_decode($novo)."',
				'".$resposta."',
				'".utf8_decode($retorno)."',
				'".$site."',
				'".date("Y-m-d")."',
				'".$userip."',
				'".$hora."')");

$emailsender =  $email;
//ENVIO DE MENSAGEM PARA O WEB JURIS
//PHP MAILER


require_once 'autenticado/PHPMailerAutoload.php';

$mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
$mail->IsSMTP();

try {
$mail->SMTPAuth = true;
$mail->Host = "mail.webjuris.com.br";
$mail->Port = 587;

$mail->Username = 'app@webjuris.com.br';
$mail->Password = '--';

$mail->SMTPSecure = false; // Define se é utilizado SSL/TLS - Mantenha o valor "false"
$mail->SMTPAutoTLS = false; // Define se, por padrão, será utilizado TLS - Mantenha o valor "false"
$mail->IsHTML(true);

// remetente
$mail->setFrom($email_contato, utf8_decode('Web Juris | Cálculos Judiciais'));
$mail->AddReplyTo($email_contato, utf8_decode('Web Juris | Cálculos Judiciais'));

// destinatário
$mail->AddAddress($email_contato);

$mail->AddCC('natan@webjuris.com.br','Natan');
$mail->AddCC('calculos@webjuris.com.br','Cálculos Web Juris');
//$mail->AddCC('leonardo@webjuris.com.br','Leonardo');
//$mail->AddCC('vinicius@webjuris.com.br','Vinicius');
$mail->AddCC('lucas@webjuris.com.br','Lucas');

$mail->Subject = $assunto;
$mail->msgHTML(utf8_decode($html));
$mail->Send();
$mail->ClearAllRecipients();

} catch (phpmailerException $e) {
  //echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  //echo $e->getMessage(); //Boring error messages from anything else!
}

//ENVIO DE MENSAGEM DE RESPOSTA AUTOMATICA
//PHP MAILER

$mail = new PHPMailer(true); //defaults to using php "mail()"; the true param means it will throw exceptions on errors, which we need to catch
$mail->IsSMTP();

try {
  $html = '<p><strong>Prezado(a) Doutor(a) '.$nome.'!</strong></p>
<p>Agradecemos pela solicitação de teste por até 7 dias do '.$programa.', para fazer <strong>'.$texto.'</strong><br /><br />
Em breve um dos nossos consultores especializados'.$texto_add.'poderá te ligar colocando a sua disposição o nosso <span color="#800000">atendimento e treinamento especializado gratuito</span>.<br /><br />
Ou fale com a gente através dos nossos canais de atendimento.</p>   
<p>Atenciosamente,</p>
<p><strong>Equipe Web Juris</strong><br />
Capitais e regiões '.$tel_admin1.'<br />
Demais localidades '.$tel_admin2.'<br />
WhatsApp '.$tel_admin3.'<br />
<a href="https://www.webjuris.com.br." target="_blank">www.webjuris.com.br</a></p>';


$mail->Port = 587;
$mail->Host = "localhost";
$mail->SMTPAuth = false;
$mail->SMTPSecure = false; // Define se é utilizado SSL/TLS - Mantenha o valor "false"
$mail->SMTPAutoTLS = false; // Define se, por padrão, será utilizado TLS - Mantenha o valor "false"
$mail->IsHTML(true);
$mail->clearAllRecipients();
// remetente
$mail->setFrom($email_contato, utf8_decode('Web Juris | Cálculos Judiciais'));
// destinatário
$mail->addAddress($emailsender, utf8_decode($_POST['nome']));
$mail->AddReplyTo($email_contato, utf8_decode('Web Juris | Cálculos Judiciais'));
$mail->Subject = $assunto;
  $mail->MsgHTML(utf8_decode($html));
  $mail->Send();
 } catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}	

header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
ob_start();

echo 200;


	}
