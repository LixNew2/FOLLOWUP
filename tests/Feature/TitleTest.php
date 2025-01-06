<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TitleTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_title_contains_hello_world(): void
    {
        $response = $this->get('/');

        $response->assertSeeInOrder(['<title>', 'Hello World', '</title>']);
    }
}
