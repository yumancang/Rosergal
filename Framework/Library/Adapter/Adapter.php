<?php
namespace Twinkle\Library\ConfigAdapter;
/**
 * 适配器接口
 * @author yumancang
 *
 */
interface Adapter
{
    public function beforeAdapter();
    public function runAdapter();
    public function afterAdapter();
}