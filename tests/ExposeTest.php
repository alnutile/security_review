<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExposeTest extends TestCase
{
    public function testPost()
    {
        $token = csrf_token();
        $data = array(
                '_token' => $token,
                'test' => 'foo',
                'bar' => array(
                    'baz' => 'quux',
                    'testing' => '<script>test</script>'
                )
        );

        $this->call('POST', 'expose', $data);
    }
}
