<?php

namespace Eleven59\BackpackSettingsExtended\Http\Controllers\Admin;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;

class SettingCrudController extends \Backpack\Settings\app\Http\Controllers\SettingCrudController
{
    public function setup()
    {
        parent::setup();
        CRUD::setModel(config('eleven59.backpack-settings-extended.model'));
        CRUD::setEntityNameStrings(config('eleven59.backpack-settings-extended.entity-name-strings.singular'), config('eleven59.backpack-settings-extended.entity-name-strings.plural'));
        CRUD::orderBy(config('eleven59.backpack-settings-extended.order-by.field'), config('eleven59.backpack-settings-extended.order-by.order'));

        foreach(config('eleven59.backpack-settings-extended.routes') as $slug => $type) {
            if(stristr(url()->current(), config('backpack.base.route_prefix', 'admin') . "/{$slug}")) {
                CRUD::setRoute(backpack_url($slug));
                $this->crud->addClause('where', 'type', '=', "{$type}");
            }
        }
    }

    public function setupListOperation()
    {
        if(!empty(config('eleven59.backpack-settings-extended.widgets.update'))) {
            foreach(config('eleven59.backpack-settings-extended.widgets.update') as $options)
            {
                Widget::add($options);
            }
        }

        CRUD::setColumns([
            [
                'name'  => 'name',
                'label' => trans('backpack::settings.name'),
            ],
            [
                'name'  => 'value',
                'label' => trans('backpack::settings.value'),
            ],
            [
                'name'  => 'description',
                'label' => trans('backpack::settings.description'),
            ],
        ]);

        CRUD::addClause('where', 'active', 1);
    }

    public function setupUpdateOperation()
    {
        if(!empty(config('eleven59.backpack-settings-extended.widgets.update'))) {
            foreach(config('eleven59.backpack-settings-extended.widgets.update') as $options)
            {
                Widget::add($options);
            }
        }

        CRUD::addField([
            'name' => 'name',
            'label' => trans('backpack::settings.name'),
            'type' => 'text',
            'attributes' => [
                'disabled' => 'disabled',
            ],
        ]);

        $fields = config('eleven59.backpack-settings-extended.field-defaults') ?? [];
        $field = json_decode(CRUD::getCurrentEntry()->field, true);
        if(!empty($fields[$field['type'] ?? 'text'])) {
            foreach($fields[$field['type'] ?? 'text'] as $index => $defaultOptions) {
                if(empty($field[$index])) {
                    $field[$index] = $defaultOptions;
                }
            }
        }
        if(!isset($field['name'])) $field['name'] = 'value';
        CRUD::addField($field, true);
    }
}
