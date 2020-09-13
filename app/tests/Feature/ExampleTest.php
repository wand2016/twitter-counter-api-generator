<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        var_dump(config('database'));

        var_dump(app()->environment());
        var_dump(DB::connection()->select('SHOW TABLES'));
        var_dump(DB::connection()->select('select 1 from dual'));
    }
}
