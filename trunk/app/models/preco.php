<?php
class Preco extends AppModel {

    var $name = 'Preco';
    var $displayField = 'preco';

    //The Associations below have been created with all possible keys, those that are not needed can be removed
    var $belongsTo = array(
            'Produto' => array(
                            'className' => 'Produto',
                            'foreignKey' => 'produto_id',
                            'conditions' => '',
                            'fields' => '',
                            'order' => ''
            )
    );

    function beforeSave() {
        if(!empty($this->data['Preco']['preco'])) {
            $this->data['Preco']['preco'] = str_replace(',', '.', $this->data['Preco']['preco']);
            $this->data['Preco']['preco'] = str_replace(' ', '', $this->data['Preco']['preco']);
            $this->data['Preco']['preco'] = str_replace('R$', '', $this->data['Preco']['preco']);
        }
        if(!empty($this->data['Preco']['desconto_por_pacote'])) {
            $this->data['Preco']['desconto_por_pacote'] = str_replace(',', '.', $this->data['Preco']['desconto_por_pacote']);
            $this->data['Preco']['desconto_por_pacote'] = str_replace(' ', '', $this->data['Preco']['desconto_por_pacote']);
            $this->data['Preco']['desconto_por_pacote'] = str_replace('R$', '', $this->data['Preco']['desconto_por_pacote']);
        }

        
        if(isset($this->data['Preco']['ativo'])){
            if($this->data['Preco']['ativo']!=true){
                $this->data['Preco']['expired'] = date('Y-m-d H:i:s');
            }
        }
        if(empty($this->data['Preco']['id']))
            $this->data['Preco']['created'] = date('Y-m-d H:i:s');

        return true;
    }

    function afterFind($results) {

        if(isset($results)) {
            foreach ($results as $key => $val) {
                if (isset($val['Preco']['preco'])) {

                    if(!empty($results[$key]['Preco']['preco'])) {
                        $results[$key]['Preco']['preco'] = 'R$'.str_replace('.', ',', $results[$key]['Preco']['preco']);
                    }
                }
            }
        }
        return $results;
    }

}
?>