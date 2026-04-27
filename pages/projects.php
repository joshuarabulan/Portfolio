<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Portfolio </title>
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/icon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/projects.css">
  <link rel="stylesheet" href="../assets/css/header.css">
  <link rel="stylesheet" href="../assets/css/modalcontact.css">
  <link rel="stylesheet" href="../assets/css/send.css">
  <link rel="stylesheet" href="../assets/css/footer.css">
  <!-- ✅ Google Analytics (CORRECT PLACE) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-FEEBMPZ8S0"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-FEEBMPZ8S0');
  </script>
</head>
<body>
<?php include "../includes/header.php"; ?>
<div class="container">
  <h2 class="section-title"> My Portfolio  </h2>
  <div class="project-filters">
    <button class="filter-btn active" data-filter="all">All</button>
    <button class="filter-btn" data-filter="web">Web</button>
    <button class="filter-btn" data-filter="php">PHP</button>
    <button class="filter-btn" data-filter="design">Design</button>
  </div>

  <div class="projects-grid">
    <!-- Project 1 -->
    <div class="project-card" data-category="php web"
         data-modal-title="An Online Support System for Report Generation at Malasakit Center"
         data-modal-desc="A fully responsive personal portfolio website built with PHP, featuring dynamic content, a contact form, and clean modern design."
         data-modal-tags="PHP,CSS3,MySQL"
         data-modal-category="PHP · Web"
         data-modal-code="https://github.com/joshuarabulan/MalasakitCenterCapstone"
         data-modal-demo="#"
         data-modal-images="../assets/images/projects/log in.png,../assets/images/projects/register.png,../assets/images/projects/user.png,../assets/images/projects/patientreq.png,../assets/images/projects/user 1.png,../assets/images/projects/dashboard1.png,../assets/images/projects/usermanagement.png,../assets/images/projects/report.png,../assets/images/projects/soa.png,../assets/images/projects/soa1.png,../assets/images/projects/soa2.png,../assets/images/projects/soa3.png,../assets/images/projects/monthly.png,../assets/images/projects/feedback.png,../assets/images/projects/feedback1.png">
      <div class="project-thumb" style="position:relative;">
        <img src="../assets/images/projects/project1.png" alt="Portfolio Website" onerror="this.parentElement.classList.add('no-img')">
        <button class="card-open-modal" title="Quick view" aria-label="Quick view"><i class="fas fa-expand-alt"></i></button>
        <div class="project-overlay">
          <a href="https://github.com/joshuarabulan/portfolio" target="_blank" class="overlay-btn" aria-label="View Code">
            <i class="fab fa-github"></i>
          </a>
        </div>
      </div>
      <div class="project-body">
        <h3 class="project-title">An Online Support System for Report Generation at Malasakit Center</h3>
        <p class="project-desc">A fully responsive online Support System website built with PHP, featuring dynamic content, a contact form, and clean modern design.</p>
        <div class="project-tags">
          <span class="project-tag">PHP</span>
          <span class="project-tag">CSS3</span>
          <span class="project-tag">MySQL</span>
        </div>
        <div class="project-links">
          <a href="https://github.com/joshuarabulan/portfolio" target="_blank" class="project-link">
            <i class="fab fa-github"></i> Code
          </a>
          <a href="#" target="_blank" class="project-link project-link-demo">
            <i class="fas fa-external-link-alt"></i> Live Demo
          </a>
        </div>
      </div>
    </div>

    <!-- Project 2 — Resume Builder -->
    <div class="project-card" data-category="php"
         data-modal-title="Resume Builder"
         data-modal-desc="Developed a dynamic web-based Resume Builder application that allows users to create, edit, and download professional resumes online. Built using the Django framework following the MVC (Model-View-Template) architecture and styled with Bootstrap for a responsive and modern user interface."
         data-modal-tags="Python,Django,Bootstrap,MongoDB"
         data-modal-category="PHP"
         data-modal-code="https://github.com/gaybriyelll/DjangoProject_ResumeBuilder"
         data-modal-images="../assets/images/projects/resumebuilder.jpg,../assets/images/projects/resumebuilder1.jpg,../assets/images/projects/resumebuilder2.jpg,../assets/images/projects/resumebuilder3.jpg,../assets/images/projects/resumebuilder4.jpg,../assets/images/projects/resumebuilder5.jpg,../assets/images/projects/resumebuilder6.jpg,../assets/images/projects/resumebuilder7.jpg,../assets/images/projects/resumebuilder8.jpg">
      <div class="project-thumb" style="position:relative;">
        <img src="../assets/images/projects/resumebuilder.jpg" alt="Resume Builder" onerror="this.parentElement.classList.add('no-img')">
        <button class="card-open-modal" title="Quick view" aria-label="Quick view"><i class="fas fa-expand-alt"></i></button>
        <div class="project-overlay">
          <a href="https://github.com/gaybriyelll/DjangoProject_ResumeBuilder" target="_blank" class="overlay-btn" aria-label="View Code">
            <i class="fab fa-github"></i>
          </a>
        </div>
      </div>
      <div class="project-body">
        <h3 class="project-title">Resume Builder</h3>
        <p class="project-desc">Developed a dynamic web-based Resume Builder application that allows users to create, edit, and download professional resumes online. Built using Django and Bootstrap.</p>
        <div class="project-tags">
          <span class="project-tag">Python</span>
          <span class="project-tag">Django</span>
          <span class="project-tag">Bootstrap</span>
          <span class="project-tag">MongoDB</span>
        </div>
        <div class="project-links">
          <a href="https://github.com/gaybriyelll/DjangoProject_ResumeBuilder" target="_blank" class="project-link">
            <i class="fab fa-github"></i> Code
          </a>
        </div>
      </div>
    </div>

    <!-- Project 3 — Apartment Rental -->
    <div class="project-card" data-category="design"
         data-modal-title="Apartment Rental Management System"
         data-modal-desc="Built an Apartment Rental Management System using C# and MySQL to efficiently manage tenant records, room availability, and rental payments. The system includes secure login, CRUD operations, and a structured database to ensure accurate data storage and retrieval."
         data-modal-tags="C#,MySQL"
         data-modal-category="Design"
         data-modal-demo="https://github.com/gaybriyelll/DjangoProject_ResumeBuilder"
         data-modal-images="../assets/images/projects/apartmentrental.jpg">
      <div class="project-thumb" style="position:relative;">
        <img src="../assets/images/projects/apartmentrental.jpg" alt="Apartment Rental Management System" onerror="this.parentElement.classList.add('no-img')">
        <button class="card-open-modal" title="Quick view" aria-label="Quick view"><i class="fas fa-expand-alt"></i></button>
        <div class="project-overlay">
          <a href="https://github.com" target="_blank" class="overlay-btn" aria-label="View github">
            <i class="fab fa-github"></i>
          </a>
        </div>
      </div>
      <div class="project-body">
        <h3 class="project-title">Apartment Rental Management System</h3>
        <p class="project-desc">Built with C# and MySQL to efficiently manage tenant records, room availability, and rental payments with secure login and CRUD operations.</p>
        <div class="project-tags">
          <span class="project-tag">C#</span>
          <span class="project-tag">MySQL</span>
        </div>
        <div class="project-links">
          <a href="https://github.com" target="_blank" class="project-link project-link-demo">
            <i class="fab fa-github"></i> View Design
          </a>
        </div>
      </div>
    </div>

    <!-- Project 4 — MedConnect -->
    <div class="project-card" data-category="php"
         data-modal-title="MedConnect"
         data-modal-desc="Created MedConnect, a healthcare management system built using the LavaLust PHP Framework, designed to streamline patient and doctor management processes. The system allows administrators to manage patient records, schedule appointments, and monitor medical information through a secure and user-friendly interface."
         data-modal-tags="PHP"
         data-modal-category="PHP"
         data-modal-code="https://github.com/joshuarabulan/grade-system"
         data-modal-images="../assets/images/projects/medconnect.jpg">
      <div class="project-thumb" style="position:relative;">
        <img src="../assets/images/projects/medconnect.jpg" alt="MedConnect" onerror="this.parentElement.classList.add('no-img')">
        <button class="card-open-modal" title="Quick view" aria-label="Quick view"><i class="fas fa-expand-alt"></i></button>
        <div class="project-overlay">
          <a href="https://github.com/joshuarabulan/grade-system" target="_blank" class="overlay-btn" aria-label="View Code">
            <i class="fab fa-github"></i>
          </a>
        </div>
      </div>
      <div class="project-body">
        <h3 class="project-title">MedConnect</h3>
        <p class="project-desc">A healthcare management system built using the LavaLust PHP Framework to streamline patient and doctor management with secure authentication and full CRUD operations.</p>
        <div class="project-tags">
          <span class="project-tag">PHP</span>
        </div>
        <div class="project-links">
          <a href="https://github.com/joshuarabulan/grade-system" target="_blank" class="project-link">
            <i class="fab fa-github"></i> Code
          </a>
        </div>
      </div>
    </div>

  </div><!-- /.projects-grid -->
