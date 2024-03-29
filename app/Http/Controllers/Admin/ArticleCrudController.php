<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ArticleCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ArticleCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\BulkCloneOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Article::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/article');
        CRUD::setEntityNameStrings('article', 'articles');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::column('id');
        CRUD::column('category_id');
        CRUD::column('title');
        CRUD::column('slug');
        CRUD::column('tags')->type('relationship');
        $this->crud->addColumn([
            'name'=> 'tags',
            'type'=> 'relationship',
        ]);
        CRUD::column('content');
        CRUD::column('image');
        CRUD::column('status');
        CRUD::column('date');
        CRUD::column('featured');
        // CRUD::column('created_at');
        // CRUD::column('updated_at');
        // CRUD::column('deleted_at');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ArticleRequest::class);

        // CRUD::field('id');
        CRUD::field('category_id');
        CRUD::field('title')->size(3);
        CRUD::field('slug')->size(3);
        // CRUD::field('content')->type('cheditor');
        $this->crud->addField([
            'name'=> 'content',
            'type'=> 'cheditor',
        ]);
         CRUD::field('content');
        CRUD::field('image');
        CRUD::field('status');
        CRUD::field('date');
        CRUD::field('featured');
        // CRUD::field('tags')->type('relationship');
        CRUD::field('tags');
        // CRUD::field('created_at');
        // CRUD::field('updated_at');
        // CRUD::field('deleted_at');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
