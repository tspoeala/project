var room = 1;
function education_fields() {

    room++;
    var objTo = document.getElementById('education_fields')
    var divtest = document.createElement("div");
    divtest.setAttribute("class", "form-group removeclass");
    var rdiv = 'removeclass' + room;

    divtest.innerHTML = $('#elementTemplate').html();
    objTo.appendChild(divtest)
}
function remove_education_fields(event) {
    console.log(event);
    $(event.target).parents(".removeclass").remove();
}