</div><!-- /.container -->

<!-- ══════════════════════════════════════
     PROJECT DETAIL MODAL
══════════════════════════════════════ -->
<div class="project-modal-overlay" id="projectModal" role="dialog" aria-modal="true">
  <div class="project-modal-inner">

    <button class="modal-close-btn" id="modalClose" aria-label="Close modal">
      <i class="fas fa-times"></i>
    </button>

    <div class="modal-gallery">
      <img id="modalGalleryMain" src="" alt="" />
      <div class="modal-thumbs" id="modalThumbs"></div>
    </div>

    <div class="modal-info">
      <span class="modal-category" id="modalCategory"></span>
      <h2 class="modal-title" id="modalTitle"></h2>
      <p class="modal-desc" id="modalDesc"></p>
      <div class="modal-tags" id="modalTags"></div>
      <div class="modal-links" id="modalLinks"></div>
    </div>

  </div>
</div>

<div class="lightbox-overlay" id="lightbox">
  <button class="lightbox-close" id="lightboxClose"><i class="fas fa-times"></i></button>
  <button class="lightbox-nav lightbox-prev" id="lightboxPrev"><i class="fas fa-chevron-left"></i></button>
  <img class="lightbox-img" id="lightboxImg" src="" alt="">
  <button class="lightbox-nav lightbox-next" id="lightboxNext"><i class="fas fa-chevron-right"></i></button>
  <div class="lightbox-counter" id="lightboxCounter"></div>
