const env = {
    X_CSRF_TOKEN: 'X-CSRF-TOKEN',
    X_REDIRECT_TO: 'X-Redirect-To',
    X_RETRY_AFTER: 'X-Retry-After',

    HTTP_OK: 200,
    HTTP_CREATED: 201,

    HTTP_BAD_REQUEST: 400,
    HTTP_UNAUTHORIZED: 401,
    HTTP_FORBIDDEN: 403,
    HTTP_TOO_MANY_REQUEST: 429,

    HTTP_INTERNAL_SERVER_ERROR: 500,
    HTTP_INSUFFICIENT_STORAGE: 507
}

const csrfTag = document.head.querySelector(`meta[name="${env.X_CSRF_TOKEN}"]`)

/**
 * 
 * @param {String} csrfToken 
 * @returns {void}
 */
const setCsrfToken = (csrfToken)=> {
    csrfTag.setAttribute('content', csrfToken)
}

/**
 * 
 * @param {String} link 
 */
const copyLink = (link) => {
    let res

    navigator.clipboard.writeText(link)
    .then(()=> {
        res = true
    })
    .catch(()=> {
        res = false
    })

    return res
}

/**
 * @returns {String}
 */
const getCsrfToken = ()=> {
    return  csrfTag.getAttribute('content')
}

/**
 * 
 * @param {String} message 
 * @param {String} type
 */
const setNotification = (message, type='alert-success')=> {
    const notification = document.querySelector('#notification')
    const close = notification.querySelector('button')

    if (! notification) {
        return
    }
    notification.querySelector('p').innerHTML = message
    notification.classList.add('show')
    notification.classList.add(type)

    close.onclick = ()=> {
        notification.querySelector('p').innerHTML = ''
        notification.classList.remove(type)
        notification.classList.remove('show')
    }

    setTimeout(() => {
        close.click()
    }, 4000)
}

export {
    env,
    setCsrfToken,
    getCsrfToken,
    copyLink,
    setNotification
}