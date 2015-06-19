<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GCG\Core;

use MongoClient;

/**
 * Description of AbstractMongoConnection
 *
 * @author jam
 */
abstract class AbstractMongoConnection extends AbstractDBConnection {
    /**
     * The connection that will be used.
     *
     * @var MongoDB
     */
    private $mongo = null;
    /**
     * Gets an existing or creates a new stored connection to return
     * 
     * @return MongoDB
     */
    public function getMongoConnection() {
        if ($this->mongo === null) {
            $this->mongo = $this->createMongoConnection();
        }
        return $this->mongo;
    }
    /**
     * Creates a mongo connection from configuration folder (or the default unoptioned connection)
     * 
     * @return MongoDB
     */
    public function createMongoConnection() {
        //Access configuration values from default location (/usr/local/etc/gpg/default)
        $config = new \Configula\Config('/usr/local/etc/gpg/default');
        // The connection configuration        
        $mongoConfig = $config->mongoConfig;
        
        if(empty($mongoConfig)) {
            return new MongoClient();
        } elseif (empty($mongoConfig->options)) {
            return new MongoClient($mongoConfig->server);
        } else {
            new MongoClient($mongoConfig->server,$mongoConfig->options);
        }
    }
}
