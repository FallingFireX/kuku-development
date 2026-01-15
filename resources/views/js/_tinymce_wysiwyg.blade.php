@if (!isset($tinymceScript) || $tinymceScript)
<script>
    $(document).ready(function() {
        // 1. Create a reusable init function
        function initTinyMCE() {
            // Remove any existing instance for this selector to prevent conflicts
            tinymce.remove('{{ $tinymceSelector ?? ".wysiwyg" }}');

            tinymce.init({
                selector: '{{ $tinymceSelector ?? ".wysiwyg" }}',
                height: {{ $tinymceHeight ?? 500 }},
                menubar: false,
                convert_urls: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks fullscreen spoiler',
                    'insertdatetime media table paste {{ config('lorekeeper.extensions.tinymce_code_editor') ? 'codeeditor' : 'code' }} help wordcount'
                ],
                toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | spoiler-add spoiler-remove | removeformat | {{ config('lorekeeper.extensions.tinymce_code_editor') ? 'codeeditor' : 'code' }}',
                content_css: [
                    '{{ asset('css/app.css') }}',
                    '{{ asset('css/lorekeeper.css') }}'
                ],
                // Essential for modals: Ensures the editor doesn't get "trapped" behind the modal
                setup: function (editor) {
                    editor.on('init', function (e) {
                        console.log('Editor initialized!');
                    });
                }
            });
        }

        // 2. Trigger ONLY when the modal is fully shown
        // We use document-level delegation to catch dynamically loaded modals
        $(document).on('shown.bs.modal', function () {
            initTinyMCE();
        });

        // 3. Optional: Initial run for non-modal pages
        if ($('{{ $tinymceSelector ?? ".wysiwyg" }}').length > 0) {
            initTinyMCE();
        }
    });
</script>
@endif