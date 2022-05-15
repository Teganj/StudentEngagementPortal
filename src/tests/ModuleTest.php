<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class ModuleTest extends TestCase
{
    public function testSuccesslidEmail(): void
    {
        $this->assertInstanceOf(
            Email::class,
            Email::fromString('user@example.com')
        );
    }
    public function testDangerInvalidEmail(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Email::fromString('invalid');
    }

    public function testCanBeUsedAsString(): void
    {
        $this->assertEquals(
            'user@example.com',
            Email::fromString('user@example.com')
        );
    }
}




