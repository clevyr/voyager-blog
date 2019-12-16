<textarea
    @if($row->required == 1) required @endif
    class="form-control laraberg"
    name="{{ $row->field }}"
    id="{{ $row->field }}"
    rows="{{ $options->display->rows ?? 5 }}"
    style="display: none;">
    {!! old($row->field, $dataTypeContent->lb_raw_content ?? $options->default ?? '') !!}
</textarea>

<div id="VoyagerFileManager"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        Laraberg.init('{{ $row->field }}', {
            voyagerFilemanager: {
                files_route: '{{ route('voyager.media.files') }}',
                current_folder: '{{ config('voyager.media.path', '/') }}',
                csrf_token: '{{ csrf_token() }}'
            }
        });
    })
</script>
