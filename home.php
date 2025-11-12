<?php
session_start();
?>
<!doctype html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Adote um Amigo — Home</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<body>
  <header class="navbar">
    <div class="nav-left">
      <a class="logo" href="/"> 
        <img src="https://via.placeholder.com/44x44.png?text=🐶" alt="Logo Adote" />
        <span>Adote um Amigo</span>
      </a>
    </div>

    <nav class="nav-links">
      <a href="pets.php" class="nav-item">Encontrar pets</a>
      <a href="#about" class="nav-item">Sobre</a>
    </nav>

    <a href="confirmar_usuario.php" class="botao-adicionar">Adicionar Animal</a>

    <div class="nav-right" id="nav-right">
      <?php if (isset($_SESSION['id_usuario'])): ?>
        <div class="user-area" style="display:flex; align-items:center; gap:10px;">
          <?php
            $nome = $_SESSION['nome'] ?? '';
            $parts = explode(' ', trim($nome));
            $initials = '';
            foreach ($parts as $p) {
              if ($p !== '') $initials .= mb_substr($p, 0, 1);
            }
            $initials = mb_strtoupper(mb_substr($initials, 0, 2));
          ?>
          <button id="avatar-btn" class="avatar-sm" aria-expanded="false"><?php echo htmlspecialchars($initials); ?></button>
          <span class="user-name" id="user-name"><?php echo htmlspecialchars($_SESSION['nome']); ?></span>
        </div>
      <?php else: ?>
        <a href="login.php" class="btn btn-ghost" id="btn-login">Entrar</a>
        <a href="cadastro.php" class="btn btn-primary" id="btn-signup">Cadastrar</a>
      <?php endif; ?>
    </div>
  </header>

  <div id="profile-float" class="profile-float hidden" aria-hidden="true">
    <div class="profile-card">
      <div class="profile-header">
        <div class="avatar-large" id="pf-avatar"><?php echo isset($_SESSION['nome']) ? htmlspecialchars($initials) : 'JP'; ?></div>
        <div>
          <strong id="pf-name"><?php echo isset($_SESSION['nome']) ? htmlspecialchars($_SESSION['nome']) : 'João'; ?></strong>
          <div id="pf-email" class="muted"><?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'joao@email.com'; ?></div>
        </div>
      </div>
      <div class="profile-body">
        <p><strong>Telefone</strong><br><small id="pf-telefone"><?php echo isset($_SESSION['telefone']) ? htmlspecialchars($_SESSION['telefone']) : '—'; ?></small></p>
        <div class="profile-actions">
          <a href="meu-perfil.html" class="btn btn-ghost small">Meu Perfil</a>
          <form method="post" action="logout.php" style="display:inline;">
            <button id="btn-logout" class="btn btn-danger small" type="submit">Sair</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <section class="carousel" aria-roledescription="carousel" id="main-carousel">
    <div class="slides">
      <div class="slide active" style="background-image: url('https://images.unsplash.com/photo-1517849845537-4d257902454a?auto=format&fit=crop&w=1400&q=60');">
        <div class="slide-caption">
          <h2>Encontre seu novo amigo</h2>
          <p>Temos cães de todas as idades esperando por um lar.</p>
          <a href="pets.php" class="btn btn-light">Ver cães para adoção</a>
        </div>
      </div>

      <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1558788353-f76d92427f16?auto=format&fit=crop&w=1400&q=60');">
        <div class="slide-caption">
          <h2>Cuidado e carinho</h2>
          <p>Cada cão recebe atenção, vacinas e avaliação antes da adoção.</p>
          <a href="#about" class="btn btn-light">Saiba mais</a>
        </div>
      </div>

      <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1537151625747-768eb6cf92b8?auto=format&fit=crop&w=1400&q=60');">
        <div class="slide-caption">
          <h2>Adotar transforma vidas</h2>
          <p>Adotar é amor que vira rotina e alegria em dobro.</p>
          <a href="pets.php" class="btn btn-light">Adote já</a>
        </div>
      </div>
    </div>

    <button class="carousel-btn prev" id="carousel-prev" aria-label="Anterior">&#10094;</button>
    <button class="carousel-btn next" id="carousel-next" aria-label="Próximo">&#10095;</button>

    <div class="carousel-indicators" id="carousel-indicators"></div>
  </section>

  <section class="why-adopt" aria-labelledby="why-title">
    <h2 id="why-title">Por que adotar?</h2>
    <div class="cards">
      <article class="card">
        <div class="card-ill">
          <img src="https://images.unsplash.com/photo-1543466835-00a7907e7f6b?auto=format&fit=crop&w=600&q=60" alt="amor por pets">
        </div>
        <div class="card-content">
          <h3>Nesse exato momento,</h3>
          <p>existem milhares de doguinhos e gatinhos esperando um humano para chamar de seu.</p>
        </div>
      </article>

      <article class="card">
        <div class="card-ill">
          <img src="https://images.unsplash.com/photo-1518779578993-ec3579fee39f?auto=format&fit=crop&w=600&q=60" alt="recompensa">
        </div>
        <div class="card-content">
          <h3>E não há recompensa maior</h3>
          <p>do que vê-los se tornando aquela coisinha alegre e saudável depois de cuidado e carinho.</p>
        </div>
      </article>

      <article class="card">
        <div class="card-ill">
          <img src="https://images.unsplash.com/photo-1507146426996-ef05306b995a?auto=format&fit=crop&w=600&q=60" alt="mudar destino">
        </div>
        <div class="card-content">
          <h3>Pensando bem, a pergunta é outra:</h3>
          <p>se você pode mudar o destino de um animal de rua, por que não faria isso?</p>
        </div>
      </article>
    </div>

    <div class="center">
      <a href="pets.php" class="btn btn-primary large">Encontrar meu novo amigo</a>
    </div>
  </section>

  <section id="about" class="about">
    <div class="container">
      <h2>Sobre o projeto</h2>
      <p class="lead">Somos uma plataforma que conecta abrigos e pessoas dispostas a adotar. Verificamos e cuidamos dos animais antes de colocá-los para adoção e oferecemos suporte no pós-adoção.</p>
      <div class="center">
        <a href="sobre.html" class="btn btn-ghost">Mais informações</a>
      </div>
    </div>
  </section>

  <footer class="site-footer">
    <div class="container footer-grid">
      <div>
        <strong>Adote um Amigo</strong>
        <p>Transformando vidas — uma adoção por vez.</p>
      </div>
      <div>
        <h4>Links</h4>
        <a href="pets.php">Encontrar pets</a><br>
        <a href="#about">Sobre</a>
      </div>
      <div>
        <h4>Contato</h4>
        <p>Email: contato@adoteuamigo.org</p>
      </div>
    </div>
    <div class="footer-bottom">
      <small>© <span id="year"></span> Adote um Amigo — Todos os direitos reservados.</small>
    </div>
  </footer>

  <script>
    (function(){
      const avatarBtn = document.getElementById('avatar-btn');
      const profileFloat = document.getElementById('profile-float');
      if (!avatarBtn || !profileFloat) return;

      avatarBtn.addEventListener('click', function(e){
        e.stopPropagation();
        profileFloat.classList.toggle('hidden');
        avatarBtn.setAttribute('aria-expanded', !profileFloat.classList.contains('hidden'));
      });

      document.addEventListener('click', function(e){
        if (!profileFloat.classList.contains('hidden')) {
          const inside = profileFloat.contains(e.target) || avatarBtn.contains(e.target);
          if (!inside) profileFloat.classList.add('hidden');
        }
      });
    })();
  </script>

  <script src="script.js"></script>
</body>
</html>
