<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LifeEventsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('life_events')->delete();
        
        \DB::table('life_events')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Je crée mon entreprise',
                'slug' => 'je-cree-mon-entreprise',
                'description' => 'Toutes les démarches pour : Je crée mon entreprise',
                'icon' => 'fas fa-store',
                'content' => '',
                'order' => 1,
                'is_active' => 1,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'created_at' => '2026-02-20 19:37:36',
                'updated_at' => '2026-02-23 21:26:13',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Je déclare une naissance',
                'slug' => 'je-declare-une-naissance',
                'description' => 'Toutes les démarches pour : Je déclare une naissance',
                'icon' => 'fas fa-baby',
                'content' => '',
                'order' => 2,
                'is_active' => 1,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'created_at' => '2026-02-20 19:37:36',
                'updated_at' => '2026-02-23 21:26:13',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Je me marie',
                'slug' => 'je-me-marie',
                'description' => 'Toutes les démarches pour : Je me marie',
                'icon' => 'fas fa-heart',
                'content' => '',
                'order' => 3,
                'is_active' => 1,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'created_at' => '2026-02-20 19:37:36',
                'updated_at' => '2026-02-23 21:26:13',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Je demande un passeport',
                'slug' => 'je-demande-un-passeport',
                'description' => 'Toutes les démarches pour : Je demande un passeport',
                'icon' => 'fas fa-passport',
                'content' => '',
                'order' => 4,
                'is_active' => 1,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'created_at' => '2026-02-20 19:37:36',
                'updated_at' => '2026-02-23 21:26:13',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'Je demande ma CNIB',
                'slug' => 'je-demande-ma-cnib',
                'description' => 'Toutes les démarches pour : Je demande ma CNIB',
                'icon' => 'fas fa-id-card',
                'content' => '',
                'order' => 5,
                'is_active' => 1,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'created_at' => '2026-02-20 19:37:36',
                'updated_at' => '2026-02-23 21:26:13',
            ),
            5 => 
            array (
                'id' => 6,
                'title' => 'Je cherche un emploi',
                'slug' => 'je-cherche-un-emploi',
                'description' => 'Toutes les démarches pour : Je cherche un emploi',
                'icon' => 'fas fa-search',
                'content' => '',
                'order' => 6,
                'is_active' => 1,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'created_at' => '2026-02-20 19:37:36',
                'updated_at' => '2026-02-23 21:26:13',
            ),
            6 => 
            array (
                'id' => 7,
                'title' => 'Je construis ma maison',
                'slug' => 'je-construis-ma-maison',
                'description' => 'Toutes les démarches pour : Je construis ma maison',
                'icon' => 'fas fa-home',
                'content' => '',
                'order' => 7,
                'is_active' => 1,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'created_at' => '2026-02-20 19:37:36',
                'updated_at' => '2026-02-23 21:26:13',
            ),
            7 => 
            array (
                'id' => 8,
                'title' => 'Je déclare un décès',
                'slug' => 'je-declare-un-deces',
                'description' => 'Toutes les démarches pour : Je déclare un décès',
                'icon' => 'fas fa-cross',
                'content' => '',
                'order' => 8,
                'is_active' => 1,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'created_at' => '2026-02-20 19:37:36',
                'updated_at' => '2026-02-23 21:26:13',
            ),
            8 => 
            array (
                'id' => 9,
                'title' => 'Je pars à la retraite',
                'slug' => 'je-pars-a-la-retraite',
                'description' => 'Toutes les démarches pour : Je pars à la retraite',
                'icon' => 'fas fa-sun',
                'content' => '',
                'order' => 9,
                'is_active' => 1,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'created_at' => '2026-02-20 19:37:36',
                'updated_at' => '2026-02-23 21:26:13',
            ),
            9 => 
            array (
                'id' => 10,
                'title' => 'Je scolarise mon enfant',
                'slug' => 'je-scolarise-mon-enfant',
                'description' => 'Toutes les démarches pour : Je scolarise mon enfant',
                'icon' => 'fas fa-book',
                'content' => '',
                'order' => 10,
                'is_active' => 1,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'created_at' => '2026-02-20 19:37:36',
                'updated_at' => '2026-02-23 21:26:13',
            ),
            10 => 
            array (
                'id' => 11,
                'title' => 'J\'importe ou j\'exporte',
                'slug' => 'jimporte-ou-jexporte',
                'description' => 'Toutes les démarches pour : J\'importe ou j\'exporte',
                'icon' => 'fas fa-ship',
                'content' => '',
                'order' => 11,
                'is_active' => 1,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'created_at' => '2026-02-20 19:37:36',
                'updated_at' => '2026-02-23 21:26:13',
            ),
            11 => 
            array (
                'id' => 12,
                'title' => 'Je demande un casier judiciaire',
                'slug' => 'je-demande-un-casier-judiciaire',
                'description' => 'Toutes les démarches pour : Je demande un casier judiciaire',
                'icon' => 'fas fa-file-alt',
                'content' => '',
                'order' => 12,
                'is_active' => 1,
                'meta_title' => NULL,
                'meta_description' => NULL,
                'created_at' => '2026-02-20 19:37:36',
                'updated_at' => '2026-02-23 21:26:13',
            ),
        ));
        
        
    }
}