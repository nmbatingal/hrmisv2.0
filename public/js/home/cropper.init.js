$(function () {

    'use strict';

    var URL = window.URL || window.webkitURL,
        $image     = document.getElementById('my-image'),
        options = {
            aspectRatio: 1 / 1,
                minContainerWidth: 600,
                minContainerHeight: 400,
                movable: false,
                zoomable: false,
                rotatable: false,
                scalable: false
            },
            $inputImage       = $('#inputImage'),
            originalImageURL  = $image.src,
            uploadedImageName = 'img/blank.png',
            uploadedImageType = 'image/jpeg',
            uploadedImageURL;

    // Tooltip
    // $('[data-toggle="tooltip"]').tooltip();

    var cropper = new Cropper($image, {
        aspectRatio: 1 / 1,
        minContainerWidth: 600,
        minContainerHeight: 400,
        movable: false,
        zoomable: false,
        rotatable: false,
        scalable: false
    });

    $inputImage.change(function () {
        var files = this.files;
        var file;

        if (files && files.length) {
            file = files[0];

            if (/^image\/\w+$/.test(file.type)) {

                uploadedImageName = file.name;
                uploadedImageType = file.type;

                if (uploadedImageURL) {
                    URL.revokeObjectURL(uploadedImageURL);
                }

                uploadedImageURL = URL.createObjectURL(file);
                cropper.destroy().replace(uploadedImageURL, options);


                // console.log(cropper);
            } else {
                window.alert('Please choose an image file.');
            }
        }
    });

    $('#setProfilePhoto').on('click', function () {
        alert("THIS");
    });

});