</div>

<?php include "../includes/footer.php"; ?>

<script>
const filterBtns   = document.querySelectorAll('.filter-btn');
const projectCards = document.querySelectorAll('.project-card');

filterBtns.forEach(btn => {
  btn.addEventListener('click', () => {
    filterBtns.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    const filter = btn.dataset.filter;
    projectCards.forEach(card => {
      const cats = card.dataset.category.split(' ');
      const hide = filter !== 'all' && !cats.includes(filter);
      card.classList.toggle('hidden', hide);
    });
  });
});
const modal      = document.getElementById('projectModal');
const modalClose = document.getElementById('modalClose');
const modalMain  = document.getElementById('modalGalleryMain');
const modalThumbs = document.getElementById('modalThumbs');
const modalCat   = document.getElementById('modalCategory');
const modalTitle = document.getElementById('modalTitle');
const modalDesc  = document.getElementById('modalDesc');
const modalTags  = document.getElementById('modalTags');
const modalLinks = document.getElementById('modalLinks');

let currentImages  = [];
let activeThumbIdx = 0;

function openModal(card) {
  const images = (card.dataset.modalImages || '').split(',').map(s => s.trim()).filter(Boolean);
  currentImages  = images;
  activeThumbIdx = 0;

  // Main image
  modalMain.src = images[0] || '';
  modalMain.alt = card.dataset.modalTitle || '';

  // Thumbnails
  modalThumbs.innerHTML = '';
  if (images.length > 1) {
    images.forEach((src, i) => {
      const t = document.createElement('img');
      t.src       = src;
      t.className = 'gallery-thumb' + (i === 0 ? ' active' : '');
      t.addEventListener('click', () => switchThumb(i));
      modalThumbs.appendChild(t);
    });
  }

  // Click main → lightbox
  modalMain.onclick = () => openLightbox(activeThumbIdx);

  // Info
  modalCat.textContent   = card.dataset.modalCategory || '';
  modalTitle.textContent = card.dataset.modalTitle    || '';
  modalDesc.textContent  = card.dataset.modalDesc     || '';

  modalTags.innerHTML = (card.dataset.modalTags || '')
    .split(',')
    .map(t => `<span class="modal-tag">${t.trim()}</span>`)
    .join('');

  const code = card.dataset.modalCode;
  const demo = card.dataset.modalDemo;
  modalLinks.innerHTML = '';
  if (code) {
    const a = document.createElement('a');
    a.href = code; a.target = '_blank';
    a.className = 'modal-link modal-link-secondary';
    a.innerHTML = '<i class="fab fa-github"></i> Code';
    modalLinks.appendChild(a);
  }
  if (demo) {
    const a = document.createElement('a');
    a.href = demo; a.target = '_blank';
    a.className = 'modal-link modal-link-primary';
    a.innerHTML = '<i class="fas fa-external-link-alt"></i> Live Demo';
    modalLinks.appendChild(a);
  }

  modal.classList.add('open');
  document.body.style.overflow = 'hidden';
}

