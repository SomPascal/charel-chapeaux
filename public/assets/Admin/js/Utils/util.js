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

    HTTP_INTERNAL_SERVER_ERROR: 500
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