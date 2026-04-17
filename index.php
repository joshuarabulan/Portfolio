<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Joshua Rabulan</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/images">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/images/icon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/modalcontact.css">
    <style>
      
    </style>
</head>
<body class="bg-image">

<?php include "includes/header.php"; ?>

<div class="container">
    <div class="hero">
        <img src="assets/images/me.JPG" alt="Joshua Rabulan Profile Picture">

        <div class="hero-text">
            <p class="greeting"><i class="fas fa-hand-wave"></i> Hey, there</p>
            <h1>Joshua Rabulan</h1>
            <p class="tagline">Aspiring Web Developer • Technical Support</p>
            <p class="description">Aspiring Web Developer and Tech Support with a strong interest in building clean, responsive, and user-friendly web applications. Passionate about solving technical issues, assisting users, and continuously learning new technologies. Open to internship and entry-level opportunities to gain hands-on experience and contribute to a dynamic team.</p>

            <div class="btn-group"> 
                <!-- Download CV button with confirmation modal trigger -->
                <button id="downloadCvBtn" class="btn">
                    <i class="fas fa-download"></i> Download CV
                </button>
                <button class="btn btn-secondary" onclick="document.getElementById('openContactModal').click()">
                    <i class="fas fa-envelope"></i> Hire Me
                </button>
            </div>
        </div>
    </div>
</div>

<div id="cvConfirmModal" class="cv-modal">
    <div class="cv-modal-content">
        <div class="cv-modal-header">
            <i class="fas fa-file-pdf"></i>
            <h3>Download CV</h3>
        </div>
        <div class="cv-modal-body">
            <p><i class="fas fa-info-circle" style="color:#2c7da0; margin-right: 6px;"></i> You are about to download Joshua Rabulan's CV (PDF).</p>
            <p style="margin-top: 12px; font-size: 0.95rem;">Would you like to proceed?</p>
        </div>
        <div class="cv-modal-footer">
            <button class="cv-btn-cancel" id="cancelDownloadBtn">Cancel</button>
            <button class="cv-btn-confirm" id="confirmDownloadBtn">Yes, Download</button>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>

<script>
    (function() {
        const modal = document.getElementById('cvConfirmModal');
        const downloadBtn = document.getElementById('downloadCvBtn');
        const confirmBtn = document.getElementById('confirmDownloadBtn');
        const cancelBtn = document.getElementById('cancelDownloadBtn');
        
        const cvFilePath = "assets/files/resume.pdf";
        
        function performDownload() {
            const link = document.createElement('a');
            link.href = cvFilePath;
            link.download = "JoshuaRabulan_CV.pdf";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
        
        function openModal() {
            if (modal) {
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }
        }
        
        function closeModal() {
            if (modal) {
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }
        }
        
        if (downloadBtn) {
            downloadBtn.addEventListener('click', (e) => {
                e.preventDefault();
                openModal();
            });
        }
        
        if (confirmBtn) {
            confirmBtn.addEventListener('click', (e) => {
                e.preventDefault();
                performDownload();     
                closeModal();
            });
        }
        
        if (cancelBtn) {
            cancelBtn.addEventListener('click', (e) => {
                e.preventDefault();
                closeModal();
            });
        }
        
        if (modal) {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    closeModal();
                }
            });
        }
        
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modal && modal.style.display === 'flex') {
                closeModal();
            }
        });
    })();
</script>
</body>
</html>