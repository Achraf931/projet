let choiceOne = document.querySelector("#choiceOne")
let choiceTwo = document.querySelector("#choiceTwo")
let sendMessage = document.querySelector('#sendMessage')
let msgSuccess = document.querySelector('#msgSuccess')

choiceOne.addEventListener('change', function () {
    sendValue(this.value)
    choiceTwo.innerHTML = ''
})

let sendValue = function (value) {
    let object = new FormData()
    object.append('value', value)

    fetch('./api/contact.php', {
        method: 'POST',
        headers: new Headers(),
        body: object
    })
        .then((res) => {
            return res.json()
        })
        .then((data) => {
            if (data.secondChoice.length !== 0) {
                choiceTwo.style.display = 'unset'
                let optionOne = document.createElement('option')
                choiceTwo.appendChild(optionOne)
                optionOne.innerText = 'Choisissez...'

                for (let i = 0; i < data.secondChoice.length; i++){
                    let options = document.createElement('option')
                    choiceTwo.appendChild(options)
                    options.text = data.secondChoice[i].choice
                    options.value = data.secondChoice[i].id
                }
            } else {
                choiceTwo.style.display = 'none'
            }
        })
        .catch(() => {
            console.log("L'opération a échoué, veuillez réessayer ")
        })
}

sendMessage.addEventListener('click', function () {
    document.querySelectorAll('.errorsMsg').forEach(function (e) {
        e.innerText = ""
    })
    recupMess()
    msgSuccess.innerText = ""

})
const recupMess = function(){
    let form = new FormData

    form.append('choiceOne', document.querySelector("#choiceOne").value)
    form.append('choiceTwo', document.querySelector("#choiceTwo").value)
    form.append('name', document.querySelector('#name').value)
    form.append('firstname', document.querySelector('#firstname').value)
    form.append('emailMess', document.querySelector('#emailMess').value)
    form.append('mobile', document.querySelector('#mobile').value)
    form.append('message', document.querySelector('#message').value)

    fetch('./api/message.php', {
        method: 'POST',
        headers: new Headers(),
        body: form
    })
        .then((res) => {
            return res.json()
        })
        .then((data) => {
                for(let k in data) {
                        if (k.valueOf() === 'type') {
                            let spanValues = document.querySelectorAll('.styledInput span')
                            spanValues.forEach(function (values) {
                                values.innerText = ""
                            })
                            let textareaValue = document.querySelector('#message')
                            textareaValue.value = ""
                            msgSuccess.style.color = '#1D7E34'
                            msgSuccess.innerText = 'Votre message a bien été envoyé !'
                            document.querySelector('.inputContainer').append(msgSuccess)
                        } else {
                            document.querySelector('#'+k+'Error').innerText = data[k]
                        }
                }
        })
        .catch(() => {
            console.log("L'opération a échoué, veuillez réessayer ")
        })
}