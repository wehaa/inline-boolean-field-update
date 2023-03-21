<template>
  <div class="relative flex justify-center">
    <Checkbox
        @input="save"
        :id="id"
        :name="field.name"
        :checked="value"
        :disabled="isReadonly"
    />
  </div>
</template>

<script>
import FormField from '../../../../../vendor/laravel/nova/resources/js/mixins/FormField.js'
import Checkbox from '../../../../../vendor/laravel/nova/resources/js/components/Checkbox.vue'

export default {
  components: {Checkbox},
  data() {
    return {
      loading: false,
      newValue: null,
      id: this.field.attribute + this.field.id
    }
  },
  mixins: [FormField],
  props: ['resourceName', 'resourceId', 'field'],
  methods: {
    save() {
      let newValue = document.getElementById(this.id).checked;
      if (newValue !== this.field.value) {
        if (!this.loading) {
          this.loading = true;
          Nova.request().put(
              `/nova-api/${this.resourceName}/${this.field.id}/`,
              {
                [this.field.attribute]: newValue
              }
          )
              .then(() => {
                this.loading = false
                this.field.value = this.newValue
                Nova.success('Successfully updated!')
              })
              .catch((error) => {
                if (error.response.status === 422) {
                  let validationErrors = [];

                  error.response.data.errors.value.forEach(function (errorMessage) {
                    validationErrors.push(errorMessage.replace('value', this.field.name));
                  });

                  Nova.error(validationErrors.join('<br>'));
                }
              });
        }
        this.loading = true;
      }
    },
    setInitialValue() {
      this.value = this.field.value || false
    },
    fill(formData) {
      formData.append(this.field.value, this.value || false)
    },
    handleChange(value) {
      this.value = value
    },
  },
}
</script>

