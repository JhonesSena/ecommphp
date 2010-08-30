<?php
class ClientePedido extends AppModel {

    var $name = 'ClientePedido';

    //The Associations below have been created with all possible keys, those that are not needed can be removed
    var $belongsTo = array(
            'Cliente' => array(
                            'className' => 'Cliente',
                            'foreignKey' => 'cliente_id',
                            'conditions' => '',
                            'fields' => '',
                            'order' => ''
            ),
            'Pedido' => array(
                            'className' => 'Pedido',
                            'foreignKey' => 'pedido_id',
                            'conditions' => '',
                            'fields' => '',
                            'order' => ''
            )
    );
    
}
?>