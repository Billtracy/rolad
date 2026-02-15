@extends('layouts.admin')

@section('header')
    Edit Role: {{ $role->name }}
@endsection

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.roles.index') }}" class="text-indigo-600 hover:text-indigo-900">← Back to Roles</a>
    </div>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Role Name</label>
                    <input type="text" name="name" id="name" value="{{ $role->name }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Permissions</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach ($permissions as $permission)
                            <div class="flex items-center">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->slug }}"
                                    id="perm_{{ $permission->id }}"
                                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    {{ $role->permissions->contains('id', $permission->id) ? 'checked' : '' }}>
                                <label for="perm_{{ $permission->id }}"
                                    class="ml-2 text-sm text-gray-600">{{ $permission->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Update Role
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
