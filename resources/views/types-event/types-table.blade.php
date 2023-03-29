@extends('app')

@section('content')
    <h1 class="mt-5">Types</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Text</th>
                <th>Background</th>
                <th>Border</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
                <tr>
                    <td>{{ $type->id }}</td>
                    <td>{{ $type->name }}</td>
                    <td><input type="color" value="{{ $type->text }}"> {{ $type->text }}</td>
                    <td><input type="color" value="{{ $type->background }}">{{ $type->background }}</td>
                    <td><input type="color" value="{{ $type->border }}">{{ $type->border }}</td>

                    <td>
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editTypeModal{{ $type->id }}">Edit</button>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deleteTypeModal{{ $type->id }}">Delete</button>
                    </td>
                </tr>
                <!-- Edit Type Modal -->
                <div class="modal fade" id="editTypeModal{{ $type->id }}" tabindex="-1"
                    aria-labelledby="editTypeModal{{ $type->id }}Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editTypeModal{{ $type->id }}Label">Edit Type</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('event-type.update', $type->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name:</label>
                                        <input type="text" name="name" id="name" value="{{ $type->name }}"
                                            class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="text" class="form-label">Color:</label>
                                        <input type="color" name="text" id="text" value="{{ $type->text }}"
                                            class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="background" class="form-label">Background:</label>
                                        <input type="color" name="background" id="background"
                                            value="{{ $type->background }}" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="border" class="form-label">Border:</label>
                                        <input type="color" name="border" id="border" value="{{ $type->border }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Delete Type Modal -->
                <div class="modal fade" id="deleteTypeModal{{ $type->id }}" tabindex="-1"
                    aria-labelledby="deleteTypeModal{{ $type->id }}Label" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteTypeModal{{ $type->id }}Label">Delete Type</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete this Type?</p>
                                <p>ID: {{ $type->id }}</p>
                                <p>Name: {{ $type->name }}</p>
                                <p>Color: {{ $type->color }}</p>
                                <p>Background: {{ $type->background }}</p>
                                <p>Border: {{ $type->border }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <form action="{{ route('event-types.destroy', $type->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
    <!-- Button trigger modal -->
    <div style="text-align: center">
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#createTypeModal">
            Create Type
        </button>
    </div>

    <!-- Type Create Modal -->
    <div class="modal fade" id="createTypeModal" tabindex="-1" aria-labelledby="createTypeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTypeModalLabel">Create Type</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('event-types.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="text" class="form-label">Texto:</label>
                            <input type="color" name="text" id="text" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="background" class="form-label">Background:</label>
                            <input type="color" name="background" id="background" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="border" class="form-label">Border:</label>
                            <input type="color" name="border" id="border" class="form-control">
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
