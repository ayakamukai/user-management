<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Bookmark;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        Bookmark::truncate();
        factory(User::class, 50)
            ->create()
            ->each(function (User $user) {
                $user->bookmark()->saveMany(
                    factory(Bookmark::class, rand(5, 55))
                        ->create([
                            'user_id' => $user->id
                        ])
                );
            });
    }
}
