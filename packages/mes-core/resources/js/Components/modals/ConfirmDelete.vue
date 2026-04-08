<template>
  <div>
    <h3>'{{ item.name }}' 항목을 정말 삭제하시겠습니까?</h3>
    <p>이 작업은 되돌릴 수 없습니다.</p>
    <div style="text-align: right; margin-top: 20px;">
        <button @click="$emit('close')" style="margin-right: 10px;">취소</button>
        <button @click="confirm" style="background-color: #dc3545; color: white; border: none; padding: 8px 12px; border-radius: 4px;">삭제 확인</button>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  item: {
    type: Object,
    required: true
  }
});

const emit = defineEmits(['close', 'confirmed']);

const confirm = () => {
    // 실제 삭제 로직은 이 컴포넌트를 부른 곳에서 처리하도록
    // confirmed 이벤트를 발생시켜 item.id를 전달합니다.
    emit('confirmed', props.item.id);
    emit('close'); // 그리고 모달을 닫습니다.
}
</script>
