<?php

if (!isset($file)) {
  if (option('debug')) {
    throw new Error("No video provided.");
  }
  return;
}

if (!isset($ratio)) {
  $getID3 = new getID3;
  $info = $getID3->analyze($file->root());
  $ratio = $info['video']['resolution_y'] / $info['video']['resolution_x'];
}

$src = $file->url();

// Prefix `src` attribute with 'data-'.
$lazy = $lazy ?? false;
$lazyPrefix = $lazy ? 'data-' : '';

$attributes = array_merge($attributes ?? [], [
  "${lazyPrefix}src" => $src ?? null
]);

if ($lazy) {
  $attributes['class'] = trim(($attributes['class'] ?? '') . ' lazy');
}

$attributeMarkup = arnoson\kirbyRatio\getAttributeMarkup($attributes);
snippet('ratio-box', [
  'ratio' => $ratio,
  'content' => "<video $attributeMarkup></video>"
]);

?>