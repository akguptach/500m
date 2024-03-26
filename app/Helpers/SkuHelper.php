<?php
function generateSkuFromTitle($title, $maxLength = 10) {
    $title = strtolower($title);
    $title = preg_replace('/[^a-zA-Z0-9]/', '', $title);
    $title = substr($title, 0, $maxLength);
    $sku = $title; // You can use other methods for uniqueness
    return $sku;
}