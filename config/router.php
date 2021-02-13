<?php

return [
    'routes' => [
        'my-foo-route-name' => array(
            'route' => '/foo',
            'verb' => 'get,post,put', // any
            'handler' => 'EventFormHandler',
            'options' => array()
        ),
    ],
];
