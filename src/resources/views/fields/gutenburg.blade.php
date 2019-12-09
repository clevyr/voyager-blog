<textarea
    @if($row->required == 1) required @endif
    class="form-control laraberg"
    name="{{ $row->field }}"
    id="{{ $row->field }}"
    rows="{{ $options->display->rows ?? 5 }}"
    style="display: none;">
    {{ old($row->field, $dataTypeContent->{$row->field} ?? $options->default ?? '') }}
</textarea>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        Laraberg.init('{{ $row->field }}')
    })
</script>
