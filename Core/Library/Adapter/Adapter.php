<?php
namespace App\Library\Adapter;
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