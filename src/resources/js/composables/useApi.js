import { ref } from 'vue';
import apiClient from '../api'; 

export function useApi() {
  
  // 1. Vue의 ref를 사용하여 반응형 상태 변수들을 선언합니다.
  const data = ref(null);      // API 응답 데이터를 담을 변수
  const isLoading = ref(false);  // 로딩 상태 (UI에 로딩 스피너 등을 표시할 때 사용)
  const error = ref(null);       // 에러 객체를 담을 변수

  /**
   * GET 요청을 수행하는 함수입니다.
   * @param {object} params - 쿼리 스트링으로 보낼 파라미터 (예: { search: 'John' })
   */
  const get = async ( url, params = {} ) => {
    isLoading.value = true;
    error.value = null;

    try {
      const response = await apiClient.get(url, { params });
      data.value = response.data;

      return response.data;
    } catch (err) {
      console.error(`[API GET Error] ${url}:`, err);
      error.value = err;
      data.value = null; // 에러 발생 시 이전 데이터가 남아있지 않도록 비워줍니다.
    } finally {
      isLoading.value = false;
    }
  };

  /**
   * POST 요청을 수행하는 함수입니다.
   * @param {object} payload - 요청 본문(body)에 담아 보낼 데이터
   */
  const post = async ( url, payload ) => {
    isLoading.value = true;
    error.value = null;

    try {
      const response = await apiClient.post(url, payload);
      data.value = response.data; // 성공 시 응답 데이터를 data 상태에 저장

      return response.data;
    } catch (err) {
      console.error(`[API POST Error] ${url}:`, err);
      error.value = err;
      throw err; // 에러를 다시 던져서, 호출한 컴포넌트에서도 try/catch로 추가 처리를 할 수 있게 합니다.
    } finally {
      isLoading.value = false;
    }
  };

  // PUT, DELETE, PATCH 등의 다른 HTTP 메서드 함수도 이와 유사하게 추가할 수 있습니다.

  // 2. 컴포넌트에서 사용할 상태와 함수들을 객체로 묶어 반환합니다.
  return {
    data,
    isLoading,
    error,
    get,
    post,
  };
}
