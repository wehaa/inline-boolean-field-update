import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
    app.component('index-liveupdate-boolean', IndexField)
    app.component('detail-liveupdate-boolean', DetailField)
    app.component('form-liveupdate-boolean', FormField)
})
