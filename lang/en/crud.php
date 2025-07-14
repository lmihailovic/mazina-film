<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'films' => [
        'name' => 'Films',
        'index_title' => 'Films List',
        'new_title' => 'New Film',
        'create_title' => 'Create Film',
        'edit_title' => 'Edit Film',
        'show_title' => 'Show Film',
        'inputs' => [
            'zanr_id' => 'Zanr',
            'Naziv' => 'Naziv',
            'Status' => 'Status',
            'Budzet' => 'Budzet',
            'DatumIzlaska' => 'Datum Izlaska',
        ],
    ],

    'scenas' => [
        'name' => 'Scenas',
        'index_title' => 'Scenas List',
        'new_title' => 'New Scena',
        'create_title' => 'Create Scena',
        'edit_title' => 'Edit Scena',
        'show_title' => 'Show Scena',
        'inputs' => [
            'film_id' => 'Film',
            'Lokacija' => 'Lokacija',
            'DatumSnimanja' => 'Datum Snimanja',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'role' => 'Role',
        ],
    ],

    'zanrs' => [
        'name' => 'Zanrs',
        'index_title' => 'Zanrs List',
        'new_title' => 'New Zanr',
        'create_title' => 'Create Zanr',
        'edit_title' => 'Edit Zanr',
        'show_title' => 'Show Zanr',
        'inputs' => [
            'Naziv' => 'Naziv',
        ],
    ],

    'zaposlenis' => [
        'name' => 'Zaposlenis',
        'index_title' => 'Zaposlenis List',
        'new_title' => 'New Zaposleni',
        'create_title' => 'Create Zaposleni',
        'edit_title' => 'Edit Zaposleni',
        'show_title' => 'Show Zaposleni',
        'inputs' => [
            'Ime' => 'Ime',
            'Prezime' => 'Prezime',
            'Uloga' => 'Uloga',
            'Status' => 'Status',
        ],
    ],
];
