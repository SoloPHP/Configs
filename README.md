# Solo Configs

Solo Configs is a simple PHP package for managing configuration settings in your application. It provides easy access to configuration values using dot notation and supports default values if a key is not found.

## Requirements

- PHP 8.1 or higher

## Installation

You can install the package via Composer:

```bash
composer require solo/configs
```

## Usage

Create an instance of `Configs` by passing an array of configurations. You can then retrieve values using dot notation or access them as properties.

### Basic Usage

```php
use Solo\Configs;

// Create a new instance with your configurations
$configs = new Configs([
    'database' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'secret',
    ],
    'app' => [
        'name' => 'My Application',
        'debug' => true,
        'settings' => [
            'timezone' => 'UTC'
        ]
    ]
]);

// Get values using dot notation
$dbHost = $configs->get('database.host');          // 'localhost'
$appName = $configs->get('app.name');             // 'My Application'
$timezone = $configs->get('app.settings.timezone'); // 'UTC'

// Using default values
$cache = $configs->get('cache.enabled', false);    // false (using default)

// Get entire sections
$dbConfig = $configs->get('database');    // Returns entire database array
$allConfigs = $configs->get();           // Returns all configurations

// Using magic method
$appName = $configs->app_name;           // 'My Application'
```

### Configuration Structure

Your configuration array can be as deeply nested as needed:

```php
$configs = new Configs([
    'session' => [
        'lifetime' => 86400,
        'options' => [
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Lax'
        ]
    ],
    'cache' => [
        'driver' => 'redis',
        'connection' => [
            'host' => 'localhost',
            'port' => 6379
        ]
    ]
]);
```

## API Reference

### Methods

#### Constructor

```php
public function __construct(array $configs)
```

Creates a new Configs instance.

**Parameters:**
- `array $configs`: Configuration array

#### Get Configuration Value

```php
public function get(string $key = '', mixed $default = null): mixed
```

Retrieves a configuration value using dot notation.

**Parameters:**
- `string $key`: Configuration key using dot notation (optional)
- `mixed $default`: Default value if key not found

**Returns:** Configuration value or default if not found

#### Magic Property Access

```php
public function __get(string $key): mixed
```

Magic method to access configurations as properties.

**Parameters:**
- `string $key`: Configuration key

**Returns:** Configuration value or null if not found

## License

This package is open-source and available under the [MIT License](LICENSE).
