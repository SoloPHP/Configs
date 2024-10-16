<?php

namespace Solo;

class Configs
{
    private array $configs;

    public function __construct(array $configs)
    {
        $this->configs = $configs;
    }

    /**
     * Get a specific configuration by key, or all configurations if no key is provided.
     * Returns null if the key does not exist.
     *
     * @param string $key The configuration key (optional).
     * @return mixed|null The configuration value(s) or null if not found.
     */
    public function get(string $key = '')
    {
        return (empty($key)) ? $this->configs : $this->configs[$key] ?? null;
    }

    /**
     * Magic method to get a configuration.
     *
     * @param string $key The configuration key.
     * @return mixed|null The configuration value or null if not found.
     */
    public function __get(string $key)
    {
        return $this->get($key);
    }
}
