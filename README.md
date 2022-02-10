<p align="center" style="text-align: center">
  <a href="https://cyberwrite.com">
    <img src="https://mk0cyberwrite26avych.kinstacdn.com/wp-content/uploads/2018/02/rightslide.png" alt="Cyberwrite" width="192px" height="192px" title="Cyberwrite"/>
  </a>
</p>

<h1 align="center" style="text-align: center">
  Cyberwrite V3

Hexagonal Architecture, DDD & CQRS
</h1>

## 🚀 Environment Setup

### 🐳 Needed tools

1. [Install Docker](https://www.docker.com/get-started)
2. Clone this project: `git clone https://github.com/cyberwrite/cyberwrite_v3 cyberwrite_v3`
3. Move to the project folder: `cd cyberwrite_v3`

### Code Quality Tools

1. PHPStan (PHP Static Analysis Tool) `./vendor/bin/phpstan --configuration=phpstan.neon`
2. Psalm (static analysis tool) `./vendor/bin/psalm`
3. PHP-CS-Fixer (PHP Coding Standards Fixer)
    1. `./vendor/bin/php-cs-fixer fix --diff` - show difference
    2. `./vendor/bin/php-cs-fixer fix` - format project files
4. PHPCPD (PHP Copy past detector) `./vendor/bin/phpcpd src/`
5. churn-php (display the classes you should refactor) `./vendor/bin/churn run`
6. PhpMetrics `php ./vendor/bin/phpmetrics --config=phpmetrics.json`

### phpDocumentor

Run: `./phpDocumentor.phar`
