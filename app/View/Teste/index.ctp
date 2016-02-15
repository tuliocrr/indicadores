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
					echo $this->Form->input('nome', array('class'=>'input-xlarge','div' => array('class' => 'input text')));
					echo $this->Form->input('data', array('class'=>'input-xlarge data','div' => array('class' => 'input text')));
					echo $this->Form->input('email', array('class'=>'input-xlarge','div' => array('class' => 'input text')));
					echo $this->Form->input('hora_hora', array('class' => 'input-xlarge datahora'));
					echo $this->Form->input('senha', array('type' => 'password', 'class' => 'input-xlarge'));
					echo $this->Form->input('observacao', array('label'=>'Observação','class' => 'texteditor'));
					echo $this->Form->input('imagem_perfil', array('class'=>'input-xlarge', 'type' => 'file'));
					echo $this->Form->input('setor', array('label' => 'Setores',
						'class'=>'input-xlarge multi-select',
						'type' => 'select',
						'multiple' => 'multiple',
						'options' => $setores,
						'div' => array(
						'class' => 'input label-block'
					)));
				?>
  			</div>
 			<div class="span6">
 				<legend>Endereço</legend>
 				<?php 
 					echo $this->Form->input('telefone',array('class' => 'input-xlarge telefone'));
					echo $this->Form->input('cpf', array('class' => 'input-xlarge cpf'));
					echo $this->Form->input('Pessoa.cep', array('class' => 'input-xlarge cep'));
					echo $this->Form->input('cnpj', array('class' => 'input-xlarge cnpj'));
					echo $this->Form->input('hora', array('class' => 'input-xlarge hora'));
					echo $this->Form->input('uf', array('label' => 'UF','type' => 'select', 'options' => Util::getEstados()));
				?>
				<legend>Dados de acesso</legend>
				<?php
					echo $this->Form->input('perfil_id', array("options" => $perfis, 'empty' => "Selecione o perfil"));
					echo $this->Form->input('chefia', array("options" => array(1=>"Sim", 0=> "Não"), 'type' => "radio"));
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

