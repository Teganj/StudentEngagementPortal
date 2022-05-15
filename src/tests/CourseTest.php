<?php
class CourseTest extends \PHPUnit\Framework\TestCase{
        public function testCourse(){

            $course = new App\courses;
            $result = $course->(["PGDip Computing", "PGDipComp"]);
            $expected = ["PGDip Computing", "PGDipComp"];
            $this->assertEquals($expected, $result);
        }
        public function testDelete(){
            $course = new App\courses;
        }

}