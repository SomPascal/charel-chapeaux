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

    validate.validators.phone = (
        value, 
        attrs, 
        attrName, 
        options, 
        constraints
    )=> {
        return (/^(((\+)?(237))?6[2456789][0-9]{7})$/.test(value)) 
        ? null : '^Veuillez entrer un vrai numero'
    }

    const phone = document.querySelector('#phone')
    const phoneConstraints = {
        'phone': {
            presence: {
                allowEmpty: false,
                message: '^Veuillez entrer votre numero'
            },
            phone: {}
        }
    }

    const name = document.querySelector('#name')
    const nameConstraints = {
        name: {
            presence: {
                allowEmpty: false,
                message: '^Veuillez entrer votre nom'
            },
            length: {
                minimum: 3,
                message: '^Votre nom doit avoir au moins 03 caracteres'
            }
        }
    }

    const contactUsForm = document.querySelector('#contact-us')
    const contactSuccess = document.querySelector('#success-contact')

    if (! contactUsForm) return

    name.addEventListener('blur', function nameBlur() {
        let errors = validate(
            {name: (this.value ?? '').replaceAll(' ', '')},
            nameConstraints,
            {format: 'flat'}
        )
        let result

        if (errors == undefined) {
            name.parentNode.querySelector('.invalid-feedback')
            .innerHTML = ''
            name.classList.remove('is-invalid')

            result = false
        }
        else {
            name.parentNode.querySelector('.invalid-feedback')
            .innerHTML = errors[0]
            name.classList.add('is-invalid')

            result = true
        }

        return result
    })

    phone.addEventListener('blur', function phoneBlur() {
        let errors = validate(
            {phone: (this.value ?? '').replaceAll(' ', '')},
            phoneConstraints,
            {format: 'flat'}
        )
        let result

        if (errors == undefined) {
            phone.parentNode.querySelector('.invalid-feedback')
            .innerHTML = ''
            phone.classList.remove('is-invalid')

            result = false 
        }
        else {
            phone.parentNode.querySelector('.invalid-feedback')
            .innerHTML = errors[0]
            phone.classList.add('is-invalid')

            result = true 
        }

        return result
    })

    contactUsForm.addEventListener('submit', (e)=> {
        e.preventDefault()
    
        phone.blur()
        name.blur()
        contactUsForm.classList.add('d-none')
        contactSuccess.classList.remove('d-none')
        
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
    console.log(swiper);
    
}

const enlargeImages = ()=> {
    const enlargeWall = document.querySelector('#enlarge-wall')
    const enlargeWallImg = enlargeWall.querySelector('.img-box img')
    const closeBtn = enlargeWall.querySelector('button')

    document.querySelectorAll('[enlarge] img').forEach(img => {
        console.log(img);
        
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