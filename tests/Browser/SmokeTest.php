<?php

it('serves all public pages without console/js errors (smoke)', function () {
    $routes = [
        '/',
        '/top-laravel-packages',
    ];

    visit($routes)
        ->assertNoBrokenImages()
        ->assertNoSmoke();
});
