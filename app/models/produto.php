<?php
class Produto extends AppModel {

    var $name = 'Produto';
    var $displayField = 'descricao';
//	var $validate = array(
//		'codigo' => array('numeric'),
//		'descricao' => array('notempty'),
//		'grupo_id' => array('numeric'),
//		'pacote' => array('numeric'),
//		'caixa' => array('numeric'),
//		'peso_bruto' => array('numeric'),
//		'peso_liquido' => array('numeric'),
//		'cubagem' => array('decimal'),
//		'preco' => array('money')
//	);

    //The Associations below have been created with all possible keys, those that are not needed can be removed
    var $belongsTo = array(
            'Grupo' => array(
                            'className' => 'Grupo',
                            'foreignKey' => 'grupo_id',
                            'conditions' => '',
                            'fields' => '',
                            'order' => ''
            )
    );

    var $hasMany = array(
            'Imagem' => array(
                            'className' => 'Imagem',
                            'foreignKey' => 'produto_id',
                            'dependent' => false,
                            'conditions' => '',
                            'fields' => '',
                            'order' => '',
                            'limit' => '',
                            'offset' => '',
                            'exclusive' => '',
                            'finderQuery' => '',
                            'counterQuery' => ''
            ),
            'ItensPedido' => array(
                            'className' => 'ItensPedido',
                            'foreignKey' => 'produto_id',
                            'dependent' => false,
                            'conditions' => '',
                            'fields' => '',
                            'order' => '',
                            'limit' => '',
                            'offset' => '',
                            'exclusive' => '',
                            'finderQuery' => '',
                            'counterQuery' => ''
            ),
            'Item' => array(
                            'className' => 'Item',
                            'foreignKey' => 'produto_id',
                            'dependent' => false,
                            'conditions' => 'ativo = true',
                            'fields' => '',
                            'order' => '',
                            'limit' => '',
                            'offset' => '',
                            'exclusive' => '',
                            'finderQuery' => '',
                            'counterQuery' => ''
            ),
            'Preco' => array(
                            'className' => 'Preco',
                            'foreignKey' => 'produto_id',
                            'dependent' => false,
                            'conditions' => array('Preco.ativo = true'),
                            'fields' => '',
                            'order' => '',
                            'limit' => '',
                            'offset' => '',
                            'exclusive' => '',
                            'finderQuery' => '',
                            'counterQuery' => ''
            )
    );

    function beforeSave() {
        if(!empty($this->data['Produto']['cubagem'])) {
            $this->data['Produto']['cubagem'] = str_replace(',', '.', $this->data['Produto']['cubagem']);
        }

        if(!empty($this->data['Produto']['preco'])) {
            $this->data['Produto']['preco'] = str_replace(',', '.', $this->data['Produto']['preco']);
            $this->data['Produto']['preco'] = str_replace('R$', '', $this->data['Produto']['preco']);
        }

        if(!empty($this->data['Produto']['desconto_por_pacote'])) {
            $this->data['Produto']['desconto_por_pacote'] = str_replace('__,__', '0.00', $this->data['Produto']['desconto_por_pacote']);
            $this->data['Produto']['desconto_por_pacote'] = str_replace(',', '.', $this->data['Produto']['desconto_por_pacote']);
        }
        return true;
    }

    function afterFind($results) {
        if(isset($results)) {
            foreach ($results as $key => $val) {
                if (isset($val['Produto']['cubagem'])) {

                    if(!empty($results[$key]['Produto']['cubagem'])) {
                        $results[$key]['Produto']['cubagem'] = str_replace('.', ',', $results[$key]['Produto']['cubagem']);
                    }
                }


                if (isset($val['Produto']['desconto_por_pacote'])) {
                    if(!empty($val['Produto']['desconto_por_pacote'])) {
                        if($results[$key]['Produto']['desconto_por_pacote'] < 10)
                            $results[$key]['Produto']['desconto_por_pacote'] = '0'.str_replace('.', ',', $val['Produto']['desconto_por_pacote']);
                        else
                            $results[$key]['Produto']['desconto_por_pacote'] = str_replace('.', ',', $val['Produto']['desconto_por_pacote']);
                    }
                }

                if (isset($val['Produto']['ativo'])) {
                    if (isset($val['Produto'])) {
                        if($val['Produto']['ativo']==1) {
                            $results[$key]['Produto']['ativo'] = 'Sim';
                        }
                        else
                            $results[$key]['Produto']['ativo'] = 'Não';
                    }
                }
            }
        }
        return $results;
    }

    function beforeFind($query) {
        $new_conditions = array('Produto.ativo'=>true);
        if(!empty ($query['conditions'])) {
            $conditions = $query['conditions'];
            $query['conditions'] = Set::merge($conditions, $new_conditions);
        }
        else
            $query['conditions'] = $new_conditions;

        return $query;
    }

    function getIdsCoresByProduto($id){
        $valores = '';
        $retorno = $this->query("
            SELECT c.id FROM produtos p
            LEFT JOIN itens ip on (ip.produto_id = p.id)
            LEFT JOIN cores c on (ip.cor_id = c.id)
            WHERE c.ativo = true AND ip.ativo = true AND p.ativo = true AND p.id = $id");
        foreach ($retorno as $key => $value) {
            $valores .= $value[0]['id'] . ',';
        }

        $valores = substr($valores,0,-1);
        return $valores;
    }

}
?>