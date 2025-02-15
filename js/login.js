//ẩn hiện mật khẩu
function fnPasswordToggle(Element) {
    let passToggle = Element.parentElement;
    let inp = passToggle.querySelector('input');
    let currentType = inp.getAttribute('type')
    inp.setAttribute(
        'type',
        currentType === 'password' ? 'text' : 'password'
    );

    let currentIcon = Element.children;
    for (let e of currentIcon) {
        e.classList.toggle('is_active')
    };

}

let btnIcon = document.querySelectorAll('.password_toggle .icon')
for (let e of btnIcon) {
    e.addEventListener('click', function () { fnPasswordToggle(this) });
}










