# Solo Configs

[![Latest Version on Packagist](https://img.shields.io/packagist/v/solophp/configs.svg)](https://packagist.org/packages/solophp/configs)
[![License](https://img.shields.io/packagist/l/solophp/configs.svg)](https://github.com/solophp/configs/blob/main/LICENSE)
[![PHP Version](https://img.shields.io/packagist/php-v/solophp/configs.svg)](https://packagist.org/packages/solophp/configs)

Solo Configs is a simple PHP package for managing configuration settings in your application. It provides easy access to configuration values using dot notation and supports default values if a key is not found.

## Requirements

- PHP 8.1 or higher

## Installation

You can install the package via Composer:

```bash
composer require solophp/configs
```

## Usage

Create an instance of `Configs` by passing an array of configurations. You can then retrieve values using dot notation.

### Basic Usage

```php
use Solo\Configs\Configs;

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

// Note: Magic method access is limited in PHP due to property name restrictions
// It's recommended to use the get() method directly for best compatibility
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

Magic method for property access (limited functionality in PHP).

**Parameters:**
- `string $key`: Configuration key

**Returns:** Configuration value or null if not found

**Note:** Due to PHP limitations with property names containing special characters, it's recommended to use the `get()` method directly.

## Development

### Running Tests

```bash
composer test
```

### Code Style

Check code style:
```bash
composer cs
```

Fix code style:
```bash
composer cs-fix
```

## License

This package is open-source and available under the [MIT License](LICENSE).
