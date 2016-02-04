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
	<div class="row">
		<div class="span12">
			<legend>Dados Pessoais</legend>
			<table cellpadding="0" cellspacing="0" class="table table-bordered table-hover table-condensed">
				<tbody>
					<tr>
						<td><strong>Nome</strong></td>
						<td><?php echo $registro['Pessoa']['nome']; ?></td>
					</tr>
					<tr>
						<td><strong>Email</strong></td>
						<td><?php echo $registro['Pessoa']['email']; ?></td>
					</tr>
					<tr>
						<td><strong>Login</strong></td>
						<td><?php echo $registro['Usuario']['login']; ?></td>
					</tr>
					<tr>
						<td><strong>CPF</strong></td>
						<td><?php echo $registro['Pessoa']['cpf']; ?></td>
					</tr>
					<tr>
						<td><strong>RG</strong></td>
						<td><?php echo $registro['Pessoa']['rg']; ?></td>
					</tr>
					<tr>
						<td><strong>Observação</strong></td>
						<td><?php echo $registro['Usuario']['observacao']; ?></td>
					</tr>		
				</tbody>				
			</table>			
		</div>
		<div class="span12">
			<legend>Endereço</legend>
			<table cellpadding="0" cellspacing="0" class="table table-bordered table-hover table-condensed">
				<tbody>
					<tr>
						<td><strong>Logradouro</strong></td>
						<td><?php echo $registro['Pessoa']['logradouro']; ?></td>
					</tr>
					<tr>
						<td><strong>Número</strong></td>
						<td><?php echo $registro['Pessoa']['numero']; ?></td>
					</tr>
					<tr>
						<td><strong>Cep</strong></td>
						<td><?php echo $registro['Pessoa']['cep']; ?></td>
					</tr>
					<tr>
						<td><strong>Bairro</strong></td>
						<td><?php echo $registro['Pessoa']['bairro']; ?></td>
					</tr>
					<tr>
						<td><strong>Cidade</strong></td>
						<td><?php echo $registro['Pessoa']['cidade']; ?></td>
					</tr>
					<tr>
						<td><strong>Uf</strong></td>
						<td><?php echo $registro['Pessoa']['uf']; ?></td>
					</tr>		
				</tbody>				
			</table>
		</div>
		<div class="span12">
			<legend>Dados de Acesso</legend>
			<table cellpadding="0" cellspacing="0" class="table table-bordered table-hover table-condensed">
				<tbody>
					<tr>
						<td><strong>Perfil</strong></td>
						<td><?php echo $registro['Perfil']['titulo']; ?></td>
					</tr>
					<tr>
						<td><strong>Cargo</strong></td>
						<td><?php echo $registro['Cargo']['titulo']; ?></td>
					</tr>
					<tr>
						<td><strong>Vínculo</strong></td>
						<td><?php echo $registro['Vinculo']['titulo']; ?></td>
					</tr>
					<tr>
						<td><strong>Setor</strong></td>
						<td><?php echo $registro['Setor']['titulo']; ?></td>
					</tr>
					<tr>
						<td><strong>Departamento</strong></td>
						<td><?php echo $registro['Departamento']['titulo']; ?></td>
					</tr>
					<tr>
						<td><strong>Chefia</strong></td>
						<td><?php echo $registro['Usuario']['chefe'] ? "Sim" : "Não"; ?></td>
					</tr>
				</tbody>				
			</table>
		</div>
	</div>
</div>