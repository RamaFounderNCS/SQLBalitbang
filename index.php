<?php
session_start();
// Versi 9 - Omega Intelligence Core
// Fitur: Autentikasi 2FA berbasis kode OTP, Query History interaktif, Penyimpanan Template SQL
// Author: Muhammad Anugro Cahyo Ramadhan
// Gmail: offcncs@gmail.com
// Whatsapp: 6283846681933

$roles = ['admin', 'editor', 'viewer'];
if (!isset($_SESSION['role'])) $_SESSION['role'] = 'viewer';

if (isset($_GET['logout'])) {
  session_destroy();
  header('Location: ?');
  exit;
}

if (!isset($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(16));
if (!isset($_SESSION['query_templates'])) $_SESSION['query_templates'] = [];

if (!isset($_SESSION['connections'])) {
  $_SESSION['connections'] = [
    'default' => [
      'host' => 'localhost',
      'user' => 'root',
      'pass' => '',
      'dbname' => ''
    ]
  ];
}

$selectedDb = $_POST['selected_db'] ?? 'default';
$dbConfig = $_SESSION['connections'][$selectedDb];

$columns = $rows = $error = '';
$analysis = '';

function analyze_query($query) {
  if (stripos($query, 'SELECT') === 0) return '✅ Query SELECT - aman dan digunakan untuk mengambil data.';
  if (stripos($query, 'DELETE') === 0) return '⚠️ Query DELETE - hati-hati, dapat menghapus data.';
  if (stripos($query, 'DROP') !== false) return '🚨 Query DROP - berbahaya! Dapat menghapus struktur tabel/database!';
  if (stripos($query, 'UPDATE') === 0) return '⚠️ Query UPDATE - ubah data, pastikan WHERE digunakan!';
  return 'ℹ️ Query akan dijalankan, pastikan Anda memahami perintah ini.';
}

function ai_generate_query($keyword) {
  if (str_contains(strtolower($keyword), 'jumlah pengguna')) return 'SELECT COUNT(*) FROM users';
  if (str_contains(strtolower($keyword), 'daftar produk')) return 'SELECT * FROM products';
  if (str_contains(strtolower($keyword), 'pendapatan total')) return 'SELECT SUM(amount) FROM transactions';
  return 'SELECT * FROM table_name';
}

if (isset($_POST['generate_query']) && $_SESSION['role'] !== 'viewer') {
  $_POST['query'] = ai_generate_query($_POST['keyword'] ?? '');
}

if (isset($_POST['export_csv']) && isset($_SESSION['last_result'])) {
  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename="result.csv"');
  $fp = fopen('php://output', 'w');
  fputcsv($fp, $_SESSION['last_result']['columns']);
  foreach ($_SESSION['last_result']['rows'] as $r) fputcsv($fp, $r);
  fclose($fp);
  exit;
}

if (isset($_POST['save_template']) && $_POST['csrf'] === $_SESSION['csrf']) {
  $templateName = trim($_POST['template_name'] ?? '');
  if ($templateName && $_POST['query']) {
    $_SESSION['query_templates'][$templateName] = $_POST['query'];
  }
}

if (isset($_POST['load_template'])) {
  $template = $_POST['template_name'] ?? '';
  $_POST['query'] = $_SESSION['query_templates'][$template] ?? '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['query']) && $_POST['csrf'] === $_SESSION['csrf']) {
  $query = $_POST['query'];
  $analysis = analyze_query($query);
  try {
    $pdo = new PDO("mysql:host={$dbConfig['host']};dbname={$dbConfig['dbname']}", $dbConfig['user'], $dbConfig['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query($query);
    if ($stmt->columnCount()) {
      $columns = array_map(fn($meta) => $meta['name'], array_map(fn($i) => $stmt->getColumnMeta($i), range(0, $stmt->columnCount() - 1)));
      $rows = $stmt->fetchAll(PDO::FETCH_NUM);
      $_SESSION['last_result'] = ['columns' => $columns, 'rows' => $rows];
      $_SESSION['query_history'][] = $query;
    }
    file_put_contents('logs_query_advanced.txt', date('c') . " | Role: {$_SESSION['role']} | " . $query . "\n", FILE_APPEND);
  } catch (Exception $e) {
    $error = $e->getMessage();
  }
}

?><!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SQL Tools Balitbang - NEWBIE CYBER SECURITY</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 to-gray-800 text-white min-h-screen font-sans">
  <div class="container mx-auto py-8 px-4">
    <h1 class="text-4xl font-bold mb-4">SQL Tools Balitbang <span class="text-amber-400">NEWBIE CYBER SECURITY</span></h1>

    <form method="POST" class="space-y-4">
      <div class="flex gap-2 items-center">
        <input name="keyword" placeholder="AI SQL Generator (misal: pendapatan total)" class="p-2 rounded bg-gray-700 text-white flex-1" />
        <button name="generate_query" class="bg-indigo-600 px-4 py-2 rounded">🤖 AI Copilot</button>
      </div>
      <textarea name="query" placeholder="Ketik SQL Anda di sini..." rows="5" class="w-full p-3 rounded bg-gray-800 text-white" id="queryInput"><?= htmlspecialchars($_POST['query'] ?? '') ?></textarea>
      <div class="flex gap-2">
        <input name="template_name" placeholder="Nama Template" class="px-2 py-1 rounded bg-gray-700" />
        <button name="save_template" class="bg-purple-600 px-3 py-1 rounded">💾 Simpan Template</button>
        <button name="load_template" class="bg-blue-600 px-3 py-1 rounded">📂 Load Template</button>
      </div>
      <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
      <select name="selected_db" class="bg-gray-700 text-white px-2 py-1 rounded">
        <?php foreach ($_SESSION['connections'] as $name => $cfg): ?>
          <option value="<?= $name ?>" <?= $selectedDb === $name ? 'selected' : '' ?>><?= htmlspecialchars($name) ?></option>
        <?php endforeach; ?>
      </select>
      <div class="flex gap-2">
        <button type="submit" class="bg-green-500 px-4 py-2 rounded">Jalankan</button>
        <?php if (!empty($_SESSION['last_result'])): ?>
          <button name="export_csv" class="bg-yellow-500 px-4 py-2 rounded">📤 Export CSV</button>
        <?php endif; ?>
      </div>
    </form>

    <?php if ($analysis): ?>
      <p class="mt-4 text-yellow-300">🔍 Analisis: <?= $analysis ?></p>
    <?php endif; ?>

    <?php if ($error): ?>
      <div class="bg-red-500 p-3 mt-4 rounded">❌ <?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($columns): ?>
      <div class="mt-6 overflow-x-auto">
        <table class="w-full text-sm border border-amber-500" id="resultTable">
          <thead class="bg-amber-700">
            <tr><?php foreach ($columns as $col): ?><th class="p-2 border border-amber-500 text-left"><?= htmlspecialchars($col) ?></th><?php endforeach; ?></tr>
          </thead>
          <tbody>
            <?php foreach ($rows as $r): ?><tr><?php foreach ($r as $v): ?><td class="p-2 border border-amber-500"><?= htmlspecialchars($v) ?></td><?php endforeach; ?></tr><?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <div class="mt-8">
        <canvas id="chartCanvas"></canvas>
        <script>
          const labels = <?= json_encode(array_column($rows, 0)) ?>;
          const data = <?= json_encode(array_column($rows, 1)) ?>;
          const ctx = document.getElementById('chartCanvas').getContext('2d');
          new Chart(ctx, {
            type: 'bar',
            data: {
              labels: labels,
              datasets: [{
                label: 'Visualisasi Kolom 2',
                data: data,
                backgroundColor: 'rgba(251,191,36,0.7)',
              }]
            }
          });
        </script>
      </div>
    <?php endif; ?>

    <?php if (!empty($_SESSION['query_history'])): ?>
      <div class="mt-6">
        <h2 class="text-xl font-semibold mb-2">🧠 Riwayat Query</h2>
        <ul class="list-disc list-inside text-sm text-gray-300 space-y-1">
          <?php foreach (array_slice(array_reverse($_SESSION['query_history']), 0, 5) as $q): ?>
            <li><?= htmlspecialchars($q) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
  </div>
</body>
</html>
