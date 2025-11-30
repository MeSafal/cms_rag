<?php

namespace App\Helpers;
use App\Models\Article;
use App\Models\Button;
use App\Models\Connection;
use App\Models\Content;
use App\Models\Mapper;
use App\Models\Menu;
use App\Models\Navigation;
use App\Models\Template;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;
use PhpParser\JsonDecoder;
use Spatie\Permission\Models\Role;
use App\Models\Slider;

class CMS_FMS
{
    public function __construct()
    {
        // $this->initDB();
    }

    /**
     * Get sliders and buttons based on entries.
     *
     * @param  array  $entries
     * @return array
     */
    public function getContentFromEntries($entries = [])
    {
        // Initialize empty response array for sliders and buttons
        $response = [];

        // Fetch sliders if the table type is 'sliders' or fetch all sliders
        if (isset($entries['table']) && $entries['table'] === 'sliders') {
            $response['sliders'] = $this->getSliders($entries['content']);
        } else {
            $response['sliders'] = $this->getSliders();
        }

        // Fetch sliders if the table type is 'articles' or fetch all articles
        if (isset($entries['table']) && $entries['table'] === 'articles') {
            $response['articles'] = $this->getArticles($entries['content']);
        } else {
            $response['articles'] = $this->getArticles();
        }

        // Fetch buttons if they are provided in the entries
        if (isset($entries['buttons'])) {
            $response['buttons'] = $this->getButtons($entries['buttons']);
        } else {
            $response['buttons'] = $this->getButtons();
        }

        return $response;
    }

    /**
     * Get sliders based on the provided content or all sliders.
     *
     * @param  mixed  $content
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSliders($content = null)
    {
        // If $content is an array, fetch only the sliders with those IDs
        if (is_array($content) && !empty($content)) {
            return Slider::whereIn('sliders_id', $content)
                ->where('status', 1)
                ->orderByRaw("FIELD(sliders_id, " . implode(',', $content) . ")")
                ->get();
        }

        // If content is null or not an array, return all active sliders
        return Slider::where('status', 1)
            ->orderBy('display_order', 'asc')
            ->get();
    }

    /**
     * Get articles based on the provided content or all articles.
     *
     * @param  mixed  $content
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getArticles($content = null)
    {
        // If $content is an array, fetch only the articles with those IDs
        if (is_array($content) && !empty($content)) {
            return Article::whereIn('articles_id', $content)
                ->where('status', 1)
                ->orderByRaw("FIELD(articles_id, " . implode(',', $content) . ")")
                ->get();
        }

        // If content is null or not an array, return all active sliders
        return Article::where('status', 1)
            ->orderBy('display_order', 'asc')
            ->get();
    }

    /**
     * Get buttons based on the provided buttons array.
     *
     * @param  mixed  $buttons
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function getButtons($buttons = null)
    {
        // If $buttons is an array, fetch only the buttons with those IDs
        if (is_array($buttons) && !empty($buttons)) {
            return Button::whereIn('buttons_id', $buttons)
                ->where('status', 1)
                ->orderByRaw("FIELD(buttons_id, " . implode(',', $buttons) . ")")
                ->get();
        }
        return Button::where('status', 1)
            ->orderBy('display_order', 'asc')
            ->get();
    }

    /**
     * Retrieve items based on the provided template path and model.
     *
     * This method dynamically fetches records from the specified model,
     * filtering by status and template ID. The model can be any class
     * within the App\Models namespace, and the template path is used
     * to fetch the corresponding template ID to filter results.
     *
     * @param  string  $model  The model to query (default is 'Slider').
     * @param  string  $template  The template path to match (default is 'home').
     * @return \Illuminate\Database\Eloquent\Collection  The filtered records from the specified model.
     */
    public function getItemsByTemplate($template = 'home')
    {
        // Fetch the template by title
        $templateObj = Template::where('title', $template)
            ->where('status', 1)
            ->first();
        if (!$templateObj) {
            return collect(); // Return empty collection if template not found
        }

        // Decode the JSON entries into an array of model names
        $modelNames = json_decode($templateObj->entries);

        if (!is_array($modelNames)) {
            return collect();
        }

        $allItems = collect();

        foreach ($modelNames as $modelName) {
            // Construct the fully qualified model class name
            $modelClass = "App\\Models\\{$modelName}";

            // Check if the class exists to prevent runtime errors
            if (!class_exists($modelClass)) {
                continue;
            }

            // Retrieve items for this model
            $items = $modelClass::where('status', 1)
                ->where('template_id', $templateObj->templates_id)
                ->orderBy('display_order', 'asc')
                ->get();

            // Merge the items into one collection
            $allItems = $allItems->merge($items);
        }
        return $allItems;
    }
    public function getButtonsForItem($template = 'home', $item)
    {
        // Build the location key for the given item.
        // For example, if $item is an Article with articles_id = 1, it becomes "articles_id/1"
        $primaryKey = $item->getKeyName();
        $itemLocationKey = $primaryKey . '/' . $item->$primaryKey;

        // Fetch the template by title and ensure it's active.
        $templateObj = Template::where('title', $template)
            ->where('status', 1)
            ->first();

        if (!$templateObj) {
            return collect();
        }

        // Get all active buttons for this template, ordered by display_order.
        $buttons = Button::where('template_id', $templateObj->templates_id)
            ->where('status', 1)
            ->orderBy('display_order', 'asc')
            ->get();

        // Create an empty collection for matching buttons.
        $result = collect();

        // Loop through each button.
        foreach ($buttons as $button) {
            // A button's location field may contain multiple comma-separated values.
            $locations = explode(',', $button->location);

            foreach ($locations as $location) {
                $location = trim($location);
                if (!$location || strpos($location, '/') === false) {
                    continue;
                }
                // Expected format is "ModelName/id", e.g. "Article/1"
                list($modelName, $id) = explode('/', $location);

                // Instead of instantiating the model, we assume a naming convention:
                // Convert model name to plural lowercase and append '_id'
                // e.g. "Article" becomes "articles_id"
                $primaryKeyName = strtolower(Str::plural($modelName)) . '_id';
                $formattedLocation = $primaryKeyName . '/' . $id;

                // Check if this button's location matches the item's location key.
                if ($formattedLocation === $itemLocationKey) {
                    // Add the button details into the result collection.
                    // Note: If more than one button matches, all are returned.
                    $result->push([
                        'title' => $button->title,
                        'url' => getUrl($button->buttons_id),
                        'target' => $button->target,
                    ]);
                }
            }
        }

        return $result;
    }


