@props(['id', 'title', 'message', 'confirmText' => 'Confirm', 'cancelText' => 'Cancel'])

<div id="{{ $id }}" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-bg/90 transition-opacity opacity-0 backdrop-blur-sm" id="{{ $id }}-backdrop"></div>

    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <!-- Modal Panel -->
        <div class="relative transform overflow-hidden rounded-[8px] bg-surface-1 border border-border text-left shadow-[0_20px_40px_-15px_rgba(0,0,0,0.5)] transition-all sm:my-8 sm:w-full sm:max-w-lg opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" id="{{ $id }}-panel">
            <div class="bg-surface-1 px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-[6px] bg-danger/10 sm:mx-0 sm:h-10 sm:w-10 border border-danger/20">
                        <svg class="h-5 w-5 text-danger" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                        <h3 class="text-[15px] font-medium leading-6 text-text-primary" id="modal-title">{{ $title }}</h3>
                        <div class="mt-2">
                            <p class="text-[13px] text-text-secondary leading-relaxed">{{ $message }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-surface-2 border-t border-border px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 gap-3">
                <form id="{{ $id }}-form" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex w-full justify-center items-center rounded-[6px] bg-danger/10 px-4 py-2.5 text-[13px] font-medium text-danger shadow-sm hover:bg-danger hover:text-white sm:w-auto transition-colors duration-150 border border-danger/20 hover:border-danger focus:outline-none focus:ring-2 focus:ring-danger focus:ring-offset-2 focus:ring-offset-bg">
                        {{ $confirmText }}
                    </button>
                </form>
                <button type="button" class="mt-3 inline-flex w-full justify-center items-center rounded-[6px] bg-surface-2 px-4 py-2.5 text-[13px] font-medium text-text-secondary shadow-sm ring-1 ring-inset ring-border hover:bg-surface-3 hover:text-text-primary hover:ring-border-light sm:mt-0 sm:w-auto transition-all duration-150 focus:outline-none focus:ring-2 focus:ring-border-light focus:ring-offset-2 focus:ring-offset-bg" onclick="closeModal('{{ $id }}')">
                    {{ $cancelText }}
                </button>
            </div>
        </div>
    </div>
</div>
