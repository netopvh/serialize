<?php

namespace NetoPvh\ResponseSerialize\Serialize;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use NetoPvh\ResponseSerialize\Interfaces\IResponseSerialize;

abstract class BaseSerialize implements IResponseSerialize
{

  /**
   * Links de navegação da api.
   *
   * @var array
   */
  protected array $links = array();

  /**
   * Dados relevantes retornados na resposta.
   *
   * @var array
   */
  protected array $data = array();

  /**
   * Mensagens de feedback no retorno
   *
   * @var array
   */
  protected array $feedbackMessage = [
    'empty' => 'Nenhum conteúdo para exibir no momento.',
    'error' => 'Ocorreu algum erro.',
    'success' => 'Sucesso.',
  ];

  /**
   * DataHora em que o recurso foi retornado.
   *
   * @var DateTime
   */
  protected $generatedAt;

  /**
   * Total de registros no recurso retornado.
   *
   * @var integer
   */
  protected int $total;

  /**
   * Debug 
   *
   * @var array
   */
  protected array $debug = array();

  /**
   * Dados para lista com paginação
   *
   * @var array
   */
  protected array $withPagination = array();

  /**
   * Seta os dados do retorno
   *
   * @param array $data
   */
  public function setData(array $data): void
  {
    $this->data = $data;
  }

  /**
   * Obtém as informações setadas no array data, que são os dados relevantes retornados no recurso.
   *
   * @return array
   */
  public function getData(): array
  {
    return $this->data;
  }

  /**
   * Obtem dados de debug
   * 
   * @return array
   */
  public function getDebug(): array
  {
    return $this->debug;
  }

  /**
   * Seta os dados do debug
   *
   * @param array $debug
   */
  public function setDebug(array $debug): void
  {
    $this->debug = $debug;
  }

  /**
   * Seta os link self do recurso da api, ou seja o link do próprio recurso.
   *
   * @param string $link
   */
  public function setLinkSelf(string $link): void
  {
    $this->links['self'] = $link;
  }

  /**
   * Seta os link da coleção.
   *
   * @param string $link
   */
  public function setLinkCollection(string $link): void
  {
    $this->links['collection'] = $link;
  }

  /**
   * Seta link no array links com o nome recebida por parâmetro.
   *
   * @param string $link
   * @param mixed  $name
   */
  public function setLink(string $link, string $name): void
  {
    $this->links[$name] = $link;
  }

  /**
   * Obtém os links definidos no set.
   *
   * @return array
   */
  public function getLinks(): array
  {
    return $this->links;
  }

  /**
   * Obtém as mensagens de retorno da api.
   *
   * @return array
   */
  public function getFeedbackMessage(): array
  {
    return $this->feedbackMessage;
  }

  /**
   * Seta as mensagens de retorno da api.
   *
   * @param array $arrayMessage
   */
  public function setFeedbackMessage(array $arrayMessage): void
  {
    $this->feedbackMessage = array_merge($this->feedbackMessage, $arrayMessage);
  }


  /**
   * Obtém a data hora da geração do resposta a ser retornado.
   *
   * @return array
   */
  public function getGeneratedAt(): string
  {
    return $this->generatedAt;
  }

  /**
   * Seta a data hora da geração do resposta a ser retornado.
   *
   * @return array
   */
  public function setGeneratedAt(): void
  {
    $this->generatedAt = Carbon::now()->format('d-m-Y H:i:s');
  }

  /**
   * Obtém a quantidade de registros retornados.
   *
   * @return array
   */
  public function getTotal(): int
  {
    return $this->total;
  }

  /**
   * Seta a quantidade total de resgistos na resposta a ser retornado.
   *
   * @param mixed $quantityTotal
   *
   * @return array
   */
  public function setTotal(int $quantityTotal): void
  {
    $this->total = $quantityTotal;
  }

  /**
   * <p>Serializa o formato a ser retornado pelo recurso da api</p>
   * <p>contendo: </p>
   * <li> <b>_links: </b> Links de navegação da api </li>
   * <li> <b>data: </b> Dados retornados </li>
   * <li> <b>feedback: </b> Mensagens de retorno. ( Sucesso, erro, etc.) </li>.
   *
   * @return array
   */
  public function getApiResponse($withPagination = false): array
  {
    $this->setGeneratedAt();

    if (!empty($this->total)) {
      $response['total'] = $this->getTotal();
    }

    $response = [
      'generated_in'  => $this->getGeneratedAt(),
      '_links'        => $this->getLinks(),
      'data'          => $this->getData(),
      'feedback'      => $this->getFeedbackMessage(),
      'query_string'  => app('request')->getQueryString(),
    ];

    if ($withPagination) {
      $response['pagination'] = $this->withPagination;
    }

    /**
     * Somente para retornar informações de debug 
     */
    if (config('serialize.debug.enabled') === 'true') {
      $response['debug'] = $this->getDebug();
    }

    return $response;
  }

  /**
   * Seta dados no retorno para listas com paginação
   *
   * @param Collection $collection
   * @return void
   */
  public function setReturnWithPagination($collection): void
  {
    $dataWithPagination = [
      "total"         =>  $collection->count(),
      "per_page"      =>  $collection->perPage(),
      "current_page"  =>  $collection->currentPage(),
      "last_page"     =>  $collection->lastPage(),
      "next_page_url" =>  "http => //api.apus/products/private?page=2",
      // "from"          =>  $collection->from(),
      // "to"            =>  $collection->nextPage(),
    ];

    $this->withPagination = $dataWithPagination;
  }

  /**
   * Seta dados no retorno para serializaçao de um unico registro
   *
   * @param Model $model
   * @return array
   */
  abstract function toSerialize(Model $model): array;

  /**
   * Seta dados no retorno para serializaçao de uma lista de registros
   *
   * @param Model $model
   * @return array
   */
  abstract function toList(Model $model): array;

  /**
   * Seta dados no retorno de uma lista serializada
   *
   * @param Collection $data
   * @return array
   */
  abstract function colToSerialize($data): array;
}
