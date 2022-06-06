<template>
  <Head title="Dashboard" />
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
        {{marker}}
        <form @submit.prevent="$emit('submit', form)">
            <input type="text" v-model="form.name" />
            <input type="text" v-model="form.description" />
            <input type="text" v-model="form.latitude" />
            <input type="text" v-model="form.longitude" />
            <button  type="submit" class="btn" value="Update">Update</button>
        </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
    emits:{
        submit: function(form){
            console.log(form)
            form.post("/googlemaps/marker/" + form.id)
        }
    }
};
</script>
<script setup>
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { inject, ref } from "vue";
import { defineProps, reactive, defineEmits } from "vue";
const route = inject("route");
const props = defineProps({
    marker: String
})
const form = useForm({
    id:props.marker.id,
    name: props.marker.name,
    description: props.marker.description,
    latitude: props.marker.latitude,
    longitude: props.marker.longitude,
})
</script>
