<?php

class FileRenamer
{
    private $basePath;
    private $directories = [
        'calls' => [
            'views' => [
                'from' => ['index.blade.php', 'create.blade.php', 'edit.blade.php', 'show.blade.php'],
                'to' => ['index_calls.blade.php', 'create_calls.blade.php', 'edit_calls.blade.php', 'show_calls.blade.php']
            ],
            'controller' => [
                'from' => 'CallController.php',
                'to' => 'CallsController.php'
            ],
            'model' => [
                'from' => 'Call.php',
                'to' => 'Calls.php'
            ]
        ],
        'servers' => [
            'views' => [
                'create' => ['index_servers.blade.php', 'create_servers.blade.php', 'edit_servers.blade.php', 'show_servers.blade.php']
            ],
            'controller' => [
                'create' => 'ServersController.php'
            ],
            'model' => [
                'create' => 'Server.php'
            ]
        ],
        'problem_descriptions' => [
            'views' => [
                'create' => ['index_problem_descriptions.blade.php', 'create_problem_descriptions.blade.php', 'edit_problem_descriptions.blade.php', 'show_problem_descriptions.blade.php']
            ],
            'controller' => [
                'create' => 'ProblemDescriptionsController.php'
            ],
            'model' => [
                'create' => 'ProblemDescription.php'
            ]
        ]
    ];

    public function __construct()
    {
        $this->basePath = dirname(__FILE__);
    }

    public function run()
    {
        foreach ($this->directories as $module => $config) {
            // Criar diretórios de views se não existirem
            $viewPath = $this->basePath . '/resources/views/' . $module;
            if (!is_dir($viewPath)) {
                mkdir($viewPath, 0755, true);
                echo "Diretório criado: {$viewPath}\n";
            }

            // Renomear/criar arquivos de views
            if (isset($config['views']['from'])) {
                // Renomear arquivos existentes
                for ($i = 0; $i < count($config['views']['from']); $i++) {
                    $oldFile = $viewPath . '/' . $config['views']['from'][$i];
                    $newFile = $viewPath . '/' . $config['views']['to'][$i];
                    if (file_exists($oldFile)) {
                        rename($oldFile, $newFile);
                        echo "Arquivo renomeado: {$oldFile} -> {$newFile}\n";
                    }
                }
            } elseif (isset($config['views']['create'])) {
                // Criar novos arquivos
                foreach ($config['views']['create'] as $file) {
                    $newFile = $viewPath . '/' . $file;
                    if (!file_exists($newFile)) {
                        file_put_contents($newFile, $this->getViewTemplate($file));
                        echo "Arquivo criado: {$newFile}\n";
                    }
                }
            }

            // Renomear/criar controllers
            $controllerPath = $this->basePath . '/app/Http/Controllers/';
            if (isset($config['controller']['from'])) {
                $oldFile = $controllerPath . $config['controller']['from'];
                $newFile = $controllerPath . $config['controller']['to'];
                if (file_exists($oldFile)) {
                    rename($oldFile, $newFile);
                    echo "Controller renomeado: {$oldFile} -> {$newFile}\n";
                }
            } elseif (isset($config['controller']['create'])) {
                $newFile = $controllerPath . $config['controller']['create'];
                if (!file_exists($newFile)) {
                    file_put_contents($newFile, $this->getControllerTemplate($module));
                    echo "Controller criado: {$newFile}\n";
                }
            }

            // Renomear/criar models
            $modelPath = $this->basePath . '/app/Models/';
            if (isset($config['model']['from'])) {
                $oldFile = $modelPath . $config['model']['from'];
                $newFile = $modelPath . $config['model']['to'];
                if (file_exists($oldFile)) {
                    rename($oldFile, $newFile);
                    echo "Model renomeado: {$oldFile} -> {$newFile}\n";
                }
            } elseif (isset($config['model']['create'])) {
                $newFile = $modelPath . $config['model']['create'];
                if (!file_exists($newFile)) {
                    file_put_contents($newFile, $this->getModelTemplate($module));
                    echo "Model criado: {$newFile}\n";
                }
            }
        }

        echo "\nProcesso de renomeação concluído!\n";
    }

    private function getViewTemplate($filename)
    {
        return "@extends('layouts.app')\n\n@section('content')\n// Template para {$filename}\n@endsection";
    }

    private function getControllerTemplate($module)
    {
        $className = ucfirst($module) . 'Controller';
        return "<?php\n\nnamespace App\Http\Controllers;\n\nclass {$className} extends Controller\n{\n    // Template do Controller\n}";
    }

    private function getModelTemplate($module)
    {
        $className = ucfirst($module);
        return "<?php\n\nnamespace App\Models;\n\nclass {$className} extends Model\n{\n    // Template do Model\n}";
    }
}

// Executar o script
$renamer = new FileRenamer();
$renamer->run();