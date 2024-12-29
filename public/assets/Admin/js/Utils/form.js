import { env } from "./util.js"

let v = validate 

v.validators.presence.message = '^Ce champ est obligatoire.'
v.validators.email.message = '^Entrez un email valid'
v.validators.length.tooLong = '^Ce champ est trop long (%{count} charactères au plus)'
v.validators.length.tooShort = '^Ce champ est trop court (%{count} charactères au moins)'
v.validators.numericality.notValid = '^Veuillez entrer un nombre entier'

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

v.validators.image = function (value) {
    let res = undefined
    let data
    
    try {
        data = JSON.parse(value)
    } catch (err) {
        return '^Un problème est survenue sur votre fichier'
    }

    if (! data.type.startsWith('image/')) {
        res = '^Veuillez choisir une image.'
    }
    else if (! env.IMAGE_ALLOWED_EXTENSIONS.includes(data.ext))
    {
        res = '^Choisissez une image ayant l\'une des extension suivantes: png, jpeg, jpg, gif.'
    }
    else if (data.size > env.IMAGE_MAX_SIZE) {
        res = '^Le poids maximal de l\'image est de 2MB.'
    }

    return res
}

const rules = {
    'code': {
        'presence': {'allowEmpty': false},
    },

    'contact-content': {
        'presence': {'allowEmpty': false}
    },

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

    'password-confirm': {
        'presence': {'allowEmpty': false},
        'equality': 'password'
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

    'category_name': {
        'presence': {'allowEmpty': false},
        'length': {
            'minimum': 3,
            'maximum': 124
        }
    },

    'new-password-confirm': {
        'presence': {'allowEmpty': false},
        'equality': 'new-password'
    },
    
    'item-name': {
        'presence': {'allowEmpty': false},
        'length': {
            'minimum': 3,
            'maximum': 124
        }
    },

    'item-images': {
        'image': {}
    },

    'item-price': {
        'presence': {'allowEmpty': false},
        'numericality': {
            'onlyInteger': true,
            'noStrings': false
        }
    },

    'item-description': {
        'presence': {'allowEmpty': false},
        'length': {
            'minimum': 6,
            'maximum': 200
        }
    },
    
    'autor': {
        'presence': {'allowEmpty': false},
        'length': {
            'minimum': 3,
            'maximum': 124
        }
    },

    'testimonial': {
        'presence': {'allowEmpty': false},
        'length': {
            'minimum': 6,
            'maximum': 200
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
 * @param {File} file 
 * @param {String} fieldId 
 */
const checkFileField = (file, fieldId)=> {
    let data = {}

    data[fieldId] = JSON.stringify({
        'size': file.size,
        'ext': file.name.slice(file.name.lastIndexOf('.') +1).toLowerCase(),
        'type': file.type.toLowerCase()
    })
    
    let errors
    let res
    let field = document.querySelector('#' + fieldId)
    
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
    checkFileField,
    setAlert,
    setErrMsg,
    disable,
    clearPassword
}