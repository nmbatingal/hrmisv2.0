$(function () {

    'use strict';

    var URL = window.URL || window.webkitURL,
        canvass = document.getElementById('imgCanvass'),
        $image  = document.getElementById('my-image'),
        options = {
                aspectRatio: 1 / 1,
                viewMode: 2,
                background: false,
                minContainerWidth: 600,
                minContainerHeight: 400,
                movable: false,
                zoomable: false,
                rotatable: false,
                scalable: false
            },
        $inputImage       = $('#inputImage'),
        // originalImageURL  = $image.src,
        uploadedImageName = 'cropped',
        uploadedImageType = 'image/jpeg',
        uploadedImageURL;

    // Tooltip
    // $('[data-toggle="tooltip"]').tooltip();

    // var cropper = new Cropper($image, options);

    // $inputImage.change(function () {
    //     var files = this.files;
    //     var file;

    //     if (files && files.length) {
    //         file = files[0];

    //         if (/^image\/\w+$/.test(file.type)) {

    //             uploadedImageName = file.name;
    //             uploadedImageType = file.type;

    //             if (uploadedImageURL) {
    //                 URL.revokeObjectURL(uploadedImageURL);
    //             }

    //             uploadedImageURL = URL.createObjectURL(file);

    //             // console.log(cropper);
    //             cropper.destroy().replace(uploadedImageURL, options);
    //             // cropper.replace(uploadedImageURL, options);

    //             // var replaced = new Cropper

    //         } else {
    //             window.alert('Please choose an image file.');
    //         }
    //     }
    // });

    $inputImage.change(function (e) {
        var files = this.files,
            file;

        if (files && files.length) {

            file = files[0];

            var img    = document.createElement('img');
                img.id      = 'image';
                img.width   = 650;
                img.src     = URL.createObjectURL(file);

            // console.log($(img));

            // clean result before
            canvass.innerHTML = '';
            // canvass.find('#btnImport').css('display', 'none');
            // append new image
            canvass.append(img);
            
            var cropper = new Cropper(img, options);
            // show save btn and options

            // console.log(img);

            // if (/^image\/\w+$/.test(file.type)) {

            //     var img = document.createElement('img');

            //     uploadedImageName = file.name;
            //     uploadedImageType = file.type;

            //     if (uploadedImageURL) {
            //         URL.revokeObjectURL(uploadedImageURL);
            //     }

            //     uploadedImageURL = URL.createObjectURL(file);

            //     // console.log(cropper);
            //     cropper.destroy().replace(uploadedImageURL, options);
            //     // cropper.replace(uploadedImageURL, options);

            //     // var replaced = new Cropper

            // } else {
            //     window.alert('Please choose an image file.');
            // }
        }
    });

    $('#setProfilePhoto').on('click', function (e) {
        e.preventDefault();

        var cropped = cropper.cropped,
            url     = $(this).attr('href');

        

        if ( cropped )
        {
            // console.log(result);

            var formData = $('#savePhotoForm'),
                // userId   = $('input#userId').val(),
                // token    = $('input[name=_token]').val(),
                result   = cropper.getCroppedCanvas().toDataURL('image/jpeg');

            formData.append('croppedImage', result);
            // formData.append('id', userId);
            // formData.append('_token', token);

            // console.log(url);

            $.ajax({
                method: "POST",
                url   : url,
                data  : formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    console.log(data);
                },
                error: function () {
                    console.log('Upload error');
                }
            });

            // var result = cropper.getCroppedCanvas().toBlob(function (blob) {

            //     var formData = new FormData(),
            //         userId   = $('input#userId').val(),
            //         token    = $('input[name=_token]').val();

            //     formData.append('croppedImage', blob);
            //     formData.append('id', userId);
            //     formData.append('_token', token);

            //     // console.log(url);

            //     $.ajax({
            //         method: "POST",
            //         url   : url,
            //         data  : formData,
            //         processData: false,
            //         contentType: false,
            //         success: function (data) {
            //             console.log(data);
            //         },
            //         error: function () {
            //             console.log('Upload error');
            //         }
            //     });
            // });
        }




    });

});