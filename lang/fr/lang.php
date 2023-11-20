<?php

return [
    'controllers' => [
        'layouts' => [
            'label' => 'Layouts',
        ],
        'pdfs' => [
            'label' => 'Pdfs',
        ],
    ],
    'driver' => [
        'description' => 'Création de PDF depuis un template ou une BDD',
        'execute' => [
            'success' => 'PDF prêt pour téléchargement',
        ],
        'label' => 'Création de PDF',
    ],
    'menu' => [
        'pdf' => [
            'description' => 'Gestion des PDFs',
            'label' => 'Pdfs',
        ],
    ],
    'model' => [
        'pdf' => [
            'html' => 'Contenu html',
            'layout' => 'Layout',
            'name' => 'Intitulé du PDF',
            'open_log' => 'Activer le footer',
            'output_name' => 'Nom de sortie',
            'paper_height' => 'Hauteur du papier',
            'paper_width' => 'Largeur du papier',
            'slug' => 'Code/Slug',
            'tab_config' => 'Configuration',
            'tab_edit' => 'Edition',
        ],
    ],
    'models' => [
        'general' => [
            'created_at' => 'Created At',
            'id' => 'ID',
            'updated_at' => 'Updated At',
        ],
        'layout' => [
            'label' => 'Layout',
            'name' => 'Intitulé',
            'slug' => 'Code/Slug',
            'template' => 'Template',
        ],
        'pdf' => [
            'label' => 'Pdf',
        ],
        'tab_edit' => 'Edition',
    ],
    'plugin' => [
        'description' => 'Aucune description fournie pour le moment...',
        'name' => 'snappyPdf',
    ],
];
