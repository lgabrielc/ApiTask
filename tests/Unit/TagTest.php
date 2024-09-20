<?php

namespace Tests\Unit;

use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     */

    public function test_create_tag()
    {
        $data = [
            'name' => 'Juegos'
        ];
        $response = $this->postJson('api/tags', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('tags', $data);
    }
    public function test_get_all_tags()
    {
        $data = [
            [

                'name' => 'Juegos'
            ],
            [

                'name' => 'Videos'
            ],
        ];
        Tag::insert($data);
        $response = $this->getJson('/api/tags');

        $response->assertStatus(200)
            ->assertJsonCount(2);
        $response->assertJson([
            [
                'name' => 'Juegos',
            ]
        ]);
    }
    public function test_update_tag()
    {
        $data = [
            'name' => 'Jueguitos'
        ];
        $data2 = [
            'name' => 'Videitos'
        ];
        $response = $this->postJson('api/tags', $data);

        $response = $this->putJson('/api/tags/4', $data2);
        $response->assertStatus(200);
        $response->assertJson($data2);
        $this->assertDatabaseHas('tags', $data2);
    }
    public function test_delete_tag()
    {
        $data = [
            'name' => 'Animes'
        ];
        $this->postJson('api/tags', $data);

        $response = $this->deleteJson('api/tags/5',$data);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('tags',$data);
    }
}
