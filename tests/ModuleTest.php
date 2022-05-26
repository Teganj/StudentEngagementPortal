<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class ModuleTest extends TestCase{
    public function testSuccessModuleName(): void{
        $this->assertInstanceOf(
            Text::class,
            Text::fromString('Test Software Development')
        );
    }
    public function testDangerModuleName(): void{
        $this->expectException(InvalidArgumentException::class);

        Text::fromString('1');
    }
    public function testStringModuleName(): void{
        $this->assertEquals(
            'Test Software Development',
            Text::fromString('Test Software Development')
        );
    }
    public function testSuccessCourseID(): void{
        $this->assertInstanceOf(
            Text::class,
            Text::fromString('HDipComp')
        );
    }
    public function testDangerCourseID(): void{
        $this->expectException(InvalidArgumentException::class);

        Text::fromString('invalid');
    }
    public function testStringCourseID(): void{
        $this->assertEquals(
            'HDipComp',
            Text::fromString('HDipComp')
        );
    }
    public function testSuccessFile(): void{
        $this->assertInstanceOf(
            Text::class,
            Text::fromString('HDipComp.csv')
        );
    }
    public function testDangerFile(): void{
        $this->expectException(InvalidArgumentException::class);

        Text::fromString('invalid');
    }
}




