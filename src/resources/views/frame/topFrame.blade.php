<div class="flex items-center h-[50px] px-5 py-3 font-bold">
    <button id="sidebar-toggle" class="p-1 mr-4 border border-transparent rounded-md box-border hover:border-black">
        @svg('heroicon-m-bars-3-bottom-left', 'h-5 w-5')
    </button>
    <div>
        <h1>Top Frame Area</h1>
    </div>
    <div class="flex-1"></div>
    <nav class="flex space-x-4">
        <a href="{{ route('user.dashboard') }}" class="text-gray-700 hover:text-blue-500">DashBoard</a>
        <a href="{{ route('user.logout') }}" class="text-gray-700 hover:text-blue-500">Logout</a>
    </nav>
</div>
