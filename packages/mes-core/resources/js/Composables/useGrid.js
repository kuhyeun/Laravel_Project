import { ref, onUnmounted } from 'vue';
import Grid from 'tui-grid';
import 'tui-grid/dist/tui-grid.css';

export function useGrid() {

    const gridInstance = ref(null);

    let resizeObserver = null;

/**
 * 그리드를 초기화하고 DOM에 마운트하는 메인 함수
 * @param {ref} gridContainerRef - 그리드가 마운트될 DOM 엘리먼트의 ref / ex) <div ref="gridEl"></div>
 * @param {object} componentOptions - 컴포넌트에서 전달하는 특정 옵션
 */
    const setGrid = ( gridContainerRef, componentOptions ) => {
        if( !gridContainerRef.value ) {
                console.error( "Grid Container Not Found" );
            return;
        }

        const containerHeight = gridContainerRef.value.offsetHeight;
        const containerStyle  = getComputedStyle( gridContainerRef.value );

        let marginTop      = Number( containerStyle.marginTop.replace( "px", "" ) );
        let marginBottom   = Number( containerStyle.marginBottom.replace( "px", "" ) );
        let gridBodyHeight = containerHeight - ( marginTop + marginBottom ) - 21; // 21 : Grid Header Area Height

        // 모든 그리드에 공통적으로 적용될 기본 옵션을 정의
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

        Grid.setLanguage('ko'); // Grid 생성전 호출해야함

        const newGrid = new Grid( finalOptions );
        const borderColor = "#D7D7D7";
        
        Grid.applyTheme( 'clean', {
            grid: {
                border: borderColor
            },
            outline: {
                border: borderColor,
            },
            selection: {
                background: "#4daaf9",
                border: "#C2D6FB"
            },
            area: {
                border: borderColor
            },
            cell: {
                normal: {
                    border: borderColor,
                    showVerticalBorder: true,
                    showHorizontalBorder: true,
                    },
                header: {
                    background: "#EDEDED",
                    border: borderColor,
                },
                rowHeader: {
                    border: borderColor,
                    showVerticalBorder: true,
                    showHorizontalBorder: true
                },
                selectedHeader: {
                    background: "#E3E3E3"
                },
                focused: {
                    border: "#8f9af2"
                }
            }
        });

        gridInstance.value = newGrid;
    };

    const autoResizeGrid = ( gridContainerRef, grid ) => {
        const containerStyle  = getComputedStyle( gridContainerRef.value );

        let marginTop = Number( containerStyle.marginTop.replace( "px", "" ) );
        let marginBottom = Number( containerStyle.marginBottom.replace( "px", "" ) );

        resizeObserver = new ResizeObserver( vv => {
        for( let v of vv ) {
            const {height} = v.contentRect;

            if( grid != null ) {
            grid.setHeight( height - ( marginTop + marginBottom ) );
            grid.refreshLayout();
            };
        }
        });

        resizeObserver.observe( gridContainerRef.value );
    }
  
  /**
   * 컴포넌트가 사라질 때(unmounted) 메모리 누수를 방지하기 위해
   * 생성된 그리드 인스턴스를 파괴하는 정리(cleanup) 로직입니다.
   */
    onUnmounted(() => {
        if( gridInstance.value ) {
            gridInstance.value.destroy();
            gridInstance.value = null;
        };

        if( resizeObserver != null ) {
            resizeObserver.disconnect();
            resizeObserver = null;
        }
    });

    // 컴포넌트에서 사용할 수 있도록 인스턴스 ref와 설정 함수를 반환합니다.
    return {
        gridInstance,
        setGrid,
        autoResizeGrid
    };
}
