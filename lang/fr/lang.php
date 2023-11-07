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
            'created_at' => 'Created At',
            'id' => 'ID',
            'updated_at' => 'Updated At',
        ],
        'pdf' => [
            'label' => 'Pdf',
        ],
        'layout' => [
            'label' => 'Layout',
        ],
    ],
    'plugin' => [
        'description' => 'Aucune description fournie pour le moment...',
        'name' => 'snappyPdf',
    ],
    'controllers' => [
        'pdfs' => [
            'label' => 'Pdfs',
        ],
        'layouts' => [
            'label' => 'Layouts',
        ],
    ],
    'menu' => [
        'pdf' => [
            'label' => 'Pdfs',
            'description' => 'Gestion des PDFs',
        ],
    ],
];