    public function getMenuByCategory($id)
    {
        return Menu::where('menuCategory_id', $id)
            ->where('status', 1)
            ->orderBy('display_order', 'asc')
            ->get();
    }

    public function getMenuItemsByLocation($location = 1)
    {
        // Fetch the navigation items for the given location
        $navigation = Navigation::where('location', $location)
            ->where('status', 1)
            ->where('parent', null)
            ->with('childrenItem')
            ->orderBy('display_order', 'asc')
            ->get();


        // Define a recursive function that transforms each navigation item.
        // It checks if 'entries' is set to compute the URL and returns only the desired keys.
        $processNavigationItem = function ($item) use (&$processNavigationItem) {
            // If 'entries' is set, compute the URL using getUrl()
            if ($item->destination_to != 'custom') {
                $templateAlias = Template::where('status', 1)
                    ->where('templates_id', $item->destination_id)
                    ->value('alias');

                $item->url = '/' . $templateAlias;

                if (!empty($item->content_from) && !empty($item->content_id)) {
                    $modelName = Str::studly(Str::singular($item->content_from)); // e.g., "articles" → "Article"

                    $table = Mapper::where('status', 1)
                        ->where('title', $modelName)
                        ->value('alias'); // e.g., "info", "views"

                    $modelClass = 'App\\Models\\' . $modelName;

                    if ($table && class_exists($modelClass)) {
                        $primaryKey = (new $modelClass)->getKeyName();

                        $alias = $modelClass::where('status', 1)
                            ->where($primaryKey, $item->content_id)
                            ->value('alias');

                        if (!empty($alias)) {
                            $item->url = '/' . $templateAlias . '/' . $table . '/' . $alias;
                        }
                    }
                }
            }

            // If there are child items, process them recursively.
            if ($item->relationLoaded('childrenItem') && $item->childrenItem->isNotEmpty()) {
                $item->childrenItem = $item->childrenItem->map($processNavigationItem);
            } else {
                // Ensure childrenItem is an empty collection if not set
                $item->childrenItem = collect();
            }
            // Return only 'title', 'thumb', and 'url', and also include the transformed children.
            return (object) [
                'title' => $item->title,
                'thumb' => $item->thumb,
                'url' => $item->url,
                'target' => $item->target,
                'childrenItem' => $item->childrenItem
            ];
        };

        // Map over the initial collection using the recursive function.
        $processedNavigation = $navigation->map($processNavigationItem);

        return $processedNavigation;
    }


