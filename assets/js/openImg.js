background = document.querySelector('#bgDark')
let img = document.querySelectorAll('.tileMedia')
img.forEach(function (elem) {
    elem.addEventListener('click', function () {
        background.style.display = 'flex'
      let imgPath = this.childNodes[1].getAttribute('src')
        document.querySelector('.imgOn').setAttribute('src',imgPath)
        document.documentElement.style.overflow = 'hidden';
    })
})

background.addEventListener('click', function () {
    background.style.display = 'none'
    document.documentElement.style.overflow = 'scroll';
})