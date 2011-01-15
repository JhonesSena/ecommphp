<?php
class ContatosController extends AppController {

    var $name = 'Contatos';
    var $helpers = array('Html', 'Form', 'Jquery');
    var $uses = array('Contato','Empresa','Estado');

    function  beforeFilter() {
        $this->Allow('view');//Para visualizar index
        $this->Allow('add');
        parent::beforeFilter();
    }
    function index() {
        $assuntos = array('Elogio'=>'Elogio','Sugestão'=>'Sugestão','Parceria'=>'Parceria','Outros'=>'Outros');
        $estados = $this->Estado->find('list');
        $empresa = $this->Empresa->find('first');
        $this->set(compact('assuntos','estados','empresa'));
    }
    function add(){
        if(!empty($this->data)){
            $estado = $this->Estado->find('list');
            $empresa = $this->Empresa->find('first');
            $nameFrom = $this->data['Contato']['nome'];
            $from = $this->data['Contato']['email'];//'smtp.envio@ig.com.br';
            $nameTo = 'Clézio';
            $to = $empresa['Empresa']['email'];
            $subject = 'Notificação - '.$this->data['Contato']['assunto'];
            $msg = '<label style="font-size: 14px;color: #0066CC"><b>Notificação:</b> '.$this->data['Contato']['assunto'].'</label><br/><br/>';
            $msg .= '<table border="0" width="70%" style="border:1px solid #BDE1D3;">';
            if(!empty($this->data['Contato']['nome'])){
                $msg .= '<tr><td align="right" style="font-weight: bold; color: #0066CC;border:1px solid #BDE1D3;">Remetente</td><td style="border:1px solid #BDE1D3;">'.$this->data['Contato']['nome'].'</td></tr>';
            }
            if(!empty($this->data['Contato']['email'])){
                $msg .= '<tr><td align="right" style="font-weight: bold; color: #0066CC;border:1px solid #BDE1D3;">Email</td><td style="border:1px solid #BDE1D3;">'.$this->data['Contato']['email'].'</td></tr>';
            }
            if(!empty($this->data['Contato']['cidade'])){
                $msg .= '<tr><td align="right" style="font-weight: bold; color: #0066CC;border:1px solid #BDE1D3;">Cidade</td><td style="border:1px solid #BDE1D3;">'.$this->data['Contato']['cidade'].'</td></tr>';
            }
            if(!empty($this->data['Contato']['estado'])){
                $msg .= '<tr><td align="right" style="font-weight: bold; color: #0066CC;border:1px solid #BDE1D3;">Estado</td><td style="border:1px solid #BDE1D3;">'.$estado[$this->data['Contato']['estado']].'</td></tr>';
            }
            if(!empty($this->data['Contato']['telefone'])){
                $msg .= '<tr><td align="right" style="font-weight: bold; color: #0066CC;border:1px solid #BDE1D3;">Telefone</td><td style="border:1px solid #BDE1D3;">'.$this->data['Contato']['telefone'].'</td></tr>';
            }
            if(!empty($this->data['Contato']['celular'])){
                $msg .= '<tr><td align="right" style="font-weight: bold; color: #0066CC;border:1px solid #BDE1D3;">Celular</td><td style="border:1px solid #BDE1D3;">'.$this->data['Contato']['celular'].'</td></tr>';
            }
            
            $msg .= '<tr><td colspan="2" align="center" style="font-weight: bold;color: #0066CC;border:1px solid #BDE1D3;">Mensagem</td></tr>';
            $msg .= '<tr><td colspan="2" style="border:1px solid #BDE1D3;";border:1px solid #BDE1D3;>'.$this->data['Contato']['mensagem'].'</td></tr>';
            $msg .= '</table>';

            if($this->enviarEmail($nameFrom, $from, $subject, $msg, $to, $nameTo))
                $this->Session->setFlash(__('A mensagem foi enviada com sucesso!', true));
            else
                $this->Session->setFlash(__('A mensagem não pôde ser enviada. Se problema persistir, contacte o administrador.', true));
            $this->redirect(array('controller'=>'contatos','action'=>'index'));
        }
    }
}
?>