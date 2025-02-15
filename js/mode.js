// nền sáng tối
let body = document.body;
let btnIcon = document.querySelector('#colormode i')
let mode = localStorage.getItem('darkmode');
if (mode == 'true') {
    body.classList.add('dark');
    btnIcon.className = "fs-3 bi bi-moon-stars-fill";
}

btnIcon.addEventListener('click', function () {
    btnIcon.className = btnIcon.className === "fs-3 bi bi-brightness-high-fill" ? "fs-3 bi bi-moon-stars-fill" : "fs-3 bi bi-brightness-high-fill";
    let mode = body.classList.toggle('dark');
    localStorage.setItem('darkmode', mode);
});







