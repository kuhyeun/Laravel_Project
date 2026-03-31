<template>
  <teleport to="body">
    <!-- store의 modals 배열을 v-for로 순회하며 활성화된 모든 모달을 렌더링합니다. -->
    <div v-for="(modal, index) in modalStore.modals" :key="modal.id">
      <!-- 
        오버레이(배경) 클릭 시 해당 모달을 닫습니다. 
        z-index를 index 기반으로 동적으로 설정하여 중첩을 구현합니다.
      -->
      <div 
        class="modal-overlay" 
        :style="{ zIndex: 1000 + index }" 
        @click.self="handleOverlayClick(modal)"
      >
        <!-- 동적으로 사이즈 클래스를 부여합니다. -->
        <div class="modal-content" :class="`size-${modal.size}`">
          <!-- 닫기 버튼 -->
          <button class="modal-close-btn" @click="modalStore.close(modal.id)">&times;</button>
          
          <!-- 
            실제 내용이 될 컴포넌트를 동적으로 렌더링합니다.
            props를 바인딩하고, 'close' 이벤트를 수신하여 모달을 닫습니다.
          -->
          <component
            :is="modal.component"
            v-bind="modal.props"
            @close="modalStore.close(modal.id)"
          />
        </div>
      </div>
    </div>
  </teleport>
</template>

<script setup>
  import { onMounted, onUnmounted } from 'vue';
  import { useModalStore } from '../stores/modalStore';

  const modalStore = useModalStore();

  const handleOverlayClick = (modal) => {
    if (modal.closeOnClickOutside) {
      modalStore.close(modal.id);
    }
  };

  const handleKeydown = (e) => {
    if (e.key === 'Escape' && modalStore.modals.length > 0) {
      const topModal = modalStore.modals[modalStore.modals.length - 1];
      if (topModal.closeOnEsc) {
        modalStore.close(); // 최상단 모달을 닫습니다.
      }
    }
  };

  onMounted(() => {
    window.addEventListener('keydown', handleKeydown);
  });

  onUnmounted(() => {
    window.removeEventListener('keydown', handleKeydown);
  });
</script>

<style scoped>
  .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    display: flex;
    justify-content: center;
    align-items: center;
  }
  .modal-content {
    background-color: white;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 5px 15px rgba(0,0,0,.5);
    position: relative;
    width: 90%;
    max-height: 90vh;
    overflow-y: auto;
  }
  .modal-close-btn {
    position: absolute;
    top: 10px;
    right: 15px;
    border: none;
    background: none;
    font-size: 1.8rem;
    cursor: pointer;
    color: #666;
  }
  
  .size-sm { max-width: 400px; }
  .size-md { max-width: 600px; }
  .size-lg { max-width: 800px; }
  .size-xl { max-width: 1140px; }
</style>
