<template>
  <div class="bg-white shadow rounded px-3 pt-3 pb-5 border border-white">
    
      <p class="text-gray-700 font-semibold font-sans tracking-wide text-sm">{{task.title}}</p>


    
    <div>
      <span class="text-sm text-gray-600">{{task.date}}</span>
    </div>
  </div>
</template>
<script>
export default {
  components: {
  },
  props: {
    task: {
      type: Object,
      default: () => ({})
    }
  },
  computed: {
    badgeColor() {
      const mappings = {
        Design: "purple",
        "Feature Request": "teal",
        Backend: "blue",
        QA: "green",
        default: "teal"
      };
      return mappings[this.task.type] || mappings.default;
    }
  }
};
</script>
