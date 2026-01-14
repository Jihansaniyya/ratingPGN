<!-- Footer -->
<footer class="app-footer">
    <div class="footer-content">
        <div class="footer-left">
            <p class="mb-0">
                <strong>Sistem Informasi Penilaian Kepuasan Pelanggan</strong>
            </p>
            <p class="mb-0 text-muted small">
                PT Telemedia Dinamika Sarana - Divisi Gasnet
            </p>
        </div>
        <div class="footer-right text-muted small">
            <p class="mb-0">
                &copy; <?php echo e(date('Y')); ?> Gasnet. Hak Cipta Dilindungi Undang-Undang.
            </p>
        </div>
    </div>
</footer>

<style>
    .app-footer {
        background: #fff;
        border-top: 1px solid #e0e0e0;
        padding: 15px 25px;
        margin-top: auto;
    }
    
    .footer-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }
    
    .footer-left strong {
        color: #1a5276;
    }
    
    @media (max-width: 768px) {
        .footer-content {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
<?php /**PATH C:\Users\Jihan Saniyya\ratingPGN-app\resources\views/layouts/footer.blade.php ENDPATH**/ ?>