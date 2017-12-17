<?php

class Logging {
    
    private $log_file, $fp;
  
    public function lfile($path) {
        $this->log_file = $path;
    }
   
    public function lwrite($message) {
       
        if (!is_resource($this->fp)) {
            $this->lopen();
        }
        
        $script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
        
        $t = microtime(true);
        $micro = sprintf("%06d",($t - floor($t)) * 1000000);
        $time =  @date('Y-m-d H:i:s.'.$micro, $t) ;
        // $time = @date('[d/M/Y:H:i:s.u]');


      
        fwrite($this->fp, "$time ($script_name) $message" . PHP_EOL);
    }
    
    public function lclose() {
        fclose($this->fp);
    }
    // open log file (private method)
    private function lopen() {
        // in case of Windows set default log file
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $log_file_default = 'c:/php/logfile.txt';
        }
        // set default log file
        else {
            $log_file_default = '/tmp/logfile.txt';
        }
       
        $lfile = $this->log_file ? $this->log_file : $log_file_default;
    
        $this->fp = fopen($lfile, 'a') or exit("Can't open $lfile!");
    }
}

?>