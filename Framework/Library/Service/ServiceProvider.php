<?php
/**
 * 
 * @author Python Luo <laifaluo@126.com>
 * 
 * */

 
namespace Twinkle\Library\Service;



class ServiceProvider implements \ArrayAccess,\Serializable 
{   
    public $container;
    
    public $paramters = [];
    
    public function __construct()
    {
        
    }
    
    
    public function offsetExists ($offset)
    {
    
    }
    
    /**
     * @param offset
     */
    public function offsetGet ($offset)
    {
        return $this->make($offset);
    }
    
    /**
     * @param offset
     * @param value
     */
    public function offsetSet ($offset, $value)
    {
        $this->mapperInstace[$offset] = $value;
    }
    
    /**
     * @param offset
     */
    public function offsetUnset ($offset)
    {
        unset($this->mapperInstace[$offset]);
    }
    
    public function serialize ()
    {
         
    }
    
    /**
     * @param serialized
     */
    function unserialize ($serialized)
    {
    
    }
    
    
}