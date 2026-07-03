<?php
// ফোল্ডার রাইট এরর দূর করার ম্যাজিক ট্রিক
$cachePath = '/tmp/bootstrap/cache';
if (!file_exists($cachePath)) {
    @mkdir($cachePath, 0775, true);
}

// আসল ইনডেক্স ফাইলকে কল করা
require __DIR__ . '/../public/index.php';