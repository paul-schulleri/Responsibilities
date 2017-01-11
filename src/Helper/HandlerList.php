<?php
namespace Schulleri\Responsibilities\Helper;

use InvalidArgumentException;

/**
 * Class HandlerList
 * @package Schulleri\Responsibilities\Helper
 */
class HandlerList
{
    /** @var string */
    private $directory;

    /**
     * HandlerList constructor.
     * @param string $directory
     */
    public function __construct(string $directory = __DIR__ . '/../../')
    {
        $this->directory = $directory;
    }

    /**
     * @param string $subset
     * @return array
     * @throws InvalidArgumentException
     */
    public function get(string $subset): array
    {
        $files = scandir($this->getNamespaceDirectory($subset));

        $classes = array_map(function ($file) use ($subset) {
            return $subset . '\\' . str_replace('.php', '', $file);
        }, $files);

        return array_filter($classes, function ($possibleClass) {
            return class_exists($possibleClass);
        });
    }

    /**
     * @return array
     */
    private function getDefinedNamespaces(): array
    {
        $composerConfig = json_decode(file_get_contents(
            $this->directory . 'composer.json'
        ));

        return (array)((array)$composerConfig->autoload)['psr-4'];
    }

    /**
     * @param $namespace
     * @return bool|string
     */
    private function getNamespaceDirectory($namespace)
    {
        $composerNamespaces = $this->getDefinedNamespaces();
        $namespaceFragments = explode('\\', $namespace);
        $undefinedNamespaceFragments = [];

        while ($namespaceFragments) {
            $possibleNamespace = implode('\\', $namespaceFragments) . '\\';
            if (array_key_exists($possibleNamespace, $composerNamespaces)) {

                return $this->getPath(
                    $composerNamespaces,
                    $possibleNamespace,
                    $undefinedNamespaceFragments
                );
            }

            $undefinedNamespaceFragments[] = array_pop(
                $namespaceFragments
            );
        }

        return false;
    }

    /**
     * @param $composerNamespaces
     * @param $possibleNamespace
     * @param $undefinedNamespaceFragments
     * @return string
     */
    private function getPath(
        $composerNamespaces,
        $possibleNamespace,
        $undefinedNamespaceFragments
    ): string {
        $path = $this->directory;
        $path .= $composerNamespaces[$possibleNamespace];
        $path .= implode('/', $undefinedNamespaceFragments);

        return realpath($path);
    }
}
