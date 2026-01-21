<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Agent;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer un admin principal
        $admin = User::create([
            'name' => 'Admin Principal',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Créer d'autres admins
        $admins = [
            [
                'name' => 'Ahmed Admin',
                'email' => 'ahmed@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Fatima Admin',
                'email' => 'fatima@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
        ];

        foreach ($admins as $adminData) {
            User::create($adminData);
        }

        // Créer des agents avec leurs informations
        $agents = [
            [
                'user' => [
                    'name' => 'Mohammed Agent',
                    'email' => 'mohammed@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'agent',
                ],
                'agent' => [
                    'nom' => 'Mohammed Alami',
                    'telephone' => '0612345678',
                    'adresse' => 'Rue 1, Rabat',
                ],
            ],
            [
                'user' => [
                    'name' => 'Amina Agent',
                    'email' => 'amina@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'agent',
                ],
                'agent' => [
                    'nom' => 'Amina Benali',
                    'telephone' => '0623456789',
                    'adresse' => 'Rue 2, Casablanca',
                ],
            ],
            [
                'user' => [
                    'name' => 'Youssef Agent',
                    'email' => 'youssef@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'agent',
                ],
                'agent' => [
                    'nom' => 'Youssef Idrissi',
                    'telephone' => '0634567890',
                    'adresse' => 'Rue 3, Marrakech',
                ],
            ],
            [
                'user' => [
                    'name' => 'Khadija Agent',
                    'email' => 'khadija@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'agent',
                ],
                'agent' => [
                    'nom' => 'Khadija Tazi',
                    'telephone' => '0645678901',
                    'adresse' => 'Rue 4, Fès',
                ],
            ],
            [
                'user' => [
                    'name' => 'Omar Agent',
                    'email' => 'omar@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'agent',
                ],
                'agent' => [
                    'nom' => 'Omar Benjelloun',
                    'telephone' => '0656789012',
                    'adresse' => 'Rue 5, Tanger',
                ],
            ],
            [
                'user' => [
                    'name' => 'Salma Agent',
                    'email' => 'salma@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'agent',
                ],
                'agent' => [
                    'nom' => 'Salma Chakir',
                    'telephone' => '0667890123',
                    'adresse' => 'Rue 6, Agadir',
                ],
            ],
            [
                'user' => [
                    'name' => 'Karim Agent',
                    'email' => 'karim@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'agent',
                ],
                'agent' => [
                    'nom' => 'Karim El Amrani',
                    'telephone' => '0678901234',
                    'adresse' => 'Rue 7, Oujda',
                ],
            ],
            [
                'user' => [
                    'name' => 'Zineb Agent',
                    'email' => 'zineb@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'agent',
                ],
                'agent' => [
                    'nom' => 'Zineb Fassi',
                    'telephone' => '0689012345',
                    'adresse' => 'Rue 8, Meknès',
                ],
            ],
        ];

        foreach ($agents as $agentData) {
            // Créer l'utilisateur
            $user = User::create($agentData['user']);
            
            // Créer l'agent lié
            Agent::create([
                'user_id' => $user->id,
                'nom' => $agentData['agent']['nom'],
                'telephone' => $agentData['agent']['telephone'],
                'adresse' => $agentData['agent']['adresse'],
            ]);
        }

        $this->command->info('✅ Utilisateurs créés avec succès!');
        $this->command->info('📧 Email: admin@example.com | Password: password');
    }
}