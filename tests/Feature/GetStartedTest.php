<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class GetStartedTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }
    public function testGetStartedReturns201WithNoFile()
    {
        $response = $this->post(
            route('get.started'),
            [
                'name' => 'Jane',
                'email' => 'jane@email.com',
            ],
            [
                'Accept' => 'application/json'
            ]
        );

        $response->assertStatus(Response::HTTP_CREATED);
    }

    public function testGetStartedReturns201()
    {
        $file = UploadedFile::fake()->image('image_one.jpg');
        Storage::fake('local');

        $response = $this->post(
            route('get.started'),
            [
                'name' => 'Jane',
                'email' => 'jane@email.com',
                'image' => $file
            ],
            [
                'Accept' => 'application/json'
            ]
        );

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertDatabaseHas('users', ['name' => 'Jane', 'email' => 'jane@email.com']);
        $this->assertDatabaseHas('uploaded_files', ['original_filename' => 'image_one.jpg']);
    }

    public function testGetStartedReturns422()
    {
        $file = UploadedFile::fake()->image('image_one.jpg');
        Storage::fake('local');

        $response = $this->post(
            route('get.started'),
            [
                'name' => 'Jane',
                'email' => 'email.com',
                'image' => $file
            ],
            [
                'Accept' => 'application/json'
            ]
        );

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
