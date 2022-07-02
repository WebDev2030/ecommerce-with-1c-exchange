<?php

namespace App\Helpers;

class Arr
{
    static function buildTree(array &$elements, $parentId = 0, $idKeyName = 'id', $parentIdKeyName = 'parent_id') {
        $branch = array();

        foreach ($elements as $element) {
            if (isset($element[$parentIdKeyName]) && $element[$parentIdKeyName] == $parentId) {
                $children = self::buildTree($elements, $element[$idKeyName], $idKeyName, $parentIdKeyName);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[$element[$idKeyName]] = $element;
                unset($elements[$element[$idKeyName]]);
            }
        }
        return $branch;
    }
}
