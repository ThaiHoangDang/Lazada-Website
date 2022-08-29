function countdown() {
    var i = document.getElementById('counter');
    if (parseInt(i.innerHTML) <= 0) {
        location.href = '../Login/login.php';
    }
    if (parseInt(i.innerHTML) != 0) {
        i.innerHTML = parseInt(i.innerHTML) - 1;
    }
}
setInterval(function () { countdown(); }, 1000);