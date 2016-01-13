<?php
class Util{
	
	/**
	 * Método que retorna o último dia do mês e o ano passados por parâmetro
	 * @param Int $mes
	 * @param Int $ano
	 * @static
	 * @return Int
	 */
	public static function ultimoDiaMes($mes,$ano){
		return date("d",mktime(0,0,0,$mes + 1,0,$ano));
	}
	
	public static function getTimesTamp($dataPtBr){
		$arrayData = explode(" ", $dataPtBr);
		if(count($arrayData) == 2){
			$strData = $arrayData[0];
			$strHora = $arrayData[1]; 
		}else{
			$strData = $arrayData[0];
			$strHora = "00:00:00";
		}
		list($intDia,$intMes,$intAno) = explode("/", $strData);
		$arrayHora = explode(":", $strHora);
		if(count($arrayHora) == 3){
			list($intHora,$intMin,$intSeg) = explode(":", $strHora);
		}else if(count($arrayHora) == 2){
			list($intHora,$intMin) = explode(":", $strHora);
			$intSeg = 0;
		}
		return mktime((int)$intHora,(int)$intMin,(int)$intSeg,(int)$intMes,(int)$intDia,(int)$intAno);
	}
	
	public static function getBomDiaBoaTardeBoaNoite(){
		$hora = date("H");
		if($hora >= 0 && $hora < 12)
			return "Bom dia";
		if($hora >= 12 && $hora < 18)
			return "Boa tarde";
		else
			return "Boa noite";
	}
	
	/**
	 * Método que tem a função de inverter o formato de data original
	 * Caso a data venha no formato ptbr, é invertido para o fotmato usa
	 * Caso venha no USA, inverte para o ptbr
	 * Caso venha hora, retorna com hora, sem os segundos
	 * Caso não venha com hora, retorna sem hora
	 * @param string $strData
	 * @static
	 * @access public
	 * @return string
	 */
	public static function inverteData($strData){
		$strData = trim($strData);
		$arrayData = explode(" ", $strData);
		
		$data = $arrayData[0];
		$hora = (isset($arrayData[1])) ? " " . substr($arrayData[1], 0,5) : "";
		
		/* ptbr to usa */
		if(strpos($data, "/")){
			list($dia,$mes,$ano) = explode("/", $data);
			return $ano . "-" . $mes . "-" . $dia . $hora;
		}
		/* usa to ptbr */
		else if(strpos($data, "-")){
			list($ano,$mes,$dia) = explode("-", $data);
			return $dia . "/" . $mes . "/" . $ano . $hora;
		}
	}

	/**
	 * Método que retira os acentos de uma String e a retorna
	 * @param String $str
	 * @access public
	 * @static
	 * @return String
	 */
	public static function retiraAcento($str){
		$arrAcentos		= array("Á","É","Í","Ó","Ú","Â","Ê","Î","Ô","Û","Ã","Ñ","Õ","Ä","Ë","Ï","Ö","Ü","À","È","Ì","Ò","Ù","á","é","í","ó","ú","â","ê","î","ô","û","ã","ñ","õ","ä","ë","ï","ö","ü","à","è","ì","ò","ù",".",",",":",";","...","ç","%","?","/","\\","","","'","!","@","#","$","*","(",")","+","=","{","}","[","]","|","<",">","\"","&ordf;","&ordm;","&deg;","","","&raquo;","-","ª","º","»","´","~","&","°","²","³");
		$arrSemacento	= array("a","e","i","o","u","a","e","i","o","u","a","n","o","a","e","i","o","u","a","e","i","o","u","a","e","i","o","u","a","e","i","o","u","a","n","o","a","e","i","o","u","a","e","i","o","u","","","","","","c","_porcento","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","","e","","2","3");
		for($intPos = 0 ; $intPos < count($arrAcentos) ; $intPos++){
			$str = str_replace($arrAcentos[$intPos],$arrSemacento[$intPos],$str,$cont);
		}
		return $str;
	}

