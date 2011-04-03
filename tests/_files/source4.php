<?php
error_log(__NAMESPACE__ . ' in ' . __DIR__ . ' ' . __FILE__);

const CONNECT_OK = 1;
class Connection {
    public function connect() 
    {
        error_log(__CLASS__ . '::' . __METHOD__ . '@' . __LINE__);
    }
}
function connect() { 
    /* ... */  
    error_log(__FUNCTION__ . '@' . __LINE__);
    
}
