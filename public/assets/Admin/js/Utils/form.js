import { env } from "./util.js"

let v = validate 

v.validators.presence.message = '^Ce champ est obligatoire.'
v.validators.email.message = '^Entrez un email valid'
v.validators.length.tooLong = '^Ce champ est trop long (%{count} charactères au plus)'
v.validators.length.tooShort = '^Ce champ est trop court (%{count} charactères au moins)'

/**
 * 
 * @param {String} value 
 * @param {*} options 
 * @param {*} key 
 * @param {*} attributes 
 */
v.validators.username = function (value) {
    let res = undefined
    
    if (! /^([a-zA-Z][a-zA-Z0-9\s]{2,29})$/.test(value)) {
        res = '^Veuillez entrer un nom d\'utilisateur valide.'
    }
    return res
}

const rules = {
    'username': {
        'presence': {'allowEmpty': false},
        'length': {
            'minimum': 3,
            'maximum': 30
        },
        'username': {},
    },

    'email': {
        'presence': {'allowEmpty': false},
        'email': true,
        'length': {
            'maximum': 254,
        }
    },

    'password': {
        'presence': {'allowEmpty': false},
        'length': {
            'minimum': 6,
        }
    },

    'current-password': {
        'presence': {'allowEmpty': false},
        'length': {
            'minimum': 6,
        }
    },

    'new-password': {
        'presence': {'allowEmpty': false},
        'length': {
            'minimum': 6,
        }
    },

    'new-password-confirm': {
        'presence': {'allowEmpty': false},
        'equality': 'new-password'
    }
}

/**
 * 
 * @param {HTMLInputElement} field 
 * @param {String} message 
 * @param {Boolean} flag
 */
const setErrMsg = (field, message, flag=true)=> {
    if (flag) {
        field.classList.add('is-invalid')
        field.parentNode.querySelector('p').innerHTML = message
    } else {
        field.classList.remove('is-invalid')
        field.parentNode.querySelector('p').innerHTML = ''
    }
}

/**
 * 
 * @description check if the field has been well filled and show and error message otherwise
 * 
 * @param {HTMLInputElement} field 
 * @param {String} fieldId 
 * @param {Boolean} flag
 * @param {HTMLInputElement} nextField
 * @param {String} nextFieldId
 * @returns {Boolean}
 */
const checkField = (field, fieldId, flag=false, nextField, nextFieldId)=> {
    let data = {}
    let errors
    let res

    data[fieldId] = field.value?.trim() ?? ''

    if (flag) {
        data[nextFieldId] = nextField.value?.trim() ?? ''
    }

    errors = v(data, rules)
        
    if (errors == undefined || errors[fieldId] == undefined) {        
        setErrMsg(field, '', false)
        res = true
    }
    else {
        setErrMsg(field, errors[fieldId][0])
        res = false
    }

    return res
}

/**
 * 
 * @param {HTMLFormElement} form 
 * @param {String} message 
 */
const setAlert = (form, message, flag=true)=> {
    let alert = form.querySelector('.alert')

    if (flag) {
        alert.classList.remove('d-none')
        alert.innerHTML = message
    }
    else {
        alert.classList.add('d-none')
        alert.innerHTML = ''
    }
}

/**
 * 
 * @param {HTMLFormElement} form 
 */
const clearPassword = (form)=> {
    form.querySelectorAll('input[type="password"]').forEach(input => {
        input.value = ''
    })
}

/**
 * 
 * @description Allow to enable the feature: Show and hide password
 * @param {HTMLFormElement} form 
 * @returns void
 */
const showPasswords = (form) => {
    form.querySelectorAll('[show-password-trigger]').forEach(btn => {
        btn.addEventListener('click', ()=> {
            form.querySelectorAll('input[show-password]')
            .forEach(input => {
                input.type = (input.type == 'password') ? 'text' : 'password'
            })
        })
    })
}

/**
 * 
 * @param {HTMLFormElement} form 
 * @param {Boolean} flag 
 */
const disable = (form, flag=true)=> {
    [
        ...form.querySelectorAll('input'),
        ...form.querySelectorAll('button'),
        ...form.querySelectorAll('select'),
        ...form.querySelectorAll('textarea')
    ].forEach(el => el.disabled = flag)
}

export {
    showPasswords,
    checkField,
    setAlert,
    setErrMsg,
    disable,
    clearPassword
}