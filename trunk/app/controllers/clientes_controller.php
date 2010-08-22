<?php
class ClientesController extends AppController {

    var $name = 'Clientes';
    var $helpers = array('Html', 'Form', 'Jquery');

    function index() {
        $this->Cliente->recursive = 0;
        $this->set('clientes', $this->paginate());
    }

    function view($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid Cliente.', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->set('cliente', $this->Cliente->read(null, $id));
    }

    function add() {
        if (!empty($this->data)) {
            $this->data['User']['username'] = $this->data['Cliente']['email'];
            $this->data['User']['password'] = Security::hash($this->data['User']['password'], null, true);
            $this->data['Cliente']['redigite_senha'] = Security::hash($this->data['Cliente']['redigite_senha'], null, true);
            $this->data['User']['autenticacao'] = Security::hash($this->data['User']['username'], null, true);
            $this->data['User']['ativo'] = false;
            if($this->data['Cliente']['tipo_pessoa']=='f') {
                unset($this->data['PessoaJuridica']);
            }
            if($this->data['Cliente']['tipo_pessoa']=='j') {
                unset($this->data['PessoaFisica']);
            }
//            $this->sendMail($this->data['Cliente']['email']);
//            exit;
            if($this->data['User']['password'] == $this->data['Cliente']['redigite_senha']) {

                $this->Cliente->create();
                if ($this->Cliente->saveAll($this->data)) {

                    $this->Session->setFlash(__('O link de confirmação de cadastro, foi enviada para o email cadastrado.', true));
                    $this->redirect(array('action'=>'index'));
                } else {
                    $this->data['User']['password'] = '';
                    $this->data['Cliente']['redigite_senha'] = '';
                    $this->Session->setFlash(__('O Cliente não pode ser salvo. Por favor, tente novamente.', true));
                }
            }
            else {
                $this->data['User']['password'] = '';
                $this->data['Cliente']['redigite_senha'] = '';
                $this->Session->setFlash(__('A confimação da senha não coincide.', true));
            }
        }
        $estados = $this->Cliente->Estado->find('list');
        $tipoCliente = array('f'=>'Pessoa Física', 'j'=>'Pessoa Jurídica');
        $this->set(compact('estados', 'tipoCliente'));
    }

    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid Cliente', true));
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->data)) {
            if ($this->Cliente->save($this->data)) {
                $this->Session->setFlash(__('The Cliente has been saved', true));
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('The Cliente could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Cliente->read(null, $id);
        }
        $estados = $this->Cliente->Estado->find('list');
        $grupoAcessos = $this->Cliente->GrupoAcesso->find('list');
        $this->set(compact('estados','grupoAcessos'));
    }


    function sendMail($destino) {
        App::import('Vendor', 'PhpMailer', array('file' => 'phpmailer' . DS . 'class.phpmailer.php'));
        $Emailc = new PHPMailer();

        $Emailc->SetLanguage('br');
        $Emailc->From     = "clezioalves@ig.com.br";

        $Emailc->FromName = "Clezio";
        $Emailc->Mailer   = "smtp";
        $Emailc->Host     = "smtp.ig.com.br";
//        $Emailc->Port = "995";
        $Emailc->Username = "clezioalves@ig.com.br";
        $Emailc->Password = "realizacao";
        $Emailc->SMTPDebug = true;
        $Emailc->SMTPAuth = true;

//        $Emailc->Mailer   = "mail";


        // HTML body
        $body  = "Hello <font size=\"4\">Testetestetestedjnbjknfjnjkf</font>, <p>";
        $body .= "<i>Your</i> personal photograph to this message.<p>";
        $body .= "Sincerely, <br>";
        $body .= "phpmailer List manager";

        // Plain text body (for mail clients that cannot read HTML)
        $text_body  = "Hello dkfjsdhfjjfkdjfddhtestetsh, \n\n";
        $text_body .= "Your personal photograph to this message.\n\n";
        $text_body .= "Sincerely, \n";
        $text_body .= "phpmailer List manager";

        $Emailc->Body    = $body;
        $Emailc->AltBody = $text_body;
        $Emailc->AddAddress('cliziolimadark@hotail.com', 'Clezio');

        if(!$Emailc->Send())
            echo "There has been a mail error sending to Clezio<br>";

        // Clear all addresses and attachments for next loop
        $Emailc->ClearAddresses();
        $Emailc->ClearAttachments();

    }

}

?>