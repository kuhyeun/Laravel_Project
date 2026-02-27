<template>
  <div @click="incrementNumber">
    <h3>This is a Vue.js Component!</h3>
    <p>My favorite number is: {{ number }}</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      number: 0
    };
  },
  methods: {
    incrementNumber() {
      this.number++;
    }
  }
};
</script>

<!-- scoped 를 추가하면 현재 Component안에서만 고유하게 css가 적용됨 -->
<style scoped>
div {
  background-color: #f0f8ff;
  border-left: 5px solid #42b983;
  padding: 15px;
  margin-top: 20px;
  cursor: pointer;
}
p {
    color: #333;
}
</style>
