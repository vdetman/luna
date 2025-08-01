<?php

namespace App\Modules\Activities\Actions;

use App\Modules\Activities\Models\Activity;
use Illuminate\Support\Collection;

class ActivityGetTreeAction
{
    public function execute(): Collection
    {
        // Получаем все активности с их детьми
        $activities = Activity::with('children')->get();

        // Строим дерево, начиная с корневых элементов (parent_id = null)
        return $this->buildTree($activities);
    }

    private function buildTree(Collection $activities, ?int $parentId = null): Collection
    {
        $tree = collect();

        foreach ($activities as $activity) {
            if ($activity->parent_id === $parentId) {
                // Рекурсивно получаем дочерние элементы для текущего элемента
                $children = $this->buildTree($activities, $activity->id);

                // Добавляем дочерние элементы к текущему элементу
                $activity->setRelation('children', $children);

                $tree->push($activity);
            }
        }

        return $tree;
    }
}
