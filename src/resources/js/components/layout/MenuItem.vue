<template>
  <li class="my-1">
    <div
      class="flex items-center justify-between p-1 rounded hover:bg-gray-200"
      :class="{ 'cursor-pointer': hasChildren }"
      @click="hasChildren ? toggle() : null"
    >
      <span v-if="hasChildren" class="flex-grow flex items-center text-[15px]">
        {{ menuItem.menu_name }}
      </span>
      <Link v-else :href="itemHref" class="flex-grow flex items-center text-[15px]">
        {{ menuItem.menu_name }}
      </Link>

      <span v-if="hasChildren" class="icon-wrapper">
        <svg
          class="w-4 h-4 transform transition-transform duration-300 ease-in-out"
          :class="{ 'rotate-90': expanded }"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M9 5l7 7-7 7"
          />
        </svg>
      </span>
    </div>

    <ul
      v-if="hasChildren"
      ref="subMenuRef"
      class="sub-menu overflow-hidden pl-4 ml-2"
      :style="{ maxHeight: expanded ? subMenuHeight + 'px' : '0px', transition: 'max-height 0.3s ease' }"
    >
      <MenuItem
        v-for="child in menuItem.children"
        :key="child.menu_idx ?? child.id ?? child.menu_route_name ?? child.menu_name"
        :menu-item="child"
      />
    </ul>
  </li>
</template>

<script setup>
import { ref, computed, nextTick } from 'vue';
import { route } from 'ziggy-js';
import { Link } from '@inertiajs/vue3';
import MenuItem from './MenuItem.vue';

const props = defineProps({
  menuItem: {
    type: Object,
    required: true,
  },
});

const expanded = ref(false);
const subMenuRef = ref(null);
const subMenuHeight = ref(0);

const hasChildren = computed(() =>
  Array.isArray(props.menuItem.children) && props.menuItem.children.length > 0
);

const itemHref = computed(() => {
  if (!props.menuItem.menu_route_name) {
    return '#';
  }
  try {
    return route(props.menuItem.menu_route_name);
  } catch {
    return '#';
  }
});

const toggle = async () => {
  if (!expanded.value) {
    expanded.value = true;
    await nextTick();
    subMenuHeight.value = subMenuRef.value?.scrollHeight ?? 0;
  } else {
    subMenuHeight.value = 0;
    expanded.value = false;
  }
};
</script>
