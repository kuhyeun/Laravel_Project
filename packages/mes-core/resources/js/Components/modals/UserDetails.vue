<template>
  <div>
    <h2>사용자 상세 정보</h2>
    <hr>
    <p><strong>이름:</strong> {{ user.name }}</p>
    <p><strong>이메일:</strong> {{ user.email }}</p>
    <p><strong>가입일:</strong> {{ user.joined }}</p>
    
    <!-- 중첩 모달 테스트를 위한 버튼 -->
    <!-- <button @click="openNestedModal" style="margin-top: 20px; margin-right: 10px;">다른 모달 열기</button> -->
    <button @click="$emit('close')">닫기</button>
  </div>
</template>

<script setup>

defineProps({
  user: {
    type: Object,
    required: true,
  }
});
defineEmits(['close']);

</script>
