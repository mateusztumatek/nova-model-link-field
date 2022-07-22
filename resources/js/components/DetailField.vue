<template>
  <PanelItem :index="index" :field="field">
      <template v-slot:value>
          <div>
              <div v-if="typeof field.value == 'string'"><a :href="field.value" type="_blank">{{ field.value }}</a></div>
              <div v-else> - </div>
          </div>
      </template>
  </PanelItem>
</template>

<script>
export default {
  props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],
}
</script>
