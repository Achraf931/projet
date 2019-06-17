let nav = document.querySelector('#navMobile')
let backgroundDark = document.querySelector('.backgroundDark')

let open = document.querySelector('.menu-icon').addEventListener('click', function () {
    nav.style.left = '0'
    backgroundDark.style.display = 'block'
    document.documentElement.style.overflow = 'hidden';
})
let close = document.querySelector('#closeNav').addEventListener('click', function () {
    nav.style.left = '-40vw'
    backgroundDark.style.display = 'none'
    document.documentElement.style.overflow = 'scroll';
})
backgroundDark.addEventListener('click', function () {
    nav.style.left = '-40vw'
    backgroundDark.style.display = 'none'
    document.documentElement.style.overflow = 'scroll';
})