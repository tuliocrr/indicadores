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
// Carregamento das variáveis para controle de acesso.
$visualizar = $this->ControleDeAcesso->validaAcessoElemento('visualizar');
$editar = $this->ControleDeAcesso->validaAcessoElemento('editar');
$excluir = $this->ControleDeAcesso->validaAcessoElemento('excluir');
?>
<div class="container">
	
	<h4><?php echo $title;?></h4>
	
	<?php echo $this->element('busca'); ?>
	
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-hover table-condensed">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('titulo', 'Título'); ?></th>
				<?php if($editar || $excluir){?>
				<th class="text-center"><?php echo __('Ações'); ?></th>
				<?php }?>
			</tr>
		</thead>
		<tbody>
		<?php foreach($lista as $linha){?>
			<tr>
				<td><?php 
				if($visualizar){
					echo $this->Html->link($linha['Perfil']['titulo'], array('action' => 'visualizar', $linha['Perfil']['id'])); 
				}else{
					echo $linha['Perfil']['titulo'];
				}
				?>&nbsp;</td>
				<?php if($editar || $excluir){?>
				<td width="7%" nowrap="nowrap" class="text-center">
					<?php 
						if($editar){
						echo $this->Html->link(
							__(""),
							array('action' => 'editar', $linha['Perfil']['id']),
							array('class'=>'icon-edit')
						);
						echo "&nbsp;&nbsp;";
						}
						if($excluir){
						echo $this->Form->postLink(
							__(""), 
							array('action' => 'excluir', $linha['Perfil']['id']), 
							array('class'=>'icon-trash'),
							__('Deseja realmente excluir o registro?', $linha['Perfil']['id'])
						);
						}
					?>
				</td>
				<?php }?>
			</tr>
			<?php } ?>
		</tbody>
	</table>
	
	<?php echo $this->element('paginacao'); ?>
	
</div>