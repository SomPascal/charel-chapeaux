const env = {
    X_CSRF_TOKEN: 'X-CSRF-TOKEN'
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
 * @returns {String}
 */
const getCsrfToken = ()=> {
    return  csrfTag.getAttribute('content')
}

export {
    env,
    setCsrfToken,
    getCsrfToken
}