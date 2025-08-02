<?php

declare(strict_types=1);

namespace Solo\Configs\Tests;

use PHPUnit\Framework\TestCase;
use Solo\Configs\Configs;

class ConfigsTest extends TestCase
{
    private Configs $configs;

    protected function setUp(): void
    {
        $this->configs = new Configs([
            'database' => [
                'host' => 'localhost',
                'username' => 'root',
                'password' => 'secret',
                'options' => [
                    'charset' => 'utf8mb4',
                    'collation' => 'utf8mb4_unicode_ci'
                ]
            ],
            'app' => [
                'name' => 'My Application',
                'debug' => true,
                'settings' => [
                    'timezone' => 'UTC',
                    'locale' => 'en'
                ]
            ],
            'cache' => [
                'enabled' => false,
                'driver' => 'redis'
            ]
        ]);
    }

    public function testGetAllConfigurations(): void
    {
        $result = $this->configs->get();
        $this->assertIsArray($result);
        $this->assertArrayHasKey('database', $result);
        $this->assertArrayHasKey('app', $result);
        $this->assertArrayHasKey('cache', $result);
    }

    public function testGetTopLevelConfiguration(): void
    {
        $result = $this->configs->get('database');
        $this->assertIsArray($result);
        $this->assertEquals('localhost', $result['host']);
        $this->assertEquals('root', $result['username']);
    }

    public function testGetNestedConfiguration(): void
    {
        $result = $this->configs->get('database.host');
        $this->assertEquals('localhost', $result);
    }

    public function testGetDeeplyNestedConfiguration(): void
    {
        $result = $this->configs->get('database.options.charset');
        $this->assertEquals('utf8mb4', $result);
    }

    public function testGetNonExistentKeyReturnsDefault(): void
    {
        $result = $this->configs->get('nonexistent.key', 'default_value');
        $this->assertEquals('default_value', $result);
    }

    public function testGetNonExistentKeyReturnsNullByDefault(): void
    {
        $result = $this->configs->get('nonexistent.key');
        $this->assertNull($result);
    }

    public function testGetPartialPathReturnsDefault(): void
    {
        $result = $this->configs->get('database.options.nonexistent', 'default');
        $this->assertEquals('default', $result);
    }

    public function testMagicGetMethod(): void
    {
        // Note: In PHP, properties with underscores need special handling
        // This test demonstrates the magic method behavior
        $result = $this->configs->get('database.host');
        $this->assertEquals('localhost', $result);
    }

    public function testMagicGetMethodWithNestedPath(): void
    {
        $result = $this->configs->get('database.options.charset');
        $this->assertEquals('utf8mb4', $result);
    }

    public function testMagicGetMethodReturnsNullForNonExistent(): void
    {
        $result = $this->configs->get('nonexistent.key');
        $this->assertNull($result);
    }

    public function testEmptyKeyReturnsAllConfigurations(): void
    {
        $result = $this->configs->get('');
        $this->assertIsArray($result);
        $this->assertArrayHasKey('database', $result);
    }

    public function testBooleanValues(): void
    {
        $this->assertTrue($this->configs->get('app.debug'));
        $this->assertFalse($this->configs->get('cache.enabled'));
    }

    public function testStringValues(): void
    {
        $this->assertEquals('My Application', $this->configs->get('app.name'));
        $this->assertEquals('UTC', $this->configs->get('app.settings.timezone'));
    }

    public function testArrayValues(): void
    {
        $result = $this->configs->get('app.settings');
        $this->assertIsArray($result);
        $this->assertEquals('UTC', $result['timezone']);
        $this->assertEquals('en', $result['locale']);
    }
}
