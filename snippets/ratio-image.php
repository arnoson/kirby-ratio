<?php

if (!isset($file)) {
  if (option('debug')) {
    throw new Error("No image provided.");
  }  
  return;
}

$ratio = $ratio ?? ($file->height() / $file->width());
$src = $file->url();

// Create srcset.
if (isset($srcset)) {
  if ($srcset === true) {
    $srcset = $file->srcset();
  } else if ($srcset === '@auto') {
    $srcset = $file->autoSrcset();
  } else {
    $srcset = $file->srcset($srcset);
  }
}

// Prefix `src` and `srcset` attribute with 'data-'.
$lazy = $lazy ?? false;
$lazyPrefix = $lazy ? 'data-' : '';

$attributes = array_filter(array_merge($attributes ?? [], [
  "${lazyPrefix}src" => $src ?? null,
  "${lazyPrefix}srcset" => $srcset ?? null,
  'sizes' => $sizes ?? null
]));

if ($lazy) {
  $attributes['class'] = trim(($attributes['class'] ?? '') . ' lazy');
}

$attributeMarkup = arnoson\kirbyRatio\getAttributeMarkup($attributes);
snippet('ratio-box', [
  'ratio' => $ratio,
  'content' => "<img $attributeMarkup/>"
]);

?>