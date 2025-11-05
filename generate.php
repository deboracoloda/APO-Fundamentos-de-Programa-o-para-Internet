<?php
// generate.php — Monta o currículo com PHP
function h($v) { return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); }

$nome        = $_POST['nome'] ?? '';
$email       = $_POST['email'] ?? '';
$telefone    = $_POST['telefone'] ?? '';
$nascimento  = $_POST['nascimento'] ?? '';
$endereco    = $_POST['endereco'] ?? '';
$resumo      = $_POST['resumo'] ?? '';
$habilidades = array_filter(array_map('trim', explode(',', $_POST['habilidades'] ?? '')));
$formacoes   = $_POST['formacao']   ?? [];
$experiencias= $_POST['experiencia']?? [];
$referencias = $_POST['referencia'] ?? [];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Currículo – <?php echo h($nome); ?></title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="stylesheet" href="public/style.css">
</head>
<body class="bg-gray-100 text-gray-900 font-[Inter]">
  <div class="max-w-4xl mx-auto my-8 p-6 bg-white shadow rounded-2xl">
    <header class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 border-b pb-4">
      <div>
        <h1 class="text-2xl font-bold"><?php echo h($nome); ?></h1>
        <p class="text-sm text-gray-600"><?php echo h($endereco); ?></p>
      </div>
      <div class="text-sm text-gray-700">
        <p><strong>E-mail:</strong> <?php echo h($email); ?></p>
        <p><strong>Telefone:</strong> <?php echo h($telefone); ?></p>
        <?php if ($nascimento): ?>
          <p><strong>Nascimento:</strong> <?php echo h($nascimento); ?></p>
        <?php endif; ?>
      </div>
    </header>

    <?php if ($resumo): ?>
    <section class="mt-6">
      <h2 class="section-title">Resumo Profissional</h2>
      <p class="leading-relaxed"><?php echo nl2br(h($resumo)); ?></p>
    </section>
    <?php endif; ?>

    <?php if ($habilidades): ?>
    <section class="mt-6">
      <h2 class="section-title">Habilidades</h2>
      <ul class="flex flex-wrap gap-2">
        <?php foreach ($habilidades as $hab): ?>
          <li class="px-3 py-1 bg-gray-100 rounded-full text-sm"><?php echo h($hab); ?></li>
        <?php endforeach; ?>
      </ul>
    </section>
    <?php endif; ?>

    <?php if ($formacoes): ?>
    <section class="mt-6">
      <h2 class="section-title">Formação Acadêmica</h2>
      <div class="space-y-3">
        <?php foreach ($formacoes as $f): ?>
          <?php if (!array_filter($f)) continue; ?>
          <article class="card">
            <div class="flex flex-wrap items-baseline justify-between gap-2">
              <h3 class="font-semibold"><?php echo h($f['curso'] ?? ''); ?></h3>
              <span class="text-sm text-gray-600"><?php echo h(($f['inicio'] ?? '') . (isset($f['fim']) && $f['fim'] ? ' — ' . $f['fim'] : '')); ?></span>
            </div>
            <p class="text-sm text-gray-700"><?php echo h($f['instituicao'] ?? ''); ?></p>
          </article>
        <?php endforeach; ?>
      </div>
    </section>
    <?php endif; ?>

    <?php if ($experiencias): ?>
    <section class="mt-6">
      <h2 class="section-title">Experiências</h2>
      <div class="space-y-3">
        <?php foreach ($experiencias as $e): ?>
          <?php if (!array_filter($e)) continue; ?>
          <article class="card">
            <div class="flex flex-wrap items-baseline justify-between gap-2">
              <h3 class="font-semibold"><?php echo h(($e['cargo'] ?? '') . (isset($e['empresa']) && $e['empresa'] ? ' — ' . $e['empresa'] : '')); ?></h3>
              <span class="text-sm text-gray-600"><?php echo h(($e['inicio'] ?? '') . (isset($e['fim']) && $e['fim'] ? ' — ' . $e['fim'] : '')); ?></span>
            </div>
            <p class="text-sm leading-relaxed whitespace-pre-line"><?php echo h($e['descricao'] ?? ''); ?></p>
          </article>
        <?php endforeach; ?>
      </div>
    </section>
    <?php endif; ?>

    <?php if ($referencias): ?>
    <section class="mt-6">
      <h2 class="section-title">Referências</h2>
      <ul class="space-y-2">
        <?php foreach ($referencias as $r): ?>
          <?php if (!array_filter($r)) continue; ?>
          <li class="text-sm"><strong><?php echo h($r['nome'] ?? ''); ?>:</strong> <?php echo h($r['contato'] ?? ''); ?></li>
        <?php endforeach; ?>
      </ul>
    </section>
    <?php endif; ?>

    <div class="mt-8 flex items-center justify-end gap-3 no-print">
      <a href="index.php" class="btn btn-ghost">Voltar</a>
      <button onclick="window.print()" class="btn">Imprimir / Baixar</button>
    </div>
  </div>
</body>
</html>