    public function getLocationKey($item = null)
    {
        $primaryKey = $item->getKeyName();
        $location = $primaryKey . '/' . $item->$primaryKey;

        return $location;
    }

    public function getTemplateChildren($children)
    {
        // Step 1: Parse and keep only positive IDs
        $positiveChildren = collect(explode(',', $children))
            ->map(fn($id) => (int) trim($id))
            ->filter(fn($id) => $id > 0)
            ->values();

        // Step 2: Fetch only active templates with status = 1
        $templates = Template::whereIn('templates_id', $positiveChildren)
            ->where('status', 1)
            ->get()
            ->keyBy('templates_id');

        // Step 3: Map to desired result format
        $result = $positiveChildren->map(function ($id) use ($templates) {
            $template = $templates->get($id);
            if ($template) {
                return (object) [
                    'id' => $id,
                    'name' => $template->name,
                    'title' => $template->title,
                    'subtitle' => $template->subtitle,
                ];
            }
            return null;
        })->filter();
        return $result;
    }


    // public function getTemplateData($template_id, $child_ids)
    // {
    //     $groupedResults = collect();
    //     dump($child_ids);

    //     foreach ($child_ids as $childId) {
    //         $contentJson = Content::where('child_id', $childId)
    //             ->where('template_id', $template_id)
    //             ->value('entries');

    //         // decode or start with empty array
    //         $entries = $contentJson
    //             ? json_decode($contentJson, true)
    //             : [];

    //         // 2) Fetch active connections for this context
    //         $connections = Connection::where('template_id', $template_id)
    //             ->where('child_id', $childId)
    //             ->where('status', 1)
    //             ->get(['connected_template_id', 'connected_child_id']);

    //         // 3) For each connected context, pull its entries and merge
    //         foreach ($connections as $conn) {
    //             $connJson = Content::where('template_id', $conn->connected_template_id)
    //                 ->where('child_id', $conn->connected_child_id)
    //                 ->value('entries');

    //             if ($connJson) {
    //                 $connEntries = json_decode($connJson, true);
    //                 if (is_array($connEntries)) {
    //                     // merge arrays so original order is preserved
    //                     $entries = array_merge($entries, $connEntries);
    //                 }
    //             }
    //         }

    //         // 4) If no entries at all, skip
    //         if (empty($entries)) {
    //             continue;
    //         }

    //         $itemsByType = [];

    //         foreach ($entries as $entry) {
    //             [$modelName, $modelId] = explode(':', $entry);

    //             $modelClass = "App\\Models\\{$modelName}";

    //             if (!class_exists($modelClass)) {
    //                 continue;
    //             }

    //             $modelInstance = new $modelClass;
    //             $primaryKey = $modelInstance->getKeyName();

    //             $modelData = $modelClass::where($primaryKey, $modelId)->where('status', 1)->first();

    //             if ($modelData) {
    //                 $itemsByType[$modelName][] = [
    //                     'id' => (int) $modelId,
    //                     'data' => $modelData,
    //                 ];
    //             }
    //         }

    //         $finalOrdered = collect();

    //         foreach ($entries as $entry) {
    //             [$modelName, $modelId] = explode(':', $entry);
    //             $modelId = (int) $modelId;

    //             // Only process once per model entry
    //             if (!isset($itemsByType[$modelName])) {
    //                 continue;
    //             }

    //             // Sort the group by display_order only once per group
    //             $sorted = collect($itemsByType[$modelName])
    //                 ->sortBy(fn($item) => $item['data']->display_order ?? 0)
    //                 ->pluck('data');

    //             // Push sorted models
    //             $finalOrdered = $finalOrdered->merge($sorted);

    //             // Remove so it won't repeat
    //             unset($itemsByType[$modelName]);
    //         }
    //         $groupedResults->put($childId, $finalOrdered);
    //     }

    //     return $groupedResults;
    // }

