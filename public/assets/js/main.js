import { checkField, disable, setAlert, setErrMsg } from "../Admin/js/Utils/form.js"
import { env, getCsrfToken, setCsrfToken, setNotification } from "../Admin/js/Utils/util.js"

const handleCookiePopUp = ()=> {
    const cookiePopUp = document.querySelector('.cookies-info')

    if (! cookiePopUp) return

    cookiePopUp.querySelector('button').addEventListener('click', ()=> {
        cookiePopUp.classList.add('cookies-accepted')
    })
}

const manageLikes = ()=> {
    const btnWishlist = document.querySelectorAll('.product-swiper .swiper-slide .product-item .btn-wishlist')
    btnWishlist.forEach(btn => {
        btn.addEventListener('click', (e)=> {
            e.preventDefault()
            btn.classList.toggle('btn-liked')
        })
    })
}

const handleContactUs = ()=> {
    const phone = document.querySelector('#phone')
    const name = document.querySelector('#name')

    const contactSentSuccess = document.querySelector('#contact-sent-success')
    const contactUsForm = document.querySelector('#contact-us form')

    if (! contactUsForm) return

    name.addEventListener('blur', function nameBlur() {
        checkField(name, 'name')
    })

    phone.addEventListener('blur', function phoneBlur() {
        checkField(phone, 'phone')
    })

    contactUsForm.addEventListener('submit', (e)=> {
        e.preventDefault()        

        console.log(checkField(name, 'name'), checkField(phone, 'phone'));
        
        if (! (checkField(name, 'name') && checkField(phone, 'phone'))) 
        {
            return
        }                

        disable(contactUsForm)
        setAlert(contactUsForm, '', false)

        let data = {
            name: name.value,
            phone: phone.value
        }
        
        fetch(contactUsForm.getAttribute('action'), {
            'method': 'post',
            'cache': 'no-cache',
            'headers': {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
                'X-Requested-With': 'XMLHttpRequest'
            },

            'body': JSON.stringify(data)
        })
        .then(response => {
            setCsrfToken(response.headers.get(env.X_CSRF_TOKEN))
            disable(contactUsForm, false)
            let sec

            if (response.ok) {
                setNotification('Notre équipe à été contacté avec succès!')

                contactUsForm.classList.add('d-none')
                contactSentSuccess.classList.remove('d-none')

                contactUsForm.remove()
                return
            }
            else if (response.status == env.HTTP_TOO_MANY_REQUEST) {
                sec = response.headers.get(env.X_RETRY_AFTER)

                setAlert(
                    contactUsForm,
                    `Trop d\'essaies. veuillez essayez de nouveau dans ${sec} secondes`
                )
            }
            else if (response.status == env.HTTP_BAD_REQUEST) {
                return response.json()
            }
            else {
                setAlert(
                    contactUsForm,
                    'Une erreur est survenue, veuillez essayer de nouveau.'
                )
            }
        })
        .then(json => {
            if (! (json != undefined && json.status == env.HTTP_BAD_REQUEST)) {
                return
            }

            for (const id in json.messages) {
                if (Object.prototype.hasOwnProperty.call(json.messages, id)) {
                    setErrMsg(
                        document.querySelector('#' + id),
                        json.messages[id]
                    )
                }
            }
        })
    })

}

const handleItemsDetails = ()=> {
    const itemsDeltails = document.querySelector('#item-details')

    if (! itemsDeltails) return

    const swiper = new Swiper('#item-details .swiper', {
        loop: true,
        
        pagination: {
            el: '.swiper-pagination'
        }
    })    
}

const enlargeImages = ()=> {
    const enlargeWall = document.querySelector('#enlarge-wall')
    const enlargeWallImg = enlargeWall.querySelector('.img-box img')
    const closeBtn = enlargeWall.querySelector('button')

    document.querySelectorAll('[enlarge] img').forEach(img => {        
        img.addEventListener('click', ()=> {
            enlargeWallImg.setAttribute('src', img.getAttribute('src'))
            enlargeWall.classList.add('show')
        })
    })

    closeBtn.addEventListener('click', ()=> {
        enlargeWallImg.setAttribute('src', '')
        enlargeWall.classList.remove('show')
    })

    enlargeWall.addEventListener('click', ()=> closeBtn.click())
}

document.addEventListener('DOMContentLoaded', ()=> {
    handleCookiePopUp()
    manageLikes()
    handleContactUs()
    handleItemsDetails()
    enlargeImages()
})