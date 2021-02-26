<?php

namespace arnoson\kirbyRatio;
use Kirby\Cms\App;

function getAttributeMarkup(array $attributes): string {
  $attributesFlattened = [];
  foreach ($attributes as $name => $value) {
    array_push($attributesFlattened, "$name=\"$value\"");
  }
  return implode(' ', $attributesFlattened);
}

App::plugin('arnoson/kirby-ratio', [
  'options' => [
    'image' => [
      'srcset' => null,
      'lazy' => false,
      'sizes' => null,
    ]
  ],
  'snippets' => [
    'ratio-box' => __DIR__ . '/snippets/ratio-box.php',
    'ratio-image' => __DIR__ . '/snippets/ratio-image.php',
    'ratio-video' => __DIR__ . '/snippets/ratio-video.php'
  ]
]);