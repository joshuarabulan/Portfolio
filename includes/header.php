<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/modalcontact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Document</title>
</head>
<body>
<?php
$isRoot = (basename(dirname($_SERVER['PHP_SELF'])) == 'PORTFOLIO' || basename($_SERVER['PHP_SELF']) == 'index.php');
$base = $isRoot ? '' : '../';
$current = basename($_SERVER['PHP_SELF'], '.php');
?>

<header class="site-header">
  <nav class="site-nav">
    <a href="<?php echo $base; ?>index.php" class="site-logo"> Joshua Rabulan </a>
    <ul class="nav-links">
      <li><a href="<?php echo $base; ?>pages/projects.php" class="nav-link <?php echo $current === 'projects' ? 'active' : ''; ?>">Portfolio</a></li>
      <li class="nav-dot" aria-hidden="true">•</li>
      <li><a href="<?php echo $base; ?>pages/about.php"    class="nav-link <?php echo $current === 'about'    ? 'active' : ''; ?>">About</a></li>
      <li class="nav-dot" aria-hidden="true">•</li>
      <li><a href="<?php echo $base; ?>pages/resume.php"   class="nav-link <?php echo $current === 'resume'   ? 'active' : ''; ?>">Resume</a></li>
    </ul>

    <!-- CTA now opens modal -->
    <button class="nav-cta" id="openContactModal" style="cursor: pointer;">
  <i class="fas fa-envelope"></i> Let's Connect
</button>

    <button class="nav-hamburger" id="navHamburger" aria-label="Toggle menu" aria-expanded="false">
      <span></span>
      <span></span>
      <span></span>
    </button>

  </nav>

  <div class="nav-mobile" id="navMobile">
    <a href="<?php echo $base; ?>index.php"          class="nav-mobile-link <?php echo $current === 'index'    ? 'active' : ''; ?>">Home</a>
    <a href="<?php echo $base; ?>pages/projects.php" class="nav-mobile-link <?php echo $current === 'projects' ? 'active' : ''; ?>">Portfolio</a>
    <a href="<?php echo $base; ?>pages/about.php"    class="nav-mobile-link <?php echo $current === 'about'    ? 'active' : ''; ?>">About</a>
    <a href="<?php echo $base; ?>pages/resume.php"   class="nav-mobile-link <?php echo $current === 'resume'   ? 'active' : ''; ?>">Resume</a>
    <!-- Mobile drawer also opens modal -->
    <button class="nav-mobile-link nav-mobile-contact" id="openContactModalMobile">
      <i class="fas fa-envelope"></i> LET'S CONNECT
    </button>
  </div>

  <script>
  (function () {
    const btn    = document.getElementById('navHamburger');
    const drawer = document.getElementById('navMobile');
    if (!btn || !drawer) return;

    btn.addEventListener('click', () => {
      const open = drawer.classList.toggle('open');
      btn.setAttribute('aria-expanded', open);
    });

    document.addEventListener('click', (e) => {
      if (!e.target.closest('.site-header')) {
        drawer.classList.remove('open');
        btn.setAttribute('aria-expanded', 'false');
      }
    });
  })();
  </script>
</header>

<!-- ───────────────────────── CONTACT MODAL ───────────────────────── -->
<div class="contact-modal-overlay" id="contactModalOverlay" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
  <div class="contact-modal">

    <button class="modal-close" id="closeContactModal" aria-label="Close modal">
      <i class="fas fa-times"></i>
    </button>

    <div class="modal-header">
      <i class="fas fa-envelope-open-text modal-icon"></i>
      <h2 id="modalTitle">Drop a Message</h2>
      <p>I’d love to hear from you! Drop a message anytime.</p>
    </div>

    <!-- Success message (hidden by default) -->
    <div class="modal-success" id="modalSuccess">
      <i class="fas fa-check-circle"></i>
      <p>Message sent! I'll be in touch soon.</p>
    </div>

