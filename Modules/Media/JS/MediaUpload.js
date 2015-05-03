jsOMS.ready(function () {
    var holder = document.getElementById('media-holder'),
        tests = {
            filereader: typeof FileReader != 'undefined',
            dnd: 'draggable' in document.createElement('span'),
            formdata: !!window.FormData,
            progress: "upload" in new XMLHttpRequest
        },
        support = {
            filereader: document.getElementById('media-filereader'),
            formdata: document.getElementById('media-formdata'),
            progress: document.getElementById('media-progress')
        },
        progress = document.getElementById('media-uploadprogress'),
        fileupload = document.getElementById('media-upload');

    "media-filereader media-formdata media-progress".split(' ').forEach(function (api) {
        if (tests[api] === false) {
            support[api].className = 'fail';
        } else {
            support[api].className = 'hidden';
        }
    });

    function previewfile(file) {
        if (tests.filereader === true) {
            var reader = new FileReader();
            reader.onload = function (event) {
                var image = new Image();
                image.src = event.target.result;
                image.width = 250; // a fake resize
                holder.appendChild(image);
            };

            reader.readAsDataURL(file);
        } else {
            holder.innerHTML += '<p>Uploaded ' + file.name + ' ' + (file.size ? (file.size / 1024 | 0) + 'K' : '');
        }
    }

    function readfiles(files) {
        var formData = tests.formdata ? new FormData() : null;
        for (var i = 0; i < files.length; i++) {
            if (tests.formdata) {
                formData.append('file', files[i]);
            }
            previewfile(files[i]);
        }

        if (tests.formdata) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '/media.php');
            xhr.onload = function () {
                progress.value = progress.innerHTML = 100;
            };

            if (tests.progress) {
                xhr.upload.onprogress = function (event) {
                    if (event.lengthComputable) {
                        var complete = (event.loaded / event.total * 100 | 0);
                        progress.value = progress.innerHTML = complete;
                    }
                }
            }

            xhr.send(formData);
        }
    }

    holder.ondragenter = function () {
        this.className = 'hover';
        return false;
    };
    holder.ondragleave = function () {
        this.className = '';
        return false;
    };
    holder.ondragend = function () {
        this.className = '';
        return false;
    };
    holder.ondrop = function (e) {
        this.className = '';
        e.preventDefault();
        readfiles(e.dataTransfer.files);
    };

    fileupload.querySelector('input').onchange = function () {
        readfiles(this.files);
    };
});