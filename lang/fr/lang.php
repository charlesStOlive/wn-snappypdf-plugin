<?php

return [
    'controllers' => [
        'layouts' => [
            'label' => 'Layouts',
        ],
        'pdfs' => [
            'label' => 'PDFs',
        ],
    ],
    'driver' => [
        'description' => 'Creating PDFs from a template or a database',
        'execute' => [
            'success' => 'PDF ready for download',
        ],
        'label' => 'PDF Creation',
    ],
    'menu' => [
        'pdf' => [
            'description' => 'PDF management',
            'label' => 'PDFs',
        ],
    ],
    'model' => [
        'pdf' => [
            'html' => 'HTML content',
            'layout' => 'Layout',
            'name' => 'PDF title',
            'open_log' => 'Activate the footer',
            'output_name' => 'Output name',
            'paper_height' => 'Paper height',
            'paper_width' => 'Paper width',
            'slug' => 'Code/Slug',
            'tab_config' => 'Configuration',
            'tab_edit' => 'Editing',
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
            'name' => 'Title',
            'slug' => 'Code/Slug',
            'template' => 'Template',
        ],
        'pdf' => [
            'label' => 'PDF',
        ],
        'tab_edit' => 'Editing',
    ],
    'plugin' => [
        'description' => 'No description provided for now...',
        'name' => 'snappyPdf',
    ],
];
