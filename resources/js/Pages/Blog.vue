<template>
  <div class="max-w-screen-lg w-full mx-auto mt-12">
    <h1 class="text-2xl text-gray-700 pb-6">Blog</h1>
    <Disclosure class="mb-4" as="div" v-for="(post, index) in posts" :key="index" v-slot="{ open }">
      <DisclosureButton
        class="
          flex
          flex-col
          justify-between
          w-full
          px-4
          py-2
          text-sm
          font-medium
          text-left text-purple-900
          bg-purple-100
          rounded-lg
          focus:outline-none
          focus-visible:ring
          focus-visible:ring-purple-500
          focus-visible:ring-opacity-75
        "
      >
        <div>
          <p class="text-lg">{{post.title}}</p>
          <p>{{post.description}}</p>
        </div>
        <div class="w-full flex items-center justify-center">
        <ChevronUpIcon
          :class="open ? 'transform rotate-180' : ''"
          class="w-5 h-5 text-purple-500"
        />
        </div>
      </DisclosureButton>
      <Comments :post="post" />
      <div class="flex gap-8" v-for="(comment, index) in post.comments" :key="index">
        <p>{{comment.comment}}</p>
        <button @click.prevent="deleteComments(comment.id)" class="btn">Delete</button>
      </div>
    </Disclosure>
  </div>
</template>

<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";
import { ChevronUpIcon } from "@heroicons/vue/solid";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
const props = defineProps({
  posts: {
    type: Array,
    default: null,
  },
});
const deleteComments = (id) => Inertia.post(`/comment-delete/${id}`)
</script>
