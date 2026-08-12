<?php
include_once "koneksi.php";
$isAdmin = true; // yes. no auth. don't ask :3
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/cms-blog/src/output.css" />
</head>

<body>
    <nav class="sticky top-0 z-[999] w-full flex items-center justify-between px-24 py-4 border-b bg-bg border-black/10">
        <div class="flex items-center">
            <a href="/cms-blog/src/index.php">
                <img src="/cms-blog/assets/logo/shiori-nobg.png" class="h-16 mr-10" />
            </a>
            <ul>
                <li class="flex gap-8 text-lg tracking-wider font-medium">
                    <a href="#">Home</a>
                    <a href="#">Blogs</a>
                    <a href="#">About Us</a>
                    <a href="#">Contact</a>
                </li>
        </div>
        <!-- <div class="bg-primary text-white text-lg tracking-wider font-bold px-7 py-3">
        <a>Login / Register</a>
      </div> -->
        <div class="">
            <a href="./new-story" class="flex items-center gap-2 bg-primary text-white text-lg tracking-wider font-bold px-6 py-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 5v14m-7-7h14" />
                </svg>
                Create</a>
        </div>
        </ul>
    </nav>
