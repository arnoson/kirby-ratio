<?php

$ratio = $ratio ?? 1;
$content = $content ?? null;

$ratioPercent = $ratio * 100;
$ratioStyle = "padding-top: $ratioPercent%";
?>

<div class="ratio-box" style="<?= $ratioStyle ?>">
  <?= $content ?>
</div>