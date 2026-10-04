// Admin Panel JavaScript
document.addEventListener('DOMContentLoaded', function () {
    // Auto-hide success messages after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.5s ease';
            setTimeout(() => alert.remove(), 500);
        }, 5000);
    });

    // File input preview
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
        input.addEventListener('change', function (e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    // Show preview if image
                    if (e.target.result.startsWith('data:image')) {
                        let preview = input.parentNode.querySelector('.image-preview');
                        if (!preview) {
                            preview = document.createElement('img');
                            preview.className = 'image-preview';
                            preview.style = 'max-width: 200px; margin-top: 10px; border-radius: 8px; display: block;';
                            input.after(preview);
                        }
                        preview.src = e.target.result;
                    }
                };
                reader.readAsDataURL(e.target.files[0]);
            }
        });
    });
});
