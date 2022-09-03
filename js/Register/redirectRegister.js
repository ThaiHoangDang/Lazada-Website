function countdown() {
    var counter = document.querySelector('#counter');
    if (parseInt(counter.innerHTML) <= 0) {
        location.href = '../Login/login.php';
    } else {
        counter.innerHTML = parseInt(counter.innerHTML) - 1;
    }
}
setInterval(countdown, 1000);