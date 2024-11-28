import { env } from "./util.js"

let v = validate 

v.validators.presence.message = '^Ce champ est obligatoire.'
v.validators.email.message = '^Entrez un email valid'
v.validators.length.tooLong = '^Ce champ est trop long (%{count} charactères au plus)'
v.validators.length.tooShort = '^Ce champ est trop court (%{count} charactères au moins)'

const rules = {
    'email': {
        'presence': {'allowEmpty': false},
        'email': true,
        'length': {
            'maximum': 254,
            'tooLong': '^Trong long. La longueur maximale est de 254 caractères.'
        }
    },

    'password': {
        'presence': {'allowEmpty': false},
        'length': {
            'minimum': 6,
            'tooShort': '',
            'tooLong': '^Trong long. La longueur maximale est de 254 caractères.'
        }
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
 * @param {HTMLInputElement} field 
 * @param {String} fieldId 
 * @returns {Boolean}
 */
const checkField = (field, fieldId)=> {
    let data = {}
    let errors
    let res

    data[fieldId] = field.value?.trim() ?? ''
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

export {
    showPasswords,
    checkField
}