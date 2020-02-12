<?php

Breadcrumbs::register('admin.subcategories.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.subcategories.management'), route('admin.subcategories.index'));
});

Breadcrumbs::register('admin.subcategories.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.subcategories.index');
    $breadcrumbs->push(trans('menus.backend.subcategories.create'), route('admin.subcategories.create'));
});
Breadcrumbs::register('admin.subcategories.edit', function ($breadcrumbs, $id) {
    // dd($id);
    $breadcrumbs->parent('admin.subcategories.index');
    $breadcrumbs->push(trans('menus.backend.subcategories.edit'), route('admin.subcategories.edit', $id));
});
