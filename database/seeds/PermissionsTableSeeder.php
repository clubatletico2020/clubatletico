<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* ALL-ACCESS */
        Role::create([
            'name'          => 'Gestion Total',
            'slug'          => 'access',
            'description'   => 'Gestionar total del sistema.',
            'special'       => 'all-access',
        ]);

        /* NO-ACCESS */
        Role::create([
            'name'          => 'Gestión Anulada',
            'slug'          => 'noaccess',
            'description'   => 'Gestionar anulada del sistema.',
            'special'       => 'no-access',
        ]);

        /* HOME */
        Permission::create([
            'name'          => 'Gestión Home',
            'slug'          => 'homegestion',
            'description'   => 'Gestionar modulo home. ',
        ]);

        /* QUIENES SOMOS */
        Permission::create([
            'name'          => 'Gestion Quienes Somos',
            'slug'          => 'somosgestion',
            'description'   => 'Gestionar modulo quienes somos. ',
        ]);

        /* FUNDACION */
        Permission::create([
            'name'          => 'Gestion Fundacion',
            'slug'          => 'fundaciongestion',
            'description'   => 'Gestionar modulo fundacion. ',
        ]);

        /* MISION-VISION */
        Permission::create([
            'name'          => 'Gestion Mision Vision',
            'slug'          => 'misionvisiongestion',
            'description'   => 'Gestionar modulo mision vision. ',
        ]);

        /* CONTACTO */
        Permission::create([
            'name'          => 'Gestión Contacto',
            'slug'          => 'contactogestion',
            'description'   => 'Gestionar modulo contacto. ',
        ]);

        /* NOTICIAS */
        Permission::create([
            'name'          => 'Gestión Noticias',
            'slug'          => 'noticiagestion',
            'description'   => 'Gestionar modulo noticias. ',
        ]);

        /* USUARIOS */
        Permission::create([
            'name'          => 'Gestión Usuarios',
            'slug'          => 'usuariogestion',
            'description'   => 'Gestionar modulos usuarios.',
        ]);

        /* SLIDER */
        Permission::create([
            'name'          => 'Gestión Slider / Banner',
            'slug'          => 'slidergestion',
            'description'   => 'Gestionar modulo slider / banner.',
        ]);

        Permission::create([
            'name'          => 'Gestión Suscripcion',
            'slug'          => 'suscripciongestion',
            'description'   => 'Gestionar modulo suscripcion.',
        ]);

        Permission::create([
                'name'          => 'Gestión Coach',
                'slug'          => 'coachgestion',
                'description'   => 'Gestionar modulo coach. ',
        ]);

        Permission::create([
                'name'          => 'Gestión Evento',
                'slug'          => 'eventogestion',
                'description'   => 'Gestionar modulo evento. ',
        ]);

        Permission::create([
                'name'          => 'Gestión Hazte Socio',
                'slug'          => 'haztesociogestion',
                'description'   => 'Gestionar modulo hazte socio. ',
        ]);

        Permission::create([
                'name'          => 'Gestión Redes Sociales',
                'slug'          => 'redessocialesgestion',
                'description'   => 'Gestionar modulo redes sociales. ',
        ]);

        Permission::create([
                'name'          => 'Gestión Valores',
                'slug'          => 'valoresgestion',
                'description'   => 'Gestionar modulo valores. ',
        ]);

        //nuevos permisos parte 2

        Permission::create([
            'name'          => 'Gestión Prefijo',
            'slug'          => 'prefijogestion',
            'description'   => 'Gestionar de prefijos. ',
        ]);

        Permission::create([
            'name'          => 'Gestión Redes Sociales',
            'slug'          => 'socialgestion',
            'description'   => 'Gestionar de redes sociales. ',
        ]);

        Permission::create([
            'name'          => 'Gestión Imagen',
            'slug'          => 'imagengestion',
            'description'   => 'Gestionar de imagenes. ',
        ]);

        Permission::create([
            'name'          => 'Gestión Motivo Correo',
            'slug'          => 'motivocorreogestion',
            'description'   => 'Gestionar de motivo de correos. ',
        ]);

        Permission::create([
            'name'          => 'Gestión Funcionario',
            'slug'          => 'funcionariogestion',
            'description'   => 'Gestionar de funcionarios. ',
        ]);

        Permission::create([
            'name'          => 'Gestión Tipo Funcionario',
            'slug'          => 'tipofuncionariogestion',
            'description'   => 'Gestionar de tipo de funcionarios. ',
        ]);

        Permission::create([
            'name'          => 'Gestión Galeria',
            'slug'          => 'galeriagestion',
            'description'   => 'Gestionar de galerias. ',
        ]);

/*
        Permission::create([
                'name'          => 'Gestión Galeria',
                'slug'          => 'galeriagestion',
                'description'   => 'Gestionar modulo galerias. ',
        ]);
*/

/*
        Permission::create([
                'name'          => 'Gestion Codigo Sanitario',
                'slug'          => 'codsanitariogestion',
                'description'   => 'Gestionar modulo codigo sanitario. ',
        ]);
*/
/*
        Permission::create([
                'name'          => 'Gestión Alianzas',
                'slug'          => 'alianzasgestion',
                'description'   => 'Gestionar modulo alianzas. ',
        ]);
*/

/*
        Permission::create([
                'name'          => 'Gestión Convenio',
                'slug'          => 'conveniogestion',
                'description'   => 'Gestionar modulo convenio. ',
        ]);
*/
/*
        Permission::create([
                'name'          => 'Gestión Capacitaciones',
                'slug'          => 'capacitaciongestion',
                'description'   => 'Gestionar modulo capacitaciones. ',
        ]);
*/

/*
        Permission::create([
                'name'          => 'Gestión Bolsa de Trabajo',
                'slug'          => 'empleogestion',
                'description'   => 'Gestionar bolsa de trabajo. ',
        ]);
*/

/*
        Permission::create([
                'name'          => 'Gestión Estadisticas',
                'slug'          => 'estadisticagestion',
                'description'   => 'Gestionar de estadisticas. ',
        ]);
*/
/*
        Permission::create([
                'name'          => 'Gestión Afiliación',
                'slug'          => 'afiliaciongestion',
                'description'   => 'Gestionar de documento de afiliacion. ',
        ]);
*/
/*
        Permission::create([
                'name'          => 'Gestión Redes Sociales',
                'slug'          => 'socialgestion',
                'description'   => 'Gestionar de redes sociales. ',
        ]);
*/
/*
        Permission::create([
                'name'          => 'Gestión Afiliados',
                'slug'          => 'afiliadogestion',
                'description'   => 'Gestionar los afiliados a la plataforma. ',
        ]);
*/
/*
        Permission::create([
                'name'          => 'Gestión sección comunidad',
                'slug'          => 'opiniongestion',
                'description'   => 'Gestionar los modulos de comunidad. ',
        ]);
*/
/*
        Permission::create([
                'name'          => 'Gestión reserva capacitaciones',
                'slug'          => 'reservacapacitaciongestion',
                'description'   => 'Gestionar las reservas de las capacitaciones. ',
        ]);
*/
        DB::table('role_user')->insert(['role_id'=>1,'user_id'=>1]);
    }
}
