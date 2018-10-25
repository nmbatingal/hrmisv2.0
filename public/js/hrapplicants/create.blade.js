var educ = 1;
// Add dynamic form education field row
function education_fields() {

    educ++;
    var objTo = document.getElementById('education_fields');
    var theFirstChild = objTo.firstChild;
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclass" + educ);

    var rdiv = 'removeclass' + educ;

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
                            '<button class="btn btn-danger" type="button" onclick="remove_education_fields(' + educ + ');"> <i class="fa fa-minus"></i>'+
                        '</div>'+
                    '</div>'+
                    '<small class="form-control-feedback">Select month and year</small> '+
                '</div>'+
            '</div>'+
        '</div>';

    // objTo.appendChild(divtest);
    objTo.insertBefore(divtest, theFirstChild);
}
// Remove dynamic form education field row
function remove_education_fields(rid) {
    $('.removeclass' + rid).remove();
}

var exp  = 1;
// Add dynamic form experience field row
function experience_fields() {

    exp++;
    var objExp = document.getElementById('experience_fields');
    var theFirstChildExp = objExp.firstChild;
    var divExp = document.createElement("div");
    divExp.setAttribute("class", "form-group removeclassExp" + exp);

    divExp.innerHTML = 
        '<div class="row">'+
            '<div class="col-md-12">'+
                '<div class="row">'+
                    '<div class="col-md-4 col-sm-12 nopadding">'+
                        '<div class="form-group">'+
                            '<input type="text" class="form-control" name="agency[]" value="" placeholder="Agency">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-3 col-sm-12 nopadding">'+
                        '<div class="form-group">'+
                            '<input type="text" class="form-control" name="position[]" value="" placeholder="Position">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-3 col-sm-12 nopadding">'+
                        '<div class="form-group">'+
                            '<input class="form-control input-daterange-datepicker" type="text" name="daterangeExperience[]" value="10/25/2018   to   10/25/2018" />'+
                            '<small class="form-control-feedback">Select starting and end dates</small>'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-2 col-sm-12 nopadding">'+
                        '<div class="form-group">'+
                            '<div class="input-group">'+
                                '<input type="text" class="form-control" name="salaryGrade[]" value="0.00">'+
                                '<div class="input-group-append">'+
                                    '<button class="btn btn-danger" type="button" onclick="remove_experience_fields(' + exp + ');"><i class="fa fa-minus"></i></button>'+
                                '</div>'+
                            '</div>'+
                            '<small class="form-control-feedback">Insert salary with decimal value</small> '+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>'+
        '</div>';

    objExp.insertBefore(divExp, theFirstChildExp);
}
// Remove dynamic form experience field row
function remove_experience_fields(ridExp) {
    $('.removeclassExp' + ridExp).remove();
}

var elig  = 1;
// Add dynamic form experience field row
function eligible_fields() {

    elig++;
    var objElig = document.getElementById('eligibility_fields');
    var theFirstChildElig = objElig.firstChild;
    var divElig = document.createElement("div");
    divElig.setAttribute("class", "form-group removeclassElig" + elig);

    divElig.innerHTML = 
        '<div class="row">'+
            '<div class="col-md-12">'+
                '<div class="row">'+
                    '<div class="col-md-4 col-sm-12 nopadding">'+
                        '<div class="form-group">'+
                            '<input type="text" class="form-control" name="licenseTitle[]" value="" placeholder="License Title">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-3 col-sm-12 nopadding">'+
                        '<div class="form-group">'+
                            '<input type="text" class="form-control" name="licenseNumber[]" value="" placeholder="License Number">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-3 col-sm-12 nopadding">'+
                        '<div class="form-group">'+
                            '<input type="month" class="form-control" name="exam_date">'+
                            '<small class="form-control-feedback">Select month and year</small> '+
                        '</div>'+
                    '</div>'+
                    '<div class="col-md-2 col-sm-12 nopadding">'+
                        '<div class="form-group">'+
                            '<div class="input-group">'+
                                '<input type="text" class="form-control" name="rating[]" value="0.00">'+
                                '<div class="input-group-append">'+
                                    '<button class="btn btn-danger" type="button" onclick="remove_eligibility_fields(' + elig + ');"><i class="fa fa-minus"></i></button>'+
                                '</div>'+
                            '</div>'+
                            '<small class="form-control-feedback">Insert rating</small> '+
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>'+
        '</div>';

    objElig.insertBefore(divElig, theFirstChildElig);
}
// Remove dynamic form experience field row
function remove_eligibility_fields(ridElig) {
    $('.removeclassElig' + ridElig).remove();
}