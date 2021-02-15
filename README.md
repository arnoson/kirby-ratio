# Kirby Ratio

A plugin for `Kirby 3` to create aspect ratio boxes with the padding-top hack.

## Installation

### Manual download

Download and copy this repository to `site/plugins/kirby-vite`.

### Git submodule

```
git submodule add https://github.com/arnoson/kirby-ratio.git site/plugins/kirby-vite
```

### Composer

```
composer require arnoson/kirby-ratio
```

## Plugin assets

Also make sure to include `kirby-ratio`'s css file:

```css
/* In your template's css file: */
@import "media/plugins/arnoson/kirby-ratio/index.css";
```

or

```php
/* In your template's header: */
<?= css('media/plugins/arnoson/kirby-ratio/index.css') ?>
```

## Usage

```php
snippet('ratio-image', [
  'file' => $page->image(),
]);
```

output:

```html
<div class="ratio-box" style="padding-top: {ratio_percent}%">
  <img src="{image_url}" />
</div>
```

Works also with videos, but you need to install `james-heinrich/getid3`.

```php
snippet('ratio-video', [
  'file' => $page->videos()->first(),
]);
```

Or generic ratio boxes with custom content.

```php
snippet('ratio-box', [
  'ratio' => 16/9,
  'content' => '<div>Some content</div>'
]);
```

## Advanced

```php
snippet('ratio-image', [
  'file' => $page->image(),

  // Create a srcset with kirby's `file->srcset()` method.
  // Other possible values:
  // 'srcset' => true - will use your default srcset
  // 'srcset' => 'cover' - will use a specific srcset preset
  // 'srcset' => '@auto' - see the `With kirby-auto-srcset plugin` section in this readme
  'srcset' => [300, 400],

  // Prefix `src` and `srcset` with 'data-' and add a `lazy` class, so you can
  // use it with a lazy loading library like lozad.
  'lazy' => true,

  // Additional HTML attributes on the <img> or <video> element:
  'attributes' => [
    'class' => 'my-image',
    // ...
  ]
]);
```

## With kirby-auto-srcset plugin

Together with [kirby-auto-srcset](https://github.com/arnoson/kirby-auto-srcset)
it is also possible to figure out the srcset automatically.

```php
// config.php
return [
  'arnoson/auto-srcset' => [
    'minWidth' => 300,
    'maxWidth' => 1000,
  ]
];
```

```php
// your template
snippet('ratio-image', [
  'image' => $page->image(),
  'srcset' => '@auto'
]);
```
