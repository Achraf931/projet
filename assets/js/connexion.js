connexionButton = document.querySelectorAll(".connexionBtn")
modal = document.querySelector(".modal")
backdrop = document.querySelector(".backdrop");
body = document.querySelector("body")
closingModal = document.querySelector(".closeModal")

connexionButton.forEach(function (elem) {
    elem.addEventListener('click', function () {
        backdrop.style.display = 'block'
        modal.style.display = 'block'
        body.style.overflow = 'hidden'
    })
})
closeModal = function () {
    modal.style.display = 'none';
    backdrop.style.display = 'none';
    body.style.overflow = 'auto'
}

backdrop.addEventListener("click", closeModal)
closingModal.addEventListener("click", closeModal)

connexion = document.querySelector("#modalConnexion")

emailRegister = document.querySelector('#email')
passwordRegister = document.querySelector('#password')

errorsConnexion = document.querySelector('#errors')

connexion.addEventListener("click", function (event) {
    event.preventDefault()
    Register()
})

Register = function () {
    user = {
        email: emailRegister.value,
        password: passwordRegister.value,
    }

    fetch('/api/connexion.php', {
        method: 'POST',
        headers: new Headers(),
        body: JSON.stringify(user)
    })
        .then((res) => res.json())

        .then((data) => {
            if (data.session) {
                console.log('Connexion réussi !')
                if (data.type == 0) {
                    document.location.replace('index.php?page=verification')
                } else {
                    location.reload()
                }
            }
            if (data.loginError) {
                console.log(data.loginError)
                errorsConnexion.innerText = data.loginError
            }
        })
        .catch(() => {
            console.log("L'opération a échoué, veuillez réessayer ")
        })
}