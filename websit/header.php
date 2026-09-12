<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    /* =========================
   الإعدادات العامة
========================= */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, Tahoma, sans-serif;
    background-color: #f4f6f9;
    color: #1f2937;
    direction: rtl;
    min-height: 100vh;
}

.container {
    width: 90%;
    max-width: 1100px;
    margin: auto;
}


/* =========================
   الشريط العلوي
========================= */

.navbar {
    background-color: #1e3a5f;
    height: 70px;

    display: flex;
    align-items: center;

    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

.navbar-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.logo {
    color: white;
    font-size: 21px;
    font-weight: bold;
}

nav {
    display: flex;
    gap: 8px;
}

nav a {
    color: #e5e7eb;
    text-decoration: none;

    padding: 10px 18px;

    border-radius: 6px;

    font-size: 15px;

    transition: 0.2s;
}

nav a:hover,
nav a.active {
    background-color: #2563eb;
    color: white;
}

</style>
<body

</body>
</html>