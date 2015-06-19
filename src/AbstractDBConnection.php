<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GCG\Core;

/**
 * Description of AbstractMysqlConnection
 *
 * @author charlie
 */
abstract class AbstractDBConnection {
    // Meedo database connection
    protected $conx = [];
            
    /**
     * Gets an existing or creates a new stored connection to return
     * 
     * @param type $source
     * @return Meedo connection
     */
    public function getConnection($source) {
        if(($this->conx === null)?true:!array_key_exists($source, $this->conx)) {
            $this->conx[$source] = $this->createMysqlConnection($source);
        }
        return $this->conx[$source];
    }
    
    public function createConnection($source) {
        //Access configuration values from default location (/usr/local/etc/gpg/default)
        $config = new \Configula\Config('/usr/local/etc/gpg/default');
        
        return new \medoo($config->databaseConfig[$source]); // medoo does not use namespaces
    }
}
