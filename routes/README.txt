Quick Start Guide: Creating and Using Admin Routes
================================================

1. Service Provider Location
--------------------------
The AdminRouteServiceProvider is located at:
/app/Providers/AdminRouteServiceProvider.php

And it is registered in AppServiceProvider register function:
$this->app->register(AdminRouteServiceProvider::class);

2. Creating New Routes
--------------------
To create new admin routes, follow these patterns:

a. Basic Route (Standard CRUD):
```php
Route::adminResource('articles', ArticlesController::class);
```

b. Route with Custom Actions:
```php
Route::adminResource('buttons', ButtonsController::class, [
    'routes' => [
        'customAction' => ['get', 'customMethod', '{id}']
    ]
]);
```

c. Route with Disabled Actions:
```php
Route::adminResource('templates', TemplatesController::class, [
    'routes' => [
        'create' => false,
        'store' => false
    ]
]);
```

3. Default Routes Generated
-------------------------
For a resource named 'articles':

GET Routes (with admin prefix):
- admin/articles/index          → index()
- admin/articles/create        → form()
- admin/articles/edit/{id}     → form()
- admin/articles/view/{id}     → view()

POST Routes (without admin prefix):
- articles/store              → save()
- articles/update/{id}        → save()
- articles/delete/{id}        → delete()
- articles/alias/{id}         → alias()
- articles/publish/{id}       → publish()
- articles/updateOrder        → updateOrder()

4. Controller Requirements
------------------------
Your controller should implement these methods:
- index()     - List view
- form()      - Create/Edit form
- save()      - Store/Update data
- view()      - Show single item
- delete()    - Delete item
- alias()     - Handle aliases
- publish()   - Toggle publish state
- updateOrder - Handle ordering

5. Route Naming Convention
------------------------
All routes are automatically named as:
{resource}.{action}

Examples:
- articles.index
- articles.create
- articles.store
- articles.edit
- articles.update

6. URL Structure
--------------
GET requests:  admin/{resource}/{action}/{parameters?}
POST requests: {resource}/{action}/{parameters?}

7. Tips
-------
- Use GET for viewing/displaying content
- Use POST for data modification
- All GET routes automatically get 'admin/' prefix
- All POST routes use the base resource name
- Custom routes can be added via the 'routes' option
- Routes can be disabled by setting them to false
