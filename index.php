<?php
// index.php — Formulário
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Gerador de Currículo</title>
  <!-- Tailwind via jsDelivr -->
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <!-- Opcional: ícones e fontes -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="public/style.css">
</head>
<body class="bg-gray-50 text-gray-900 font-[Inter]">
  <header class="bg-white shadow-sm sticky top-0 z-10">
    <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
      <h1 class="text-xl sm:text-2xl font-bold">Gerador de Currículo</h1>
      <nav class="hidden sm:flex gap-4 text-sm">
        <a href="#dados" class="hover:underline">Dados Pessoais</a>
        <a href="#formacao" class="hover:underline">Formação</a>
        <a href="#experiencias" class="hover:underline">Experiências</a>
        <a href="#referencias" class="hover:underline">Referências</a>
      </nav>
    </div>
  </header>

  <main class="max-w-5xl mx-auto px-4 py-8">
    <form action="generate.php" method="POST" id="cvForm" class="space-y-8">
      <!-- Dados Pessoais -->
      <section id="dados" class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">Dados Pessoais</h2>
        <div class="grid sm:grid-cols-2 gap-4">
          <div>
            <label class="block text-sm mb-1" for="nome">Nome Completo</label>
            <input required name="nome" id="nome" class="w-full input" placeholder="Seu nome" />
          </div>
          <div>
            <label class="block text-sm mb-1" for="email">E-mail</label>
            <input required type="email" name="email" id="email" class="w-full input" placeholder="voce@email.com" />
          </div>
          <div>
            <label class="block text-sm mb-1" for="telefone">Telefone</label>
            <input name="telefone" id="telefone" class="w-full input" placeholder="(xx) xxxxx-xxxx" />
          </div>
          <div>
            <label class="block text-sm mb-1" for="nascimento">Data de Nascimento</label>
            <input type="date" name="nascimento" id="nascimento" class="w-full input" />
            <p class="text-xs text-gray-500 mt-1">Idade: <span id="idade">—</span></p>
          </div>
          <div class="sm:col-span-2">
            <label class="block text-sm mb-1" for="endereco">Endereço</label>
            <input name="endereco" id="endereco" class="w-full input" placeholder="Rua, nº — Cidade/UF" />
          </div>
          <div class="sm:col-span-2">
            <label class="block text-sm mb-1" for="resumo">Resumo Profissional</label>
            <textarea name="resumo" id="resumo" class="w-full input" rows="4" placeholder="Breve resumo sobre você"></textarea>
          </div>
          <div class="sm:col-span-2">
            <label class="block text-sm mb-1" for="habilidades">Habilidades (separe por vírgulas)</label>
            <input name="habilidades" id="habilidades" class="w-full input" placeholder="PHP, HTML, CSS, JavaScript" />
          </div>
        </div>
      </section>

      <!-- Formação Acadêmica -->
      <section id="formacao" class="bg-white rounded-2xl shadow p-6">
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-lg font-semibold">Formação Acadêmica</h2>
          <button type="button" class="btn btn-secondary" data-add="formacao">+ Adicionar</button>
        </div>
        <div id="lista-formacao" class="space-y-4">
          <div class="grupo-formacao card">
            <div class="grid sm:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm mb-1">Curso</label>
                <input name="formacao[0][curso]" class="w-full input" placeholder="Tecnologia em ..." />
              </div>
              <div>
                <label class="block text-sm mb-1">Instituição</label>
                <input name="formacao[0][instituicao]" class="w-full input" placeholder="Universidade ..." />
              </div>
              <div>
                <label class="block text-sm mb-1">Início</label>
                <input type="month" name="formacao[0][inicio]" class="w-full input" />
              </div>
              <div>
                <label class="block text-sm mb-1">Fim</label>
                <input type="month" name="formacao[0][fim]" class="w-full input" />
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Experiências Profissionais -->
      <section id="experiencias" class="bg-white rounded-2xl shadow p-6">
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-lg font-semibold">Experiências Profissionais</h2>
          <button type="button" class="btn btn-secondary" data-add="experiencia">+ Adicionar</button>
        </div>
        <div id="lista-experiencia" class="space-y-4">
          <div class="grupo-exp card">
            <div class="grid sm:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm mb-1">Empresa</label>
                <input name="experiencia[0][empresa]" class="w-full input" placeholder="Empresa X" />
              </div>
              <div>
                <label class="block text-sm mb-1">Cargo</label>
                <input name="experiencia[0][cargo]" class="w-full input" placeholder="Desenvolvedor(a)" />
              </div>
              <div>
                <label class="block text-sm mb-1">Início</label>
                <input type="month" name="experiencia[0][inicio]" class="w-full input" />
              </div>
              <div>
                <label class="block text-sm mb-1">Fim</label>
                <input type="month" name="experiencia[0][fim]" class="w-full input" />
              </div>
              <div class="sm:col-span-2">
                <label class="block text-sm mb-1">Responsabilidades/Resultados</label>
                <textarea name="experiencia[0][descricao]" class="w-full input" rows="3" placeholder="Descreva principais atividades e resultados"></textarea>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Referências -->
      <section id="referencias" class="bg-white rounded-2xl shadow p-6">
        <div class="flex items-center justify-between mb-4">
          <h2 class="text-lg font-semibold">Referências</h2>
          <button type="button" class="btn btn-secondary" data-add="referencia">+ Adicionar</button>
        </div>
        <div id="lista-referencia" class="space-y-4">
          <div class="grupo-ref card">
            <div class="grid sm:grid-cols-2 gap-4">
              <div>
                <label class="block text-sm mb-1">Nome</label>
                <input name="referencia[0][nome]" class="w-full input" placeholder="Pessoa de referência" />
              </div>
              <div>
                <label class="block text-sm mb-1">Contato</label>
                <input name="referencia[0][contato]" class="w-full input" placeholder="E-mail ou telefone" />
              </div>
            </div>
          </div>
        </div>
      </section>

      <div class="flex items-center justify-end gap-3">
        <button type="reset" class="btn btn-ghost">Limpar</button>
        <button type="submit" class="btn">Gerar Currículo</button>
      </div>
    </form>
  </main>

  <script src="public/script.js"></script>
</body>
</html>
