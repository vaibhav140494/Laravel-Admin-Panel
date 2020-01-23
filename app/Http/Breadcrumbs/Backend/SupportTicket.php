<?php

Breadcrumbs::register('admin.supporttickets.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.supporttickets.management'), route('admin.supporttickets.index'));
});

Breadcrumbs::register('admin.supporttickets.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.supporttickets.index');
    $breadcrumbs->push(trans('menus.backend.supporttickets.create'), route('admin.supporttickets.create'));
});

Breadcrumbs::register('admin.supporttickets.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.supporttickets.index');
    $breadcrumbs->push(trans('menus.backend.supporttickets.edit'), route('admin.supporttickets.edit', $id));
});
