<?php
class ClientesController extends AppController {

    var $name = 'Clientes';
    var $helpers = array('Html', 'Form', 'Jquery');
    var $components = array('Email');
    var $uses= array('Cliente', 'User');

    function beforeFilter () {
        // executa o beforeFilter do AppController
        parent::beforeFilter();
        // adicione ao método allow as actions que quer permitir sem o usuário estar logado
        $this->Auth->allow('auth');
//        print_r($this->Auth);
    }
    
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
            $linkAuth = 'http://localhost'.$this->webroot."clientes/auth/".$this->data['User']['autenticacao'];
            $nameFrom = 'Bocazul';
            $from = 'clezioalves@ig.com.br';
            $nameTo = $this->data['Cliente']['nome'];
            $to = $this->data['Cliente']['email'];
            $subject = 'Confirmação de cadastro';
            $msg = 'Bém vindo! <br> <p>O click no link abaixo para confirmar seu
                cadastro no site bocazul.<br>'.$linkAuth;
            if($this->data['User']['password'] == $this->data['Cliente']['redigite_senha']) {
                $this->Cliente->create();
                if ($this->Cliente->saveAll($this->data)) {
                    $this->enviarEmail($nameFrom, $from, $subject, $msg, $to, $nameTo);
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

    function enviarEmail($nameFrom, $from, $subject, $msg, $to, $nameTo, $replyTo=null) {
//        $Emailc->SMTPAuth = false;
        /* SMTP Options */
        $this->Email->smtpOptions = array(
                'port' => '465',//587
                'timeout' => '40',
                'host' => 'ssl://smtp.ig.com.br',
                'username' => 'clezioalves@ig.com.br',
                'password' => 'realizacao',
                'client' => 'smtp.ig.com.br');
        
        /* Define a forma de entrega */
        $this->Email->delivery = 'smtp';

        $this->Email->sendAs = 'text'; // html, text, both
//        $this->set('conteudo', $msg); // especifica variavel da mensagem para o template
        $this->Email->layout = 'default'; // views/elements/email/html/contact.ctp
//        $this->Email->template = 'default';
//
//        //set view variables as normal
//        $this->set('from', $name);
//        $this->set('msg', $msg);
        $this->Email->to = $nameTo . '<' . $to . '>';
        $this->Email->subject = $subject;
        $this->Email->replyTo = $replyTo;
        $this->Email->from = $nameFrom . '<' . $from .'>';

        if ( $this->Email->send($msg) ) {
            $this->Session->setFlash('E-mail enviado');

        } else {
            $this->Session->setFlash('E-mail não enviado');
        }

//        $this->redirect(array('controller'=>'clientes','action'=>'add'));

    }

    function auth($hash){
        if($hash){
            $user = $this->User->find('all', array('conditions'=>array('User.autenticacao'=>$hash)));
            if($user){
                $this->data['User']['id'] = $user[0]['User']['id'];
                $this->data['User']['ativo'] = true;
                if($this->User->save($this->data)){
                    $this->Session->setFlash('Confirmação realizada com sucesso.');
                } else {
                    $this->Session->setFlash('A confirmação não pôde ser realizada.');
                }
                

            }
            else{
                $this->Session->setFlash('A confirmação não pôde ser realizada.');
            }
            $this->redirect(array('controller'=>'shopps','action'=>'index'));
        }
    }

}

?>