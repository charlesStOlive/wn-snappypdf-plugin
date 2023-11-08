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
            'name' => 'Intitulé',
            'slug' => 'Code/Slug',
            'template' => 'Template',
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
    'model' => [
        'pdf' => [
            'tab_info' => 'Info',
            'html' => 'Contenu html',
            'tab_options' => 'Configurations',
            'paper_width' => 'Largeur du papier',
            'paper_height' => 'Hauteur du papier',
            'open_log' => 'Activer le footer',
            'output_name' => 'Nom de sortie',
            'layout' => 'Layout',
            'slug' => 'Code/Slug',
            'name' => 'Intitulé du PDF',
            'tab_config' => 'Configuration',
            'tab_edit' => 'Edition',
        ],
    ],
];
