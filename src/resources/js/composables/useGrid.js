import { ref, onUnmounted } from 'vue';
import Grid from 'tui-grid';
import 'tui-grid/dist/tui-grid.css';

export function useGrid() {

  const gridInstance = ref(null);

  /**
   * 그리드를 초기화하고 DOM에 마운트하는 메인 함수입니다.
   * @param {ref} gridContainerRef - 그리드가 마운트될 DOM 엘리먼트의 ref (e.g., <div ref="gridEl"></div>)
   * @param {object} componentOptions - 컴포넌트에서 전달하는 특정 옵션 (columns, data 등)
   */
  const setGrid = ( gridContainerRef, componentOptions ) => {
    if( !gridContainerRef.value ) {
        console.error( "TUI GRID Element Not Found" );
    //   console.error( "TUI Grid를 마운트할 엘리먼트가 없습니다. ref가 올바르게 연결되었는지 확인하세요.");
      return;
    }

    const containerHeight = gridContainerRef.value.offsetHeight;
    const containerStyle  = getComputedStyle( gridContainerRef.value );

    let marginTop = Number( containerStyle.marginTop.replace( "px", "" ) );
    let marginBottom = Number( containerStyle.marginBottom.replace( "px", "" ) );
    let gridBodyHeight = containerHeight - ( marginTop + marginBottom ) - 30; // 30 : Grid Header Area Height

    // 모든 그리드에 공통적으로 적용될 기본 옵션을 정의합니다.
    const defaultOptions = {
      header: {
        height: 35
      },
      rowHeight: 33,
      minRowHeight: 33,
      bodyHeight: gridBodyHeight > 150 ? gridBodyHeight : 150,
      columnOptions: {
        resizable: true
      },
      language: "ko",
      useClientSort: false,
      scrollY: false,
      scrollX: false,
      showConfigButton: true
    };
    
    const finalOptions = {
      el: gridContainerRef.value, // 필수: 그리드가 그려질 실제 DOM 엘리먼트
      ...defaultOptions,
      ...componentOptions
    };

    const newGrid = new Grid( finalOptions );

    gridInstance.value = newGrid;
  };

  /**
   * 컴포넌트가 사라질 때(unmounted) 메모리 누수를 방지하기 위해
   * 생성된 그리드 인스턴스를 파괴하는 정리(cleanup) 로직입니다.
   */
  onUnmounted(() => {
    if( gridInstance.value ) {
      gridInstance.value.destroy();
      gridInstance.value = null;
    }
  });

  // 컴포넌트에서 사용할 수 있도록 인스턴스 ref와 설정 함수를 반환합니다.
  return {
    gridInstance,
    setGrid,
  };
}
