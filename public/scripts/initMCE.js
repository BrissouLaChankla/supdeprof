
function initMCE(crsf_token) {
    tinymce.init({
        selector: 'textarea.basic',
        plugins: ' importcss searchreplace autolink directionality code visualblocks visualchars fullscreen image link media codesample table charmap  nonbreaking   lists wordcount    charmap quickbars ',
        // imagetools_cors_hosts: ['picsum.photos'],
        menubar: 'file edit view insert format tools table help',
        toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen | insertfile image media link codesample | ltr rtl',
        toolbar_sticky: true,
        // autosave_ask_before_unload: true,
        // autosave_interval: '30s',
        // autosave_prefix: '{path}{query}-{id}-',
        // autosave_restore_when_empty: false,
        // autosave_retention: '2m',
        // image_advtab: true,
        importcss_append: true,
        images_upload_url: '/home/upload-course-img', // L'URL à laquelle les images seront téléchargées.
        images_upload_credentials: true, // Permet d'envoyer les cookies de session avec la requête.
        images_upload_handler: function example_image_upload_handler(blobInfo, success, failure, progress) {
            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '/home/upload-course-img');
            xhr.setRequestHeader("X-CSRF-Token", crsf_token);

            xhr.upload.onprogress = function (e) {
                progress(e.loaded / e.total * 100);
            };

            xhr.onload = function () {
                var json;

                if (xhr.status === 403) {
                    failure('HTTP Error: ' + xhr.status, { remove: true });
                    return;
                }

                if (xhr.status < 200 || xhr.status >= 300) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }

                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }

                success(json.location);
            };

            xhr.onerror = function () {
                failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
            };

            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);
        },

        height: 300,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        noneditable_noneditable_class: 'disabled',
        toolbar_mode: 'sliding',
        theme: "silver",
        content_css: false,
        skin: false,
        contextmenu: 'link image imagetools table',
    });
}
