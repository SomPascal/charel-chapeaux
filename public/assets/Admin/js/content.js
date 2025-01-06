import { setVisibility } from "./Utils/admin.js"

const siteDescriptionSection = document.querySelector('#site-desc')

const testimonialSlider = ()=> {
    new Swiper('#testimonials .swiper', {
        // Optional parameters
        loop: false,
        slidesPerView: 1,
        spaceBetween: '20px',

        // responsive behavior
        breakpoints: {
            768: { slidesPerView: 2 },
            1112: { slidesPerView: 3 }
        },
      
        // If we need pagination
        pagination: {
          el: '.swiper-pagination',
        },

        keyboard: {
            enabled: true,
            onlyInViewport: false,
        }
    })
}

const descriptionSlider = ()=> {
    new Swiper('#site-desc .swiper', {
        // Optional parameters
        loop: false,
        slidesPerView: 1,
        spaceBetween: '20px',

        // responsive behavior
        breakpoints: {
            768: { slidesPerView: 2 },
            1112: { slidesPerView: 3 }
        },
      
        // If we need pagination
        pagination: {
          el: '.swiper-pagination',
        },

        keyboard: {
            enabled: true,
            onlyInViewport: false,
        }
    })
}

const deleteTestimonial = ()=> {
    const testimonials = document.querySelector('#testimonials')
    const deleteTestimonialModal = document.querySelector('#delete-testimonial-modal')
    const deleteTestimonialForm = deleteTestimonialModal.querySelector('form')

    
    testimonials.querySelectorAll('.swiper .card').forEach(card => {        
        card.querySelectorAll('button[delete]').forEach(btn => {            
            btn.addEventListener('click', ()=> {                
                deleteTestimonialForm.addEventListener('submit', (e)=> {
                    e.preventDefault()
    
                    setVisibility(
                        deleteTestimonialForm,
                        card.id.slice(12),
                        'id'
                    )
                })
            })
        })
    })
}

const extendDescription = ()=> {
    const extendDescriptionModal = document.querySelector('#extend-description-modal')

    siteDescriptionSection.querySelectorAll('.card').forEach(card => {
        card.querySelectorAll('[extend-description]').forEach(btn => {
            btn.addEventListener('click', ()=> {
                extendDescriptionModal.querySelector('h5').innerHTML = card.querySelector('h5').innerHTML
                extendDescriptionModal.querySelector('p').innerHTML = card.querySelector('textarea').value
            })    
        })
    })

}

document.addEventListener('DOMContentLoaded', ()=> {
    testimonialSlider()
    deleteTestimonial()
    descriptionSlider()
    extendDescription()
})