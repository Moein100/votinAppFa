<?php

namespace Database\Seeders;

use App\Models\AbouteUs;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Idea;
use App\Models\Status;
use App\Models\Vote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create(
            [
                'name' => 'moein',
                'email' =>'moein.kia.20@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('moeinkia1380!@#$'), // password
                'remember_token' => Str::random(10),
            ]);
        \App\Models\User::factory(19)->create();
        // Category::factory(4)->create();
        Category::factory()->create(['name' => 'عمومی']);
        Category::factory()->create(['name' => 'دانشگاه']);
        Category::factory()->create(['name' => 'علمی']);
        Category::factory()->create(['name' => 'آگهی']);
        Status::factory()->create(['name' => 'Open' ,'name_fa' => 'باز']);
        Status::factory()->create(['name' => 'good','name_fa' => 'خوب']);
        Status::factory()->create(['name' => 'great','name_fa' => 'عالی']);
        Status::factory()->create(['name' => 'warning','name_fa' => 'اخطار']);
        Status::factory()->create(['name' => 'delete','name_fa' => 'حذف']);
        Idea::factory(100)->create();


        //generate unique votes.Ensure idea_id and user_id are unique for each row

        foreach(range(1,20) as $user_id)
        {
            foreach(range(1,100) as $idea_id)
            {
                if($idea_id % 2 == 0)
                {
                    Vote::factory()->create(
                        [
                        'user_id' => $user_id,
                         'idea_id' => $idea_id
                        ]);
                }
            }
        }

        // generate comments for ideas
        foreach (Idea::all() as $idea)
        {
            Comment::factory(5)->existing()->create(['idea_id' => $idea->id]);
        }

        AbouteUs::factory(1)->create();
    }
}
