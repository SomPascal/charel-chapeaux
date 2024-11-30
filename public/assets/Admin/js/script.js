import { Admin, AdminBag } from "./Components/Admin.js";

let admins = new AdminBag()

const swiperTestimonials = ()=> {
    const swiper = new Swiper('#testimonials .swiper', {
        // Optional parameters
        loop: false,
        slidesPerView: 1,
        spaceBetween: '50px',

        // responsive behavior
        breakpoints: {
            768: { slidesPerView: 2 }
        },
      
        // If we need pagination
        pagination: {
          el: '.swiper-pagination',
        },

        keyboard: {
            enabled: true,
            onlyInViewport: false,
        }
    });
    
}

const swiperCapsPopulary = ()=> {
    // const mostPopularSwiper = new Swiper('#most-popular-caps', {
    //     // Optional parameters

    //     loop: false,
    //     slidesPerView: 1,
    //     spaceBetween: '10px',

    //     pagination: {
    //         el: '.swiper-pagination',
    //     },
  
    //     keyboard: {
    //         enabled: true,
    //         onlyInViewport: false
    //     },

    //     breakpoints: {
    //         780: {
    //             slidesPerView: 3,
    //             spaceBetween: '40px'
    //         }
    //     }
    // })

    document.querySelectorAll('#caps-popularity .swiper').forEach(swiper => {
        new Swiper(swiper, {
            loop: false,
            slidesPerView: 1,
            spaceBetween: '10px',

            pagination: {
                el: '.swiper-pagination',
            },
    
            keyboard: {
                enabled: true,
                onlyInViewport: false
            },

            breakpoints: {
                780: {
                    slidesPerView: 3,
                    spaceBetween: '40px'
                }
            }
        })
    })
    
}

const handleDescModal = ()=> {
    const expandDescModal = ()=> {
        let modalTarget, descTarget
        document.querySelectorAll('#site-desc button[data-toggle="modal"]').forEach(btn => {

            btn.addEventListener('click', ()=> {

                modalTarget = document.querySelector(btn.getAttribute('data-target'))

                if (modalTarget == null) {
                    return
                }
                descTarget = btn.parentNode.parentNode.parentNode

                modalTarget.querySelector('.modal-title')
                .innerHTML = descTarget.querySelector('.card-header h5').innerHTML

                modalTarget.querySelector('.modal-body textarea')
                .value = descTarget.querySelector('.card-body textarea').value
            })
        })
    }

    const editDesc = ()=> {
        const extendDescModal = document.querySelector('#extend-desc')
        const editBtn = document.querySelector('#edit-desc')
        const updateBtn = document.querySelector('#update-desc')
        const cancelEditBtn = document.querySelector('#cancel-update-desc')
        const descField = document.querySelector('#desc-text')

        extendDescModal.querySelectorAll('[data-dismiss="modal"]')
        .forEach((btn)=> {
            btn.addEventListener('click', ()=> {
                cancelEditBtn.click()
            })

        })

        extendDescModal.addEventListener('click', ()=> {
            cancelEditBtn.click()
        })

        editBtn.addEventListener('click', ()=> {
            editBtn.parentNode.classList.add('d-none')
            updateBtn.parentNode.classList.remove('d-none')
            descField.removeAttribute('readonly')
        })

        cancelEditBtn.addEventListener('click', (e)=> {
            e.target.parentNode.classList.add('d-none')
            descField.setAttribute('readonly', 'readonly')
            editBtn.parentNode.classList.remove('d-none')
        })

        updateBtn.addEventListener('click', ()=> {
            alert('description saved')
        })
        // console.log(extendDescModal)
    }

    editDesc()
    expandDescModal()
}

const setAdmins = ()=> {    
    admins = AdminBag.getAdmins()    
}

function showAdminDetails () {
    const adminDetailsModal = document.querySelector('#admin-details')
    const selects = ['id', 'invitedBy', 'username', 'email', 'registredAt']
    let admin

    document.querySelectorAll('[admin-card]').forEach(card => {
        card.querySelector('[show-admin]').addEventListener('click', ()=> {
            admin = admins.findById(card.getAttribute('admin-id'))
            
            if (admin == null)
            {
                adminDetailsModal.querySelector('.modal-body').innerHTML = '<p>Aucune donnée a afficher.</p>'
                return
            }
        
            selects.forEach(sel => {
                const el = document.querySelector(`#detail-${sel}`)
                if (! el) {
                    return 
                }
                el.querySelector('span').innerHTML = admin[sel]
            })
        })

        adminDetailsModal.querySelectorAll('button[data-dismiss]').forEach(btn => {
            btn.addEventListener('click', ()=> {
                selects.forEach(sel => {
                    const el = document.querySelector(`#detail-${sel}`)
                    // if (! el) {
                    //     return 
                    // }
                    el.querySelector('span').innerHTML = ''
                })
            })
        })
    })
    
}

document.addEventListener('DOMContentLoaded', ()=> {
    document.querySelector('#sidebarToggleTop')?.click()
    setAdmins()
    showAdminDetails()
    
    // swiperTestimonials()
    swiperCapsPopulary()
    // handleDescModal()
    // handleLinksModal()

})