<?php

namespace Tests\Feature\API;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Book;
use Illuminate\Testing\Fluent\AssertableJson;


class BooksControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_books_get_endpoint()
    {
        // $book = Book::factory()->create();
        $response = $this->getJson('/api/books');

        $response->assertStatus(200);
        $response->assertJsonCount(5);

        $response->assertJson(function(AssertableJson $json){
            $json->whereType('0.id', 'integer');
            $json->whereType('0.title', 'string');
            $json->whereType('0.isbn', 'string');

            $json->hasAll(['0.id', '0.title', '0.isbn']);

            

            $json->whereAll([
                '0.id' => $book->id,
                '0.title' => $book->title,
                '0.isbn' => $book->isbn
            ]);
        });

    }
}
