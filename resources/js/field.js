Nova.booting((Vue, router, store) => {
    Vue.component('index-liveupdate-boolean', require('./components/IndexField'))
    Vue.component('detail-liveupdate-boolean', require('./components/DetailField'))
    Vue.component('form-liveupdate-boolean', require('./components/FormField'))
})
