<?php

$pint = file_get_contents(__DIR__ . '/pint.json');
$data = json_decode($pint, true);

$rules = array_merge([
    '@' . ucfirst($data['preset']) => true
], $data['rules']);

$excludes = $data['exclude'];

$config = new PhpCsFixer\Config;
$config->setRules($rules);

return $config;
