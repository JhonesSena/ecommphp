<?php
class ItensPedido extends AppModel {

	var $name = 'ItensPedido';
        var $displayField = 'id';

        var $belongsTo = array(
                'Pedido' => array(
                                'className' => 'Pedido',
                                'foreignKey' => 'pedido_id',
                                'conditions' => '',
                                'fields' => '',
                                'order' => ''
                ),
                'Item' => array(
                                'className' => 'Item',
                                'foreignKey' => 'item_id',
                                'conditions' => '',
                                'fields' => '',
                                'order' => ''
                ),
                'Produto' => array(
                                'className' => 'Produto',
                                'foreignKey' => 'produto_id',
                                'conditions' => '',
                                'fields' => '',
                                'order' => ''
                )
        );
}
?>