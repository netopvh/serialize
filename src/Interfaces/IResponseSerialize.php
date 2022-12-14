<?php

namespace NetoPvh\ResponseSerialize\Interfaces;

use DateTime;
use Illuminate\Support\Collection;

interface IResponseSerialize
{
  /**
   * Seta os dados do retorno
   *
   * @param array $data
   */
  public function setData(array $data): void;

  /**
   * Seta os dados do debug
   *
   * @param array $debug
   */
  public function setDebug(array $debug): void;

  /**
   * Seta os link self do recurso da api, ou seja o link do próprio recurso.
   *
   * @param string $link
   */
  public function setLinkSelf(string $link): void;

  /**
   * Seta os link da coleção.
   *
   * @param string $link
   */
  public function setLinkCollection(string $link): void;

  /**
   * Seta link no array links com o nome recebida por parâmetro.
   *
   * @param string $link
   * @param mixed  $name
   */
  public function setLink(string $link, string $name): void;

  /**
   * Seta as mensagens de retorno da api.
   *
   * @param array $arrayMessage
   */
  public function setFeedbackMessage(array $arrayMessage): void;

  /**
   * Seta a data hora da geração do resposta a ser retornado.
   *
   * @return array
   */
  public function setGeneratedAt(): void;

  /**
   * Seta a quantidade total de resgistos na resposta a ser retornado.
   *
   * @param mixed $quantityTotal
   *
   * @return void
   */
  public function setTotal(int $quantityTotal): void;

  /**
   * Obtém as informações setadas no array data, que são os dados relevantes retornados no recurso.
   *
   * @return array
   */
  public function getData(): array;

  /**
   * Obtem dados de debug
   * 
   * @return array
   */
  public function getDebug(): array;

  /**
   * Obtém os links definidos no set.
   *
   * @return array
   */
  public function getLinks(): array;

  /**
   * Obtém as mensagens de retorno da api.
   *
   * @return array
   */
  public function getFeedbackMessage(): array;

  /**
   * Obtém a data hora da geração do resposta a ser retornado.
   *
   * @return DateTime
   */
  public function getGeneratedAt(): DateTime;

  /**
   * Obtém a quantidade de registros retornados.
   *
   * @return int
   */
  public function getTotal(): int;

  /**
   * <p>Serializa o formato a ser retornado pelo recurso da api</p>
   * <p>contendo: </p>
   * <li> <b>_links: </b> Links de navegação da api </li>
   * <li> <b>data: </b> Dados retornados </li>
   * <li> <b>feedback: </b> Mensagens de retorno. ( Sucesso, erro, etc.) </li>.
   *
   * @return array
   */
  public function getApiResponse($withPagination = false): array;

  /**
   * Seta dados no retorno para listas com paginação
   *
   * @param Collection $collection
   * @return array
   */
  public function setReturnWithPagination($collection): void;
}