<form class="modal-form" id="contactModalForm" action="/pages/send.php" method="POST" novalidate>

      <div class="modal-form-group">
        <label for="modalName"><i class="fas fa-user"></i> Name</label>
        <input type="text" id="modalName" name="name" placeholder="Enter your name" required autocomplete="name">
        <span class="modal-error" id="nameError">Please enter your name.</span>
      </div>

      <div class="modal-form-group">
        <label for="modalEmail"><i class="fas fa-envelope"></i> Email</label>
        <input type="email" id="modalEmail" name="email" placeholder="your.email@example.com" required autocomplete="email">
        <span class="modal-error" id="emailError">Please enter a valid email.</span>
      </div>

      <div class="modal-form-group">
        <label for="modalMessage"><i class="fas fa-comment-dots"></i> Message</label>
        <textarea id="modalMessage" name="message" rows="5" placeholder="Write your message here..." required></textarea>
        <span class="modal-error" id="messageError">Please enter a message.</span>
      </div>

      <button type="submit" class="modal-submit" id="modalSubmitBtn">
        <i class="fas fa-paper-plane"></i>
        <span>Send Message</span>
      </button>

    </form>
  </div>
</div>

<!-- ───────────────────────── MODAL SCRIPT ───────────────────────── -->
<script>
(function () {
  const overlay       = document.getElementById('contactModalOverlay');
  const openBtn       = document.getElementById('openContactModal');
  const openBtnMobile = document.getElementById('openContactModalMobile');
  const closeBtn      = document.getElementById('closeContactModal');
  const form          = document.getElementById('contactModalForm');
  const successMsg    = document.getElementById('modalSuccess');
  const submitBtn     = document.getElementById('modalSubmitBtn');

  function openModal() {
    overlay.classList.add('open');
    document.body.style.overflow = 'hidden';
    document.getElementById('modalName').focus();
  }

  function closeModal() {
    overlay.classList.remove('open');
    document.body.style.overflow = '';
  }

  openBtn.addEventListener('click', openModal);
  openBtnMobile.addEventListener('click', openModal);
  closeBtn.addEventListener('click', closeModal);

  // Close on overlay click
  overlay.addEventListener('click', (e) => {
    if (e.target === overlay) closeModal();
  });

  // Close on Escape key
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeModal();
  });

  // ── Client-side validation ──
  function validate() {
    let valid = true;

    const fields = [
      { id: 'modalName',    errorId: 'nameError',    check: v => v.trim().length > 0 },
      { id: 'modalEmail',   errorId: 'emailError',   check: v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v) },
      { id: 'modalMessage', errorId: 'messageError', check: v => v.trim().length > 0 },
    ];

    fields.forEach(({ id, errorId, check }) => {
      const input = document.getElementById(id);
      const error = document.getElementById(errorId);
      if (!check(input.value)) {
        input.classList.add('invalid');
        error.classList.add('visible');
        valid = false;
      } else {
        input.classList.remove('invalid');
        error.classList.remove('visible');
      }
    });

    return valid;
  }

  // Clear invalid state on input
  ['modalName', 'modalEmail', 'modalMessage'].forEach(id => {
    document.getElementById(id).addEventListener('input', function () {
      this.classList.remove('invalid');
      document.getElementById(id.replace('modal', '').toLowerCase() + 'Error')?.classList.remove('visible');
    });
  });

  // ── Form submission (fetch) ──
  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    if (!validate()) return;

    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending…';

    try {
      const res = await fetch(form.action, {
        method: 'POST',
        body: new FormData(form),
      });

      if (res.ok) {
        form.style.display = 'none';
        successMsg.classList.add('show');
        setTimeout(closeModal, 2500);
        form.reset();
      } else {
        throw new Error('Server error');
      }
    } catch {
      submitBtn.disabled = false;
      submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Send Message';
      alert('Something went wrong. Please try again.');
    } finally {
      // Re-show form after modal closes for next open
      setTimeout(() => {
        form.style.display = '';
        successMsg.classList.remove('show');
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Send Message';
      }, 3000);
    }
  });
})();
</script>

</body>
</html>