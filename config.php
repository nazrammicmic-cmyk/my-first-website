<?php
mysqli_report(MYSQLI_REPORT_OFF);
$conn = new mysqli("localhost", "root", "", "sfhs_complaints");
if ($conn->connect_error) die("Database connection failed. Start MySQL and import database.sql. " . htmlspecialchars($conn->connect_error));
$conn->set_charset("utf8mb4");
date_default_timezone_set("Asia/Manila");
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
function e($v){ return htmlspecialchars((string)$v, ENT_QUOTES, "UTF-8"); }
function require_admin(){ if (empty($_SESSION["admin_id"])) { header("Location: login.php"); exit; } }
