<!-- This is just an example of an artist credit. Create a new file in config/lorekeeper/creds-tracker for it to register properly. Delete this file (or edit it to have credits appropriate to your site) once you have created your own credits! 
~ Creator = DeviantArt Username

Put each new credit on a new line
'Art Piece Name' => 'Link To Artwork',

Below is an example of a user being credited for 2 different items.
-->

<?php

return [
    'creator' => 'Unikeko', 
    'credits' => json_encode([
        'Item: All Base Imports' => '#',
        'Item: Fungal Contamination Import Item' => '#',
        'Item: Varma Base' => '#',
        'Item: BG sets' => '#',
        'Item: Familiars' => '#',
        'Item: Activity Letters' => '#',
    ]),
];
