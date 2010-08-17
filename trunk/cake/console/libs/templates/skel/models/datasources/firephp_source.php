<?
require_once (LIBS . 'model' . DS . 'datasources' . DS .'dbo_source.php');
require_once (LIBS . 'model' . DS . 'datasources' . DS . 'dbo' . DS .'dbo_mysql.php');

class FirephpSource extends DboMysql {
    
    function showLog($sorted = false) {
	
			$fire = new FirephpComponent();
	
	        if ($sorted) {
	            $log = sortByKey($this->_queriesLog, 'took', 'desc', SORT_NUMERIC);
	        } else {
	            $log = $this->_queriesLog;
	        }

	        if ($this->_queriesCnt > 1) {
	            $text = 'queries';
	        } else {
	            $text = 'query';
	        }

	        if (php_sapi_name() != 'cli') {
	            $summery = "{$this->_queriesCnt} {$text} took {$this->_queriesTime} ms";
	            $header = array("Nr", "Query", "Error", "Affected", "Num. rows", "Took (ms)");
	            $body = array($header);
	            foreach ($log as $k => $i) {
	                $row = array(($k + 1), $i['query'], $i['error'], $i['affected'], $i['numRows'], $i['took']);
	                $body[] = $row;
	                }
	            $fire->fb(array($summery, $body), FirePHP::TABLE);
	            } else {
	            foreach ($log as $k => $i) {
	                print (($k + 1) . ". {$i['query']} {$i['error']}\n");
	            }
	        }
	    }
}
?>