function switchThumb(idx) {
  activeThumbIdx = idx;

  // Smooth image transition
  modalMain.classList.add('switching');
  setTimeout(() => {
    modalMain.src = currentImages[idx];
    modalMain.classList.remove('switching');
  }, 200);

  document.querySelectorAll('.gallery-thumb').forEach((t, i) => {
    t.classList.toggle('active', i === idx);
  });
}

function closeModal() {
  modal.classList.remove('open');
  document.body.style.overflow = '';
}

modalClose.addEventListener('click', closeModal);
modal.addEventListener('click', e => { if (e.target === modal) closeModal(); });

/* ── Quick-view buttons on cards ── */
document.querySelectorAll('.card-open-modal').forEach(btn => {
  btn.addEventListener('click', e => {
    e.preventDefault();
    e.stopPropagation();
    openModal(btn.closest('.project-card'));
  });
});

/* ══════════════════════════════════════
   LIGHTBOX
══════════════════════════════════════ */
const lightbox        = document.getElementById('lightbox');
const lightboxImg     = document.getElementById('lightboxImg');
const lightboxCounter = document.getElementById('lightboxCounter');
const lightboxClose   = document.getElementById('lightboxClose');
const lightboxPrev    = document.getElementById('lightboxPrev');
const lightboxNext    = document.getElementById('lightboxNext');
let   lbIndex         = 0;

function openLightbox(startIdx = 0) {
  lbIndex = startIdx;
  updateLightbox();
  lightbox.classList.add('open');
}

function updateLightbox() {
  lightboxImg.classList.add('switching');
  setTimeout(() => {
    lightboxImg.src = currentImages[lbIndex];
    lightboxImg.classList.remove('switching');
  }, 150);
  lightboxCounter.textContent = currentImages.length > 1
    ? `${lbIndex + 1} / ${currentImages.length}` : '';
  lightboxPrev.style.display = currentImages.length > 1 ? 'flex' : 'none';
  lightboxNext.style.display = currentImages.length > 1 ? 'flex' : 'none';
}

function closeLightbox() { lightbox.classList.remove('open'); }

lightboxClose.addEventListener('click', closeLightbox);
lightbox.addEventListener('click', e => { if (e.target === lightbox) closeLightbox(); });

lightboxPrev.addEventListener('click', () => {
  lbIndex = (lbIndex - 1 + currentImages.length) % currentImages.length;
  updateLightbox();
});
lightboxNext.addEventListener('click', () => {
  lbIndex = (lbIndex + 1) % currentImages.length;
  updateLightbox();
});

/* Keyboard nav */
document.addEventListener('keydown', e => {
  if (lightbox.classList.contains('open')) {
    if (e.key === 'ArrowLeft')  lightboxPrev.click();
    if (e.key === 'ArrowRight') lightboxNext.click();
    if (e.key === 'Escape')     closeLightbox();
  } else if (modal.classList.contains('open') && e.key === 'Escape') {
    closeModal();
  }
});
</script>

</body>
</html>