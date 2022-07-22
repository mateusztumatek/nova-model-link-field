import IndexField from './components/IndexField'
import DetailField from './components/DetailField'
import FormField from './components/FormField'

Nova.booting((app, store) => {
  app.component('index-nova-model-link-field', IndexField)
  app.component('detail-nova-model-link-field', DetailField)
  app.component('form-nova-model-link-field', FormField)
})
