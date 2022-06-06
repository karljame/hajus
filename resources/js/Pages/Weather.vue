<template>
  <Head title="Weather" />
    <div class="flex items-center font-semibold gap-2" v-if="data">
    <img :src="weatherIcon" alt="" />
    <p>{{ data.name }}</p>
    <p><span class="font-normal">temp: </span>{{data.main.temp}}℃</p>
    <p><span class="font-normal">feels like: </span>{{data.main.feels_like}}℃</p>
    <p><span class="font-normal">Description: </span>{{data.weather[0].description}}</p>
  </div>
</template>
<script>
export default {
  props: { data: String },
};
// export default { layoutName: "Authenticated" };
</script>
<script setup>
import { Head } from "@inertiajs/inertia-vue3";
</script>
<style scoped>
</style>
