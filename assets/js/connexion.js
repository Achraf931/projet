connexionButton = document.querySelectorAll(".connexionBtn")
modal = document.querySelector(".modal")
backdrop = document.querySelector(".backdrop");
body = document.querySelector("body")
closingModal = document.querySelector(".closeModal")
titleConnexion = document.querySelector('#titleConnexion')
errorsConnexion = document.querySelector('#errors')

document.querySelector('.mdpForgot').addEventListener('click', function () {
    errorsConnexion.innerText = ""
    document.querySelector('.connexion').style.display = 'none'
    document.querySelector('.formForgot').style.display = 'flex'
    titleConnexion.innerText = "Mot de passe oublié"
})

document.querySelector('#backForm').addEventListener('click', function () {
    document.querySelector('.connexion').style.display = 'flex'
    document.querySelector('.formForgot').style.display = 'none'
    titleConnexion.innerText = "Connexion"
})

document.querySelector('#sendForgot').addEventListener("click", function (event) {
    event.preventDefault()
    forgotPassword()
})

connexionButton.forEach(function (elem) {
    elem.addEventListener('click', function () {
        backdrop.style.display = 'block'
        modal.style.display = 'block'
        body.style.overflow = 'hidden'
        document.querySelector('.connexion').style.display = 'flex'
        document.querySelector('.formForgot').style.display = 'none'
        document.querySelector('#errorsEmail').innerText = ""
        errorsConnexion.innerText = ""
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

connexion.addEventListener("click", function (event) {
    event.preventDefault()
    Register()
})

Register = function () {
    user = {
        email: emailRegister.value,
        password: passwordRegister.value,
    }

    fetch('./api/connexion.php', {
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
                errorsConnexion.innerText = data.loginError
            }
        })
        .catch(() => {
            console.log("L'opération a échoué, veuillez réessayer ")
        })
}


forgotPassword = function () {
    let emailForPassword = new FormData
    emailForPassword.append('email', document.querySelector('#forgotPasswordEmail').value)

    fetch('./api/forgot-password.php', {
        method: 'POST',
        headers: new Headers(),
        body: emailForPassword
    })
        .then((res) => res.json())
        .then((data) => {
            for(let k in data) {
                if (k.valueOf() === 'type') {
                    document.querySelector('#errorsEmail').innerText = ""
                    document.querySelector('#successNewPassword').innerText = "Nouveau mot de passe envoyé !"
                    document.querySelector('#forgotPasswordEmail').value = ""
                } else {
                    document.querySelector('#errorsEmail').innerText = data[k]
                }
            }
        })
        .catch(() => {
            console.log("L'opération a échoué, veuillez réessayer ")
        })
}