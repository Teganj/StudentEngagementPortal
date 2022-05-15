<?php
class UserTest extends \PHPUnit\Framework\TestCase{
    use DatabaseMigrations;

    public function testLoginTrue()
    {
        $credential = [
            'email' => 'user',
            'password' => '123456'
        ];
        $this->post('login',$credential)->assertRedirect('/');
    }

    public function testLoginFalse()
    {
        $credential = [
            'email' => 'user@ad.com',
            'password' => 'incorrectpass'
        ];

        $response = $this->post('login',$credential);

        $response->assertSessionHasErrors();
    }
}
