<nav class="p-3">
    <ul class="mt-4">
        {{-- $userMenu 변수가 존재하고 비어있지 않은지 확인합니다. --}}
        @if(isset($userMenu) && count($userMenu) > 0)
            @foreach($userMenu as $menuItem)
                {{-- 각 최상위 메뉴 항목에 대해 _menuItem 뷰를 포함시킵니다. --}}
                @include('template.menuItem', ['menuItem' => $menuItem])
            @endforeach
        @endif
    </ul>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggles = document.querySelectorAll('.menu-toggle');

        toggles.forEach(toggle => {
            toggle.addEventListener('click', function (event) {
                event.preventDefault();

                const listItem = this.closest('li');
                const subMenu = listItem.querySelector('.sub-menu');
                const iconWrapper = this.querySelector('.icon-wrapper');

                if (subMenu) {
                    if (subMenu.style.maxHeight && subMenu.style.maxHeight !== '0px') {
                        subMenu.style.maxHeight = '0px';
                    } else {
                        subMenu.style.maxHeight = subMenu.scrollHeight + 'px';
                    }

                    if (iconWrapper) {
                        const icon = iconWrapper.querySelector('svg');
                        // 오른쪽 화살표를 90도 회전시켜 아래를 보게 합니다.
                        icon.classList.toggle('rotate-90');
                    }
                }
            });
        });
    });
</script>