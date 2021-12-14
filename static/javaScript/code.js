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

    }
};

var notlogged = [artikli, artikliAdd, prodajalci, prodajalciAdd, stranke, strankeAdd, dropdown, cart];
var stranka = [artikliAdd, prodajalci, prodajalciAdd, stranke, strankeAdd, register, login];
var prodajalec = [prodajalci, prodajalciAdd, register, login];