    /**
     * Master function: returns a Collection keyed by child_id,
     * each value is a Collection of items, each item has ->buttons (Collection).
     */
    public function getTemplateData(int $templateId, iterable $childIds): \Illuminate\Support\Collection
    {
        $grouped = collect();

        foreach ($childIds as $childId) {
            $entries = $this->gatherEntries($templateId, $childId);
            if (empty($entries)) {
                continue;
            }

            $items = $this->getItemsFromEntries($entries);
            $buttons = $this->getButtonsFromEntries($entries);

            // attach the same buttons collection to every item
            $itemsWithButtons = $items->map(function ($item) use ($buttons) {
                $item->buttons = $buttons;
                return $item;
            });

            $grouped->put($childId, $itemsWithButtons);
        }

        return $grouped;
    }

    /**
     * Shared utility: resolve any modelName:modelId pair to a model instance or null.
     */

    //before module support
    // protected function resolveModel(string $modelName, $modelId)
    // {
    //     $class = "App\\Models\\{$modelName}";

    //     if (!class_exists($class)) {
    //         return null;
    //     }
    //     $instance = new $class;
    //     $pk = $instance->getKeyName();

    //     return $class::where($pk, $modelId)
    //         ->where('status', 1)
    //         ->first();
    // }

    //with module support
    protected function resolveModel(string $modelName, $modelId, ?string $moduleName = null)
    {
        if ($moduleName) {
            $module = Str::studly(trim($moduleName));
            if (! $this->isModuleEnabled($module)) {
                return null;
            }

            $class = "Modules\\{$module}\\Models\\{$modelName}";

            if (! class_exists($class)) {
                $class = "App\\Models\\{$modelName}";
            }
        } else {
            $class = "App\\Models\\{$modelName}";
        }
        if (!class_exists($class)) {
            return null;
        }
        $instance = new $class;
        $pk = $instance->getKeyName();

        return $class::where($pk, $modelId)
            ->where('status', 1)
            ->first();
    }

    /**
     * Pulls entries JSON for a template/child and any connected templates.
     * Returns flat array of "ModelName:Id" strings.
     */
    protected function gatherEntries(int $templateId, int $childId): array
    {
        $entries = json_decode(
            Content::where('template_id', $templateId)
                ->where('child_id', $childId)
                ->value('entries') ?: '[]',
            true
        );

        $conns = Connection::where(function ($q) use ($templateId, $childId) {
            $q->where('template_id', $templateId)
                ->where('child_id', $childId)
                ->whereIn('bidirectional', [-1, 1]);
        })
            ->orWhere(function ($q) use ($templateId, $childId) {
                $q->where('connected_template_id', $templateId)
                    ->where('connected_child_id', $childId)
                    ->where('bidirectional', 1);
            })
            ->get();

        foreach ($conns as $conn) {
            $t = ($conn->template_id === $templateId)
                ? $conn->connected_template_id
                : $conn->template_id;
            $c = ($conn->child_id === $childId)
                ? $conn->connected_child_id
                : $conn->child_id;

            $json = Content::where('template_id', $t)
                ->where('child_id', $c)
                ->value('entries');

            if ($json) {
                $more = json_decode($json, true);
                if (is_array($more)) {
                    $entries = array_merge($entries, $more);
                }
            }
        }

        return $entries;
    }

    /**
     * Extracts all non-Button entries, resolves models, returns Collection of models in original order.
     */
    protected function getItemsFromEntries(array $entries): \Illuminate\Support\Collection
    {
        return collect($entries)
            ->filter(fn($entry) => explode(':', $entry, 2)[0] !== 'Button')
            ->map(fn($entry) => $this->resolveModel(...explode(':', $entry, 2)))
            ->filter()  // drop any nulls
            ->values();
    }

    /**
     * Extracts all Button entries, resolves models, returns Collection of button models in original order.
     */
    protected function getButtonsFromEntries(array $entries): \Illuminate\Support\Collection
    {
        return collect($entries)
            ->filter(fn($entry) => explode(':', $entry, 2)[0] === 'Button')
            ->map(fn($entry) => $this->resolveModel(...explode(':', $entry, 2)))
            ->filter()
            ->values();
    }

