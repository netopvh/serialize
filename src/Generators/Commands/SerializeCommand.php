<?php

namespace NetoPvh\ResponseSerialize\Generators\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use NetoPvh\ResponseSerialize\Exceptions\FileAlreadyExistsException;
use NetoPvh\ResponseSerialize\Generators\SerializeGenerator;
use NetoPvh\ResponseSerialize\Generators\SerializeInterfaceGenerator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class SerializeCommand
 * @package NetoPvh\ResponseSerialize\Generators\Commands
 * @author Angelo Neto <netopvh@gmail.com>
 */
class SerializeCommand extends Command
{

  /**
   * The name of command.
   *
   * @var string
   */
  protected $name = 'make:serialize';

  /**
   * The description of command.
   *
   * @var string
   */
  protected $description = 'Create a new serialize.';

  /**
   * The type of class being generated.
   *
   * @var string
   */
  protected $type = 'Serialize';

  /**
   * @var Collection
   */
  protected $generators = null;


  /**
   * Execute the command.
   *
   * @see fire()
   * @return void
   */
  public function handle()
  {
    $this->laravel->call([$this, 'fire'], func_get_args());
  }

  /**
   * Execute the command.
   *
   * @return void
   */
  public function fire()
  {
    try {

      // (new SerializeInterfaceGenerator([
      //   'name'  => $this->argument('name'),
      //   'force' => $this->option('force'),
      // ]))->run();

      (new SerializeGenerator([
        'name'      => $this->argument('name'),
        'force'     => $this->option('force'),
      ]))->run();

      $this->info("Serialize created successfully.");
    } catch (Exception $e) {
      $this->error($this->type . $e->getMessage());

      return false;
    }
  }


  /**
   * The array of command arguments.
   *
   * @return array
   */
  public function getArguments()
  {
    return [
      [
        'name',
        InputArgument::REQUIRED,
        'The name of class being generated.',
        null
      ],
    ];
  }


  /**
   * The array of command options.
   *
   * @return array
   */
  public function getOptions()
  {
    return [
      [
        'force',
        'f',
        InputOption::VALUE_NONE,
        'Force the creation if file already exists.',
        null
      ],
    ];
  }
}
