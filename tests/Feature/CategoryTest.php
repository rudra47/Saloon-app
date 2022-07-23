<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use \App\Models\Category;
use \App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Str;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_category_list_data()
    {
        $category = Category::factory()->create();

        $response = $this->actingAsAdmin()
                         ->get('/admin/categories');

        $response->assertSee($category->name);

        // $response = $this->get('/admin/categories');

        // $response->assertSee('hello');
    }

    public function test_authentic_admin_can_create_category()
    {
        $data=[
            'name' => 'T Shirt',
            'slug' => Str::slug('T Shirt')
        ];

        $this->actingAsAdmin()
            ->post('/admin/categories', $data);

        $this->assertEquals(1, Category::all()->count());
    }

    public function test_unauthenticated_admin_cannot_create_category()
    {
        $data=[
            'name' => 'T Shirt',
            'slug' => Str::slug('T Shirt')
        ];

        $this->clearCache();

        $response = $this->post('/admin/categories', $data);

        $response->assertRedirect('/login');
    }
    
    public function test_admin_can_edit_category()
    {
        $category = Category::factory()->create();

        $this->actingAsAdmin()
             ->put('admin/categories/'.$category->id, ['name' => 'Half Pant']);

        $this->assertEquals('Half Pant', Category::where('id', $category->id)->first()->name);
    }

    public function test_unauthenticated_admin_cannot_edit_category()
    {
        $category = Category::factory()->create();
        $data=[
            'name' => 'T Shirt'
        ];

        $this->clearCache();

        $response = $this->put('/admin/categories/'.$category->id, $data);

        $response->assertRedirect('/login');
    }

    public function test_admin_can_delete_the_task(){
        $category = Category::factory()->create();
        
        $this->actingAsAdmin()->delete('/admin/categories/'.$category->id);

        $this->assertDatabaseMissing('categories',['id'=> $category->id]);
    }
}
 