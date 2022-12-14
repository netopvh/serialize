<?php

namespace NetoPvh\ResponseSerialize\Generators;

/**
 * Class SerializeGenerator
 * @package NetoPvh\ResponseSerialize\Generators
 * @author Angelo Neto <netopvh@gmail.com>
 */
class SerializeGenerator extends Generator
{

  /**
   * Get stub name.
   *
   * @var string
   */
  protected $stub = 'serializer';

  /**
   * Get root namespace.
   *
   * @return string
   */
  public function getRootNamespace()
  {
    return parent::getRootNamespace() . parent::getConfigGeneratorClassPath($this->getPathConfigNode());
  }

  /**
   * Get generator path config node.
   *
   * @return string
   */
  public function getPathConfigNode()
  {
    return 'serializes';
  }

  /**
   * Get destination path for generated file.
   *
   * @return string
   */
  public function getPath()
  {
    return $this->getBasePath() . '/' . parent::getConfigGeneratorClassPath($this->getPathConfigNode(), true) . '/' . $this->getName() . 'Serialize.php';
  }

  /**
   * Get base path of destination file.
   *
   * @return string
   */
  public function getBasePath()
  {
    return config('serialize.generator.basePath', app()->path());
  }
}
