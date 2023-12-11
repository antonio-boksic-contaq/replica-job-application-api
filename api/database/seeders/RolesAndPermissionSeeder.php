<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $sections = [
            'acquisition channel' => 'Canali di acquisizione',
            'candidate' => 'Candidati',
            'internal training session' => 'Corsi di formazione per candidati',
            'contract classification' => 'Classificazione contratto',
            'contract duty' => 'Mansioni contratto',
            'contract rejection reason' => 'Motivi di rifiuto del contratto',
            'contract sector' => 'Settore contratto',
            'contract type' => 'Tipi di contratto',
            'headquarter' => 'Sedi',
            'internal training' => 'Formazione interna',
            'job application rejection reason' => 'Motivi di rifiuto colloquio',
            'job application result' => 'Esiti colloquio',
            'job application' => 'Colloquio',
            'job position' => 'Posizioni lavorative',
            'question' => 'Domande',
            'skill' => 'Competenze',
            'skill type' => 'Tipi di competenze',
            'training course' => 'Corsi di formazione',
            'user' => 'Utenti',
            'user contract' => 'Contratti',
            'user training course' => 'Corsi di formazione per gli utenti',
            'role' => 'Ruoli',
            'permission' => 'Permessi',
            'staff request' => 'Richiesta personale',
            'digital asset type' => 'Tipologia asset digitali',
            'digital asset status' => 'Status asset digitali',
            'device asset type' => 'Tipologia asset fisici',
            'device asset status' => 'Status asset fisici',
            'device asset feature' => 'Caratteristiche asset fisici',
            'asset assignment' => 'Assegnazione asset',
            'digital asset' => 'Asset digitali',
            'device asset' => 'Asset fisici',
        ];

        // il base permission viene popolato con il foreach sotto
        $basePermissions = [];
        
        foreach($sections as $key => $value){

            // se la key è user
            if($key == 'user'){
                $basePermissions[] = [
                    'name' => 'create user from candidate',
                    'label' => 'Creare un utente da un candidato',
                ];
                $basePermissions[] = [
                    'name' => 'create user from scratch',
                    'label' => 'Creare un utente da zero',
                ];
                $basePermissions[] = [
                    'name' => 'bind user and headquarter',
                    'label' => 'Legare utenti e sedi',
                ];
            }

            // se la key è user contract
            if ($key == 'user contract') {
                $basePermissions[] = [
                    'name' => 'can extend '.$key,
                    'label' => 'Gestire proroga del contratto',
                ];
                $basePermissions[] = [
                    'name' => 'end '.$key,
                    'label' => 'Terminare contratto',
                ];
            }

            // se la key è diversa da user
            if($key != 'user'){
                $basePermissions[] = [
                    'name' => 'create ' . $key,
                    'label' => 'Creare '. strtolower($value),
                ];
            }
                
            $basePermissions[] = [
                'name' => 'see ' . $key,
                'label' => 'Vedere '. strtolower($value),
            ];
            $basePermissions[] = [
                'name' => 'update ' . $key,
                'label' => 'Modificare '. strtolower($value),
            ];
            $basePermissions[] = [
                'name' => 'select ' . $key,
                'label' => 'Selezionare '. strtolower($value),
            ];
            $basePermissions[] = [
                'name' => 'delete ' . $key,
                'label' => 'Cancellare '. strtolower($value),
            ];
            $basePermissions[] = [
                'name' => 'restore ' . $key,
                'label' => 'Ripristinare '. strtolower($value),
            ];
            $basePermissions[] = [
                'name' => 'see trashed ' . $key,
                'label' => 'Vedere '.strtolower($value).' cancellati',
            ];
        }

        $permissions = collect($basePermissions)->map(function ($permission) {
            return ['name' => $permission['name'], 'label' => $permission['label'], 'guard_name' => 'api', 'software' => 'hr'];
        });

        //inserisco i permessi nella loro tabella
        Permission::insert($permissions->toArray());

        // DA QUI GESTISCO I RUOLI

        // create role and give permissions to role
        $role = Role::create(['name' => 'System Admin','guard_name' => 'api']);
        $role->givePermissionTo(Permission::all());
        
        $role = Role::create(['name' => 'HR Admin','guard_name' => 'api']);
        $role->givePermissionTo(Permission::where('name', 'not like', '%role')->get());

        $role = Role::create(['name' => 'HR Sede','guard_name' => 'api']);
        $role->givePermissionTo(Permission::where('name', 'like', '%candidate')
        ->orWhere('name', 'like', '%internal training session')
        ->orWhere('name', 'like', '%job application')
        ->get());

        $role->givePermissionTo([
            'see user', 
            'create user from candidate', 
            'update user', 
            'delete user', 
            'create user contract', 
            'see user contract', 
            'select user contract',
            'end user contract',
        ]);

        $role = Role::create(['name' => 'Supervisor','guard_name' => 'api']);
        $role->givePermissionTo([
            'see staff request', 
            'create staff request', 
            'see user contract', 
            'can extend user contract',
        ]);

        $role = Role::create(['name' => 'Operatore','guard_name' => 'api']);

        $role = Role::create(['name' => 'Helpdesk', 'guard_name' => 'api']);
        $role->givePermissionTo(Permission::where('name', 'like', '%asset%')->get());
    }
}