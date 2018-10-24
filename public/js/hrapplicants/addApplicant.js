var room = 1;


// Add dynamic form education field row
function education_fields() {

    room++;
    var objTo = document.getElementById('education_fields')
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclass" + room);
    var rdiv = 'removeclass' + room;
    divtest.innerHTML = 
    	'<div class="row">'+
            '<div class="col-sm-5 nopadding">'+
                '<div class="form-group">'+
                    '<input type="text" class="form-control" name="program[]" value="" placeholder="Degree">'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-4 nopadding">'+
                '<div class="form-group">'+
                    '<input type="text" class="form-control" name="school[]" value="" placeholder="School name">'+
                '</div>'+
            '</div>'+
            '<div class="col-sm-3 nopadding">'+
                '<div class="form-group">'+
                    '<div class="input-group">'+
                        '<input type="month" class="form-control" name="yearGraduated[]">'+
                        '<div class="input-group-append">'+
                            '<button class="btn btn-danger" type="button" onclick="remove_education_fields(' + room + ');"> <i class="fa fa-minus"></i>'+
                        '</div>'+
                    '</div>'+
                    '<small class="form-control-feedback">Select month and year</small> '+
                '</div>'+
            '</div>'+
        '</div>';

    objTo.appendChild(divtest)
}

// Remove dynamic form education field row
function remove_education_fields(rid) {
    $('.removeclass' + rid).remove();
}