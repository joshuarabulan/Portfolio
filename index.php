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
        /* Modal confirmation (CV download modal) - independent styling */
        .cv-modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.6);
            backdrop-filter: blur(4px);
            justify-content: center;
            align-items: center;
            font-family: 'Inter', sans-serif;
        }
        .cv-modal-content {
            background: #fff;
            max-width: 450px;
            width: 90%;
            border-radius: 28px;
            box-shadow: 0 25px 45px -12px rgba(0,0,0,0.3);
            overflow: hidden;
            animation: modalSlideIn 0.25s ease-out;
            margin: 20px;
        }
        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: scale(0.96) translateY(-12px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
        .cv-modal-header {
            padding: 24px 28px 12px 28px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-bottom: 1px solid #eef2f6;
        }
        .cv-modal-header i {
            font-size: 32px;
            color: #2c7da0;
        }
        .cv-modal-header h3 {
            margin: 0;
            font-size: 1.6rem;
            font-weight: 700;
            color: #0a2b3e;
            letter-spacing: -0.3px;
        }
        .cv-modal-body {
            padding: 20px 28px 20px 28px;
            color: #2c3e4e;
            font-size: 1rem;
            line-height: 1.5;
            background: #fefefe;
        }
        .cv-modal-body p {
            margin: 6px 0;
        }
        .cv-modal-footer {
            padding: 16px 28px 24px 28px;
            display: flex;
            justify-content: flex-end;
            gap: 14px;
            background: #ffffff;
            border-top: 1px solid #edf2f7;
        }
        .cv-btn-cancel, .cv-btn-confirm {
            padding: 10px 22px;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            font-family: 'Inter', sans-serif;
        }
        .cv-btn-cancel {
            background: #f1f5f9;
            color: #1e2f3a;
        }
        .cv-btn-cancel:hover {
            background: #e2e8f0;
            transform: scale(0.97);
        }
        .cv-btn-confirm {
            background: #0f3b4f;
            color: white;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
        .cv-btn-confirm:hover {
            background: #1f5e7a;
            transform: scale(0.98);
        }
        /* ensure existing modalcontact styles don't conflict */
        .btn-group .btn {
            cursor: pointer;
        }
        /* responsiveness */
        @media (max-width: 550px) {
            .cv-modal-footer {
                flex-direction: column-reverse;
            }
            .cv-btn-cancel, .cv-btn-confirm {
                width: 100%;
                text-align: center;
                justify-content: center;
            }
        }
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