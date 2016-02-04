<?php 
/**
 *
 * Copyright [2016] -  Civis Gestão Inteligente
 * Este arquivo é parte do programa Civis Estratégia
 * O civis estratégia é um software livre, você pode redistribuí-lo e/ou modificá-lo dentro dos termos da Licença Pública Geral GNU como publicada pela Fundação do Software Livre (FSF) na versão 2 da Licença.
 * Este programa é distribuído na esperança que possa ser  útil, mas SEM NENHUMA GARANTIA, sem uma garantia implícita de ADEQUAÇÃO a qualquer  MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a Licença Pública Geral GNU/GPL em português para maiores detalhes.
 * Você deve ter recebido uma cópia da Licença Pública Geral GNU, sob o título "licença GPL.odt", junto com este programa. Se não encontrar,
 * Acesse o Portal do Software Público Brasileiro no endereço www.softwarepublico.gov.br ou escreva para a Fundação do Software Livre(FSF) Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301, USA
 *
 */
?>
<div class="container">
	
	<h4><?php echo $title;?></h4>
	
	<form method="post" enctype="multpart/form-data">
 		<div class="row">
	  		<div class="span6">
	  			<legend>Dados Pessoais</legend>
	  			<?php				
					echo $this->Form->input('Pessoa.nome', array('class'=>'input-xlarge','div' => array('class' => 'input text')));
					echo $this->Form->input('Pessoa.email', array('class'=>'input-xlarge','div' => array('class' => 'input text')));
					echo $this->Form->input('Pessoa.tipo', array('type' => 'hidden', 'value' => 'PF'));
					echo $this->Form->input('Usuario.login', array('class' => 'input-xlarge'));
					echo $this->Form->input('Usuario.senha', array('type' => 'password', 'class' => 'input-xlarge'));
					echo $this->Form->input('Usuario.confirmacao_senha', array('type' => 'password', 'class' => 'input-xlarge'));
					echo $this->Form->input('Pessoa.cpf', array('class' => 'input-xlarge'));
					echo $this->Form->input('Pessoa.rg', array('class' => 'input-xlarge'));
					echo $this->Form->input('Usuario.observacao', array('class' => ' jqte-test'));
					echo $this->Form->input('imagem_perfil', array('class'=>'input-xlarge', 'type' => 'file'));
					echo $this->Form->input('diretorio_imagem_perfil', array('type' => 'hidden'));
				?>
  			</div>
 			<div class="span6">
 				<legend>Endereço</legend>
 				<?php 
 					echo $this->Form->input('Pessoa.logradouro',array('class' => 'input-xlarge'));
					echo $this->Form->input('Pessoa.numero', array('class' => 'input-xlarge'));
					echo $this->Form->input('Pessoa.cep', array('class' => 'input-xlarge'));
					echo $this->Form->input('Pessoa.bairro', array('class' => 'input-xlarge'));
					echo $this->Form->input('Pessoa.cidade', array('class' => 'input-xlarge'));
					echo $this->Form->input('Pessoa.uf', array('label' => 'UF','type' => 'select', 'options' => Util::getEstados()));
				?>
				<legend>Dados de acesso</legend>
				<?php
					echo $this->Form->input('Usuario.perfil_id', array("options" => $perfis, 'empty' => "Selecione o perfil"));
					echo $this->Form->input('Usuario.cargo_id', array("options" => $cargos, 'empty' => "Selecione o cargo"));
					echo $this->Form->input('Usuario.vinculo_id', array("options" => $vinculos, 'empty' => "Selecione o vinculo"));
					echo $this->Form->input('Usuario.setor_id', array("options" => $setores, 'empty' => "Selecione o setor"));
					echo $this->Form->input('Usuario.departamento_id', array("options" => $departamentos, 'empty' => "Selecione o departamento"));
					echo $this->Form->input('Usuario.chefe', array("label" => "Chefia?" ,"options" => array(0 => 'Não', 1 => "Sim")));
 				?>
	 		</div>
 		</div>
		<div class="row">
			<div class="span12">
				<div class="form-actions">
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</div>
		</div>
 	</form>
</div>

<script type="text/javascript" src="http://code.jquery.com/jquery.min.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo $this->base?>/js/jquery-te-1.4.0.min.js"></script>
<link type="text/css" rel="stylesheet" href="<?php echo $this->base?>/css/jquery-te-1.4.0.css">
<script>
	$('.jqte-test').jqte();
	// settings of status
	var jqteStatus = true;
	$(".status").click(function(){
		jqteStatus = jqteStatus ? false : true;
		$('.jqte-test').jqte({"status" : jqteStatus})
	});
</script>