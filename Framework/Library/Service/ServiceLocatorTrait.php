<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2019/1/13
 * Time: 10:08
 */

namespace Twinkle\Library\Service;


use Twinkle\Library\Common\StringHelper;
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
        /**
         * elseif (is_callable(parent::__get)) {
         * return parent::__get($name);
         * }
         */
    }

    protected function getByCalledClass($propertyName)
    {
        $className = ucwords($propertyName);

        foreach (static::supportAutoNamespaces() as $namespace) {
            if (class_exists("{$namespace}\\{$className}")) {
                return Container::getInstance()->reflector("{$namespace}\\{$className}");
            }
        }

        throw new \Exception('属性不存在');
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
        ];

        return (new StringHelper())->endWith($name, $suffixList) && !in_array($name, $suffixList);

    }

}