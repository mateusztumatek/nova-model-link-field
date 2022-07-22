<template>
  <DefaultField :field="field" :errors="errors" :show-help-text="showHelpText">
    <template #field>
        <SearchInput
            :id="field.attribute"
            :data-testid="`${field.resourceName}-search-input`"
            @input="performSearch"
            @clear="clearSelection"
            @selected="selectResource"
            :error="hasError"
            :debounce="200"
            :value="value"
            :data="availableResources"
            :clearable="true"
            trackBy="linkable"
            class="w-full"
        >
            <div v-if="value" class="flex items-center">
                {{ value }}
            </div>
            <template #option="{ selected, option }">
                <div class="flex items-center">
                    <div class="flex-auto">
                        <div
                            class="text-sm font-semibold leading-normal"
                            :class="{ 'text-white dark:text-gray-900': selected }"
                        >
                            {{ option.title }}
                        </div>
                    </div>
                </div>
            </template>
        </SearchInput>
    </template>
  </DefaultField>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
  mixins: [FormField, HandlesValidationErrors],

  props: ['resourceName', 'resourceId', 'field'],

    data:() => {
      return{
        availableResources: [],
      }
    },
    mounted(){

    },
  methods: {
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      this.value = this.field.value || ''
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData) {
      formData.append(this.field.attribute, this.value || '')
    },
    performSearch(text){
        let serialize = function(obj, prefix) {
            var str = [],
                p;
            for (p in obj) {
                if (obj.hasOwnProperty(p) && obj[p]) {
                    var k = prefix ? prefix + "[" + p + "]" : p,
                        v = obj[p];
                    str.push((v !== null && typeof v === "object") ?
                        serialize(v, k) :
                        encodeURIComponent(k) + "=" + encodeURIComponent(v));
                }
            }
            return str.join("&");
        }
        Nova.request().get('/nova-vendor/model-link-field/search_models?'+serialize({term: text, exceptResources: (this.field.exceptResources)? this.field.exceptResources : null, store_type: this.field.storeType})).then(({data}) => {
            this.availableResources = data;
        })
    },
      selectResource(resource){
          this.value = resource.linkable;
      },
      clearSelection(){
        this.value = null;
      }
  },
}
</script>