	/**
	 * Método responsável por retornar o dia da semana em português
	 * @param int $intDia
	 * @param int $intMes
	 * @param int $intAno
	 */
	public static function getDiaDaSemana($intDia = null, $intMes = null, $intAno = null){
		
		$intDia = (is_null($intDia)) ? date("d") : $intDia;
		$intMes = (is_null($intMes)) ? date("m") : $intMes;
		$intAno = (is_null($intAno)) ? date("Y") : $intAno;
		
		switch(date('N', mktime(0, 0, 0, $intMes, $intDia, $intAno))){
			case 1:
				$strRetorno = 'segunda-feira';
				break;
			case 2:
				$strRetorno = 'terça-feira';
				break;
			case 3:
				$strRetorno = 'quarta-feira';
				break;
			case 4:
				$strRetorno = 'quinta-feira';
				break;
			case 5:
				$strRetorno = 'sexta-feira';
				break;
			case 6:
				$strRetorno = 'sábado';
				break;
			case 7:
				$strRetorno = 'domingo';
				break;
		}
		
		return $strRetorno;
	}

	/**
	 * Retorna a extensão de um arquivo atravéz do fileName informado
	 * @param String $strFileName
	 * @static
	 * @return String
	 */
	public static function getExtensao($strFileName){
		$pecas = explode(".", $strFileName);
		$tam = count($pecas);
		return $pecas[$tam - 1];
	}

	/**
	 * Método usado na geração de senhas aleatórias
	 * @param $intTam
	 * @access public
	 * @static
	 * @return string
	 */
	public static function gerarSenha($intTam = 6){
		$array = array(
			array("1","2","3","4","5","6","7","8","9"),
			array("a","b","c","d","e","f","g","h","k","m","n","p","q","r","s","t","u","v","x","z")
		);
		$strSenha = "";
		for($i = 0 ; $i  < $intTam ; $i++ ){
			$key = rand(0,count($array)-1);
			$strSenha .= $array[$key][rand(0,count($array[$key]) - 1)];
		}
		return $strSenha;
	}

	/**
	 * Método que retorna uma string passada por parâmetro em formato de url
	 * @param String $strTitulo
	 * @access public
	 * @return String
	 */
	public static function formatarTituloParaUrl($strTitulo){
		// retira todos os acentos e caracteres especiais
		$strTitulo = str_replace(" - ", " ", $strTitulo);
		$strTitulo = self::retiraAcento($strTitulo);
		// retita os espaços em branco e troca para um "-"
		$strTitulo = str_replace(" ", "-", $strTitulo);
		return strtolower($strTitulo);
	}
	
	/**
	 * Método que retorna a extensão do arquivo
	 * @param string $strFileName
	 * @return string
	 */
	public static function getExtensaoArquivo($strFileName){
		return strtolower(substr($strFileName, strrpos($strFileName, ".")));
	}

	/**
	 * Método que retorna os estados brasileiros
	 * @static
	 */
	public static function getEstados(){
		return array("AC"=>"Acre", 
					 "AL"=>"Alagoas", 
					 "AM"=>"Amazonas", 
					 "AP"=>"Amapá",
					 "BA"=>"Bahia",
					 "CE"=>"Ceará",
					 "DF"=>"Distrito Federal",
					 "ES"=>"Espírito Santo",
					 "GO"=>"Goiás",
					 "MA"=>"Maranhão",
					 "MT"=>"Mato Grosso",
					 "MS"=>"Mato Grosso do Sul",
					 "MG"=>"Minas Gerais",
					 "PA"=>"Pará",
					 "PB"=>"Paraíba",
					 "PR"=>"Paraná",
					 "PE"=>"Pernambuco",
					 "PI"=>"Piauí",
					 "RJ"=>"Rio de Janeiro",
					 "RN"=>"Rio Grande do Norte",
					 "RO"=>"Rondônia",
					 "RS"=>"Rio Grande do Sul",
					 "RR"=>"Roraima",
					 "SC"=>"Santa Catarina",
					 "SE"=>"Sergipe",
					 "SP"=>"São Paulo",
					 "TO"=>"Tocantins");
	}
	
