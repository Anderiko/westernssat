window._ = require('lodash')

try {
    window.Popper = require('popper.js').default
    window.$ = window.jQuery = require('jquery')

    require('bootstrap/dist/js/bootstrap.bundle.min.js')


    window.bootstrap = require('bootstrap/dist/js/bootstrap.bundle.min.js')
} catch (e) {}

const config = {
    csrf: document.querySelector('meta[name="csrf-token"]').content,
    url: document.querySelector('link[rel="canonical"]').href
}

window.axios = require('axios')

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

window.axios.defaults.withCredentials = true

window.axios.defaults.headers.common['X-CSRF-TOKEN'] = config.csrf

window.axios.defaults.baseURL = config.url

export default config


let toastElList = [].slice.call(document.querySelectorAll('.toast'))
let toastList = toastElList.map(function(toastEl) {
    return new bootstrap.Toast(toastEl, { delay: 3000 })
})

toastList.forEach(toast => toast.show())





/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });