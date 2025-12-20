<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Sidebar Links
    |--------------------------------------------------------------------------
    |
    | Admin panel sidebar links.
    | Add links here to have them show up in the admin panel.
    | Users that do not have the listed power will not be able to
    | view the links in that section.
    |
    */

    'Admin'      => [
        'power' => 'manage_reports',
        'links' => [
            [
                'name' => 'User Ranks',
                'url'  => 'admin/users/ranks',
            ],
            [
                'name' => 'Admin Logs',
                'url'  => 'admin/admin-logs',
            ],
            [
                'name' => 'Staff Reward Settings',
                'url'  => 'admin/staff-reward-settings',
            ],
        ],
    ],
    'Site'    => [
        'power' => 'manage_reports',
        'links' => [
            [
                'name' => 'Report Queue',
                'url'  => 'admin/reports/pending',
            ],
            [
                'name' => 'News',
                'url'  => 'admin/news',
            ],
            [
                'name' => 'Dev Logs',
                'url'  => 'admin/devlogs',
            ],
            [
                'name' => 'Approved Affiliates',
                'url'  => 'admin/affiliates/current',
            ],
        ],
    ],

    'Pages'       => [
        'power' => 'edit_pages',
        'links' => [
            [
                'name' => 'Pages',
                'url'  => 'admin/pages',
            ],
            [
                'name' => 'Sidebar',
                'url'  => 'admin/sidebar',
            ],
            [
                'name' => 'Random Generators',
                'url'  => 'admin/data/random',
            ],
            [
                'name' => 'Carousel',
                'url'  => 'admin/data/carousel',
            ],
            [
                'name' => 'Sales',
                'url'  => 'admin/sales',
            ],
            [
                'name' => 'Raffles',
                'url'  => 'admin/raffles',
            ],
        ],
    ],
    'Users'      => [
        'power' => 'edit_user_info',
        'links' => [
            [
                'name' => 'User Index',
                'url'  => 'admin/users',
            ],
            [
                'name' => 'Invitation Keys',
                'url'  => 'admin/invitations',
            ],
        ],
    ],
    'Teams'       => [
        'power' => 'edit_teams',
        'links' => [
            [
                'name' => 'Teams',
                'url'  => 'admin/teams',
            ],
            [
                'name' => 'Admin Applications',
                'url'  => 'admin/applications',
            ],
        ],
    ],
    'Queues'     => [
        'power' => 'manage_submissions',
        'links' => [
            [
                'name' => 'Gallery Submissions',
                'url'  => 'admin/gallery/submissions',
            ],
            [
                'name' => 'Gallery Currency Awards',
                'url'  => 'admin/gallery/currency',
            ],
            [
                'name' => 'Prompt Submissions',
                'url'  => 'admin/submissions',
            ],
            [
                'name' => 'Claim Submissions',
                'url'  => 'admin/claims',
            ],
            [
                'name' => 'Trades',
                'url'  => 'admin/trades/incoming',
            ],
        ],
    ],
    'Grants'     => [
        'power' => 'edit_inventories',
        'links' => [
            [
                'name' => 'Currency Grants',
                'url'  => 'admin/grants/user-currency',
            ],
            [
                'name' => 'Item Grants',
                'url'  => 'admin/grants/items',
            ],
            [
                'name' => 'Award Grants',
                'url'  => 'admin/grants/awards',
            ],
            [
                'name' => 'Recipe Grants',
                'url'  => 'admin/grants/recipes',
            ],
            [
                'name' => 'EXP Grants',
                'url'  => 'admin/grants/exp',
            ],

            [
                'name' => 'Pet Grants',
                'url'  => 'admin/grants/pets',
            ],
            [
                'name' => 'Border Grants',
                'url'  => 'admin/grants/borders',
            ],
                'name' => 'Loot Table Grants',
                'url'  => 'admin/grants/loot-tables',
            ],
        ],
    'Masterlist' => [
        'power' => 'manage_characters',
        'links' => [
            [
                'name' => 'Create Character',
                'url'  => 'admin/masterlist/create-character',
            ],
            [
                'name' => 'Create MYO Slot',
                'url'  => 'admin/masterlist/create-myo',
            ],
            [
                'name' => 'Character Transfers',
                'url'  => 'admin/masterlist/transfers/incoming',
            ],
            [
                'name' => 'Design Updates',
                'url'  => 'admin/design-approvals/pending',
            ],
            [
                'name' => 'MYO Approvals',
                'url'  => 'admin/myo-approvals/pending',
            ],
        ],
    ],
    'Genetics'       => [
        'power' => 'edit_data',
        'links' => [
            [
                'name' => 'Adoption Center',
                'url'  => 'admin/data/adoption-center',
            ],
            [
                'name' => 'Character Categories',
                'url'  => 'admin/data/character-categories',
            ],
            [
                'name' => 'Species',
                'url'  => 'admin/data/species',
            ],
            [
                'name' => 'Subtypes',
                'url'  => 'admin/data/subtypes',
            ],
            [
                'name' => 'Traits',
                'url'  => 'admin/data/traits',
            ],
            [
                'name' => 'Markings',
                'url'  => 'admin/data/markings',
            ],
            // [
            //     'name' => 'Carriers',
            //     'url'  => 'admin/data/carriers',
            // ],
            [
                'name' => 'Bases',
                'url'  => 'admin/data/bases',
            ],
            [
                'name' => 'Illnesses',
                'url'  => 'admin/data/status-effects',
            ],
            [
                'name' => 'Alt Images',
                'url'  => 'admin/data/transformations',
            ],
        ],
    ],

    'Activities'       => [
        'power' => 'edit_data',
        'links' => [
            [
                'name' => 'Galleries',
                'url'  => 'admin/data/galleries',
            ],
            [
                'name' => 'Award Categories',
                'url'  => 'admin/data/award-categories',
            ],
            [
                'name' => 'Awards',
                'url'  => 'admin/data/awards',
            ],

            [
                'name' => 'Sub Masterlists',
                'url'  => 'admin/data/sublists',
            ],
            [
                'name' => 'Rarities',
                'url'  => 'admin/data/rarities',
            ],

            [
                'name' => 'Shops',
                'url'  => 'admin/data/shops',
            ],
            [
                'name' => 'Dailies',
                'url'  => 'admin/data/dailies',
            ],
            [
                'name' => 'Currencies',
                'url'  => 'admin/data/currencies',
            ],
            [
                'name' => 'Prompts',
                'url'  => 'admin/data/prompts',
            ],
            [
                'name' => 'Loot Tables',
                'url'  => 'admin/data/loot-tables',
            ],
            [
                'name' => 'Items',
                'url'  => 'admin/data/items',
            ],
            [
                'name' => 'Dynamic Limits',
                'url'  => 'admin/data/limits',
            ], 
            [
                'name' => 'Library',
                'url'  => 'admin/data/volumes',
            ],
            [
                'name' => 'Recipes',
                'url'  => 'admin/data/recipes',
            ],
            [
                'name' => 'Familiars',
                'url'  => 'admin/data/pets',
            ],
            [
                'name' => 'User Borders',
                'url'  => 'admin/data/borders',
            ],
        ],
    ],

    'World_Expanded' => [
        'power' => 'manage_world',
        'links' => [
            [
                'name' => 'Glossary',
                'url'  => 'admin/world/glossary',
            ],
            [
                'name' => 'Locations',
                'url'  => 'admin/world/locations',
            ],
            [
                'name' => 'Fauna',
                'url'  => 'admin/world/faunas',
            ],
            [
                'name' => 'Flora',
                'url'  => 'admin/world/floras',
            ],
            [
                'name' => ' Events',
                'url'  => 'admin/world/events',
            ],
            [
                'name' => ' Figures',
                'url'  => 'admin/world/figures',
            ],
            [
                'name' => 'Factions',
                'url'  => 'admin/world/factions',
            ],
            [
                'name' => 'Concepts',
                'url'  => 'admin/world/concepts',
            ],
            [
                'name' => 'Criteria Rewards',
                'url'  => 'admin/data/criteria',
            ],
            [
                'name' => 'Elements',
                'url'  => 'admin/data/elements',
            ],
        ],
    ],

    'Settings'   => [
        'power' => 'edit_site_settings',
        'links' => [
            [
                'name' => 'Site Settings',
                'url'  => 'admin/settings',
            ],
            [
                'name' => 'Site Images',
                'url'  => 'admin/images',
            ],
            [
                'name' => 'File Manager',
                'url'  => 'admin/files',
            ],
            [
                'name' => 'Theme Manager',
                'url'  => 'admin/themes',
            ],
            [
                'name' => 'Log Viewer',
                'url'  => 'admin/logs',
            ],
        ],
    ],
];
