<?php

Breadcrumbs::register('admin.offers.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.offers.management'), route('admin.offers.index'));
});

Breadcrumbs::register('admin.offers.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.offers.index');
    $breadcrumbs->push(trans('menus.backend.offers.create'), route('admin.offers.create'));
});

Breadcrumbs::register('admin.offers.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.offers.index');
    $breadcrumbs->push(trans('menus.backend.offers.edit'), route('admin.offers.edit', $id));
});
