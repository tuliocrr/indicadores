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

App::uses('Model', 'Model');

App::uses('CakeSession', 'Model/Datasource');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	
	/**
	 * Adiciona sempre a condição excluído = false para todas as consultas
	 * (non-PHPdoc)
	 * @see Model::beforeFind()
	 */
	public function beforeFind($queryData) {
		if(Router::getParam('controller') != 'autenticacao' && $this->name != "Conta" && $this->name != "Pessoa"){
			$queryData["conditions"][$this->name . ".conta_id = "] = CakeSession::read("Auth.Indicadores.Conta.id");
		}
		$queryData["conditions"][$this->name . ".status != "] = 0;
		return $queryData;
	}
	
	public function beforeSave($options = array()){
		$this->data[$this->name]["conta_id"] = CakeSession::read("Auth.Indicadores.Conta.id");
	}
	
}
