<?php

namespace LaravelRepositoryGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRepository extends Command
{
    protected $signature = 'make:repository {name}';

    protected $description = 'Create a new repository and interface';

    public function handle()
    {
        $name = $this->argument('name');
        $this->createInterface($name);
        $this->createRepository($name);
        $this->registerBinding($name);

        $this->info("🎉 Repository and Interface created successfully!");
        $this->line("📂 Interface: app/Repositories/Interfaces/{$name}Interface.php");
        $this->line("📂 Repository: app/Repositories/{$name}.php");
        $this->line("🔗 Auto-registered in: app/Providers/AppServiceProvider.php");
    }

    protected function createInterface($name)
    {
        $stub = File::get(__DIR__ . '/stubs/interface.stub');
        $stub = str_replace('{{ class }}', $name, $stub);

        $path = app_path("Repositories/Interfaces/{$name}Interface.php");
        File::ensureDirectoryExists(dirname($path));
        File::put($path, $stub);
    }

    protected function createRepository($name)
    {
        $stub = File::get(__DIR__ . '/stubs/repository.stub');
        $stub = str_replace('{{ class }}', $name, $stub);

        $path = app_path("Repositories/{$name}.php");
        File::ensureDirectoryExists(dirname($path));
        File::put($path, $stub);
    }

    protected function registerBinding($name)
    {
        $interface = "App\\Repositories\\Interfaces\\{$name}Interface";
        $repository = "App\\Repositories\\{$name}";

        $providerPath = app_path('Providers/AppServiceProvider.php');

        $providerContent = file_get_contents($providerPath);

        // Prevent duplicate bindings
        if (str_contains($providerContent, $interface)) {
            $this->warn("Already registered in AppServiceProvider.");
            return;
        }

        // Add use statements if not present
        if (!str_contains($providerContent, "use $interface;")) {
            $providerContent = preg_replace(
                '/namespace App\\\Providers;(\n)/',
                "namespace App\Providers;\n\nuse $interface;\nuse $repository;\n",
                $providerContent
            );
        }

        // Insert binding into register() method
        $providerContent = preg_replace(
            '/public function register\(\): void\s*\{\n/',
            "public function register(): void\n    {\n        \$this->app->bind($name" . "Interface::class, $name::class);\n",
            $providerContent
        );

        file_put_contents($providerPath, $providerContent);
    }
}
