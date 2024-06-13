<!-- resources/views/components/Pagination.blade.php -->

@props(['paginator'])

@if ($paginator->hasPages())
    <div class="mt-4 d-flex justify-content-center fixed-bottom">
        <ul class="pagination">
            {{-- Botão Anterior --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Primeira Página</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link text-danger" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="fa-solid fa-angles-left"></i> Anterior
                    </a>
                </li>
            @endif

            {{-- Botão Próximo --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link text-danger" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        Próximo <i class="fa-solid fa-angles-right"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Última página</span>
                </li>
            @endif
        </ul>
    </div>
@endif
