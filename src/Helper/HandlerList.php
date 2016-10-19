<?php
declare(strict_types = 1);
namespace Schulleri\Responsibilities\Helper;

/**
 * Class HandlerList
 * @package Schulleri\Responsibilities\Helper
 */
class HandlerList
{
    /**
     * @param string $subset
     * @return array
     */
    public function get(string $subset):array
    {
        $files = str_replace('.php', '', preg_grep('~\.(php)$~', scandir(
            $this->handlerDirectory($subset)
        )));

        $files = array_map(function ($val) use ($subset) {
            return $this->handlerNamespace($subset) . $val;
        }, $files);

        return array_values($files);
    }

    /**
     * @param $subset
     * @return string
     */
    private function handlerDirectory($subset):string
    {
        $directory = dirname(__DIR__) . DIRECTORY_SEPARATOR;
        $directory .= 'Handler' . DIRECTORY_SEPARATOR;

        return $directory . $subset . DIRECTORY_SEPARATOR;
    }

    /**
     * @param $subset
     * @return string
     */
    private function handlerNamespace($subset):string
    {
        $namespace = $this->parentNamespace() . '\\';
        $namespace .= 'Handler' . '\\';

        return $namespace . $subset . '\\';
    }

    /**
     * @return string
     */
    private function parentNamespace():string
    {
        $path = explode("\\", __NAMESPACE__);
        array_pop($path);
        
        return implode("\\", $path);
    }
}
