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
        $this->setDirectory($directory);
    }

    /**
     * @param string $subset
     * @return array
     * @throws InvalidArgumentException
     */
    public function get(string $subset): array
    {
        $files = scandir($this->getNamespaceDirectory($subset));

        $classes = $this->appendNamespace($subset, $files);

        $classesExisting = array_filter($classes, function ($possibleClass) {
            return class_exists($possibleClass);
        });

        return $this->sortByOrderList($subset, $classesExisting);
    }

    /**
     * @param string $directory
     */
    public function setDirectory(string $directory)
    {
        $this->directory = $directory;
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
    private function getNamespaceDirectory(string $namespace)
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
        array $composerNamespaces,
        string $possibleNamespace,
        array $undefinedNamespaceFragments
    ): string {
        $path = $this->directory;
        $path .= $composerNamespaces[$possibleNamespace];
        $path .= implode('/', $undefinedNamespaceFragments);

        return realpath($path);
    }

    /**
     * @param string $subset
     * @param $files
     * @return array
     */
    private function appendNamespace(string $subset, array $files): array
    {
        $classes = array_map(function ($file) use ($subset) {
            return $subset . '\\' . str_replace('.php', '', $file);
        }, $files);
        return $classes;
    }

    /**
     * @param string $subset
     * @param $classes
     * @return array
     */
    private function sortByOrderList(string $subset, array $classes): array
    {
        $filename = $this->getNamespaceDirectory($subset) . '/Order.json';

        if (!file_exists($filename)) {
            return $classes;
        }

        $orderList = array_flip($this->appendNamespace(
            $subset, json_decode(file_get_contents($filename))
        ));

        usort($classes, function ($a, $b) use ($orderList) {
            return $orderList[$a] > $orderList[$b] ? 1 : -1;
        });

        return $classes;
    }
}
