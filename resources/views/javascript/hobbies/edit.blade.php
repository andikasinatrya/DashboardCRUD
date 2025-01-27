<div id="editModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-11/12 max-w-2xl dark:bg-slate-800">
        <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
            <h3 class="text-lg font-bold">Edit Hobby</h3>
            <button id="closeEditModal" class="text-gray-400 hover:text-red-600">
                <iconify-icon icon="heroicons-outline:x" class="w-6 h-6"></iconify-icon>
            </button>
        </div>
        <div class="p-6">
            <form id="editForm" method="POST" action="" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="editName" class="block text-sm font-medium text-gray-700 dark:text-white">Hobby Name</label>
                    <input type="text" id="editName" name="name" class="mt-1 block w-full rounded-md border-gray-300 dark:bg-slate-200 shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter hobby name" required>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700">
                    Update
                </button>
            </form>
        </div>
    </div>
</div>
