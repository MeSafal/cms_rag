<?php

namespace App\Services;

use App\Models\Content;
use App\Models\Template;

class TemplateService
{
    public function updateTemplateEntries(
        string $model,
        ?int $newTemplateId,
        ?int $newChildId,
        int $itemId,
        int $status = 1
    ) {
        $posKey = "{$model}:{$itemId}";
        $negKey = "{$model}:-{$itemId}";
        $newEntry = $status === -1 ? $negKey : $posKey;

        // 1) Locate any row containing this entry (positive or negative)
        $current = Content::whereJsonContains('entries', $posKey)
            ->orWhereJsonContains('entries', $negKey)
            ->first();

        // 2) Only status change (no new tpl/child) → swap key in place
        if ($current && !$newTemplateId && !$newChildId) {
            $entries = json_decode($current->entries, true) ?: [];
            $entries = array_filter($entries, fn($e) => $e !== $posKey && $e !== $negKey);
            $entries[] = $newEntry;
            $current->entries = json_encode(array_values($entries));
            $current->save();
            return;
        }

        // 3) Status = 0 → just remove the entry, leave the row (even if empty)
        if ($current && $status === 0) {
            $entries = json_decode($current->entries, true) ?: [];
            $entries = array_filter($entries, fn($e) => $e !== $posKey && $e !== $negKey);
            $current->entries = json_encode(array_values($entries));
            $current->save();
            return;
        }

        // 4) Moving to a new location:
        if ($current) {
            $entries = json_decode($current->entries, true) ?: [];
            $entries = array_filter($entries, fn($e) => $e !== $posKey && $e !== $negKey);
            $current->entries = json_encode(array_values($entries));
            $current->save();
        }

        // 5) If status ≠ 0 and we have a new target, add it there
        if ($status !== 0 && $newTemplateId && $newChildId) {
            $target = Content::firstOrNew(
                ['template_id' => $newTemplateId, 'child_id' => $newChildId]
            );
            $tEntries = json_decode($target->entries ?? '[]', true) ?: [];
            // remove existing keys just in case
            $tEntries = array_filter($tEntries, fn($e) => $e !== $posKey && $e !== $negKey);
            $tEntries[] = $newEntry;
            $target->entries = json_encode(array_values($tEntries));
            $target->save();
        }
    }

    public function getTemplateLocation(string $model, int $itemId): ?array
    {
        //last pull is successful
        $modelKey = "{$model}:{$itemId}";
        $negativeKey = "{$model}:-{$itemId}";

        $content = \App\Models\Content::whereJsonContains('entries', $modelKey)
            ->orWhereJsonContains('entries', $negativeKey)
            ->first();

        if (!$content) {
            return null;
        }

        return [
            'template_id' => $content->template_id,
            'child_id' => $content->child_id,
        ];
    }

    public function getDefaultLocation($template, $child)
    {
        $template = Template::where('name', $template)->where('status', 1)->value('templates_id');
        $child = Template::where('name', $child)->where('status', 1)->value('templates_id');

        $location = [
            'template_id' => $template,
            'child_id' => $child
        ];
        return $location;
    }

}
