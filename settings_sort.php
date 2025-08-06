<?php
$data = file_get_contents($urlPartner . "/app/settings.json");
$root = json_decode($data);
$mantenimiento = false;

$progressbar_colors = $root->progressbar_colors;
$numberprocess = $root->numberprocess;
$wins = $root->wins;
$textboletos = $root->textboletos;