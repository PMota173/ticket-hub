@props(['id', 'title', 'message', 'confirmText' => 'Confirm', 'cancelText' => 'Cancel'])

<div id="{{ $id }}" class="fixed inset-0 z-50 hidden overflow-y-auto font-mono" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-bg/90 transition-opacity opacity-0 backdrop-blur-sm" id="{{ $id }}-backdrop"></div>

    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <!-- Modal Panel -->
        <div class="relative transform overflow-hidden rounded-none bg-surface-1 border border-border text-left transition-all sm:my-8 sm:w-full sm:max-w-lg opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" id="{{ $id }}-panel">
            <!-- Terminal Header -->
            <div class="h-8 border-b border-border bg-surface-2 flex items-center px-3 justify-between">
                <div class="flex gap-2">
                    <div class="w-2 h-2 bg-text-muted"></div>
                </div>
                <div class="text-xs text-text-muted tracking-widest uppercase">confirm_action</div>
            </div>

            <div class="bg-surface-1 px-6 pb-6 pt-6 sm:p-6 sm:pb-6">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-none bg-danger/10 sm:mx-0 sm:h-10 sm:w-10 border border-danger/50 text-danger font-bold text-lg">
                        !
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-sm font-semibold leading-6 text-text-primary uppercase tracking-widest" id="modal-title">{{ $title }}</h3>
                        <div class="mt-2">
                            <p class="text-xs text-text-secondary leading-relaxed font-sans">{{ $message }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-surface-2 border-t border-border px-6 py-4 sm:flex sm:flex-row-reverse gap-3">
                <form id="{{ $id }}-form" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex w-full justify-center items-center rounded-none bg-danger text-bg px-5 py-2.5 text-xs font-semibold hover:bg-danger/90 sm:w-auto transition-transform duration-150 hover:-translate-y-0.5 active:translate-y-0 border border-danger focus:outline-none focus:ring-1 focus:ring-danger focus:ring-offset-1 focus:ring-offset-bg uppercase tracking-wider">
                        [{{ $confirmText }}]
                    </button>
                </form>
                <button type="button" class="mt-3 inline-flex w-full justify-center items-center rounded-none bg-transparent px-5 py-2.5 text-xs font-medium text-text-secondary hover:text-text-primary sm:mt-0 sm:w-auto transition-colors duration-150 border border-border hover:border-text-secondary focus:outline-none focus:ring-1 focus:ring-border focus:ring-offset-1 focus:ring-offset-bg uppercase tracking-wider" onclick="closeModal('{{ $id }}')">
                    {{ $cancelText }}
                </button>
            </div>
        </div>
    </div>
</div>