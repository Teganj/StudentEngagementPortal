<?php
class CourseTest extends \PHPUnit\Framework\TestCase{
        public function testAdd(){

            $course = new App\courses;
            $result = $course->("PGDip Computing", "PGDipComp");

            $this->assertEquals("pgdip", $result);
        }

}