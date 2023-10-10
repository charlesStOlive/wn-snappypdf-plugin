<?php

return [
    'driver' => [
        'description' => 'Création de PDF depuis un template ou une BDD',
        'label' => 'Création de PDF',
        'execute' => [
            'success' => 'PDF prêt pour téléchargement',
        ],
    ],
    'models' => [
        'general' => [
            'created_at' => 'Créé le',
            'id' => 'ID',
            'updated_at' => 'Mis à jour le',
        ],
    ],
    'plugin' => [
        'description' => 'Aucune description fournie pour le moment...',
        'name' => 'snappyPdf',
    ],
];
