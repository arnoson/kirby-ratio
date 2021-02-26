<?php

if (!isset($file)) {
  if (option('debug')) {
    throw new Error("No image provided.");
  }  
  return;
}

$lazy = option('arnoson.kirby-ratio.lazy');
$sizes = option('arnoson.kirby-ratio.sizes');
$srcset = option('arnoson.kirby-ratio.srcset');

$ratio = $ratio ?? ($file->height() / $file->width());
$src = $file->url();

// Create srcset.
if ($srcset === true) {
  $srcset = $file->srcset();
} else if ($srcset === '@auto') {
  $srcset = $file->autoSrcset();
} else if (isset($srcset)) {
  $srcset = $file->srcset($srcset);
}

// Prefix `src` and `srcset` attribute with 'data-'.
$lazyPrefix = $lazy ? 'data-' : '';

$attributes = array_filter(array_merge($attributes ?? [], [
  "${lazyPrefix}src" => $src,
  "${lazyPrefix}srcset" => $srcset,
  'sizes' => $sizes
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