    private function initDB()
    {
        // DB::statement('CREATE TABLE IF NOT EXISTS `viso_articles`
        // (
        //         `article_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        //         `title` varchar(255) DEFAULT NULL,
        //         `subtitle` varchar(255) DEFAULT NULL,
        //         `alias` varchar(200) DEFAULT NULL,
        //         `parent` int(11),
        //         `cover` varchar(255) DEFAULT NULL,
        //         `thumb` varchar(255) DEFAULT NULL,
        //         `description` text DEFAULT NULL,
        //         `entries` text DEFAULT NULL,
        //         `remarks` varchar(255) DEFAULT NULL,
        //         `seo_title` varchar(255) DEFAULT NULL,
        //         `seo_keyword` varchar(255) DEFAULT NULL,
        //         `seo_description` varchar(255) DEFAULT NULL,
        //         `display_order` int(11) DEFAULT NULL,
        //         `status` int(11) DEFAULT 1,
        //         `createdby` varchar(255) DEFAULT NULL,
        //         `created_at` varchar(255) DEFAULT NULL,
        //         `updatedby` varchar(255) DEFAULT NULL,
        //         `updated_at` varchar(255) DEFAULT NULL
        // );'
        // );
        // DB::statement('CREATE TABLE IF NOT EXISTS `viso_labels`
        //     (
        //         `label_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        //         `en` varchar(255) DEFAULT NULL,
        //         `alias` varchar(255) DEFAULT NULL,
        //         `np` varchar(255) DEFAULT NULL,
        //         `hi` varchar(255) DEFAULT NULL,
        //         `status` int(11) DEFAULT 1,
        //         `display_order` int(11) DEFAULT NULL,
        //         `createdby` varchar(255) DEFAULT NULL,
        //         `created_at` varchar(255) DEFAULT NULL,
        //         `updatedby` varchar(255) DEFAULT NULL,
        //         `updated_at` varchar(255) DEFAULT NULL
        //     );');

        // DB::statement('CREATE TABLE IF NOT EXISTS `viso_settings`
        // (
        //         `setting_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        //         `switch_state` varchar(255) DEFAULT NULL,
        //         `profile_image` varchar(255) DEFAULT NULL,
        //         `selected_color` varchar(255) DEFAULT NULL,
        //         `custom_color` varchar(200) DEFAULT NULL,
        //         `status` int(11) DEFAULT 1,
        //         `display_order` int(11) DEFAULT NULL,
        //         `createdby` varchar(255) DEFAULT NULL,
        //         `created_at` varchar(255) DEFAULT NULL,
        //         `updatedby` varchar(255) DEFAULT NULL,
        //         `updated_at` varchar(255) DEFAULT NULL
        // );');

        // try {
        //     // Check if the 'users' table exists
        //     if (DB::getSchemaBuilder()->hasTable('users')) {
        //         // Check if the superadmin user exists
        //         if (!User::where('email', 'subedigokul119@gmail.com')->exists()) {
        //             // Create the superadmin user if it does not exist
        //             $user = User::create([
        //                 'id' => 1,
        //                 'name' => 'Gokul Subedi',
        //                 'email' => 'subedigokul119@gmail.com',
        //                 'password' => Hash::make('password'),
        //             ]);
        //         } else {
        //             // Retrieve the existing user
        //             // $user = User::where('email', 'subedigokul119@gmail.com')->first();
        //             ;

        //         }
        //     } else {
        //         \Log::error("The 'users' table does not exist.");
        //     }

        //     // Check if the 'roles' table exists
        //     if (DB::getSchemaBuilder()->hasTable('roles')) {
        //         // Check if the superadmin role exists
        //         if (!Role::where('name', 'superadmin')->exists()) {
        //             $role = Role::create([
        //                 'id' => 1,
        //                 'name' => 'superadmin',
        //                 'guard_name' => 'web',
        //             ]);
        //         } else {
        //             // Retrieve the existing role
        //             $role = Role::where('name', 'superadmin')->first();
        //         }

        //         // Assign the superadmin role to the user if not already assigned
        //         if ($user && !$user->hasRole('superadmin')) {
        //             $user->assignRole('superadmin');
        //         }
        //     } else {
        //         \Log::error("The 'roles' table does not exist.");
        //     }
        // } catch (\Exception $e) {
        //     \Log::error('Error during user and role creation: ' . $e->getMessage());
        // }
    }
}
// ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci

?>
