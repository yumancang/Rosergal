<?php
use PHPUnit\Framework\TestCase;
use Twinkle\Library\Cache\CacheFacade;
use Twinkle\Library\Config\ConfigLoader;
/**
 * 缓存单元测试
 * 
 * vendor/bin/phpunit --bootstrap vendor/autoload.php tests/Framework/Cache/CacheTest.php
 * 
 * @author yumancang
 *
 */
class CacheTest extends TestCase
{
    
    private $cache;
    
    public function setUp()
    {
        ConfigLoader::LoadConfig(__DIR__ . '/../../../App/Config/phpunit','cache.php');
        $config = ConfigLoader::$Config['cache.php'];
        $this->cache = new CacheFacade();
        
    }
    
    public function testSet()
    {
        $this->assertEquals(true,$this->cache->set('name','yumancang'));
    }
    
    
    public function testGet()
    {
        $this->assertEquals('yumancang',$this->cache->get('name'));
    }
    
    public function testDelete()
    {
        $this->assertEquals(true,$this->cache->delete('name'));
    }
     
    public function testHset()
    {
        $this->setExpectedException('Exception');
        $this->assertEquals(true,$this->cache->hset('hash','field','value'));
    }
    
    
    public function testHget()
    {
        $this->setExpectedException('Exception');
        $this->assertEquals('value',$this->cache->hget('hash','field'));
    }

}