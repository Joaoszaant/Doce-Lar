/* ---------- Simulação / configuração inicial ----------
   Em um site real estas informações viriam do backend via API.
   Para testar aqui você pode:
   - deixar `simulatedUser = null` -> usuario não logado
   - setar um objeto -> usuario logado
*/
const simulatedUser = null;
// const simulatedUser = { id: 1, name: "João Pedro", email: "joao@exemplo.com", adoptions: ["Rex"] };

document.addEventListener("DOMContentLoaded", () => {
  initNavbar();
  initCarousel();
  renderAnimals();
  document.getElementById("year").textContent = new Date().getFullYear();
});

/* ---------------- NAVBAR & PROFILE ---------------- */
function initNavbar(){
  const navRight = document.getElementById("nav-right");
  if (!navRight) return;

  if (simulatedUser){
    // substitui botões por avatar
    navRight.innerHTML = '';
    const avatar = document.createElement('div');
    avatar.className = 'avatar-sm';
    avatar.textContent = initials(simulatedUser.name);
    avatar.title = simulatedUser.name;
    avatar.id = 'user-avatar';
    navRight.appendChild(avatar);

    avatar.addEventListener('click', toggleProfileFloat);

    // preencher dados do perfil flutuante
    document.getElementById('pf-name').textContent = simulatedUser.name;
    document.getElementById('pf-email').textContent = simulatedUser.email || '';
    document.getElementById('pf-adoptions').textContent = (simulatedUser.adoptions && simulatedUser.adoptions.join(', ')) || 'Nenhuma ainda';
    document.getElementById('pf-avatar').textContent = initials(simulatedUser.name);

    document.getElementById('btn-logout').addEventListener('click', () => {
      // Em app real: chamar endpoint /logout e depois recarregar
      alert('Funcionalidade de logout precisa ser implementada no backend. (Simulação)');
    });

    // clique fora fecha o painel
    document.addEventListener('click', (e) => {
      const pf = document.getElementById('profile-float');
      const av = document.getElementById('user-avatar');
      if (!pf || !av) return;
      if (pf.classList.contains('hidden')) return;
      if (!pf.contains(e.target) && !av.contains(e.target)) {
        closeProfileFloat();
      }
    });

  } else {
    const login = document.getElementById('btn-login');
    const signup = document.getElementById('btn-signup');
   if (login) login.setAttribute('href','login.php');
if (signup) signup.setAttribute('href','cadastro.php');

  }
}

function initials(name){
  if (!name) return '';
  return name.split(' ').map(n=>n[0]).slice(0,2).join('').toUpperCase();
}
function toggleProfileFloat(){
  const pf = document.getElementById('profile-float');
  if (!pf) return;
  const hidden = pf.classList.toggle('hidden');
  pf.setAttribute('aria-hidden', hidden);
}
function closeProfileFloat(){
  const pf = document.getElementById('profile-float');
  if (!pf) return;
  pf.classList.add('hidden');
  pf.setAttribute('aria-hidden', 'true');
}

/* ---------------- CAROUSEL ---------------- */
function initCarousel(){
  const slides = Array.from(document.querySelectorAll('.slide'));
  const indicatorsWrap = document.getElementById('carousel-indicators');
  let index = slides.findIndex(s => s.classList.contains('active'));
  if (index === -1) index = 0;

  slides.forEach((_, i) => {
    const btn = document.createElement('button');
    if (i === index) btn.classList.add('active');
    btn.addEventListener('click', ()=> goTo(i));
    indicatorsWrap.appendChild(btn);
  });

  document.getElementById('carousel-prev').addEventListener('click', ()=> goTo(index-1));
  document.getElementById('carousel-next').addEventListener('click', ()=> goTo(index+1));

  let timer = setInterval(()=> goTo(index+1), 5000);

  function goTo(newIndex){
    clearInterval(timer);
    const n = slides.length;
    index = ((newIndex % n) + n) % n;
    slides.forEach((s,i)=> s.classList.toggle('active', i===index));
    Array.from(indicatorsWrap.children).forEach((b,i)=> b.classList.toggle('active', i===index));
    timer = setInterval(()=> goTo(index+1), 5000);
  }
}

/* ---------------- ANIMALS (exemplo estático) ---------------- */
function renderAnimals(){
  const animals = [
    { id:1, name:'Rex', age:'3 anos', city:'Rio de Janeiro', img:'https://images.unsplash.com/photo-1548199973-03cce0bbc87b?auto=format&fit=crop&w=600&q=60' },
    { id:2, name:'Luna', age:'1 ano', city:'São Paulo', img:'https://images.unsplash.com/photo-1507149833265-60c372daea22?auto=format&fit=crop&w=600&q=60' },
    { id:3, name:'Thor', age:'4 anos', city:'Belo Horizonte', img:'https://images.unsplash.com/photo-1517423440428-a5a00ad493e8?auto=format&fit=crop&w=600&q=60' },
    { id:4, name:'Maya', age:'6 meses', city:'Curitiba', img:'https://images.unsplash.com/photo-1568572933382-74d440642117?auto=format&fit=crop&w=600&q=60' }
  ];

  const grid = document.getElementById('animal-grid');
  grid.innerHTML = '';
  animals.forEach(a=>{
    const card = document.createElement('div');
    card.className = 'animal-card';
    card.innerHTML = `
      <div class="animal-thumb" style="background-image:url('${a.img}');"></div>
      <div>
        <strong>${a.name}</strong>
        <div class="muted">${a.age} • ${a.city}</div>
      </div>
      <div class="animal-info">
        <a href="detalhes.html?id=${a.id}" class="btn btn-ghost small">Ver detalhes</a>
        <button class="btn btn-primary small" onclick="startAdoption(${a.id})">Quero adotar</button>
      </div>
    `;
    grid.appendChild(card);
  });
}

/* função chamada ao clicar "Quero adotar" */
function startAdoption(animalId){
  // Em um sistema real: abrir modal e chamar endpoint para iniciar processo de adoção.
  alert('Para iniciar a adoção precisamos integrar com o backend. (Simulação) Animal: ' + animalId);
}

/* ----------------- End of file ----------------- */
