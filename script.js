document.addEventListener('DOMContentLoaded', function () {
    const uploadForm = document.getElementById('uploadForm');
    const fileInput = uploadForm.querySelector('input[type="file"]');

    // Image preview before upload
    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file && file.type.startsWith("image/")) {
            const reader = new FileReader();
            reader.onload = function (e) {
                let preview = document.getElementById('preview');
                if (!preview) {
                    preview = document.createElement('img');
                    preview.id = 'preview';
                    preview.style.maxWidth = '150px';
                    preview.style.marginTop = '10px';
                    uploadForm.appendChild(preview);
                }
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // AJAX upload with auto-refresh
    uploadForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(uploadForm);
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'upload.php', true);

        // Progress bar (optional)
        xhr.upload.addEventListener("progress", function (e) {
            if (e.lengthComputable) {
                console.log(`Uploaded ${e.loaded / e.total * 100}%`);
            }
        });

        xhr.onload = function () {
            if (xhr.status === 200) {
                // Clear form and preview
                uploadForm.reset();
                const preview = document.getElementById('preview');
                if (preview) preview.remove();

                // Reload the page (or part of it)
                window.location.reload(); // or you could fetch updated content via AJAX
            } else {
                alert("Upload failed: " + xhr.responseText);
            }
        };

        xhr.send(formData);
    });
});
