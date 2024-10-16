# Solo Configs

Solo Configs is a simple PHP package for managing configuration settings in your application. It allows you to easily retrieve configuration values by key, and it supports fetching all configurations if no key is specified.

## Installation

You can install the package via Composer. Run the following command in your terminal:

```bash
composer require solo/configs
```

## Usage

To use the `Configs` class, you first need to create an instance of it by passing an array of configurations. After that, you can retrieve specific configurations using the `get()` method or by accessing them as properties.

### Example

```php
require 'vendor/autoload.php';

use Solo\Configs;

// Create a new instance with your configurations
$configs = new Configs([
    'database' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'secret',
    ],
    'app_name' => 'My Application',
]);

// Get a specific configuration
$dbHost = $configs->get('database')['host']; // 'localhost'

// Get all configurations
$allConfigs = $configs->get(); // Returns the entire configs array

// Using magic method
$appName = $configs->app_name; // 'My Application'
```

## Methods

### `public function get(string $key = '')`

- **Parameters:**
    - `string $key` (optional): The configuration key to retrieve.

- **Returns:** The configuration value(s) or `null` if not found.

### `public function __get(string $key)`

- **Parameters:**
    - `string $key`: The configuration key to retrieve.

- **Returns:** The configuration value or `null` if not found.

## License

This package is open-source and available under the [MIT License](LICENSE).
