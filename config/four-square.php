<?php

return [
    'client_id' => env('FOUR_SQUARE_CLIENT_ID', 'WM22MYIL1RZ0HSVWDA1TYQPZXQR1HHCKXCTQ2REDWWCHI0I'),
    'client_secret' => env('FOUR_SQUARE_CLIENT_SECRET', 'FPDAN125SF04RWTHRJFGGVQVHPFJQ1PJFOQJ4NKLYEG1XKYS'),
    'version' => env('FOUR_SQUARE_VERSION', '20210220'),
    'category_id' => env('FOUR_SQUARE_DEFAULT_CATEGORY', '4deefb944765f83613cdba6e'),
    'cities' => env('CITIES', []),
    'country_code' => env('COUNTRY_CODE', 'JP'),
    'api_url' => 'http://api.foursquare.com/v2/venues',
];
