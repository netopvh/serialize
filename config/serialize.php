<?php

return [
  /**
   * Mensagens de feedback no retorno
   */
  'messages' => [
    'empty' => 'Nenhum conteúdo para exibir no momento.',
    'error' => 'Ocorreu algum erro.',
    'success' => 'Sucesso.',
  ],
  'debug' => [
    'enabled' => env('APP_DEBUG', false),
  ],
  'generator' => [
    'basePath'      => app()->path(),
    'rootNamespace' => 'App\\',
    'stubsOverridePath' => app()->path(),
    'paths'         => [
      'serializes'   => 'Serializes',
      'interfaces'   => 'Serializes\\Interfaces',
      'provider'     => 'SerializeServiceProvider',
    ]
  ]
];
