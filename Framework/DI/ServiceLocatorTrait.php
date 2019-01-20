<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2019/1/13
 * Time: 10:08
 */

namespace Twinkle\DI;


use Twinkle\DI\Exception\NotFoundException;
use Twinkle\Library\Common\Helper;
use Twinkle\Library\Framework\Container;

trait ServiceLocatorTrait
{

    public static function supportAutoNamespaces()
    {
        return [];
    }

    /**
     * @param string $name 属性名称
     * @return mixed
     * @todo 父类如果有__get方法, 在判断失败时调用父类的
     */
    public function __get($name)
    {

        if ($this->isSupportedClassSuffix($name)) {
            return $this->getByCalledClass($name);
        }

        return parent::__get($name);
    }

    protected function getByCalledClass($propertyName)
    {
        $className = ucwords($propertyName);

        foreach (static::supportAutoNamespaces() as $namespace) {
            if (class_exists("{$namespace}\\{$className}")) {
                return Container::getInstance()->reflector("{$namespace}\\{$className}");
            }
        }

        throw new NotFoundException("No entry or class found for {$propertyName}");
    }


    /**
     * 是否支持以属性的方式加载
     * @param $name
     * @return bool
     */
    protected function isSupportedClassSuffix($name)
    {
        $suffixList = [
            'Service',
            'Model',
            'Facade'
        ];

        return Helper::endWith($name, $suffixList) && !in_array($name, $suffixList);
    }

}