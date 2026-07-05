<!-- PARAMETERS -->
<?php

/** @var string $brandName  */

?>

<!-- LAYOUT -->
<?= $this->layout("Layouts/App", [
    "brandName" => $brandName,
    "title" => "Ana Sayfa",
    "activeNav" => "/",
    "dateYear" => "2026",
]) ?>

<!-- CONTENT -->

<!-- SCRIPT -->
<?= $this->start("scripts") ?>
<?= $this->stop() ?>

<!-- STYLE -->
<?= $this->start("styles") ?>
<?= $this->stop() ?>