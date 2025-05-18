const login = document.getElementById('login')
const senha = document.getElementById('senha')
const form = document.getElementById('form')
const errorElement = document.getElementById('error')

form.addEventListener('submit', (e) => {
    let messages = []
    if (login.value === '' || login.value == null) {
        messages.push('Insira seu CA')
    }

    if (senha.value === '' || senha.value == null) {
        messages.push('Insira sua senha')
    }

    if (messages.length > 0) {
        e.preventDefault()
        errorElement.innerText = messages.join(', ')
    }
})

var inputs = document.querySelectorAll("input");
for (var i = 0; i < inputs.length; i++) {
    inputs[i].addEventListener("keypress", function (e) {
        if (e.which == 13) {
            e.preventDefault();
            var nextInput = document.querySelectorAll('[tabIndex="' + (this.tabIndex + 1) + '"]');
            if (nextInput.length > 0) nextInput[0].focus();
        }
    })
}

