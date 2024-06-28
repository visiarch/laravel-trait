<?php

namespace Visiarch\TraitServiceTrait;

use Illuminate\Console\GeneratorCommand;

/**
 * This file is part of the Laravel Trait package.
 *
 * @author Gusti Bagus Suandana <visiarch@gmail.com> (C)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Class MakeTrait
 */
class MakeTrait extends GeneratorCommand
{
    /**
     * The STUB_PATH constant holds the path to the stub file.
     */
    const STUB_PATH = __DIR__.'/Stubs/';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:trait {name : Create a php trait}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new php trait';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Trait';

    /**
     * Get the stub file path.
     *
     * @return string
     */
    protected function getStub()
    {
        return self::STUB_PATH.'trait.stub';
    }

    /**
     * Execute the console command.
     *
     * @return bool|null
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     *
     * @see \Illuminate\Console\GeneratorCommand
     */
    public function handle()
    {
        if ($this->isReservedName($this->getNameInput())) {
            $this->error('The name "'.$this->getNameInput().'" is reserved by PHP.');

            return false;
        }

        // Get the qualified class name
        $name = $this->qualifyClass($this->getNameInput());

        // Get the file path
        $path = $this->getPath($name);

        // Check if the trait already exists
        if ((! $this->hasOption('force') ||
                ! $this->option('force')) &&
            $this->alreadyExists($this->getNameInput())
        ) {
            $this->error($this->type.' already exists!');

            return false;
        }

        // Create the directory if it does not exist
        $this->makeDirectory($path);

        // Put the trait content into the file
        $this->files->put(
            $path,
            $this->sortImports(
                $this->buildServiceClass($name)
            )
        );

        // Display success message
        $message = $this->type;
        $this->info($message.' created successfully.');
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name  The name of the trait
     * @return string The content of the trait file
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildServiceClass(string $name): string
    {
        $stub = $this->files->get(
            $this->getStub()
        );

        return $this->replaceNamespace($stub, $name)->replaceClass($stub, $name);
    }

    /**
     * Get the default namespace for the trait.
     *
     * @return string The default namespace for the trait
     */
    protected function getDefaultNamespace($rootNamespace): string
    {
        return $rootNamespace.'\Traits';
    }
}
