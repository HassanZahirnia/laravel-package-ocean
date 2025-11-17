<?php

it('can render correctly', function () {
    // Desktop
    visit('/')
        ->assertSee('Hassan Zahirnia')
        ->assertSee('Discover new Laravel packages.')
        ->assertSee('Laravel')
        ->assertSee('GitHub')
        ->assertSee('Categories')
        ->assertSee('Sponsor')
        ->assertSeeLink('Github')
        ->assertSeeLink('Twitter')
        ->assertSeeLink('Website');

    // Mobile
    visit('/')
        ->on()
        ->mobile()
        ->assertSourceHas('Official Packages');
});

it('has working navigation links', function () {
    $page = visit('/');

    $page->navigate('/top-laravel-packages')
        ->assertPathIs('/top-laravel-packages')
        ->assertSee('Top Laravel Packages')
        ->assertSee('Filament');
});
