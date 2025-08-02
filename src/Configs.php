<?php

declare(strict_types=1);

namespace Solo\Configs;

class Configs
{
    private array $configs;

    public function __construct(array $configs)
    {
        $this->configs = $configs;
    }

    /**
     * Get a specific configuration by key, or all configurations if no key is provided.
     * Supports dot notation for accessing nested values.
     * Returns default value if the key does not exist.
     *
     * @param string $key The configuration key (optional).
     * @param mixed $default Default value if key not found
     * @return mixed The configuration value(s) or default if not found.
     */
    public function get(string $key = '', mixed $default = null): mixed
    {
        if (empty($key)) {
            return $this->configs;
        }

        $segments = explode('.', $key);
        $data = $this->configs;

        foreach ($segments as $segment) {
            if (!is_array($data) || !array_key_exists($segment, $data)) {
                return $default;
            }
            $data = $data[$segment];
        }

        return $data;
    }

    /**
     * Magic method to get a configuration.
     *
     * @param string $key The configuration key.
     * @return mixed The configuration value or null if not found.
     */
    public function __get(string $key): mixed
    {
        return $this->get($key);
    }
}
