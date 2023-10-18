
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
        extended_valid_elements: 'img[class|src|alt|title|width|loading=lazy]',
        importcss_append: true,
        images_upload_credentials: true, // Permet d'envoyer les cookies de session avec la requête.
        automatic_uploads: true,
        images_upload_url: '/home/upload-course-img', // L'URL à laquelle les images seront téléchargées.
        file_picker_types: 'image',
        file_picker_callback: function (cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.onchange = function () {
                var file = this.files[0];

                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function () {
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), { title: file.name });
                };
            };

            xhr.send(formData);
        },

        height: 400,
        quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
        noneditable_noneditable_class: 'disabled',
        toolbar_mode: 'sliding',
        theme: "silver",
        content_css: false,
        skin: false,
        contextmenu: 'link image imagetools table',
        mobile: {
            menubar: true
        }

    });
}