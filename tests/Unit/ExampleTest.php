<?php

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class, RefreshDatabase::class);

test('the application returns a successful response', function () {
    $response = $this->getJson('/');

    $response->assertOk();
});
