<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class CourseTest extends TestCase{
    public function testSuccessCourseName(): void{
        $this->assertInstanceOf(
            Text::class,
            Text::fromString('HDip in Computing')
        );
    }
    public function testDangerCourseName(): void{
        $this->expectException(InvalidArgumentException::class);

        Text::fromString('1');
    }
    public function testStringCourseName(): void{
        $this->assertEquals(
            'HDip in Computing',
            Text::fromString('HDip in Computing')
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
}




