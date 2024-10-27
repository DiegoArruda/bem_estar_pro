@extends('admin.layouts.default')

@section('title', 'BemEstar Pro - Departamentos')

@section('content')
    <x-btnCreate>
        <x-slot name="route">{{ route('departments.create') }}</x-slot>
        <x-slot name="title">Cadastrar Departamento</x-slot>
    </x-btnCreate>

    <h1 class="fs-2 mb-3">Departamentos</h1>

    <p>Total de departamentos: {{ $totalDepartments }}</p>

    @if (session('success'))
        <div class="alert alert-success text-center"> {{ session('success') }}</div>
    @endif

    <x-busca>
        <x-slot name="rota">{{ route('departments.index') }}</x-slot>
        <x-slot name="tipo">Buscar departamento</x-slot>
    </x-busca>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr class="text-center">
                    <th scope="col" width="80px">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col" width="110px">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departments as $department)
                    <tr class="align-middle">
                        <th class="text-center" scope="row">{{ $department->id }}</th>
                        <td>{{ $department->name }}</td>
                        <td>
                            <a href="{{ route('departments.edit', $department->id) }}" title="Editar" class="btn btn-primary"><i class="bi bi-pen"></i></a>
                            <a href="" title="Deletar" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-delete-{{ $department->id }}"><i class="bi bi-trash"></i></a>
                            {{-- Inseri o componente modal na view --}}
                            <x-modalDelete>
                                <x-slot name="id">{{ $department->id }}</x-slot>
                                <x-slot name="tipo">departamento</x-slot>
                                <x-slot name="nome">{{ $department->name }}</x-slot>
                                <x-slot name="rota">departments.destroy</x-slot>
                            </x-modalDelete>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if ($totalDepartments != 0 && $departments->count() == 0)
            <div class="text-center alert alert-warning">Departamento não encontrado</div>
        @endif
    </div>

    <style>
        .pagination {
            justify-content: center;
        }
    </style>
    {{ $departments->links() }}
@endsection
