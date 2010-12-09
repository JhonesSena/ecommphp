<?
class MenuHelper extends AppHelper {

    private $menu = array();
    public $telas = array();
    private $caminhos = array();


    // url e li padronizados
    private $liChild = '<li><a href="#" onclick="location.href=%s"><span>%s</span></a></li>';
    private $liLink = '<a id="menu" class="parent" href="%s" tabindex="0"><span>%s</span></a>';
    private $liNoLink = '<li><a class=""><span>%s</span></a></li>';
    private $liMain = '<li><a class=""><span>%s</span></a>';
    private $aMain = '<li><a id="menu%s" class="parent" href="#cont-menu%s" tabindex="0"><span>%s</span></a>';
    //private $divMain = '<div class="hidden" id="cont-menu%s">';


    public function gerarMenu($telas, $menu) {
        $this->menu = $menu;
        $this->telas = $telas;
        $div = '<div id="menu"><ul class="menu">';
        $a = '';
        $cont = 0;
        if($this->telas) {
            foreach ($this->menu as $label => &$link) {
                $cont++;
                $a = '';
                $divInt = '';
                if(is_array($link)) {
                    $a = sprintf($this->aMain,$cont,$cont,$label);
                    $divInt .= $this->validaMenu($label,$link);
                    
                    if(!count($this->menu[$label])) {
                        unset($this->menu[$label]);
                        $a = '';
                        $divInt = '';
                    }
                }
                else {
                    $a = $this->validaLink($label,$link, true);
                    if(!$a) {
                        unset($this->menu[$label]);
                        $a = '';
                    }

                }
                $div .= $a;
                $div .= $divInt;
                $div .= '</li>';
            }

        }
        $div .= '</ul></div>';
        return $this->output($div);
    }

    private function validaMenu($label,&$link) {
        $ul =  '<ul>';
        foreach ($link as $Clabel => $Clink) {
            if(is_array($Clink)) {
                $a = sprintf($this->liMain,$Clabel);
                $a .= $this->validaMenu($Clabel,$Clink);

                if(!count($link[$Clabel])) {
                    unset($link[$Clabel]);
                    $a = '';
                }
            }
            else {
                $a = $this->validaLink($Clabel,$Clink);
                if(!$a) {
                    unset($link[$Clabel]);
                    $a = '';
                }
            }
            $ul .= $a;
        }
        $ul .= '</ul>';
        return $ul;
    }

    public function validaLink($label,$url,$a = false) {

        $linkArray = explode('/',$url);
        if(count($linkArray) > 1) {
            $link = $url;
        }else {
            $link = $url . '/view';
        }

        if(!empty($this->telas[$link]) || $link == 'users/logout' || $link == 'shopps') {
            if($a)
                return sprintf($this->liLink, $this->webroot . $url,$label);
            else
                return sprintf($this->liChild, "'$this->webroot$url'",$label);

        }else {           
            return false;
        }
    }
}
?>
