<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Database\Factories\TeamFactory;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password

        $team = $this->withPersonalTeam(
            $user = User::forceCreate([
                'name' => 'Taylor Otwell',
                'email' => 'taylor@laravel.com',
                'password' => $password,
            ]),
            'Laravel'
        );

        $this->withPersonalTeam(
            User::forceCreate([
                'name' => 'Mohamed Said',
                'email' => 'mohamed@laravel.com',
                'password' => $password,
            ])
        );

        $this->withPersonalTeam(
            User::forceCreate([
                'name' => 'David Hemphill',
                'email' => 'david@laravel.com',
                'password' => $password,
            ])
        );

        $this->withPersonalTeam(
            User::forceCreate([
                'name' => 'Laravel Nova',
                'email' => 'nova@laravel.com',
                'password' => $password,
            ])
        );

        $team->users()->attach(
            User::whereNotIn('id', [$user->getKey()])->pluck('id')
        );
    }

    /**
     * Create personal team.
     *
     * @param  \App\Models\User  $user
     * @param  string|null $name
     * @return \App\Models\Team
     */
    protected function withPersonalTeam(User $user, string $name = null): Team
    {
        return TeamFactory::new()->create(array_filter([
            'user_id' => $user->getKey(),
            'name' => $name,
            'personal_team' => true,
        ]));
    }
}