	/**
	 * Método que retorna os meses do ano
	 * @static
	 */
	public static function getMeses($index = false) {
		$meses = array("01"=>"Janeiro",
					 "02"=>"Fevereiro",
					 "03"=>"Março",
					 "04"=>"Abril",
					 "05"=>"Maio",
					 "06"=>"Junho",
			  		 "07"=>"Julho",
					 "08"=>"Agosto",
					 "09"=>"Setembro",
					 "10"=>"Outubro",
					 "11"=>"Novembro",
					 "12"=>"Dezembro"); 
		return $index ? $meses[$index]: $meses;
	}
	
	public static function difData($d1, $d2, $type='', $sep='-'){
		$d1 = explode($sep, $d1);
		$d2 = explode($sep, $d2);
		switch ($type){
			case 'A':
				$X = 31536000;
				break;
			case 'M':
				$X = 2592000;
				break;
			case 'D':
				$X = 86400;
				break;
			case 'H':
				$X = 3600;
				break;
			case 'MI':
				$X = 60;
				break;
			default:
				$X = 1;
		}
		return floor(((mktime(0, 0, 0, $d2[1], $d2[2], $d2[0]) - mktime(0, 0, 0, $d1[1], $d1[2], $d1[0]))/$X));
	}
	
	/**
	 * Método responsável por retornar o nome do mês por extenso
	 * @param unknown $mes
	 * @return string
	 */
	public static function getMes($mes){
		switch ($mes){
			case "01":
				$retorno = "Janeiro";
				break;
			case "02":
				$retorno = "Fevereiro";
				break;
			case "03":
				$retorno = "Março";
				break;
			case "04":
				$retorno = "Abril";
				break;
			case "05":
				$retorno = "Maio";
				break;
			case "06":
				$retorno = "Junho";
				break;
			case "07":
				$retorno = "Julho";
				break;
			case "08":
				$retorno = "Agosto";
				break;
			case "09":
				$retorno = "Setembro";
				break;
			case "10":
				$retorno = "Outubro";
				break;
			case "11":
				$retorno = "Novembro";
				break;
			case "12":
				$retorno = "Dezembro";
				break;
			default:
				break;
		}
		
		return $retorno;
	}
	
	/**
	 * Função que informa se uma data é valida ou não
	 * @param String $data
	 * @return boolean
	 */
	public static function validaData($data){
		
		if(empty($data))
			return false;
		
		// Pegando apenas a parte da data, no caso da mesma ser uma data:hora
		$arrayData = explode(" ", $data);
		if(count($arrayData) > 1)
			$data = $arrayData[0];
		
		$ptbr = (strpos($data, "/") !== false) ? true : false;
		$us = (strpos($data, "-") !== false) ? true : false;
		
		if(!ptbr && !$us)
			return false;
		
		if($ptbr){
			$arrayData = explode("/", $data);
			if(count($arrayData) != 3)
				return false;
			list($dia, $mes, $ano) = $arrayData;
		}else if($us){
			$arrayData = explode("-", $data);
			if(count($arrayData) != 3)
				return false;
			list($ano, $mes, $dia) = $arrayData;
		}
		
		return checkdate($mes, $dia, $ano);
		
	}

	/**
	 * Método que formata valor para gravar no banco
	 * @static
	 */
	public static function formataValorParaBanco($val){
		$val = str_replace('.', '', $val);
		$val = str_replace(',', '.', $val);
		return $val;
	}
	
	/**
	 * Método que retorna a imagem do farol de acordo com a diferença entre a data 1 e data 2
	 * @param strinf $data1
	 * @param strinf $data2
	 * @return string
	 */
	public static function farol($data1, $data2){
		list($d,$m,$a) = explode("/",$data1);
		$timeVencimento = mktime(0,0,0,$m,$d,$a);
		list($d,$m,$a) = explode("/",$data2);
		$timePagamento = mktime(0,0,0,$m,$d,$a);
		if($timeVencimento > $timePagamento){
			return '<img src="'.BASE.'/img/verde.gif" /> ';
		}else if($timeVencimento < $timePagamento){
			return '<img src="'.BASE.'/img/vermelho.gif" /> ';
		}else{
			return '<img src="'.BASE.'/img/laranja.gif" /> ';
		}
	}

}
?>