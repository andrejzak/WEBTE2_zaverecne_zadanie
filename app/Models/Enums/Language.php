<?php

namespace App\Models\Enums;

enum Language: string
{
  case English = "en";
  case Slovak = "sk";

  /**
   * Return array of enum values.
   *
   * @return array<string>
   */
  public static function values()
  {
    return array_map(function ($item) {
      return $item->value;
    }, Language::cases());
  }
}
