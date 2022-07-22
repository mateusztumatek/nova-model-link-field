<template>
    <div>
        <div v-if="typeof fieldValue == 'string'"><a :href="fieldValue" type="_blank">{{ fieldValue }}</a></div>
        <div v-else> - </div>
    </div>
</template>

<script>
export default {
  props: ['resourceName', 'field'],

  computed: {
    fieldValue() {
      return this.field.displayedAs || this.field.value
    },
  }
}
</script>
