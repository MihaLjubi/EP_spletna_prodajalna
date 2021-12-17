window.onload = function() {
    const role = document.getElementById("role").value
    // document.getElementById("artikli").style.display = 'none'
    if( role == 'notlogged') {
        notlogged.forEach(element => element.style.display = 'none');
    } else if (role == 'stranka') {
        stranka.forEach(element => element.style.display = 'none');
    } else if (role == 'prodajalec') {
        prodajalec.forEach(element => element.style.display = 'none');
    } else {
        admin.forEach(element => element.style.display = 'none');
    }
};

var notlogged = [artikli, artikliAdd, prodajalci, prodajalciAdd, stranke, strankeAdd, dropdown, narocila];
var stranka = [artikliAdd, prodajalci, prodajalciAdd, stranke, strankeAdd, register, login, narocila];
var prodajalec = [prodajalci, prodajalciAdd, register, login];
var admin = [register, login];

