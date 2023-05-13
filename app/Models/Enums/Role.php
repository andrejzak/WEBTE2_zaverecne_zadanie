<?php

namespace App\Models\Enums;

enum Role: string
{
  case Teacher = "teacher";
  case Student = "student";

  /**
   * Return array of enum values.
   *
   * @return array<string>
   */
  public static function values()
  {
    return array_map(function ($item) {
      return $item->value;
    }, Role::cases());
  }
}
