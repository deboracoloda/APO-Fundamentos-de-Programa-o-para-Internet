// script.js — campos dinâmicos + cálculo de idade (vanilla JS)
const $ = (s, r = document) => r.querySelector(s);
const $$ = (s, r = document) => Array.from(r.querySelectorAll(s));

// Cálculo automático da idade
const nasc = $('#nascimento');
const idadeSpan = $('#idade');
if (nasc) {
  nasc.addEventListener('change', () => {
    if (!nasc.value) { idadeSpan.textContent = '—'; return; }
    const hoje = new Date();
    const dn = new Date(nasc.value + 'T00:00:00');
    let idade = hoje.getFullYear() - dn.getFullYear();
    const m = hoje.getMonth() - dn.getMonth();
    if (m < 0 || (m === 0 && hoje.getDate() < dn.getDate())) idade--;
    idadeSpan.textContent = isFinite(idade) ? idade : '—';
  });
}

// Helpers para adicionar grupos
function addGrupo(tipo) {
  const mapa = {
    formacao: { lista: '#lista-formacao', classe: 'grupo-formacao', campos: [
      { name: 'curso', placeholder: 'Tecnologia em ...' },
      { name: 'instituicao', placeholder: 'Universidade ...' },
      { name: 'inicio', type: 'month' },
      { name: 'fim', type: 'month' },
    ]},
    experiencia: { lista: '#lista-experiencia', classe: 'grupo-exp', campos: [
      { name: 'empresa', placeholder: 'Empresa X' },
      { name: 'cargo', placeholder: 'Desenvolvedor(a)' },
      { name: 'inicio', type: 'month' },
      { name: 'fim', type: 'month' },
      { name: 'descricao', textarea: true, placeholder: 'Atividades e resultados', span: 2 },
    ]},
    referencia: { lista: '#lista-referencia', classe: 'grupo-ref', campos: [
      { name: 'nome', placeholder: 'Pessoa de referência' },
      { name: 'contato', placeholder: 'E-mail ou telefone' },
    ]},
  };
  const cfg = mapa[tipo];
  const container = $(cfg.lista);
  const idx = $$(`.${cfg.classe}`, container).length;
  const wrapper = document.createElement('div');
  wrapper.className = `${cfg.classe} card relative`;
  wrapper.innerHTML = `
    <button type="button" class="btn-remove" title="Remover">×</button>
    <div class="grid sm:grid-cols-2 gap-4"></div>
  `;
  const grid = $('div.grid', wrapper);
  cfg.campos.forEach(c => {
    const col = document.createElement('div');
    if (c.span === 2) col.className = 'sm:col-span-2';
    const idBase = `${tipo}[${idx}][${c.name}]`;
    const label = document.createElement('label');
    label.className = 'block text-sm mb-1';
    label.textContent = c.name.charAt(0).toUpperCase() + c.name.slice(1);
    let input;
    if (c.textarea) {
      input = document.createElement('textarea');
      input.rows = 3;
    } else {
      input = document.createElement('input');
      if (c.type) input.type = c.type; else input.type = 'text';
    }
    input.name = idBase;
    input.className = 'w-full input';
    if (c.placeholder) input.placeholder = c.placeholder;
    col.appendChild(label);
    col.appendChild(input);
    grid.appendChild(col);
  });
  container.appendChild(wrapper);
}

// Botões + Adicionar
$$('button[data-add]').forEach(btn => {
  btn.addEventListener('click', () => addGrupo(btn.dataset.add));
});

// Remover grupos
addEventListener('click', (e) => {
  if (e.target.classList.contains('btn-remove')) {
    e.target.parentElement.remove();
  }
});
